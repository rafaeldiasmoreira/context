<?php

namespace Context\Validator;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
    private $vm;
    private $contextName = 'venture.product.create';
    private $dataWrapper;

    public function setup()
    {
        $this->vm = new ValidatorManager();
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
}
