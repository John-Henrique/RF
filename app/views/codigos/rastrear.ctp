<?php 
$titulo = "rastreamento de pedido";

?>
<div class="codigos form">





<?php 
if( isset( $codigos ) && !stristr( $codigos, 'o encontrado' ) )
{	
	
	$htmls = null;
				$htmls .= "<p>Resultado do <b>". $title_for_layout ."</b></p>";
				$htmls .= "<div class=\"ui-widget\"> ";
					$htmls .= "<div id=\"flashMessages\" class=\"ui-state-highlight ui-corner-all\" style=\"margin-top: 20px; padding: 10px;\">";
						$htmls .= '<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><p>Cadastre-se para utilizar a função '. $html->link( "Rastreamento via email", array( 'controller' => 'codigos', 'action' => 'rastrear' ) ) .', '. $html->link( "cadastre-se aqui", array( 'controller' => 'users', 'action' => 'add' ) ) .'</p>';
					$htmls .= "</div>";
				$htmls .= "</div>";
				
				$htmls .= "<table border=\"1\" class=\"rastreamento\" width=\"100%\">";
				$htmls .= "	<tr>";
				$htmls .= "		<th scope=\"col\">Data</th>";
				$htmls .= "		<th scope=\"col\">Local</th>";
				$htmls .= "		<th scope=\"col\">Situação</th>";
				$htmls .= "	</tr>";
				$htmls .= $codigos;
				$htmls .= "	</tr>";
				$htmls .= "</table>";
				$htmls .= "<div id=\"clear\"></div>";
				
	echo $htmls;
}else{
	
	
	/**
	 * Quando o código não for encontrado será exibida a mensagem de erro padrão dos Correios
	 */
	echo $codigos;
}

//print_r( $codigos ); class="" style="padding: 0 .7em;"
?>


</div>



<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
echo $html->css( '/ui-themes/smoothness/jquery-ui-1.8.2.css' );
$javascript->link( '/theme/rastreamento/js/funcoes', false );
$javascript->link( '/js/jquery/jquery-ui-1.8.2.min.js', false );
?>