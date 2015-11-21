<?php

namespace AppBundle\Tests\Validator\Constraints;

use AppBundle\Validator\Constraints\Pesel;
use AppBundle\Validator\Constraints\PeselValidator;

/**
 * Class PeselValidatorTest
 */
class PeselValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $constraint;
    private $context;
    
    public function setUp()
    {
        $this->constraint = new Pesel();
        $this->context = $this->getMockBuilder('Symfony\Component\Validator\ExecutionContext')->disableOriginalConstructor()->getMock();
    }
    
    public function testValidate()
    {
        $validator = new PeselValidator();
        $validator->initialize($this->context);

        $this->context->expects($this->once())
            ->method('addViolation')
            ->with($this->constraint->message, array());
        $validator->validate('81090104436', $this->constraint);
    }

    public function tearDown()
    {
        $this->constraint = null;
    }

}
