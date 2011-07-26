<?php
class Rastreamento extends RastreamentoAppModel {
	var $name = 'Rastreamento';
	var $displayField = 'codigo';
	var $validate = array(
		'codigo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minlength' => array(
				'rule' => array('minlength', 13),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxlength' => array(
				'rule' => array('maxlength', 13),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Você precisa informar um email válido',
				'allowEmpty' => true,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	
	
	
	public function afterFind( $arrData )
	{
		
		foreach( $arrData as $chave => $valor )
		{

			// se existir e houver valor
			if( isset( $valor['Rastreamento']['identificacao'] ) && empty( $valor['Rastreamento']['identificacao'] ) )
			{
				
				$arrData[ $chave ]['Rastreamento']['identificacao'] = '---------';
			}
			
			// se existir e houver valor
			if( isset( $valor['Rastreamento']['situacao'] ) && empty( $valor['Rastreamento']['situacao'] ) )
			{
				
				$arrData[ $chave ]['Rastreamento']['situacao'] = '---------';
			}
		}
		
		
		
		// desativa rastreamentos com mais de 10 meses
		$this->desativa();
		
		
		return $arrData;
	}
	
	
	
	public function afterSave( $arrData = null )
	{
		
		// desativa rastreamentos com mais de 10 meses
		//$this->desativa();
		
		
		
		
		return true;
	}
	
	
	
	
	/**
	 * Códigos de rastreamento com mais de 
	 * 10 meses são desativados automaticamente
	 *
	 */
	public function desativa()
	{
		/**
		 * Códigos com mais de 10 meses 
		 * são desativados do rastreamento
		 */
		$this->updateAll( array(
			'Rastreamento.flag' => 1, //1 para entregue | 1 para de rastrear
		), array(
			"PERIOD_DIFF( DATE_FORMAT( NOW( ), '%Y%m' ), DATE_FORMAT( Rastreamento.modified, '%Y%m' ) ) >= 10", 
			'Rastreamento.flag' => 0
		));
	}
	
	
	
}
?>