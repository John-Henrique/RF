<div class="rastreamentos form">
<h2><?php printf(__('Admin Add %s', true), __('Rastreamento', true)); ?></h2>

<div class="actions">
	<ul>

		<li><?php echo $this->Html->link(sprintf(__('Listar %s', true), __('Rastreamentos', true)), array('action' => 'index'));?></li>
	</ul>
</div>

<?php echo $this->Form->create('Rastreamento');?>
	<?php
		echo $this->Form->input('codigo');
		echo $this->Form->input('email');
		echo $this->Form->input('identificacao');
		echo $this->Form->input('situacao');
		echo $this->Form->input('hash');
		echo $this->Form->input('flag');
	?>
<?php echo $this->Form->end(__('Enviar', true));?>
</div>
