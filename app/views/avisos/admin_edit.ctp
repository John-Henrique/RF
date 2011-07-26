<div class="avisos form">
<h2><?php __('Edit Aviso');?></h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Aviso.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Aviso.id'))); ?></li>
		<li><?php echo $html->link(__('List Avisos', true), array('action' => 'index'));?></li>
	</ul>
</div>


<?php echo $form->create('Aviso');?>
	<fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('produtos_id');
		echo $form->input('users_id');
		echo $form->input('estatus');
	?>
	</fieldset>
<?php echo $form->end('Salvar');?>
</div>
