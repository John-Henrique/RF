<h2>Cores e estilos de botões</h2>
<div  class="actions">
	<ul>
		<li><?php echo $html->link( 'Todas', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId .'/todas' ) ); ?></li>
		<li><?php echo $html->link( 'Vermelho', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId .'/vermelho' ) ); ?></li>
		<li><?php echo $html->link( 'Verde', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId .'/verde' ) ); ?></li>
		<li><?php echo $html->link( 'Azul', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId .'/azul' ) ); ?></li>
		<li><?php echo $html->link( 'Laranja', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId .'/laranja' ) ); ?></li>
		<li><?php echo $html->link( 'Terra', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId .'/terra' ) ); ?></li>
		<li><?php echo $html->link( 'Preto', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId .'/preto' ) ); ?></li>
	</ul>
</div>


<div id="produtos">
	<?php
	$server = 'http://'. $_SERVER['HTTP_HOST'];
	
	
	
	
	foreach ( $botoes as $botao )
	{
		
		
		$strBtnImagem = r( 'img/', '/img/', $botao );
	?>
		<div class="blocoCodigo">
			<?php echo $html->link( $html->image( $strBtnImagem ), array( 'controller' => 'calcular', 'action' => 'calculo-frete', $intProdutoId ), false, false, false ) ."<br />";	?>
			<div class="alignleft botao" id="<?php echo $strBtnImagem; ?>">Código HTML</div>
			<?php /**<div class="alignright botao" id="<?php echo $strBtnImagem; ?>">Código JavaScript</div>*/ ?>
			
			<textarea class="html" id="html-<?php echo $strBtnImagem; ?>"><div style="display:block;"><a href="<?php echo $server; ?>/calcular/frete/<?php echo $intProdutoId; ?>/<?php echo $strCor; ?>" target="_blank"><img src="<?php echo $server . $strBtnImagem; ?>" alt="Calcule o frete aqui" /></a></div></textarea>
			
			<?php /**<textarea class="html" id="js-<?php echo $strBtnImagem; ?>"><script language="javascript" src="<?php echo $server; ?>/js/funcoes.js"></script><script language="javascript">var usuario="fulano";var produto=1;</script></textarea> */ ?>
		</div>
	<?php
	}
	
	//pr( $botoes );
	
	?>
</div>