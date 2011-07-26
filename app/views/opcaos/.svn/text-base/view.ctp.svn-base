<div class="opcoes view">
<h2><?php  __('Opcao');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $opcao['Opcao']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Produtos Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $opcao['Opcao']['produtos_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Chave'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $opcao['Opcao']['chave']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $opcao['Opcao']['valor']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Opcao', true), array('action' => 'edit', $opcao['Opcao']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Opcao', true), array('action' => 'delete', $opcao['Opcao']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $opcao['Opcao']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Opcoes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Opcao', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<?php pr( $opcao ); ?>