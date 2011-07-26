<?php
    CroogoRouter::plugins();
    Router::parseExtensions('json', 'rss');

    // Installer
    if (!file_exists(APP.'config'.DS.'settings.yml')) {
        CroogoRouter::connect('/', array('plugin' => 'install' ,'controller' => 'install'));
    }

    // Basic
    //CroogoRouter::connect('/', array('controller' => 'nodes', 'action' => 'principal'));

    CroogoRouter::connect('/', array('controller' => 'nodes', 'action' => 'promoted'));
    CroogoRouter::connect('/promoted/*', array('controller' => 'nodes', 'action' => 'promoted'));
    CroogoRouter::connect('/admin', array('admin' => true, 'controller' => 'settings', 'action' => 'dashboard'));
    CroogoRouter::connect('/search/*', array('controller' => 'nodes', 'action' => 'search'));

    // Blog
    CroogoRouter::connect('/blog', array('controller' => 'nodes', 'action' => 'index', 'type' => 'blog'));
    CroogoRouter::connect('/blog/archives/*', array('controller' => 'nodes', 'action' => 'index', 'type' => 'blog'));
    //CroogoRouter::connect('/blog/:slug', array('controller' => 'nodes', 'action' => 'view', 'type' => 'blog'));
    CroogoRouter::connect('/:slug', array('controller' => 'nodes', 'action' => 'view', 'type' => 'blog'));
    //CroogoRouter::connect('/blog/term/:slug/*', array('controller' => 'nodes', 'action' => 'term', 'type' => 'blog'));
    CroogoRouter::connect('/categoria/:slug/*', array('controller' => 'nodes', 'action' => 'term', 'type' => 'blog'));

    // Node
    CroogoRouter::connect('/node', array('controller' => 'nodes', 'action' => 'index', 'type' => 'node'));
    CroogoRouter::connect('/node/archives/*', array('controller' => 'nodes', 'action' => 'index', 'type' => 'node'));
    CroogoRouter::connect('/node/:slug', array('controller' => 'nodes', 'action' => 'view', 'type' => 'node'));
    CroogoRouter::connect('/node/term/:slug/*', array('controller' => 'nodes', 'action' => 'term', 'type' => 'node'));

    // Page
    CroogoRouter::connect('/about', array('controller' => 'nodes', 'action' => 'view', 'type' => 'page', 'slug' => 'about'));
    CroogoRouter::connect('/page/:slug', array('controller' => 'nodes', 'action' => 'view', 'type' => 'page'));

    // Users
    CroogoRouter::connect('/register', array('controller' => 'users', 'action' => 'add'));
    CroogoRouter::connect('/user/:username', array('controller' => 'users', 'action' => 'view'), array('pass' => array('username')));

    // Contact
    CroogoRouter::connect('/contact', array('controller' => 'contacts', 'action' => 'view', 'contact'));
    CroogoRouter::connect('/contato', array('controller' => 'contacts', 'action' => 'view', 'contact'));
    
    
    
    
    CroogoRouter::connect('/conta-premium.html', array( 'controller' => 'nodes', 'action' => 'view', 'type' => 'node', 'slug' => 'conta-premium' ) );
    CroogoRouter::connect('/conta-premium', array('controller' => 'nodes', 'action' => 'view', 'type' => 'node', 'slug' => 'conta-premium' ) );
    
    
    
    /**
     * frete
     */
    CroogoRouter::connect('/calculo-frete/*', array( 'controller' => 'produtos', 'action' => 'frete' ) );
    //CroogoRouter::connect('/frete/*', array( 'controller' => 'produtos', 'action' => 'frete' ) );
    
    
    /**
     * Link demo calculo frete da estrutura 
     * WordPress
     */
    CroogoRouter::connect('/calculo/frete.html', array( 'controller' => 'produtos', 'action' => 'frete' ) );
    
    
    /**
     * Corrige links de versões antigas como a estrutura
     * WordPress
     */
    CroogoRouter::connect('/calcular-frete/*', array( 'controller' => 'urls', 'action' => 'url' ) );
    
    // Botao calculo frete antigo
    CroogoRouter::connect('/frete/*', array( 'controller' => 'produtos', 'action' => 'frete' ) );
    
    
    
    /**
     * BOTOES
     * no WordPress existia uma estrutura na raiz
     * onde havia o diretório botoes na raiz
     */
    CroogoRouter::connect( '/botoes/*', array( 'controller' => 'urls', 'action' => 'botoes' ) );
    
    
    /**
     * Rastreamento
     * Corrige links de versões antigas como a estrutura 
     * WordPress
     */
    //CroogoRouter::connect( '/rastreamento/rastrear-pedido.html', array( 'controller' => 'codigos', 'action' => 'add' ) );
    
    
    
    
    /**
     * API Rest
     */
    //Router::mapResources( 'Produtos', array('prefix' => '/api/') );
    Router::mapResources( 'Produtos' );
    Router::mapResources( 'Codigos' );
    Router::mapResources( 'Avisos' );
	Router::parseExtensions( 'xml', 'html', 'pdf' );
	

	
?>