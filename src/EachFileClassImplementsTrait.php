<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino/each-file-class-implements
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

/**
 * Trait EachFileClassImplementsTrait
 * @package each-file-class-implements
 */
trait EachFileClassImplementsTrait
{
    /**
     * Call callback iterating over class files matching regular expression implementing interface.
     *
     * @param string $dir Root files directory
     * @param string $regEx File matching regular expression
     * @param string $namespace Class namespace
     * @param string $interface Required class interface
     * @param callable $callback Callback
     */
    protected function eachFileClassImplements(
        string $dir,
        string $regEx,
        string $namespace,
        string $interface,
        callable $callback
    ) {
        if (is_dir($dir)) {
            $iterator = new RecursiveDirectoryRegexIterator($dir, $regEx);
            foreach ($iterator as $file) {
                $class = $namespace . '\\' . substr(basename($file), 0, -4);
                if (class_exists($class)) {
                    $implements = class_implements($class);
                    empty($implements[$interface]) or $callback($class);
                }
            }
        }
    }
}
