<?php
class Aviso extends AppModel {

	var $name = 'Aviso';
	var $validate = array(
		'codigos_id' => array('numeric'),
		'users_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Codigo' => array(
			'className' => 'Codigo',
			'foreignKey' => 'codigos_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'users_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	//var $hasOne = 'Codigo';
	
	

}
?>