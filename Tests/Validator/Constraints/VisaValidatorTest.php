<?php
namespace Pixelavengers\Bundle\ExtraValidatorBundle\Tests\Validator\Constraints;

use Pixelavengers\Bundle\ExtraValidatorBundle\Validator\Constraints\Visa;
use Pixelavengers\Bundle\ExtraValidatorBundle\Validator\Constraints\VisaValidator;

class VisaValidatorTest extends \PHPUnit_Framework_TestCase
{
    protected $validator;

    protected function setUp()
    {
        $this->validator = new VisaValidator();
    }

    protected function tearDown()
    {
        $this->validator = null;
    }

    public function testNullIsValid()
    {
        $this->assertTrue($this->validator->isValid(null, new Visa()));
    }

    public function testEmptyStringIsValid()
    {
        $this->assertTrue($this->validator->isValid('', new Visa()));
    }

    /**
     * @expectedException Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->isValid(new \stdClass(), new Visa());
    }

    /**
     * @dataProvider getValidVisas
     */
    public function testValidVisas($visa)
    {
        $this->assertTrue($this->validator->isValid($visa, new Visa()));
    }

    public function getValidVisas()
    {
        return array(
            array('4548812049400004'),
        );
    }

    /**
     * @dataProvider getInvalidVisas
     */
    public function testInvalidVisas($visa)
    {
        $this->assertFalse($this->validator->isValid($visa, new Visa()));
    }

    public function getInvalidVisas()
    {
        return array(
            array('4548813149400013'),
        );
    }
}