<?php

declare(strict_types=1);

namespace Ray\Compiler;

class FakeConcreteDependDepend
{
    /**
     * @var FakeRobotInterface
     */
    private $robot;

    public function __construct(FakeRobotInterface $robot)
    {
        $this->robot = $robot;
    }
}
