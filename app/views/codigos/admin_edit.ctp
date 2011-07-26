<div class="codigos form">
<h2><?php __('Edit Codigo');?></h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Codigo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Codigo.id'))); ?></li>
		<li><?php echo $html->link(__('Listar códigos', true), array('action' => 'index'));?></li>
	</ul>
</div>


<?php echo $form->create('Codigo');?>
	<fieldset>
<?php
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
		echo $form->input( 'users_id', array( 'type' => ( isset( $userData['id'] ) )? 'hidden': 'text', 'value' =>  $userData['id'] ) );
		echo $form->input('id');
		echo $form->input( 'codigo', array( 'class' => 'codigo campo inputSize', 'label' => 'Código de rastreamento' ) );
		echo $form->input( 'rastrear', array( 'type' => 'checkbox', 'class' => 'campo', 'value' => 1 , 'label' => '', 'between' => 'Acompanhar andamento da entrega via email' ) );
	?>
	</fieldset>
<?php echo $form->end('Salvar alterações');?>
</div>
