<div class="opcoes form">
<?php echo $form->create('Opcao');?>
	<fieldset>
 		<legend><?php __('Edit Opcao');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('produtos_id');
		echo $form->input('chave');
		echo $form->input('valor');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Opcao.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Opcao.id'))); ?></li>
		<li><?php echo $html->link(__('List Opcoes', true), array('action' => 'index'));?></li>
	</ul>
</div>
