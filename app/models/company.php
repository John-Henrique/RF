<?php

class Company extends AppModel {

	public $name = 'Company';
  public $useDbConfig = 'imap';
  public $useTable = false;
  public $displayField = "subject";


  //Model::exists()  must return true
  function exists($reset = false) 
  {
    return true;
  }

}



/*
	Como chamar a função
	$emails = $this->CompanyEmail->find('all', array(
	
		'order' => array('message_date' => 'DESC')
	)
*/
?>