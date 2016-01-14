<?php

namespace Context\Context;

use Context\Validator;
use Context\DataWrapper;

interface ContextInterface
{
    /**
     * Get the context name
     *
     * @return string
     */
    public function getName();

    /**
     * Get the datawrapper from the context
     *
     * @return DataWrapper\DataWrapperInterface
     */
    public function getDataWrapper();

    /**
     * Get hash information
     *
     * @return string
     */
    public function getHash();
    
    /**
     * Set hash information
     *
     * @param string $hash
     * @return ContextInterface
     */
    public function setHash($hash);

    /**
     * Asks for the validator manager to validate the current dataWrapper
     *
     * @return bool
     */
    public function validate();

    /**
     * Get the current validator manager
     *
     * @return Validator\Manager
     */
    public function getValidatorManager();
}
