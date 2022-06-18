<?php

declare(strict_types=1);

namespace Ray\Compiler;

final class FakeConcrete
{
    /**
     * @var FakeConcreteDepend
     */
    private $robot;

    public function __construct(FakeConcreteDepend $robot)
    {
        $this->robot = $robot;
    }
}
