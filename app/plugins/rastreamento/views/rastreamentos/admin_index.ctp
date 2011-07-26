<div class="rastreamentos index">
	<h2><?php __('Rastreamentos');?></h2>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(sprintf(__('Novo %s', true), __('Rastreamento', true)), array('action' => 'add')); ?></li>
		</ul>
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('codigo');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('identificacao');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($rastreamentos as $rastreamento):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $rastreamento['Rastreamento']['id']; ?>&nbsp;</td>
		<td><?php echo $rastreamento['Rastreamento']['codigo']; ?>&nbsp;</td>
		<td><?php echo $rastreamento['Rastreamento']['email']; ?>&nbsp;</td>
		<td><?php echo $rastreamento['Rastreamento']['identificacao']; ?>&nbsp;</td>
		<td><?php echo $rastreamento['Rastreamento']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver', true), array('action' => 'view', $rastreamento['Rastreamento']['id'])); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $rastreamento['Rastreamento']['id'])); ?>
			<?php echo $this->Html->link(__('Excluir', true), array('action' => 'delete', $rastreamento['Rastreamento']['id']), null, sprintf(__('Você tem certeza que deseja excluir o id #%s?', true), $rastreamento['Rastreamento']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página %page% de %pages%, mostrando %current% registros de %count%, começando no registro %start% e terminando no %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('próxima', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
