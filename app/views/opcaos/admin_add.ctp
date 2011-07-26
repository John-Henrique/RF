<div class="opcoes form">
<?php echo $form->create('Opcao' );?>
	<fieldset> 
 		<legend><?php __('Add Opcao');?></legend>
	<?php
		echo $form->input('produtos_id', array( 'type' => 'text' ) );
		echo $form->input('chave');
		echo $form->input('valor');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Opcoes', true), array('action' => 'index'));?></li>
	</ul>
</div>
<?php pr( $this->data ); ?>