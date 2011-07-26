<div class="produtos form">
<?php echo $this->Form->create('Produto');?>
	<fieldset>
 		<legend><?php __('Edit Produto'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('users_id');
		echo $this->Form->input('nome');
		echo $this->Form->input('flag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Produto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Produto.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Opcaos', true), array('controller' => 'opcaos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Opcao', true), array('controller' => 'opcaos', 'action' => 'add')); ?> </li>
	</ul>
</div>