<?php
require_once(dirname(__FILE__).'/../../../init_new.php');

/**
* PHPUnit special settings :
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class XoopsXmlRpcStringTest extends \PHPUnit_Framework_TestCase
{
    protected $myclass = 'XoopsXmlRpcString';
    
    public function test___construct()
	{
		$value = 'string';
		$x = new $this->myclass($value);
		$this->assertInstanceof($this->myclass, $x);
		$this->assertInstanceof('XoopsXmlRpcTag', $x);
	}

    public function test_render()
    {
		$value = 'string';
		$instance = new $this->myclass($value);
        
        $result = $instance->render();
        $this->assertSame('<value><string>' . $instance->encode($value) . '</string></value>', $result);
    }
}
