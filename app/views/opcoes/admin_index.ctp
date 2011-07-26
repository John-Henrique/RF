<div class="opcoes index">
<h2><?php __('Opcoes');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('produtos_id');?></th>
	<th><?php echo $paginator->sort('chave');?></th>
	<th><?php echo $paginator->sort('valor');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($opcoes as $opcao):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $opcao['Opcao']['id']; ?>
		</td>
		<td>
			<?php echo $opcao['Opcao']['produtos_id']; ?>
		</td>
		<td>
			<?php echo $opcao['Opcao']['chave']; ?>
		</td>
		<td>
			<?php echo $opcao['Opcao']['valor']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $opcao['Opcao']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $opcao['Opcao']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $opcao['Opcao']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $opcao['Opcao']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Opcao', true), array('action' => 'add')); ?></li>
	</ul>
</div>