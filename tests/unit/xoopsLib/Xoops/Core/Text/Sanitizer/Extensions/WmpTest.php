<?php
namespace Xoops\Core\Text\Sanitizer\Extensions;

use Xoops\Core\Text\Sanitizer;

require_once __DIR__.'/../../../../../../init_new.php';

/**
 * PHPUnit special settings :
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class WmpTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Wmp
     */
    protected $object;

    /**
     * @var Sanitizer
     */
    protected $sanitizer;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->sanitizer = Sanitizer::getInstance();
        $this->object = new Wmp($this->sanitizer);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testContracts()
    {
        $this->assertInstanceOf('\Xoops\Core\Text\Sanitizer\ExtensionAbstract', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Text\Sanitizer\SanitizerComponent', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Text\Sanitizer\SanitizerConfigurable', $this->object);
    }

    /**
     * @covers Xoops\Core\Text\Sanitizer\Extensions\Wmp::getDhtmlEditorSupport
     */
    public function testGetDhtmlEditorSupport()
    {
        $support = $this->object->getDhtmlEditorSupport('testeditorarea');
        $this->assertTrue(2 == count($support));
        $this->assertTrue(is_string($support[0]));
        $this->assertTrue(is_string($support[1]));
    }

    /**
     * @covers Xoops\Core\Text\Sanitizer\Extensions\Wmp::registerExtensionProcessing
     */
    public function testRegisterExtensionProcessing()
    {
        $this->sanitizer->enableComponentForTesting('wmp');
        $this->assertTrue($this->sanitizer->getShortCodes()->hasShortcode('wmp'));
        $expected = '<object ';

        $in = '[wmp=300,200]wmp://url[/wmp]';
        $actual = trim($this->sanitizer->filterForDisplay($in));
        $this->assertTrue(is_string($actual));
        $this->assertEquals($expected, substr($actual, 0, strlen($expected)));
    }
}
