<?php



App::import( 'Core', 'HttpSocket' );


class FreteSource extends DataSource 
{
	
	
	
	protected $_schema = array(
		'fretes' => array(
			
	        'nCdEmpresa' => array(
	        	'type' => 'integer',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 10
	        ),
	        'sDsSenha' => array(
	        	'type' => 'integer',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 10
	        ),
	        'nCdServico' => array(
	        	'type' => 'integer',
	        	'null' => false,
	        	'key' => 'primary',
	        	'length' => 5
	        ),
	        'sCepOrigem' => array(
	        	'type' => 'integer',
	        	'null' => false,
	        	'key' => 'primary',
	        	'length' => 8
	        ),
	        'sCepDestino' => array(
	        	'type' => 'integer',
	        	'null' => false,
	        	'key' => 'primary',
	        	'length' => 8
	        	//78300000
	        ),
	        'nVlPeso' => array(
	        	'type' => 'integer',
	        	'null' => false,
	        	'key' => 'primary',
	        	'length' => 10
	        ),
	        'nCdFormato' => array(
	        	'type' => 'integer',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 1
	        ),
	        'nVlComprimento' => array(
	        	'type' => 'integer',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 10
	        ),
	        'nVlAltura' => array(
	        	'type' => 'integer',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 10
	        ),
	        'nVlLargura' => array(
	        	'type' => 'integer',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 10
	        ),
	        'nVlDiametro' => array(
	        	'type' => 'integer',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 10
	        ),
	        'sCdMaoPropria' => array(
	        	'type' => 'string',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 1
	        ),
	        'nVlValorDeclarado' => array(
	        	'type' => 'integer',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 10
	        ),
	        'sCdAvisoRecebimento' => array(
	        	'type' => 'string',
	        	'null' => true,
	        	'key' => 'primary',
	        	'length' => 1
	        ),

		)
	);
	
	
	
	public function __construct($config)
	{
		
		$this->conection = new HttpSocket(
			'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx'
		);
		
		parent::__construct($config);
	}
	
	
	
	public function read( $queryData = array())
	{
 		
		if( !isset($queryData['conditions']['nCdServico']))
		{
			$queryData['conditions']['nCdServico'] = 40051;
		}
		
		return $queryData;
	}
	
	
	
	public function listSources()
	{
		return array('fretes');
	}
	
	
	
	public function describe(&$model)
	{
		return $this->_schema['fretes'];
	}
	
	
}

?>