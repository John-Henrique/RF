<div class="produtos view">
<h2><?php  __('Produto');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produto['Produto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($produto['User']['name'], array('controller' => 'users', 'action' => 'view', $produto['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produto['Produto']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produto['Produto']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $produto['Produto']['flag']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Produto', true), array('action' => 'edit', $produto['Produto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Produto', true), array('action' => 'delete', $produto['Produto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $produto['Produto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Produtos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Produto', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Opcaos', true), array('controller' => 'opcaos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Opcao', true), array('controller' => 'opcaos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Opcaos');?></h3>
	<?php if (!empty($produto['Opcao'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Produtos Id'); ?></th>
		<th><?php __('Chave'); ?></th>
		<th><?php __('Valor'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($produto['Opcao'] as $opcao):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $opcao['id'];?></td>
			<td><?php echo $opcao['produtos_id'];?></td>
			<td><?php echo $opcao['chave'];?></td>
			<td><?php echo $opcao['valor'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'opcaos', 'action' => 'view', $opcao['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'opcaos', 'action' => 'edit', $opcao['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'opcaos', 'action' => 'delete', $opcao['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $opcao['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Opcao', true), array('controller' => 'opcaos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
