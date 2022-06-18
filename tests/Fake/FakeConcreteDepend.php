<?php

declare(strict_types=1);

namespace Ray\Compiler;

final class FakeConcreteDepend
{
    /**
     * @var FakeConcreteDependDepend
     */
    private $depend;

    public function __construct(FakeConcreteDependDepend $depend)
    {
        $this->depend = $depend;
    }
}
