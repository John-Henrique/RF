<div class="rastreamentos view">
<h2><?php  __('Rastreamento');?></h2>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(sprintf(__('Editar %s', true), __('Rastreamento', true)), array('action' => 'edit', $rastreamento['Rastreamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Excluir %s', true), __('Rastreamento', true)), array('action' => 'delete', $rastreamento['Rastreamento']['id'], $rastreamento['Rastreamento']['codigo']), null, sprintf(__('Você tem certeza que deseja excluir o id #%s?', true), $rastreamento['Rastreamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Listar %s', true), __('Rastreamentos', true)), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(sprintf(__('Novo %s', true), __('Rastreamento', true)), array('action' => 'add')); ?> </li>
	</ul>
</div>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rastreamento['Rastreamento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rastreamento['Rastreamento']['codigo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rastreamento['Rastreamento']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Identificação'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rastreamento['Rastreamento']['identificacao']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Situação'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rastreamento['Rastreamento']['situacao']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Hash'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rastreamento['Rastreamento']['hash']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rastreamento['Rastreamento']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $rastreamento['Rastreamento']['flag']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
