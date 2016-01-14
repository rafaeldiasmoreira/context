<?php

namespace Context\Factory;

use Context\DataWrapper;
use Context\Context;
use Context\Validator;

interface FactoryInterface
{
    /**
     * Build the context
     *
     * @param string $contextName
     * @param DataWrapper\DataWrapperInterface $dataWrapper;
     * @return void
     */
    public function get($contextName, DataWrapper\DataWrapperInterface $dataWrapper);

    /**
     * Starts the process to overwrites a context, without the need to extend 
     * Factory class
     *
     * @return void
     */
    public function prepareOverwrite();

    /**
     * Finishes the overwrite process
     *
     * @return void
     */
    public function overwrite();

    /**
     * Set the context object for the context that is being overwriten
     *
     * @param Context\ContextInterface $context
     * @return Factory\FactoryInterface
     */
    public function setContext(Context\ContextInterface $context);

    /**
     * Set the validator manager for the context that is being overwriten
     *
     * @param Validator\ValidatorManager
     * @return void
     */
    public function setValidatorManager(Validator\ValidatorManager $validatorManager);
}
