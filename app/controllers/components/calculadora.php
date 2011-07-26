<?php

class CalculadoraComponent extends Object 
{

	var $components = array( 'Frete' );
	
	var $get;
	
	var $ativar = false;
	

	
	function __construct()
	{
		
		$this->tratamento();
		
		$this->voltar();
		
		$this->verifica();
	}
	
	
	
	function verifica()
	{
		
		if( ( !empty( $arrCampos['cepOrigem'] ) ) && ( !empty( $arrCampos['cepDestino'] ) ) && ( !empty( $arrCampos['valor'] ) ) && ( !empty( $arrCampos['peso'] ) ) )
		{
			
			$this->ativar = true;
		}else{
			
			$this->ativar = false;
		}
	}
	
	
	

	function sedex( $arrCampos )
	{
	
		/**
		 * SEDEX
		 
		try {
			
			
			$this->Frete->nCdServico     = EncomendasCorreios::SERVICO_SEDEX;
			$this->Frete->sCepOrigem     = $arrCampos['cepOrigem'];
			$this->Frete->sCepDestino    = $arrCampos['cepDestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			$this->Frete->nVlComprimento = $arrCampos['comprimento'];
			$this->Frete->nVlAltura      = $arrCampos['altura'];
			$this->Frete->nVlLargura     = $arrCampos['largura'];
			$this->Frete->nCdFormato     = $arrCampos['formato'];
			$this->Frete->nVlValorDeclarado = $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {
				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>SEDEX</h3>";
				 $html .=	"O prazo de entrega é de ". $this->Frete->PrazoEntrega ." dias úteis</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( $this->Frete->Valor ) ."</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( ( $this->Frete->Valor + $arrCampos['valor'] ), $arrCampos['quantidade'] ) ."</td>";
				 $html .= "</tr>";
				 
				 return $html;
			}
		} catch (Exception $e) {
			return  "Erro: {$e->getMessage() } <BR><BR>";
		}
		*/
			
			$this->Frete->nCdServico     = 40010;
			$this->Frete->sCepOrigem     = $arrCampos['cep'];
			$this->Frete->sCepDestino    = $arrCampos['cepdestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			$this->Frete->nVlComprimento = $arrCampos['comprimento'];
			$this->Frete->nVlAltura      = $arrCampos['altura'];
			$this->Frete->nVlLargura     = $arrCampos['largura'];
			$this->Frete->nCdFormato     = $arrCampos['formato'];
			$this->Frete->nVlValorDeclarado = $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {
				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>SEDEX</h3>";
				 $html .=	"O prazo de entrega é de ". $this->Frete->PrazoEntrega ." dias úteis</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( $this->Frete->Valor ) ."</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( ( $this->Frete->Valor + $arrCampos['valor'] ), $arrCampos['quantidade'] ) ."</td>";
				 $html .= "</tr>";
				 
				 return $html;
			}
	}

	
	
	
	function esedex( $arrCampos )
	{
	
			
			echo $this->Frete->nCdEmpresa     = Configure::read( "Ect.cCdEmpresa" );
			$this->Frete->sDsSenha	     = Configure::read( "Ect.sDsSenha" );
			$this->Frete->nCdServico     = EncomendasCorreios::SERVICO_ESEDEX;
			$this->Frete->sCepOrigem     = $arrCampos['cep'];
			$this->Frete->sCepDestino    = $arrCampos['cepdestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			$this->Frete->nVlComprimento = $arrCampos['comprimento'];
			$this->Frete->nVlAltura      = $arrCampos['altura'];
			$this->Frete->nVlLargura     = $arrCampos['largura'];
			$this->Frete->nCdFormato     = $arrCampos['formato'];
			$this->Frete->nVlValorDeclarado = $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {
				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>E SEDEX</h3>";
				 $html .=	"O prazo de entrega é de ". $this->Frete->PrazoEntrega ." dias úteis</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( $this->Frete->Valor ) ."</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( ( $this->Frete->Valor + $arrCampos['valor'] ), $arrCampos['quantidade'] ) ."</td>";
				 $html .= "</tr>";
				 
				 return $html;
			}
	}


	function sedex_hoje()
	{
	
		/**
		 * SEDEX HOJE
		 */
		try {
			
			$this->Frete->nCdServico     = EncomendasCorreios::SERVICO_SEDEXHOJE;
			$this->Frete->sCepOrigem     = $arrCampos['cepOrigem'];
			$this->Frete->sCepDestino    = $arrCampos['cepDestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			$this->Frete->nVlComprimento = $arrCampos['comprimento'];
			$this->Frete->nVlAltura      = $arrCampos['altura'];
			$this->Frete->nVlLargura     = $arrCampos['largura'];
			$this->Frete->nCdFormato     = $arrCampos['formato'];
			$this->Frete->nVlValorDeclarado = $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {

				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>SEDEX HOJE</h3>";
				 $html .=	$this->Frete->PrazoEntrega ."</td>";
				 $html .=	"<td class='valor'>". $this->moeda( $this->Frete->Valor ) ."</td>";
				 $html .=	"<td class='valor'>". $this->moeda( ( $this->Frete->Valor + $this->Frete->nVlValorDeclarado ) ) ."</td>";
				 $html .= "</tr>";
				 
				 return $html;
			}
		} catch (Exception $e) {
			return  "Erro: {$e->getMessage() } <BR><BR>";
		}
		

	}







	function sedex_10()
	{
	
		/**
		 * SEDEX 10
		 */
		try {
			
			$this->Frete->nCdServico     = EncomendasCorreios::SERVICO_SEDEX10;
			$this->Frete->sCepOrigem     = $arrCampos['cepOrigem'];
			$this->Frete->sCepDestino    = $arrCampos['cepDestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			$this->Frete->nVlComprimento = $arrCampos['comprimento'];
			$this->Frete->nVlAltura      = $arrCampos['altura'];
			$this->Frete->nVlLargura     = $arrCampos['largura'];
			$this->Frete->nCdFormato     = $arrCampos['formato'];
			$this->Frete->nVlValorDeclarado = $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {
				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>SEDEX</h3>";
				 $html .=	$this->Frete->PrazoEntrega ."</td>";
				 $html .=	"<td class='valor'>". $this->moeda( $this->Frete->Valor ) ."</td>";
				 $html .=	"<td class='valor'>". $this->moeda( ( $this->Frete->Valor + $this->Frete->nVlValorDeclarado ), $arrCampos['quantidade'] ) ."</td>";
				 $html .= "</tr>";
				 
				 return $html;
			}
		} catch (Exception $e) {
			return  "Erro: {$e->getMessage() } <BR><BR>";
		}
		

	}


	function sedex_a_cobrar()
	{
	
		/**
		 * SEDEX A COBRAR
		 */
		try {
			
			$this->Frete->nCdServico     = EncomendasCorreios::SERVICO_SEDEXACOBRAR;
			$this->Frete->sCepOrigem     = $arrCampos['cepOrigem'];
			$this->Frete->sCepDestino    = $arrCampos['cepDestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			$this->Frete->nVlComprimento = $arrCampos['comprimento'];
			$this->Frete->nVlAltura      = $arrCampos['altura'];
			$this->Frete->nVlLargura     = $arrCampos['largura'];
			$this->Frete->nCdFormato     = $arrCampos['formato'];
			$this->Frete->nVlValorDeclarado = $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {
				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>SEDEX A COBRAR</h3>";
				 $html .=	"O prazo de entrega é de ". $this->Frete->PrazoEntrega ." dias úteis</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( $this->Frete->Valor ) ."</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( ( $this->Frete->Valor + $arrCampos['valor'] ), $arrCampos['quantidade']  ) ."</td>";
				 $html .= "</tr>";
				 
				 return $html;			}
		} catch (Exception $e) {
			return  "Erro: {$e->getMessage() } <BR><BR>";
		}
		

	}


	function e_sedex()
	{
	
		/**
		 * E SEDEX
		 */
		try {
			
			$this->Frete->nCdServico     = EncomendasCorreios::SERVICO_ESEDEX;
			$this->Frete->sCepOrigem     = $arrCampos['cepOrigem'];
			$this->Frete->sCepDestino    = $arrCampos['cepDestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			$this->Frete->nVlComprimento = $arrCampos['comprimento'];
			$this->Frete->nVlAltura      = $arrCampos['altura'];
			$this->Frete->nVlLargura     = $arrCampos['largura'];
			$this->Frete->nCdFormato     = $arrCampos['formato'];
			$this->Frete->nVlValorDeclarado = $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {
				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>E SEDEX</h3>";
				 $html .=	$this->Frete->Valor ."</td>";
				 $html .=	"<td class='valor'>". $this->Frete->PrazoEntrega ."</td>";
				 $html .= "</tr>";
				 
				 return $html;
			}
		} catch (Exception $e) {
			return  "Erro: {$e->getMessage() } <BR><BR>";
		}
		

	}


	function malote()
	{
	
		/**
		 * MALOTE
		 */
		try {
			
			$this->Frete->nCdServico     = EncomendasCorreios::SERVICO_MALOTE;
			$this->Frete->sCepOrigem     = $arrCampos['cepOrigem'];
			$this->Frete->sCepDestino    = $arrCampos['cepDestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			$this->Frete->nVlComprimento = $arrCampos['comprimento'];
			$this->Frete->nVlAltura      = $arrCampos['altura'];
			$this->Frete->nVlLargura     = $arrCampos['largura'];
			$this->Frete->nCdFormato     = $arrCampos['formato'];
			$this->Frete->nVlValorDeclarado = $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {
				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>MALOTE</h3>";
				 $html .=	$this->Frete->Valor ."</td>";
				 $html .=	"<td class='valor'>". $this->Frete->PrazoEntrega ."</td>";
				 $html .= "</tr>";
				 
				 return $html;
			}
		} catch (Exception $e) {
			return  "Erro: {$e->getMessage() } <BR><BR>";
		}
		

	}


	function pac()
	{
	
		/**
		 * PAC
		 */
		try {
			
			$this->Frete->nCdServico     = EncomendasCorreios::SERVICO_PAC;
			$this->Frete->sCepOrigem     = $arrCampos['cepOrigem'];
			$this->Frete->sCepDestino    = $arrCampos['cepDestino'];
			$this->Frete->nVlPeso        = $arrCampos['peso'];
			
			$this->Frete->nVlComprimento = 16;
			$this->Frete->nVlAltura      = 16;
			$this->Frete->nVlLargura     = 16;
			
			$this->Frete->nCdFormato     = 1;
			$this->Frete->nVlValorDeclarado= $arrCampos['valor'];
			$this->Frete->obterResposta();
		
			if ($this->Frete->Erro != '0') {
				return  "Erro: {$this->Frete->MsgErro}<BR><BR>";
			} else {
				
				 $html  = "<tr>";
				 $html .= 	"<td><h3>PAC</h3>";
				 $html .=	"O prazo de entrega é de ". $this->Frete->PrazoEntrega ." dias úteis</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( $this->Frete->Valor ) ."</td>";
				 $html .=	"<td class='valor'>R$ ". $this->moeda( ( $this->Frete->Valor + $arrCampos['valor'] ), $arrCampos['quantidade'] ) ."</td>";
				 $html .= "</tr>";
				 
				 return $html;
			}
		} catch (Exception $e) {
			return  "Erro: {$e->getMessage() } <BR><BR>";
		}
		

	}
	
	
	
	
	
	
	function moeda( $intValor )
	{
		
		return number_format( ( $intValor * $arrCampos['quantidade'] ), 2, ',', '.' );
	}
	
	
	
	
	
	
	function voltar()
	{
		
		/**
		 * Links para retorno com codigo de afiliado
		 * http://pmstrk.mercadolivre.com.br/jm/PmsTrk?tool=5715635&go=[Trocar pela URL de destino]
		 * 
		 */
		if( ( isset( $_SERVER['HTTP_REFERER'] ) ) && ( !strstr( $_SERVER['HTTP_REFERER'], SITEURL ) ) )
		{
			
			return $_SERVER['HTTP_REFERER'];
		}else{
			
			return false;
		}
	}
	
	


	function tratamento()
	{
	
		
		/**
		 * TRATANDO INFORMA��ES
		 */
		$get = $_REQUEST;
		
		$arrCampos = $get;
		
		if( isset( $get['user'] ) ){ $arrCampos['user'] = $get['user'];	}
		
		
		if( isset( $get['produto'] ) ){ $arrCampos['produto'] = $get['produto']; }
				
		
		if( isset( $get['peso'] ) ){ $arrCampos['peso'] = $get['peso']; }
		
				
		if( isset( $get['comprimento'] ) ){ $arrCampos['comprimento'] = $get['comprimento']; }
		
				
		if( isset( $get['altura'] ) ){ $arrCampos['altura'] = $get['altura']; }
		
		
		if( isset( $get['largura'] ) ){ $arrCampos['largura'] = $get['largura']; }
		
				
		if( isset( $get['formato'] ) ){ $arrCampos['formato'] = $get['formato']; }
		
				
		if( isset( $get['cepOrigem'] ) ){ $arrCampos['cepOrigem'] = $get['cepOrigem'];	}		
		
		
		if( isset( $get['cepDestino'] ) ){ 	$arrCampos['cepDestino'] = $get['cepDestino']; }
		
		
		if( isset( $get['valor'] ) ){ $arrCampos['valor'] = $get['valor']; }
		
		
		if( ( isset( $get['quantidade'] ) ) && ( !empty( $get['quantidade'] ) ) ){ $arrCampos['quantidade'] = $get['quantidade']; }else{ $arrCampos['quantidade'] = 1; }

	}
	
	
	
	
	
}
?>