<?php
    
    # ROTAS ENCURTADAS
    
    /**
     * Rastreamento via plugin rastreamento
     * RastreamentoController::rss e RastreamentoController::view
     * encurtando url
     */
    CroogoRouter::connect( '/rastrear/:action/:codigo', array( 
    	'plugin' => 'rastreamento', 
    	'controller' => 'rastreamentos', 
    ), array(
    	'pass' => array( 'codigo' )
    ));
    
    /**
     * Rastreamento via plugin rastreamento
     * RastreamentoController::webservice
     * encurtando url
     */
    CroogoRouter::connect( '/webservice/:codigo', array( 
    	'plugin' => 'rastreamento', 
    	'controller' => 'rastreamentos', 
    	'action' => 'webservice'
    ), array(
    	'pass' => array( 'codigo' )
    ));
    
    CroogoRouter::connect( '/webservice/:codigo/:formato', array( 
    	'plugin' => 'rastreamento', 
    	'controller' => 'rastreamentos', 
    	'action' => 'webservice'
    ), array(
    	'pass' => array( 'codigo', 'formato' )
    ));
    
?>