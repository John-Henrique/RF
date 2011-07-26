<?php

/*
 * @author    Paulo Freitas <v1d4l0k4@gmail.com>
 * @copyright Copyright (C) 2009-2010  Paulo Freitas
 * @license   http://creativecommons.org/licenses/by-sa/3.0
 */



class FreteComponent extends Object 
{
	
	
	
	
    /*
     * Servi�os
     */
    const SERVICO_ESEDEX       = 81019;
    const SERVICO_MALOTE       = 44105;
    const SERVICO_PAC          = 41106;
    const SERVICO_SEDEX        = 40010;
    const SERVICO_SEDEX10      = 40215;
    const SERVICO_SEDEXACOBRAR = 40045;
    const SERVICO_SEDEXHOJE    = 40290;

    var $Erro;
    var $MsgErro;
    
    var $api_url =
        'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

    var $entrada = array(
        'nCdEmpresa'          => '',
        'sDsSenha'            => '',
        'nCdServico'          => 40010,
        'sCepOrigem'          => '',
        'sCepDestino'         => '',
        'nVlPeso'             => 0,
        'nCdFormato'          => 1,
        'nVlComprimento'      => 0,
        'nVlAltura'           => 0,
        'nVlLargura'          => 0,
        'nVlDiametro'         => 0,
        'sCdMaoPropria'       => 'N',
        'nVlValorDeclarado'   => 0,
        'sCdAvisoRecebimento' => 'N'
    );
    var $saida;

    
    
   	function pre( )
   	{
   		
   		$entrada = $this->entrada;
   		foreach ( $entrada as $chave => $value)
	    {
	    	
	    	$this->entrada[ $chave ] = r( '.', ',', $value );
	    }
   	}
    
    
    
    function requisicao( $envio_maximo = null )
    {
    	
    	/**
    	 * Trata possiveis erros como . ao invés de ,
    	 */
    	$this->pre( );
    	
    	
    	
    	App::import( "Xml" );
    	
    	$this->entrada['StrRetorno'] = 'xml';
    	$target = html_entity_decode( ( $this->api_url .'?'. http_build_query( $this->entrada ) ) );
    	
    	$xml = new XML( $target );
    	
    	//print_r( $this->api_url .'?'. http_build_query( $this->entrada ) ."<br>" );

    	
    	$arrFrete = Set::reverse( $xml );
    	$arrFrete['Servicos']['CServico']['envio_maximo'] = $envio_maximo;

    	    	
    	
    	
    	//debug( $arrFrete );
    	return $this->processa( $arrFrete );
    	
    }
    
    
    
    
    function processa( $arrObj )
    {
    	
    	/**
    	 * Atalho para acessar os Arrays
    	 */
    	$frete = $arrObj['Servicos']['CServico'];
    	
    	/**
    	 * Corrigindo valor
    	 */
    	$frete['Valor'] = str_replace( ',', '.', $frete['Valor'] );
    	$frete['ValorAvisoRecebimento'] = str_replace( ',', '.', $frete['ValorAvisoRecebimento'] );
    	$frete['ValorMaoPropria'] = str_replace( ',', '.', $frete['ValorMaoPropria'] );
    	$frete['nVlValorDeclarado'] = str_replace( ',', '.', $this->entrada['nVlValorDeclarado'] );
    	
    	// facilitando manipular dados
    	$frete['quantidade'] = $this->entrada['quantidade'];

    	
    	/**
    	 * Corrigindo valor declarado
    	 */
    	$frete['ValorValorDeclarado'] = r( ',', '.', $frete['ValorValorDeclarado'] );
    	
    	/**
    	 * Corrigindo o prazo de entrega
    	 */
    	$frete['PrazoEntrega'] = ( $frete['PrazoEntrega'] > 1 )? $frete['PrazoEntrega'] ." dias úteis": $frete['PrazoEntrega'] ." dia útil";

    	
    	  		
    	/**
    	 * Adicionando recurso para calcular 
    	 * de acordo com a quantidade por encomenda
    	 * 
    	 * qtn 6
    	 * max 3
    	 */
    	if( ($frete['quantidade'] > 1 ) && ($frete['quantidade'] > $frete['envio_maximo']) )
    	{
    		$frete['maximo'] = ceil($this->entrada['quantidade'] / $frete['envio_maximo']);
    		//$frete['quantidade'] = ceil($frete['quantidade'] / $frete['envio_maximo']);
    		
    		$frete['frete_correto'] = $frete['Valor'] * $frete['maximo'];
    		
    	}else{
    		$frete['maximo'] = $frete['quantidade'];
    		
    		$frete['frete_correto'] = $frete['Valor'];
    	}
    	
    	
    	/**
    	 * Adicionando total frete * quantidade + valor
    	 */
    	//$frete['total'] = ( $frete['Valor'] + $frete['nVlValorDeclarado'] );
    	$frete['total'] = ( $frete['frete_correto'] + $frete['nVlValorDeclarado'] ) * $frete['quantidade'];
    	
    	
    	
    	/**
    	 * Total do produto com seguro
    	 */
    	$frete['seguro'] = $frete['total'] + $frete['ValorValorDeclarado'];
    	
    	
    	/**
    	 * Total frete com seguro
    	 */
    	$frete['freteSeguro'] = $frete['ValorValorDeclarado'] + $frete['Valor'];
    	
    	
    	$frete['valor'] = $this->entrada['nVlValorDeclarado'];
    	
    	
    	//debug( $frete );
    	
    	return $frete;
    	
    }
    
    
    
        

    
    
    function calcula( $arrCampos, $servico = 41106 )
    {
		 
    	$arrCampos['formato'] = ( empty( $arrCampos['formato'] ) )? 1: $arrCampos['formato'];
    	
    	
    	
    	
			$this->nCdServico     = $servico;
			$this->sCepOrigem     = $arrCampos['cep'];
			$this->sCepDestino    = $arrCampos['cepdestino'];
			$this->nVlPeso        = $arrCampos['peso'];
			$this->nVlComprimento = $arrCampos['comprimento'];
			$this->nVlAltura      = $arrCampos['altura'];
			$this->nVlLargura     = $arrCampos['largura'];
			$this->nCdFormato     = $arrCampos['formato'];
			$this->nVlValorDeclarado = r( '.', ',', $arrCampos['valor'] );
			
			
				 $html  = "<tr>";
				 $html .= 	"<td><h3>SEDEX</h3>";
				 $html .=	"O prazo de entrega é de ". $this->PrazoEntrega ." dias úteis</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( $this->Valor ) ."</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( ( $this->Valor + $arrCampos['valor'] ), $arrCampos['quantidade'] ) ."</td>";
				 $html .= "</tr>";
				 
				 return $html;			
		
    }

}




?>
