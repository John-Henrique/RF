<?php


class BotaoComponent extends Object  
{
	
	

	
	/**
	 * Reservada para retorno de métodos
	 *
	 * @var Arrays
	 */
	public $get = null;

	
	
	/**
	 * O endereço para a pasta do plugin
	 *
	 * @var String
	 */
	protected $plugin_dir = null;
	
	
	
	
	
	
	function listar( $strCor = "" )
	{
		
		/**
		 * Se status estiver definido uma cor será escolhida
		 */
		if( $strCor == "todas" ){ $strCor = ""; }
		
		return  glob( "img/botoes/*". ucfirst( $strCor ) ."{.jpg,.png}", GLOB_BRACE  );
	}

	
	
	

	
}

?>