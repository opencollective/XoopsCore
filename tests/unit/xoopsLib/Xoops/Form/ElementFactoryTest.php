<?php
namespace Xoops\Form;

require_once(dirname(__FILE__).'/../../../init_new.php');

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-08-18 at 21:59:24.
 */

/**
 * PHPUnit special settings :
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */

class ElementFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ElementFactory
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ElementFactory;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }


    public function testConst()
    {
        $this->assertTrue(defined('\Xoops\Form\ElementFactory::CLASS_KEY'));
        $this->assertTrue(defined('\Xoops\Form\ElementFactory::FORM_KEY'));
    }

    /**
     * @covers Xoops\Form\ElementFactory::create
     * @covers Xoops\Form\ElementFactory::validateSpec
     */
    public function testCreate()
    {
        $spec = [
            ElementFactory::CLASS_KEY => 'Raw',
            'value' => 'myvalue',
        ];
        $actual = $this->object->create($spec);
        $this->assertInstanceOf('\Xoops\Form\Raw', $actual);
    }

    /**
     * @covers Xoops\Form\ElementFactory::validateSpec
     * @expectedException \DomainException
     */
    public function testValidateException1()
    {
        $value = $this->object->create([]);
    }

    /**
     * @covers Xoops\Form\ElementFactory::validateSpec
     * @expectedException \DomainException
     */
    public function testValidateException2()
    {
        $spec = [
            ElementFactory::CLASS_KEY => 'NoSuchClassExists',
        ];
        $value = $this->object->create($spec);
    }

    /**
     * @covers Xoops\Form\ElementFactory::validateSpec
     * @expectedException \DomainException
     */
    public function testValidateException3()
    {
        $spec = [
            ElementFactory::CLASS_KEY => '\ArrayObject',
        ];
        $value = $this->object->create($spec);
    }

    /**
     * @covers Xoops\Form\ElementFactory::create
     * @covers Xoops\Form\ElementFactory::setContainer
     * @covers Xoops\Form\ElementFactory::validateSpec
     */
    public function testSetContainer()
    {
        $container = new ElementTray([]);
        $this->object->setContainer($container);

        $spec = new \ArrayObject([
            ElementFactory::CLASS_KEY => 'Raw',
            'value' => 'myvalue',
        ]);
        $actual = $this->object->create($spec);
        $this->assertInstanceOf('\Xoops\Form\Raw', $actual);
        $this->assertArrayHasKey(ElementFactory::FORM_KEY, $spec);
        $this->assertSame($container, $spec[ElementFactory::FORM_KEY]);
    }
}
