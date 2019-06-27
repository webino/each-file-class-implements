<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUnhandledExceptionInspection
 *
 * @link        https://github.com/webino/var-export-php
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use Tester\Assert;
use Tester\Environment;

Environment::setup();


$obj = new class()
{
    use EachFileClassImplementsTrait;

    public function __invoke(): void
    {
        $this->eachFileClassImplements(
            __DIR__ . '/EachFileClassImplements',
            '~Class.php$~',
            __NAMESPACE__,
            ExampleInterface::class,
            function ($class) {
                Assert::same('Webino\ExampleClass', $class);
            }
        );
    }
};


$obj();
