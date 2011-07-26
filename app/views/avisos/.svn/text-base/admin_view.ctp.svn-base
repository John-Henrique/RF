<div class="avisos view">
<h2><?php  __('Aviso');?></h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Aviso', true), array('action' => 'edit', $aviso['Aviso']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Aviso', true), array('action' => 'delete', $aviso['Aviso']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $aviso['Aviso']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Avisos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Aviso', true), array('action' => 'add')); ?> </li>
	</ul>
</div>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aviso['Aviso']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigos Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aviso['Aviso']['codigos_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Users Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aviso['Aviso']['users_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estatus'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aviso['Aviso']['estatus']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $aviso['Aviso']['updated']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
$javascript->link( '/theme/rastreamento/js/funcoes', false );
?>