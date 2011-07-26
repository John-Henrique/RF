<?php
/* Rastreamento Fixture generated on: 2011-07-24 06:07:33 : 1311500853 */
class RastreamentoFixture extends CakeTestFixture {
	var $name = 'Rastreamento';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 13),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'codigo' => 'Lorem ipsum',
			'email' => 'Lorem ipsum dolor sit amet',
			'modified' => '2011-07-24 06:47:33'
		),
	);
}
?>