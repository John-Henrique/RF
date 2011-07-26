<?php
if (!$correio->erro):
?>

<p>Resultado de rastreamento para <b><?php echo $id; ?></b></p>
<p>Receba o rastreamento desta encomenda diretamente no seu email, saiba como.</p>

	<h2>Status: <?php echo $correio->status ?></h2>
	
	<table cellpadding="5" class="rastreamento">
		<tr>
			<th>Data</th>
			<th>Local</th>
			<th>Ação</th>
			<th>Detalhes</th>
		</tr>
		<?php foreach ($correio->track as $info): ?>
			<tr>
				<td><?php echo $info->data ?></td>
				<td><?php echo $info->local ?></td>
				<td><?php echo $info->acao ?></td>
				<td><?php echo $info->detalhes ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	
	
<?php else: ?>
	<?php echo $correio->erro_msg ?>
<?php endif; ?>
