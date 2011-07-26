<?php
/* Rastreamentos Test cases generated on: 2011-07-24 06:07:02 : 1311501182*/
App::import('Controller', 'Rastreamento.Rastreamentos');

class TestRastreamentosController extends RastreamentosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class RastreamentosControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->Rastreamentos =& new TestRastreamentosController();
		$this->Rastreamentos->constructClasses();
	}

	function endTest() {
		unset($this->Rastreamentos);
		ClassRegistry::flush();
	}

}
?>