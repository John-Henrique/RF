<?php
class Codigo extends AppModel {

	var $name = 'Codigo';
	var $validate = array(
		'users_id' => array('numeric'),
		'codigo' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'users_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/*
		'Aviso' => array( 
			'className' => 'Aviso', 
			'foreignKey' => 'codigos_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		*/
	);
	
	
	
	var $hasMany = array(
		'Aviso' => array( 
			'className' => 'Aviso', 
			'foreignKey' => 'codigos_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>