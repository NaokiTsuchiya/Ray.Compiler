<?php
declare(strict_types=1);

namespace Ray\Compiler;

class FakeAnotherContainer
{
    private static $service;

    public static function get(): FakeConcreteDepend
    {
        if (self::$service === null) {
            self::$service = new FakeConcreteDepend(new FakeConcreteDependDepend(new FakeRobot()));
        }

        return self::$service;
    }
}
