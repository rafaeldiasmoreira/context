<?php

namespace Context\Context;

use Context\Validator;
use Context\DataWrapper;

class Base implements ContextInterface
{
    /**
     * Context name
     *
     * @var string
     */
    protected $name;

    /**
     * Hash to identify an operation using this context
     *
     * @var string
     */
    protected $hash;
    
    /**
     * DataWrapper
     *
     * @var DataWrapper\DataWrapperInterface
     */
    protected $dataWrapper;

    /**
     * List of validators attached to the context
     *
     * @var \SplObjectStorage
     */
    protected $validators;

    /**
     * @param string $contextName
     * @param \Context\DataWrapper\DataWrapperInterface $dataWrapper
     */
    public function __construct(
        $contextName,
        \Context\DataWrapper\DataWrapperInterface $dataWrapper
    ) {
        $this->validators  = new \SplObjectStorage;
        $this->name        = $contextName;
        $this->dataWrapper = $dataWrapper;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataWrapper()
    {
        return $this->dataWrapper;
    }

    /**
     * {@inheritdoc}
     */
    public function setDataWrapper(DataWrapper\DataWrapperInterface $dataWrapper)
    {
        $this->dataWrapper = $dataWrapper;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidators()
    {
        return $this->validators;
    }

    /**
     * {@inheritdoc}
     */
    public function attachValidator(Validator\ValidatorInterface $validator)
    {
        $this->validators->attach($validator);
    }

    /**
     * {@inheritdoc}
     */
    public function detachValidator(Validator\ValidatorInterface $validator)
    {
        $this->validators->detach($validator);
    }

    /**
     * {@inheritdoc}
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * {@inheritdoc}
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }
}
