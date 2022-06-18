<?php
declare(strict_types=1);

namespace Ray\Compiler;

use Ray\Di\AbstractModule;

class FakeUntargetedWithProviderModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(FakeConcrete::class);
        $this->bind(FakeConcreteDepend::class)->toProvider(FakeConcreteDependProvider::class);
    }
}
