<div class="rastreamentos form">

<h2><?php printf(__('Editar %s', true), __('Rastreamento', true)); ?></h2>

<?php echo $this->Form->create('Rastreamento');?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo');
		echo $this->Form->input('email');
		echo $this->Form->input('identificacao');
	?>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
<div class="actions">
	<h3><?php __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Excluir', true), array('action' => 'delete', $this->Form->value('Rastreamento.id'), $this->Form->value( 'Rastreamento.codigo' ) ), null, sprintf(__('Você tem certeza que deseja excluir o id #%s?', true), $this->Form->value('Rastreamento.codigo'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Listar %s', true), __('Rastreamentos', true)), array('action' => 'index'));?></li>
	</ul>
</div>