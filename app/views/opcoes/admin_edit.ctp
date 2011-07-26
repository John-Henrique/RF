<h2><?php __('Edit Opcao');?></h2>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Opcao.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Opcao.id'))); ?></li>
		<li><?php echo $html->link(__('List Opcoes', true), array('action' => 'index'));?></li>
	</ul>
</div>


<div class="opcoes form">
<?php echo $form->create('Opcao', array( 'url' => array( 'controller' => 'opcoes', 'action' => 'edit', $form->value( 'Opcao.id' ) ) ) );?>
	<fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('produtos_id', array( 'type' => 'hidden' ) );
		echo $form->input('chave', array( 'readonly' => 'readonly', 'disabled' => 'disabled' ));
		echo $form->input('valor');
	?>
	</fieldset>
<?php echo $form->end('Salvar alterações');?>
</div>
