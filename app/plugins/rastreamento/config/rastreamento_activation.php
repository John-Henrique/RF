<?php
/**
 * Example Activation
 *
 * Activation class for Example plugin.
 * This is optional, and is required only if you want to perform tasks when your plugin is activated/deactivated.
 *
 * @package  Croogo
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class RastreamentoActivation {
/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeActivation(&$controller) {
        return true;
    }
/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onActivation(&$controller) {
        // ACL: set ACOs with permissions
        $controller->Croogo->addAco('Rastreamento'); // ExampleController
        $controller->Croogo->addAco('Rastreamento/admin_index'); // ExampleController::admin_index()
        $controller->Croogo->addAco('Rastreamento/admin_edit'); // ExampleController::admin_index()
        $controller->Croogo->addAco('Rastreamento/admin_add'); // ExampleController::admin_index()
        $controller->Croogo->addAco('Rastreamento/admin_view'); // ExampleController::admin_index()
        $controller->Croogo->addAco('Rastreamento/admin_delete'); // ExampleController::admin_index()
        
        $controller->Croogo->addAco('Rastreamento/index', array('registered', 'public')); // ExampleController::index()
        $controller->Croogo->addAco('Rastreamento/add', array('registered', 'public')); // ExampleController::index()
        $controller->Croogo->addAco('Rastreamento/edit', array('registered', 'public')); // ExampleController::index()
        $controller->Croogo->addAco('Rastreamento/view', array('registered', 'public')); // ExampleController::index()
        $controller->Croogo->addAco('Rastreamento/delete', array('registered', 'public')); // ExampleController::index()
        
        $controller->Croogo->addAco('Rastreamento/automatico', array('registered', 'public')); // ExampleController::index()
        
        $controller->Croogo->addAco('Rastreamento/webservice', array('registered', 'public')); // ExampleController::index()
        $controller->Croogo->addAco('Rastreamento/rss', array('registered', 'public')); // ExampleController::index()

        
        
        // Main menu: add an Example link
        $mainMenu = $controller->Link->Menu->findByAlias('main');
        $controller->Link->Behaviors->attach('Tree', array(
            'scope' => array(
                'Link.menu_id' => $mainMenu['Menu']['id'],
            ),
        ));
        $controller->Link->save(array(
            'menu_id' => $mainMenu['Menu']['id'],
            'title' => 'Rastreamento',
            'link' => 'plugin:rastreamento/controller:rastreamentos/action:add',
            'status' => 1,
        ));
        
    }
/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
    public function beforeDeactivation(&$controller) {
        return true;
    }
/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onDeactivation(&$controller) {
        // ACL: remove ACOs with permissions
        $controller->Croogo->removeAco('Rastreamento'); // RastreamentoController ACO and it's actions will be removed

        // Main menu: delete Rastreamento link
        $link = $controller->Link->find('first', array(
            'conditions' => array(
                'Menu.alias' => 'main',
                'Link.link' => 'plugin:rastreamento/controller:rastreamentos/action:add',
            ),
        ));
        $controller->Link->Behaviors->attach('Tree', array(
            'scope' => array(
                'Link.menu_id' => $link['Link']['menu_id'],
            ),
        ));
        if (isset($link['Link']['id'])) {
            $controller->Link->delete($link['Link']['id']);
        }
    }
}
?>