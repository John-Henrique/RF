<div class="codigos index">
<h2><?php __('Codigos');?></h2>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Codigo', true), array('action' => 'add')); ?></li>
	</ul>
</div>



<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('users_id');?></th>
	<th><?php echo $paginator->sort('nome');?></th>
	<th><?php echo $paginator->sort('codigo');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($codigos as $codigo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $codigo['Codigo']['id']; ?>
		</td>
		<td>
			<?php echo ( !empty( $codigo['User']['username'] ) )? $codigo['User']['name']: '-----'; ?>
		</td>
		<td>
			<?php echo ( !empty( $codigo['Codigo']['nome'] ) )? $codigo['Codigo']['nome']: '-----'; ?>
		</td>
		<td>
			<?php echo $html->link( $codigo['Codigo']['codigo'], array( 'action' => 'rastrear', $codigo['Codigo']['codigo'] ) ); ?>
		</td>
		<td>
			<?php echo $codigo['Codigo']['created']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $codigo['Codigo']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $codigo['Codigo']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $codigo['Codigo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $codigo['Codigo']['id'])); ?>
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
