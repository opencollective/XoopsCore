<?php
require_once(dirname(__FILE__).'/../../../../../../init_new.php');

/**
* PHPUnit special settings :
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class Plugins_Xoops_codeTest extends \PHPUnit_Framework_TestCase
{
    protected $buffer = null;
       
    public function output_callback($buffer, $flags)
    {
        $this->buffer = $buffer;
        return '';
    }

    public function test_100()
    {
        $xoops_root_path = \XoopsBaseConfig::get('root-path');
		ob_start(array($this,'output_callback')); // to catch output after ob_end_flush in Xoops::simpleFooter
		require($xoops_root_path.'/class/xoopseditor/tinymce/tiny_mce/plugins/xoops_code/xoops_code.php');
		ob_get_clean();
		$this->assertTrue(is_string($this->buffer));
    }
}
