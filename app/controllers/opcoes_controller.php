<?php
class OpcoesController extends AppController {


	var $name = 'Opcoes';
	var $uses = array( 'Opcao' );
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Opcao->recursive = 0;
		$this->set('opcoes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Opcao.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('opcao', $this->Opcao->read(null, $id));
	}

	function add( $id = null )
	{
		
		if (!empty($this->data)) {
			$this->Opcao->create();
			if ($this->Opcao->save($this->data)) {
				$this->Session->setFlash(__('The Opcao has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Opcao could not be saved. Please, try again.', true));
				
				
				$this->redirect( array( 'controller' => 'produtos', 'action' => 'view', $this->data['Opcao']['produtos_id'] ) );
			}
		}
		
			
			
			/**
			 * Se informar um ID adiciona-lo no produtos_id
			 */
			if( isset( $id ) )
			{
				$this->data['Opcao']['produtos_id'] = $id;
			}
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Opcao', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Opcao->save($this->data)) {
				$this->Session->setFlash(__('The Opcao has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Opcao could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Opcao->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Opcao', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Opcao->del($id)) {
			$this->Session->setFlash(__('Opcao deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Opcao->recursive = 0;
		$this->set('opcoes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Opcao.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('opcao', $this->Opcao->read(null, $id));
	}

	function admin_add( $id = null ) {
		if (!empty($this->data)) {
			$this->Opcao->create();
			if ($this->Opcao->save($this->data)) {
				$this->Session->setFlash(__('The Opcao has been saved', true));
				$this->redirect(array( 'controller' => 'produtos', 'action'=>'index', $id ));
			} else {
				$this->Session->setFlash(__('The Opcao could not be saved. Please, try again.', true));
			}
		}
		
			
			
			/**
			 * Se informar um ID adiciona-lo no produtos_id
			 */
			if( isset( $id ) )
			{
				$this->data['Opcao']['produtos_id'] = $id;
			}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Opcao', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Opcao->save($this->data)) {
				$this->Session->setFlash(__('The Opcao has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Opcao could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Opcao->find( 'first', array(
				'conditions' => array( 'Opcao.valor' => $id )
			));
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Opcao', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Opcao->del($id)) {
			$this->Session->setFlash(__('Opcao deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>