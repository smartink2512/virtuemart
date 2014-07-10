<?php
/**
 * Created by JetBrains PhpStorm.
 * User: valerie
 * Date: 12/06/14
 * Time: 15:23
 * To change this template use File | Settings | File Templates.
 */
require_once 'PHPUnit/Autoload.php';
class plgVmPaymentRealexTest extends PHPUnit_Framework_TestCase {
	protected function setUp()
	{
		$this->setBrowser("*chrome");
		$this->setBrowserUrl("http://joomla-virtuemart.org/");
	}

	public function testMyTestCase()
	{
		$this->open("/VM2/VM2024/administrator/index.php?option=com_virtuemart&view=paymentmethod");
		$this->click("link=Cash on delivery");
		$this->waitForPageToLoad("30000");
		$this->click("css=a.chzn-single.chzn-single-with-drop > span");
		$this->click("//ul[@id='tabs']/li[2]");
		$this->click("css=span.icon-32-apply");
		$this->waitForPageToLoad("30000");
		$this->type("id=paramsmerchant_id", "virtuemart");
		$this->type("id=paramsshared_secret", "secret");
		$this->type("id=paramssubaccount", "localhost");
		$this->click("css=a.chzn-single.chzn-single-with-drop > span");
		$this->click("css=a.chzn-single.chzn-single-with-drop > span");
		$this->click("css=a.chzn-single.chzn-single-with-drop > span");
		$this->click("css=a.chzn-single.chzn-single-with-drop > span");
		$this->click("css=span.icon-32-apply");
		$this->waitForPageToLoad("30000");
		$this->click("link=View Site");
	}
}
