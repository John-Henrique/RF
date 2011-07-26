<div class="produtos index">



		
		<div class="clear"></div>
		
		
				
	<?php
	/**
	 * Se o parametro flag possuir o valor 2 
	 * exibir a mensagem para o usuário
	 */
	if( isset( $this->params['named']['flag'] ) && $this->params['named']['flag'] == 2 ):
	?>
		<div id="flashMessage" class="success">
			<p>Recomendamos que você teste o cálculo de frete para verificar se está funcionando corretamente. É possível que você cadastre informações incorretas e isto 
			gere problemas aos futuros compradores no momento que eles forem calcular o frete de seu produto.</p>
		</div>
	<?php endif; ?>
	
	
		
		<div class="clear"></div>
		
		
		
		

	<h2><?php __('Lista de produtos');?></h2>
	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Produto', true), array( 'controller' => 'produtos', 'action' => 'add')); ?></li>
			<li><?php echo $html->link(__('Produtos ativos', true), array( 'controller' => 'produtos', 'action' => 'index', 'flag:1' ) ); ?></li>
			<li><?php echo $html->link(__('Produtos excluídos', true), array( 'controller' => 'produtos', 'action' => 'index', 'flag:0' ) ); ?></li>
		</ul>
	</div>
	


<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('users_id');?></th>
	<th><?php echo $paginator->sort('nome');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('flag');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($produtos as $produto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $produto['Produto']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($produto['User']['username'], array('controller' => 'users', 'action' => 'reset_password', $produto['User']['id'])); ?>
		</td>
		<td>
			<?php echo $produto['Produto']['nome']; ?>
		</td>
		<td>
			<?php echo $produto['Produto']['created']; ?>
		</td>
		<td>
			<?php echo $layout->status( $produto['Produto']['flag'] ); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Calcular frete', true), array( 'controller' => 'produtos', 'admin' => false, 'action' => 'frete', $produto['Produto']['id'], Inflector::slug( low( $produto['Produto']['nome'] ) )  ), array( 'target' => '_blank' ) ); ?>
			<?php echo $html->link(__('Botões de cálculo', true), array( 'controller' => 'produtos', 'action' => 'botoes', $produto['Produto']['id'], Inflector::slug( low( $produto['Produto']['nome'] ) ) ) ); ?>
			<?php echo $html->link(__('View', true), array( 'controller' => 'produtos', 'action' => 'view', $produto['Produto']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array( 'controller' => 'produtos', 'action' => 'edit', $produto['Produto']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array( 'controller' => 'produtos', 'action' => 'delete', $produto['Produto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $produto['Produto']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>



  
    
<div class="paging"><?php echo $paginator->numbers(); ?></div>
<div class="counter"><?php echo $paginator->counter(array('format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true))); ?></div>


</div>





<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
$this->Html->link( '/theme/rastreamento/js/funcoes', false );
?>