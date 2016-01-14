<?php

namespace Context\Context;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    private $context;
    private $validatorManager;
    private $contextName = 'venture.product.create';
    private $dataWrapper;

    public function setup()
    {
        $this->dataWrapper      = $this->getMock('Context\DataWrapper\DataWrapperInterface');
        $this->validatorManager = $this->getMock('Context\Validator\Manager');
        $this->context = new Base(
            $this->contextName,
            $this->validatorManager, 
            $this->dataWrapper
        );
    }

    public function testGetName()
    {
        $this->assertSame(
            $this->contextName,
            $this->context->getName()
        );
    }

    public function testGetDataWrapper()
    {
        $this->assertSame(
            $this->dataWrapper,
            $this->context->getDataWrapper()
        );
    }

    public function testSetDataWrapper()
    {
        $dataWrapper  = $this->getMock('Context\DataWrapper\DataWrapperInterface');
        $this->assertSame(
            $this->context,
            $this->context->setDataWrapper($dataWrapper)
        );

        $this->assertSame(
            $dataWrapper, 
            $this->context->getDataWrapper()
        );
    }

    public function testGetValidatorManager()
    {
        $this->assertSame(
            $this->validatorManager,
            $this->context->getValidatorManager()
        );
    }

    public function testValidate()
    {
        $this->validatorManager
            ->expects($this->once())
            ->method('validate')
            ->willReturn(true);

        $this->assertTrue($this->context->validate());
    }

    public function testGetAndSetHash()
    {
        $hash = rand(1,99999);
        $this->assertSame(
            $this->context,
            $this->context->setHash($hash)
        );

        $this->assertSame(
            $hash, 
            $this->context->getHash()
        );
    }

    public function testGetRandomHash()
    {
        $this->assertSame(
            40,
            strlen($this->context->getHash())
        );
    }
}
