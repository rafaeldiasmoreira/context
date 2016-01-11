<?php

namespace Context\Factory;

use Context\DataWrapper;

interface FactoryInterface
{
    /**
     * This would be used to rebuild an context with the same properties, usually
     * sent by another service/server
     *
     * @param \Context\Context\ContextInterface $context
     * @return \Context\Context\ContextInterface
     */
    public function reconstruct($context);

    /**
     * Build the context
     *
     * @param string $contextName
     * @param DataWrapper\DataWrapperInterface $dataWrapper;
     * @return void
     */
    public function build($contextName, DataWrapper\DataWrapperInterface $dataWrapper);
}
