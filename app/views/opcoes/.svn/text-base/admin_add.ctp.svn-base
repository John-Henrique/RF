<div class="opcoes form">

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Produtos', true), array( 'controller' => 'produtos', 'action' => 'view', $form->value( 'Opcao.produtos_id' ) ) );?></li>
		<li><?php echo $html->link(__('List Opcoes', true), array('action' => 'index'));?></li>
	</ul>
</div>


<?php echo $form->create('Opcao' );?>
	<fieldset> 
	<?php
		echo $form->input('produtos_id', array( 'type' => 'hidden' ) );
		echo $form->input('chave', array( 'readonly' => 'readonly', 'disabled' => 'disabled' ));
		echo $form->input('valor');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
