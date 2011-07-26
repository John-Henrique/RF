<div class="avisos form">

<h2><?php __('Add Aviso');?></h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Avisos', true), array('action' => 'index'));?></li>
	</ul>
</div>

<?php echo $form->create('Aviso');?>
	<fieldset>
	<?php
		echo $form->input('codigos_id');
		echo $form->input('users_id');
		echo $form->input('estatus');
	?>
	</fieldset>
<?php echo $form->end('Adicionar');?>
</div>
