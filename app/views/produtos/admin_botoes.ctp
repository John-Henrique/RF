<h2>Cores e estilos de botões</h2>

<p>Você pode escolher entre os diversos estilos de botões, clique no link <b>Código HTML</b> para pegar o código para cálculo de frete 
 que poderá ser utilizado no seu site ou blog e sites de leilões como Mercado livre (e diversos outros).</p>
 
<p>Você pode testar os botões de cálculo clicando neles, o funcionamento será exatamente como se o botão estivesse em seu site ou anúncio de leilão.</p>
 
 <br />
 
<div id="flashMessage" class="message">
	<p>Precisa de ajuda para adicionar o botão de cálculo de frete em seu anúncio no Mercado Livre? Veja nossa sessão de ajuda, <?php echo $html->link( 'como adicionar botão de cálculo no mercado livre', array( 'admin' => false, 'controller' => 'nodes', 'action' => 'view', 'type' => 'blog', 'slug' => 'como-inserir-botao-calculo-de-frete-no-mercado-livre' ) ); ?>.</p>
</div>

 
<div id="flashMessage" class="success">
	<p>Contas premium tem acesso ao API que permite utilizar o sistema de cálculo de frete transparente, onde em nenhum momento seus 
	clientes verão que o serviço de cálculo é fornecido por nossa empresa.</p>
</div>


<div class="clear"></div>



<div  class="actions">
	<ul>
		<li><?php echo $html->link( 'Todas as cores', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId, $strLink ,'cor:todas' ) ); ?></li>
		<li><?php echo $html->link( 'Vermelho', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId, $strLink ,'cor:vermelho' ) ); ?></li>
		<li><?php echo $html->link( 'Verde', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId, $strLink ,'cor:verde' ) ); ?></li>
		<li><?php echo $html->link( 'Azul', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId, $strLink ,'cor:azul' ) ); ?></li>
		<li><?php echo $html->link( 'Laranja', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId, $strLink ,'cor:laranja' ) ); ?></li>
		<li><?php echo $html->link( 'Terra', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId, $strLink ,'cor:terra' ) ); ?></li>
		<li><?php echo $html->link( 'Preto', array( 'controller' => 'produtos', 'action' => 'botoes', $intProdutoId, $strLink ,'cor:preto' ) ); ?></li>
	</ul>
</div>


<div id="produtos">
	<?php
	$server = 'http://'. $_SERVER['HTTP_HOST'];
	
	
	
	/**
	 * Evitando erros quando não houver indices
	 */
	if( count( $botoes ) != 0 )
	{
		
		
		
		foreach ( $botoes as $botao )
		{
			
			
			$strBtnImagem = r( 'img/', '/img/', $botao );
			
			/**
			<a href="<?php echo $server; ?>/calcular/frete/<?php echo $intProdutoId; ?>/<?php echo $strLink; ?>" target="_blank"><?php echo ( $html->image( $strBtnImagem ) ); ?></a>
			
			*/
		?>
			<div class="blocoCodigo">
				<?php $strButtonLink = $html->link( $html->image( $strBtnImagem, array( 'alt' => 'CÁLCULO DE FRETE AUTOMÁTICO' ) ), array( 'admin' => false, 'controller' => 'produtos', 'action' => 'frete', $intProdutoId, $strLink ), array( 'target' => '_blank', 'title' => 'Calcule o frete aqui', 'escape' => false ) ); ?>
				
				<?php echo $strButtonLink; ?>
	
			
				
				<div class="alignleft botao" id="<?php echo $strBtnImagem; ?>">Código HTML</div>
				<?php $strButtonLink = $html->link( $html->image( $server . $strBtnImagem, array( 'alt' => 'CÁLCULO DE FRETE AUTOMÁTICO' ) ), array( 'admin' => false, 'controller' => 'produtos', 'action' => 'frete', $intProdutoId, $strLink ), array( 'target' => '_blank', 'title' => 'Calcule o frete aqui', 'escape' => false ) ); ?>
				<?php /**<div class="alignright botao" id="<?php echo $strBtnImagem; ?>">Código JavaScript</div>*/ ?>
				
				<textarea class="html" id="html-<?php echo $strBtnImagem; ?>"><div style="display:block;"><?php echo str_replace( 'href="/calculo', 'href="'. $server .'/calculo', $strButtonLink ); ?></div></textarea>
				
				
			</div>
		<?php
		}
		
		
	}else{
		
		echo "<div class=\"clear\"></div>";
		echo "<h3>Botões indisponíveis neste momento.</h3>";
		echo "<p>Tente novamente dentro de alguns instantes</p>";
	}
	//pr( $botoes );
	
	?>
</div>

<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
$javascript->link( '/theme/rastreamento/js/funcoes', false );
?>