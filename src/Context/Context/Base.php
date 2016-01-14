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
     * Validator Manager
     *
     * @var Validator\Manager
     */
    protected $validatorManager;

    /**
     * @param string $contextName
     * @param \Validator\Manager $validatorManager
     * @param \DataWrapper\DataWrapperInterface $dataWrapper
     */
    public function __construct(
        $contextName,
        Validator\Manager $validatorManager,
        DataWrapper\DataWrapperInterface $dataWrapper
    ) {
        $this->validatorManager  = $validatorManager;
        $this->name              = $contextName;
        $this->dataWrapper       = $dataWrapper;
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
    public function getValidatorManager()
    {
        return $this->validatorManager;
    }

    /**
     * Sets a validator manager
     *
     * @param Validator\Manager $validatorManager
     * @return Context\Base
     */
    public function setValidatorManager(Validator\Manager $validatorManager)
    {
        $this->validatorManager = $validatorManager;
        return $this;
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
    public function getHash()
    {
        if (!$this->hash) {
            $this->hash = $this->generateHash();
        }

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

    /**
     * {@inheritdoc}
     */
    public function validate()
    {
        return $this->validatorManager->validate($this->dataWrapper);
    }

    /**
     * Generate a unique hash
     *
     * @return string
     */
    protected function generateHash()
    {
        return sha1(uniqid(mt_rand(), true));
    }
}
