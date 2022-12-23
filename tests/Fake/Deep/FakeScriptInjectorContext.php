<?php

declare(strict_types=1);

namespace Ray\Compiler\Deep;


use Doctrine\Common\Cache\CacheProvider;
use Ray\Compiler\AbstractInjectorContext;
use Ray\Compiler\Annotation\Compile;
use Ray\Compiler\DiCompileModule;
use Ray\Di\AbstractModule;
use Ray\Di\NullCache;
use Ray\Di\Scope;

final class FakeScriptInjectorContext extends AbstractInjectorContext
{
    public function __invoke(): AbstractModule
    {
        return new FakeDepModule();
    }

    public function getCache(): CacheProvider
    {
       return new NullCache();
    }
}
