<?php
class Opcao extends AppModel {

	var $name = 'Opcao';
	var $validate = array(
		'chave' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Produto' => array(
			'className' => 'Produto',
			'foreignKey' => 'produtos_id',
			'conditions' => '',
			'fields' => '',
			'order' => '', 
			'dependant'	 => true, 
            'exclusive'	 => true 
		)
	);

}
?>