<div class="codigos view">
<h2><?php  __('Codigo');?></h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Codigo', true), array('action' => 'edit', $codigo['Codigo']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Codigo', true), array('action' => 'delete', $codigo['Codigo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $codigo['Codigo']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Codigos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Codigo', true), array('action' => 'add')); ?> </li>
	</ul>
</div>


	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $codigo['Codigo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Users Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $codigo['Codigo']['users_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nome'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $codigo['Codigo']['nome']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $codigo['Codigo']['codigo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $codigo['Codigo']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="avisos vievers">

<p>Usuários acompanhando este rastreamento</p>

<ol>
	<?php
	if( isset( $users ) )
	{
		
		foreach ( $users as $user )
		{
			
		?>

			<li><?php echo $user['User']['name']; ?></li>
		
			<?php //echo $user['User']['id']; ?> 
			
			<?php //echo $user['User']['email']; ?> 
			<?php //echo $user['User']['email']; ?> 
		
		<?php
		}
	}
	?>
</ol>

</div>

<?php

//print_r( $users );

echo $html->css( '/theme/rastreamento/css/admin_style' );
$javascript->link( '/theme/rastreamento/js/funcoes', false );
?>