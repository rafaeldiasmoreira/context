<?php

namespace Context\Context;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    private $context;
    private $contextName = 'venture.product.create';
    private $dataWrapper;

    public function setup()
    {
        $this->dataWrapper  = $this->getMock('Context\DataWrapper\DataWrapperInterface');
        $this->context = new Base($this->contextName, $this->dataWrapper);
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

    public function testGetValidators()
    {
        $this->assertInstanceOf(
            'SplObjectStorage', 
            $this->context->getValidators()
        );
    }

     public function testAttachValidator()
     {
         $validator = $this->getMock('Context\Validator\ValidatorInterface');
         $this->context->attachValidator($validator);
         $validators = $this->context->getValidators();

         $this->assertTrue($validators->contains($validator));
     }

    public function testDetachValidators()
    {
         $validator = $this->getMock('Context\Validator\ValidatorInterface');

         $this->context->attachValidator($validator);
         $this->assertTrue($this->context->getValidators()->contains($validator));

         $this->context->detachValidator($validator);
         $this->assertFalse($this->context->getValidators()->contains($validator));
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
}
