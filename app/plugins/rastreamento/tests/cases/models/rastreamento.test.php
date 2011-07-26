<?php
/* Rastreamento Test cases generated on: 2011-07-24 06:07:41 : 1311500861*/
App::import('Model', 'Rastreamento.Rastreamento');

class RastreamentoTestCase extends CakeTestCase {
	function startTest() {
		$this->Rastreamento =& ClassRegistry::init('Rastreamento');
	}

	function endTest() {
		unset($this->Rastreamento);
		ClassRegistry::flush();
	}

}
?>