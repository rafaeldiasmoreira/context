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
      * Get the list of validators attached to the context
      *
      * @return \SplObjectStorage
      */
    public function getValidators();

     /**
      * Attach a new validator the context
      *
      * @param Validator\ValidatorInterface $validator
      * @return ContextInterface
      */
    public function attachValidator(Validator\ValidatorInterface $validator);

     /**
      * Detach a validator from the context
      *
      * @param Validator\ValidatorInterface $validator
      * @return void
      */
    public function detachValidator(Validator\ValidatorInterface $validator);

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
}
