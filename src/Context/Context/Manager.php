<?php

namespace Context\Context;

use Context\Factory;
use Context\DataWrapper;

class Manager
{
    /**
     * List of registered Contexts
     *
     * @var array
     */
    private $contexts = [];

    /**
     * Factory responsible to create the ContextObject
     *
     * @var Factory\FactoryInterface
     */
    private $factory;

    /**
     * @param Factory\FactoryInterface $factory
     * @return void
     */
    public function __construct(Factory\FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Get the current factory
     *
     * @return void
     */
    public function getFactory()
    {
        return $this->factory;
    }
     
    /**
     * Sets a new factory class
     *
     * @param Factory\FactoryInterface
     * @return Context\Manager
     */
    public function setFactory(Factory\FactoryInterface $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * Get generate the context
     *
     * @param string $contextName
     * @param DataWrapper\DataWrapperInterface $dataWrapper
     * @return void
     */
    public function get($contextName, DataWrapper\DataWrapperInterface $dataWrapper)
    {
        if (!isset($this->contexts[$contextName])) {
            $this->contexts[$contextName] = $this->getFactory()
                ->build($contextName, $dataWrapper);
        }

        return $this->contexts[$contextName];
    }
}
