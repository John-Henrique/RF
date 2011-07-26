<?php
/**
 * Users Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ClientesController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
    public $name = 'Clientes';
/**
 * Components
 *
 * @var array
 * @access public
 */
    public $components = array(
        'Email',
    );
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();

        if (in_array($this->params['action'], array('admin_login', 'login'))) {
            $field = $this->Auth->fields['username'];
            if (!empty($this->data) && empty($this->data['User'][$field])) {
                $this->redirect(array('action' => $this->params['action']));
            }
            $cacheName = 'auth_failed_' . $this->data['User'][$field];
            if (Cache::read($cacheName, 'users_login') >= Configure::read('User.failed_login_limit')) {
                $this->Session->setFlash(__('You have reached maximum limit for failed login attempts. Please try again after a few minutes.', true), 'default', array('class' => 'error'));
                $this->redirect(array('action' => $this->params['action']));
            }
        }
    }

    public function beforeRender() {
        parent::beforeRender();

        if (in_array($this->params['action'], array('admin_login', 'login'))) {
            if (!empty($this->data)) {
                $field = $this->Auth->fields['username'];
                $cacheName = 'auth_failed_' . $this->data['User'][$field];
                $cacheValue = Cache::read($cacheName, 'users_login');
                Cache::write($cacheName, (int)$cacheValue + 1, 'users_login');
            }
        }
    }

    public function admin_index() {
        $this->set('title_for_layout', __('Users', true));

        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    
    
    
    public function admin_cliente() 
    {
    	
    	$this->theme = "rastreamento";
    	
    	
        if (!empty($this->data['Cliente'])) 
        {
        	
        	// POG para resolver pendência
        	$this->data['User'] = $this->data['Cliente'];
        	
            $this->User->create();
            $this->data['User']['activation_key'] = md5(uniqid());
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('The User has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array( 'controller' => 'codigos', 'action' => 'add', $this->User->getLastInsertID()));
            } else {
                $this->Session->setFlash(__('The User could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
                unset($this->data['Cliente']['password']);
            }
        } else {
            $this->data['Cliente']['role_id'] = 2; // default Role: Registered
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }
    
    
    
    
    
    

    public function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid User', true), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('The User has been saved', true), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The User could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->User->read(null, $id);
        }
        $roles = $this->User->Role->find('list');
        $this->set(compact('roles'));
    }

    public function admin_reset_password($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid User', true), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $user = $this->User->findById($id);
            if ($user['User']['password'] == Security::hash($this->data['User']['current_password'], null, true)) {
                if ($this->User->save($this->data)) {
                    $this->Session->setFlash(__('Password has been reset.', true), 'default', array('class' => 'success'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Password could not be reset. Please, try again.', true), 'default', array('class' => 'error'));
                }
            } else {
                $this->Session->setFlash(__('Current password did not match. Please, try again.', true), 'default', array('class' => 'error'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->User->read(null, $id);
        }
    }

    public function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for User', true), 'default', array('class' => 'error'));
            $this->redirect(array('action' => 'index'));
        }
        if (!isset($this->params['named']['token']) || ($this->params['named']['token'] != $this->params['_Token']['key'])) {
            $blackHoleCallback = $this->Security->blackHoleCallback;
            $this->$blackHoleCallback();
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted', true), 'default', array('class' => 'success'));
            $this->redirect(array('action' => 'index'));
        }
    }

    public function admin_login() {
        $this->set('title_for_layout', __('Admin Login', true));
        $this->layout = "admin_login";
    }

    public function admin_logout() {
        $this->Session->setFlash(__('Log out successful.', true), 'default', array('class' => 'success'));
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->set('title_for_layout', __('Users', true));
    }

    
}
?>