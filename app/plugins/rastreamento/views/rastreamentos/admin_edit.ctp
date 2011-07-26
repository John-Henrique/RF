<div class="rastreamentos form">
<h2><?php printf(__('Admin Edit %s', true), __('Rastreamento', true)); ?></h2>

<div class="actions">
	<ul>

		<li><?php echo $this->Html->link(__('Excluir', true), array('action' => 'delete', $this->Form->value('Rastreamento.id')), null, sprintf(__('Você tem certeza que deseja excluir o id #%s?', true), $this->Form->value('Rastreamento.id'))); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Listar %s', true), __('Rastreamentos', true)), array('action' => 'index'));?></li>
	</ul>
</div>


<?php echo $this->Form->create('Rastreamento');?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo');
		echo $this->Form->input('email');
		echo $this->Form->input('identificacao');
		echo $this->Form->input('situacao');
		echo $this->Form->input('hash');
		echo $this->Form->input('flag');
	?>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
