<?php
class RastreamentoComponent extends Object 
{
	
	var $strCodigo = null;
	var $siteurl = null;
	
	
	
	function __construct()
	{
		$this->siteurl = $_SERVER['SERVER_NAME'];
	}
	
	
	
	
	/**
	 * Processa a requisicao ao site dos correios
	 *
	 * @param unknown_type $strCodigo
	 * @param Bool $processa informando false o retorno será um Array sem tratamento
	 * @return unknown
	 */
	function inicia( $strCodigo, $processa = true )
	{
		
		$this->strCodigo = $strCodigo;
		

			//EE182898571CN
			$strContent = file_get_contents( 'http://websro.correios.com.br/sro_bin/txect01$.Inexistente?P_LINGUA=001&P_TIPO=002&P_COD_LIS='. $strCodigo );
			
			preg_match_all("|<t[^>]+>(.*)</t[^>]+>|U", $this->converte_utf8( $strContent ), $conteudo);
			
			
			if( $processa )
			{
				
				if( count( $conteudo[0] ) >= 2 )
				{
					return $this->processa( $conteudo[0] );
				}else{
					
					return "<h2>Código não encontrado</h2>";
				}
			}else{
				
				return $conteudo[0];
			}
	}
	

	
	
	
	
	
	
	
	
	/**
	 * Percorre os indices em busca de novos valores
	 *
	 * @param Array $arrContent
	 * @return String
	 */
	function processa( $arrContent )
	{
		
		$htmls=null;
		$html=null;
		
			
			unset( $arrContent[0] );
			unset( $arrContent[1] );
			unset( $arrContent[2] );
			
			foreach ( $arrContent as $strContent )
			{
				
				$html .= $this->replace( $strContent );
			}
		
			

/**			
				$htmls .= "<p>Resultado do rastreamento do objeto <strong>". $this->strCodigo ."</strong></p>";
				$htmls .= '<p>Cadastre-se para utilizar a função <a href="'. SITEURL .'/wp-login.php?action=register" class="button add-new-h2">Salvar Rastreamento</a></p>';
				$htmls .= "<table border=\"1\" class=\"rastreamento\" width=\"100%\">";
				$htmls .= "	<tr>";
				$htmls .= "		<th scope=\"col\">Data</th>";
				$htmls .= "		<th scope=\"col\">Local</th>";
				$htmls .= "		<th scope=\"col\">Situação</th>";
				$htmls .= "	</tr>";
				$htmls .= $html;
				$htmls .= "	</tr>";
				$htmls .= "</table>";
				$htmls .= "<div id=\"clear\"></div>";
*/
			
		return $html;
	}

	

	
	
	
	/**
	 * Renmove HTML inutil ou com problemas
	 *
	 * @return String formatada com HTML removido
	 */
	function replace( $strContent = null )
	{
		
		
		
		$strSiteUrl = 'http://'. $this->siteurl; 
		
		
		$arrProcura = array( 
							"<FONT COLOR=\"000000\">", 
							'</FONT>', 
							'<font FACE=Tahoma color=\'#CC0000\' size=2>', 
							'</font>', 
							'<FONT COLOR="5F9F9F">Entregue', 
							'<td> Entregue </td>', 
							'<FONT COLOR="007FFF">Saiu para entrega', 
							'<td> Aguardando retirada </td>', 
							'Conferido', 
							'<td> Encaminhado </td>', 
							'Postado', 
							'<td> Destinatário ausente </td>', 
							'FISCALIZACAO/CUSTOMS', 
							'FISCALIZAÇÃO/CUSTOMS', 
							'Liberado pela alfândega', 
							'CTCI SAO PAULO (GEARA)', 
							'CTCI SAO PAULO (GEEXP)', 
							'OBJ RETIDO - VER AUTENTICIDADE MARCA', 
							'Recebido/Brasil', 
							'TRIBUTADO', 
							'Por favor, entre em contato conosco clicando <a href="http://www.correios.com.br/servicos/falecomoscorreios/default.cfm">aqui</a>.', 
							);
		$arrTroca =	array( 
							' ', 
							' ', 
							' ', 
							' ', 
							'<span class="entregue">Entregue</span>', 
							'<td><span class="entregue">Entregue</span></td>', 
							'<span class="saiu">Saiu para entrega</span>',  
							'<td><span class="saiu">Saiu para entrega</span></td>',  
							'<span class="conferido">Conferido</span>', 
							'<td><span class="encaminhado">Encaminhado</span></td>', 
							'<span class="postado">Postado</span>', 
							'<td><span class="ausente">Destinatário ausente</span></td>', 
							'<a href="'. $strSiteUrl .'/fiscalizacao-ou-customs" class="informacao">FISCALIZACAO/CUSTOMS</a>', 
							'<a href="'. $strSiteUrl .'/fiscalizacao-ou-customs" class="informacao">FISCALIZACAO/CUSTOMS</a>', 
							'<a href="'. $strSiteUrl .'/liberado-pela-alfandega" class="informacao">Liberado pela alfândega</a>', 
							'<a href="'. $strSiteUrl .'/o-que-e-ctci" class="informacao">CTCI SAO PAULO (GEARA)</a>', 
							'<span class="informacao">CTCI SAO PAULO (GEEXP)</span>', 
							'<a href="'. $strSiteUrl .'/objeto-retido" class="informacao">OBJ RETIDO - VER AUTENTICIDADE MARCA</a>',
							'<a href="'. $strSiteUrl .'/recebido-no-brasil" class="informacao">Recebido/Brasil</a>',
							'<a href="'. $strSiteUrl .'/tributado" class="informacao">TRIBUTADO</a>',
							'<span class="problema"><a href="http://www.correios.com.br/servicos/falecomoscorreios/default.cfm">Por favor, entre em contato conosco clicando aqui</a>.</span>', 
							);
							
		return r( $arrProcura, $arrTroca, preg_replace( '/\s{2,}/', '', $strContent ) );
	}
	
	
	
	
	
	
	/**
	 * Converte caracteres escritos em ISO-8859 em UTF-8
	 *
	 * @author John-Henrique F. Silva <john@midianegocios.com.br>
	 * @since 20100315
	 * @version 0.1
	 * @license http://creativecommons.org/licenses/by-nc-sa/2.0/br Commons Creative
	 * @param String $strContent que precisa ser convertida
	 * @return String convertida em UTF-8
	 */
	function converte_utf8( $strContent )
	{
		
		return mb_convert_encoding( $strContent, 'UTF-8', mb_detect_encoding( $strContent, 'UTF-8, ISO-8859-1', true ) );
	}

	
	
	
	
	
}

?>