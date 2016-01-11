<?php

namespace Context\Validator;

use Context\DataWrapper;

interface ValidatorInterface
{
    /**
     * Validate a DataWrapper
     *
     * @param DataWrapper\DataWrapperInterface $dataWrapper
     * @return bool
     */
    public function validate(DataWrapper\DataWrapperInterface $dataWrapper);
}
