<?php
declare(strict_types=1);

namespace Ray\Compiler;

use Ray\Di\ProviderInterface;

class FakeConcreteDependProvider implements ProviderInterface
{
    public function get(): FakeConcreteDepend
    {
        return FakeAnotherContainer::get();
    }
}
