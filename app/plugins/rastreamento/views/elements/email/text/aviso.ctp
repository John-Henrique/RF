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
    
    echo sprintf(__('O rastreamento de sua encomenda %s foi alterado', true), $identificacao ) . "\n \n";
?>
<?php
if (!$correio->erro):
?>

	Status: <?php echo $correio->status ?>
	<?php echo ( isset( $correio->track[ end( $correio->track ) ]->data ) )?$correio->track[ end( $correio->track ) ]->data:''; ?>
	
	<?php echo ( isset( $correio->track[ end( $correio->track ) ]->local ) )?$correio->track[ end( $correio->track ) ]->local:''; ?>
	
	<?php echo ( isset( $correio->track[ end( $correio->track ) ]->acao ) )?$correio->track[ end( $correio->track ) ]->acao:''; ?>
	
	<?php echo ( isset( $correio->track[ end( $correio->track ) ]->detalhes ) )?$correio->track[ end( $correio->track ) ]->detalhes:''; ?>
		
	
	
	<?php echo sprintf( __( "<a href=\"%s\">Ver histórico completo do rastreamento</a>", true ), $url_rastreamento ); ?>
	
	<?php echo sprintf( __("Enviaremos a você um novo email sempre que houver alterações no status de entrega desta encomenda até que ela seja entregue.", true) ); ?>
	
	
	<?php echo sprintf( __("Para cancelar o acompanhamento desta encomenda <a href=\"%s\">clique aqui</a>.", true), $url_cancelamento ); ?>
	
<?php else: ?>
	<?php echo $correio->erro_msg ?>
<?php endif; ?>


<?php echo sprintf( __("Em caso de dúvidas, <a href=\"%s\">entre em contato</a>.", true), $url_contato ); ?>


Mídia Negócios - Soluções para comércio social.
<?php echo Router::url( 'http://www.midianegocios.com.br' ); ?>