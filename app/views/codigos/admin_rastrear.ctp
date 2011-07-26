<?php 
$titulo = "rastreamento de pedido";

?>
<div class="codigos form">
<h2><?php echo $title_for_layout;?></h2>





<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Codigos', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Produtos', true), array( 'controller' => 'produtos', 'action' => 'index'));?></li>
	</ul>
</div>




</div>



<?php 
if( isset( $codigos ) && !stristr( $codigos, 'o encontrado' ) )
{	
	
	$htmls = null;
				$htmls .= "<p>Resultado do <b>". ucfirst( $title_for_layout ) ."</b></p>";
				//$htmls .= '<p>Cadastre-se para utilizar a função <a href="'. SITEURL .'/wp-login.php?action=register" class="button add-new-h2">Salvar Rastreamento</a></p>';
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

//print_r( $codigos );
?>


<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
$javascript->link( '/theme/rastreamento/js/funcoes', false );
?>