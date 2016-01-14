<?php

namespace Context\Validator;

use Context\DataWrapper;

class Manager 
{
    /**
     * List of attached validators
     *
     * @var \SplObjectStorage
     */
    protected $validators;

     /**
      * Get the list of validators attached to the context
      *
      * @return \SplObjectStorage
      */
    public function getValidators()
    {
        return $this->validators;
    }

     /**
      * Attach a new validator the context
      *
      * @param Validator\ValidatorInterface $validator
      * @return ContextInterface
      */
    public function attachValidator(ValidatorInterface $validator)
    {
        $this->validators->attach($validator);
    }

     /**
      * Detach a validator from the context
      *
      * @param Validator\ValidatorInterface $validator
      * @return void
      */
    public function detachValidator(ValidatorInterface $validator)
    {
        $this->validators->detach($validator);
    }

    /**
     * Validate a dataWrapper
     *
     * @param DataWrapper\DataWrapperInterface
     * @return bool
     */
    public function validate(DataWrapper\DataWrapperInterface $dataWrapper)
    {
        foreach ($this->validators as $validator) {
            if (!$this->validator->validate($dataWrapper)) {
                return false;
            }   
        }
    }
}
