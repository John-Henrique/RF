<?php

	// visualizar rastreamento
    $url_rastreamento = $this->Html->url( array( 
    	'plugin' => 'rastreamento', 
        'controller' => 'rastreamentos',
        'action' => 'view',
        $rastreamento['Rastreamento']['codigo'],
    ), true);
    
    
    // remover rastreamento
    $url_cancelamento = $this->Html->url( array( 
    	'plugin' => 'rastreamento', 
    	'controller' => 'rastreamentos', 
    	'action' => 'delete', 
    	$rastreamento['Rastreamento']['id'],
    	$rastreamento['Rastreamento']['codigo']
    ), true);
    
    
    // contato
    $url_contato = $this->Html->url( array(
    	'plugin' => false, 
    	'controller' => 'contacts', 
    	'action' => 'view', 
    	'contact'
    ), true );
    
    
    // se não foi informado uma identificacao troca pelo código
    if( !empty( $rastreamento['Rastreamento']['identificacao'] ) )
    {
    	$identificacao = $rastreamento['Rastreamento']['identificacao'];
    }else{
    	$identificacao = $rastreamento['Rastreamento']['codigo'];
    }
    
    echo sprintf(__('O rastreamento de sua encomenda <b>%s</b> foi alterado', true), $identificacao ) . "\n \n";
?>
<?php
if (!$correio->erro):
?>

	<h2>Status: <?php echo $correio->status ?></h2>
	
	<table cellpadding="5" cellspacing="5" border="1">
		<tr>
			<td>Data</td>
			<td>Local</td>
			<td>Ação</td>
			<td>Detalhes</td>
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
	
	<p><?php echo sprintf( __( "<a href=\"%s\">Ver histórico completo do rastreamento</a>", true ), $url_rastreamento ); ?></p>
	
	<p><?php echo sprintf( __("Enviaremos a você um novo email sempre que houver alterações no status de entrega desta encomenda até que ela seja entregue.", true) ); ?></p>
	
	<p><?php echo sprintf( __("Para cancelar o acompanhamento desta encomenda <a href=\"%s\">clique aqui</a>.", true), $url_cancelamento ); ?></p>
	
<?php else: ?>
	<p><?php echo $correio->erro_msg ?></p>
<?php endif; ?>


<p><?php echo sprintf( __("Em caso de dúvidas, <a href=\"%s\">entre em contato</a>.", true), $url_contato ); ?></p>


<address>Mídia Negócios - Soluções para comércio social.</address>
<?php echo $this->Html->link( 'http://www.midianegocios.com.br' ); ?>