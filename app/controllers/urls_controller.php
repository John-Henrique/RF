<?php 

class UrlsController extends AppController 
{
	
	var $uses = array('Frete');
	
	
	
	
	function teste()
	{
		
		$this->set( 'fretes', $this->Frete->read( array(
			'conditions' => array( 
				'nVlPeso' => 1,
				'nCdServico' => 40010,
				'sCepOrigem' => 78300000,
				'sCepDestino' => 75860000,
				
			)
		) ) );
		
		
	}
	
	
	
	function index()
	{
		
		$this->set( 'fretes', $this->redirect( array( 'action' => 'url' ) ) );
	}	
	
	
	
	
	function url()
	{
		
		$id = $this->params["url"]["id"];
		
		
		$this->redirect( array( 'controller' => 'produtos', 'action' => 'frete', $this->params["url"]["id"] ), 301, true);
	}
	
	
	
	
	/**
	 * redirecionar imagens de botoes da estrutura WordPress
	 *
	 */
	function botoes( $str = null )
	{
		
		$this->redirect( array( 'controller' => 'img', 'action' => 'botoes', $str ) );
	}
	
}

?>