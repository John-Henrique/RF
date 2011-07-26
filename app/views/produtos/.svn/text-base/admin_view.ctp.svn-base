<?php
// Declarando variaveis
$preco = 
$cep =
$peso =
$altura =
$largura =
$comprimento =
$envio_local =
$envio_sedex =
$envio_sedexacobrar =
$envio_pac = 
$envio_maximo =
$produto_imagem =
null;

								$arrOptions = array(
									/**
									 * Deu um problema com o Security 
									 * alterei de . para , para tentar resolver 
									 * FUNCIONOU
									 */
									'0.300'	=>	'Até 0,300 gramas', 
									1 		=>	'Até 1 quilo', 
									2 		=>	'Até 2 quilos', 
									3 		=>	'Até 3 quilos', 
									4 		=>	'Até 4 quilos', 
									5 		=>	'Até 5 quilos', 
									6 		=>	'Até 6 quilos', 
									7 		=>	'Até 7 quilos', 
									8 		=>	'Até 8 quilos', 
									9 		=>	'Até 9 quilos', 
									10 		=>	'Até 10 quilos', 
									11 		=>	'Até 11 quilos', 
									12 		=>	'Até 12 quilos', 
									13 		=>	'Até 13 quilos', 
									14 		=>	'Até 14 quilos', 
									15 		=>	'Até 15 quilos', 
									16 		=>	'Até 16 quilos', 
									17 		=>	'Até 17 quilos', 
									18 		=>	'Até 18 quilos', 
									19 		=>	'Até 19 quilos', 
									20 		=>	'Até 20 quilos', 
									21 		=>	'Até 21 quilos', 
									22 		=>	'Até 22 quilos', 
									23 		=>	'Até 23 quilos', 
									24 		=>	'Até 24 quilos', 
									25 		=>	'Até 25 quilos', 
									26 		=>	'Até 26 quilos', 
									27 		=>	'Até 27 quilos', 
									28 		=>	'Até 28 quilos', 
									29 		=>	'Até 29 quilos', 
									30 		=>	'Até 30 quilos', 
								);

								
								
/**
 * Corrige problemas com opções extras do produto
 */
		if( isset( $produto['Opcao'] ) )
		{
			
			foreach ( $produto['Opcao'] as $opcao )
			{
				
				// Refente ao basico do produto
				if( $opcao['chave'] == 'preco' && !empty( $opcao['valor'] ) ): $preco = $opcao['valor']; endif;
				if( $opcao['chave'] == 'cep' && !empty( $opcao['valor'] ) ): $cep = $opcao['valor']; endif;
				if( $opcao['chave'] == 'peso' && !empty( $opcao['valor'] ) ): $peso = $opcao['valor']; endif;
				
				
				
				// Referencia ao tamanho
				if( $opcao['chave'] == 'altura' && !empty( $opcao['valor'] ) ): $altura = $opcao['valor']; endif;
				if( $opcao['chave'] == 'largura' && !empty( $opcao['valor'] ) ): $largura = $opcao['valor']; endif;
				if( $opcao['chave'] == 'comprimento' && !empty( $opcao['valor'] ) ): $comprimento = $opcao['valor']; endif;
				
				
				
				// Referencia ao tipo de envio
				if( $opcao['chave'] == 'envio_local' && !empty( $opcao['valor'] ) ): $envio_local = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_sedex' && !empty( $opcao['valor'] ) ): $envio_sedex = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_sedexacobrar' && !empty( $opcao['valor'] ) ): $envio_sedexacobrar = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_pac' && !empty( $opcao['valor'] ) ): $envio_pac = $opcao['valor']; endif;
				
				
				
				// Refente a quantidade máxima por pacote (itens no mesmo pacote)
				if( $opcao['chave'] == 'envio_maximo' && !empty( $opcao['valor'] ) ): $envio_maximo = $opcao['valor']; else: $envio_maximo = 1; endif;
				

				// Imagem do produto no calculo de frete
				if( $opcao['chave'] == 'produto_imagem' && empty( $opcao['valor'] ) ): $produto_imagem_null = __( "Não foram adicionadas imagens do produto", true ); endif;
				
				
				//echo $this->Form->input( 'Opcao.'. $opcao['chave'], array( 'value' => $opcao['valor'] ) );
			}
		}

?>
<div class="produtos view">
<h2><?php  __('Produto');?></h2>




<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Produto', true), array('action' => 'edit', $produto['Produto']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Produto', true), array('action' => 'delete', $produto['Produto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $produto['Produto']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Produtos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Produto', true), array('action' => 'add')); ?> </li>
		<li><?php echo $html->link(__('New Opcao', true), array( 'controller' => 'opcoes', 'action' => 'add', $produto['Produto']['id'] ) ); ?> </li>
	</ul>
</div>




	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produto['Produto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Users'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($produto['User']['username'], array('controller' => 'users', 'action' => 'view', $produto['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produto['Produto']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produto['Produto']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produto['Produto']['flag']; ?>
			&nbsp;
		</dd>
	</dl>
	
	
<h2><?php  __('Opções');?></h2>



<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Opcao', true), array( 'controller' => 'opcoes', 'action' => 'add', $produto['Produto']['id'] ) ); ?> </li>
	</ul>
</div>



	<dl><?php $i = 0; $class = ' class="altrow"';
	if( isset( $produto['Opcao']) && !empty( $produto['Opcao']))
	{
	?>

	
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "CEP"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( $cep, array( 'controller' => 'opcoes', 'action' => 'edit', $cep, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Peso"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( $peso, array( 'controller' => 'opcoes', 'action' => 'edit', $peso, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Preço"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( $preco, array( 'controller' => 'opcoes', 'action' => 'edit', $preco, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Largura"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( $largura, array( 'controller' => 'opcoes', 'action' => 'edit', $largura, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Altura"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( $altura, array( 'controller' => 'opcoes', 'action' => 'edit', $altura, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Comprimento"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( $comprimento, array( 'controller' => 'opcoes', 'action' => 'edit', $comprimento, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Retira no local"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( ( empty( $envio_local ))? "Não, não é possível retirar no local": "Sim, pode retirar no local", array( 'controller' => 'opcoes', 'action' => 'edit', $envio_local, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Envia PAC"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( ( empty( $envio_pac ))? "Não, não envio PAC": "Sim, envio PAC", array( 'controller' => 'opcoes', 'action' => 'edit', $envio_pac, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Envia SEDEX"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( ( empty( $envio_sedex ))? "Não, não envio SEDEX": "Sim, envio SEDEX", array( 'controller' => 'opcoes', 'action' => 'edit', $envio_sedex, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Envia a cobrar"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( ( empty( $envio_sedexacobrar ))? "Não, não envio SEDEX a cobrar": "Sim, envio SEDEX a cobrar", array( 'controller' => 'opcoes', 'action' => 'edit', $envio_sedexacobrar, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Qtd. por pacote"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $html->link( ( empty( $envio_maximo ))? "Quantidade não informada": $envio_maximo ." unidades", array( 'controller' => 'opcoes', 'action' => 'edit', $envio_maximo, $produto['Produto']['id'] ) ); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __( "Imagens"); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php 
			foreach ( $produto['Opcao'] as $imagem ):
			
				if( $imagem['chave'] == 'produto_imagem' ):
					echo $html->link( $this->Html->image( '/produto'. DS . $imagem['valor'], array( 'width' => 100, 'height' => 100, 'style' => 'border:2px solid #000;margin:5px;float:left;') ) , array( 'controller' => 'opcoes', 'action' => 'edit', $envio_maximo, $produto['Produto']['id'] ), array( 'escape' => false) );
				endif;
				
			endforeach;
			
			if( isset( $produto_imagem_null ) ): echo $produto_imagem_null; endif;
			?>
				&nbsp;
			</dd>
	<?php
	}else{
	?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('New Opcao', true), array( 'controller' => 'opcoes', 'action' => 'add', $produto['Produto']['id'] ) ); ?> </li>
			</ul>
		</div>
	<?php
	}
	?>
	</dl>
	
</div>

<?php
//debug( $produto['Opcao']);
echo $html->css( '/theme/rastreamento/css/admin_style' );
$this->Html->link( '/theme/rastreamento/js/funcoes', false );
?>