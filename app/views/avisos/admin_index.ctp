<div class="avisos index">
<h2><?php __('Avisos');?></h2>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Aviso', true), array('action' => 'add')); ?></li>
		<li><?php echo $html->link(__('Todos', true), array( 'action' => 'index' ) ); ?></li>
		<li><?php echo $html->link(__('Postado', true), array( 'action' => 'index', 'flag:postado' ) ); ?></li>
		<li><?php echo $html->link(__('Encaminhado', true), array( 'action' => 'index', 'flag:encaminhado' ) ); ?></li>
		<li><?php echo $html->link(__('Conferido', true), array( 'action' => 'index', 'flag:conferido' ) ); ?></li>
		<li><?php echo $html->link(__('Saiu para entrega', true), array( 'action' => 'index', 'flag:entrega' ) ); ?></li>
		<li><?php echo $html->link(__('Entregue', true), array( 'action' => 'index', 'flag:entregue' ) ); ?></li>
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
	<th><?php echo $paginator->sort('codigos_id');?></th>
	<th><?php echo $paginator->sort('users_id');?></th>
	<th><?php echo $paginator->sort('estatus');?></th>
	<th><?php echo $paginator->sort('updated');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($avisos as $aviso):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $aviso['Aviso']['id']; ?>
		</td>
		<td>
			<?php echo $aviso['Codigo']['codigo']; ?>
		</td>
		<td>
			<?php echo $aviso['User']['username']; ?>
		</td>
		<td>
			<?php echo $aviso['Aviso']['estatus']; ?>
		</td>
		<td>
			<?php echo $aviso['Aviso']['updated']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action' => 'view', $aviso['Aviso']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action' => 'edit', $aviso['Aviso']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action' => 'delete', $aviso['Aviso']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $aviso['Aviso']['id'])); ?>
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

<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
$javascript->link( '/theme/rastreamento/js/funcoes', false );
?>