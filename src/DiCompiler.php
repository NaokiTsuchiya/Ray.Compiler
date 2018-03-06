<?php
/**
 * This file is part of the Ray.Compiler package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\Compiler;

use Ray\Di\AbstractModule;
use Ray\Di\Container;
use Ray\Di\Injector;
use Ray\Di\InjectorInterface;
use Ray\Di\Name;

final class DiCompiler implements InjectorInterface
{
    const POINT_CUT = '/metas/pointcut';

    /**
     * @var string
     */
    private $scriptDir;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var DependencyCode
     */
    private $dependencyCompiler;

    /**
     * @var Injector
     */
    private $injector;

    /**
     * @var AbstractModule|null
     */
    private $module;

    /**
     * @var DependencySaver
     */
    private $dependencySaver;

    /**
     * @param AbstractModule $module
     * @param string         $scriptDir
     */
    public function __construct(AbstractModule $module = null, $scriptDir = '')
    {
        $this->scriptDir = $scriptDir ?: \sys_get_temp_dir();
        $this->container = $module ? $module->getContainer() : new Container;
        $this->injector = new Injector($module, $scriptDir);
        $this->dependencyCompiler = new DependencyCode($this->container);
        $this->module = $module;
        $this->dependencySaver = new DependencySaver($scriptDir);
    }

    /**
     * {@inheritdoc}
     */
    public function getInstance($interface, $name = Name::ANY)
    {
        $instance = $this->injector->getInstance($interface, $name);
        $this->compile();

        return $instance;
    }

    /**
     * Compile all dependencies in container
     */
    public function compile() : void
    {
        $container = $this->container->getContainer();
        foreach ($container as $dependencyIndex => $dependency) {
            $code = $this->dependencyCompiler->getCode($dependency);
            $this->dependencySaver->__invoke($dependencyIndex, $code);
        }
        $this->savePointcuts($this->container);
    }

    public function dumpGraph() : void
    {
        $dumper = new GraphDumper($this->container, $this->scriptDir);
        $dumper();
    }

    private function savePointcuts(Container $container) : void
    {
        $ref = (new \ReflectionProperty($container, 'pointcuts'));
        $ref->setAccessible(true);
        $pointcuts = $ref->getValue($container);
        \file_put_contents($this->scriptDir . self::POINT_CUT, \serialize($pointcuts));
    }
}
