<?php
class CodigosController extends AppController {

	var $name = 'Codigos';
	var $uses = array( 'Codigo', 'Aviso', 'User' );
	var $helpers = array('Html', 'Form', 'Javascript' );
	var $components = array( 'Rastreamento' );

	
	
  	/**
  	 * API Rest permite listar os registros dos codigos
  	 *
  	 */
	function index()
	{
		
		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		$conditions = array();

			
			
			/**
			 * Condição para permitir o admin visualizar todos os registros
			 */
			if( $userData['role_id'] != 1 )
			{
				
				$conditions[] = array( 'Codigo.users_id' => $userData['id'] );
			}
			
			
			$this->Codigo->recursive = 1;
	    	$codigos = $this->Codigo->find( 'all', array( 'fields' => array( 'Codigo.id', 'Codigo.nome', 'Codigo.codigo', 'Codigo.created' ), 'conditions' => array( $conditions ) ) );
	    	
		
    	$this->set(compact('codigos'));
	}
	
	
	
  	/**
  	 * API Rest permite mostrar o registro do produto informado por ID
  	 *
  	 * @param Integer $id
  	 */
	function view($id)
	{
		
		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		$conditions = array();
		$message = "Usuário não habilitado";

				
				
				/**
				 * Condição para permitir o admin visualizar todos os registros
				 */
				if( $userData['role_id'] != 1 )
				{
					
					$conditions[] = array( 'Codigo.users_id' => $userData['id'] );
				}
				
				
				
				
				/**
				 * Localizando o produto do usuário e id informado
				 */
				$produto = $this->Codigo->find( 'first', array( 'fields' => array(  'Codigo.id', 'Codigo.nome', 'Codigo.codigo', 'Codigo.created' ), 'conditions' => array( 'Codigo.id' => $id, $conditions ) ) );
				
				
				/**
				 * Se for encontrado registro
				 */
				if( $this->Codigo->getNumRows() != 0 )
				{
						
					/**
					 * Alterna a mensagem de erro para o objeto de produtos
					 */
					$message = $produto;
					$this->set(compact('codigo'));
				}

				$this->set(compact('codigo'));
					

		$this->set(compact('message'));
	}
	
	
	
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Codigo', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Codigo->save($this->data)) {
				$this->Session->setFlash(__('The Codigo has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Codigo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Codigo->read(null, $id);
		}
		$users = $this->Codigo->User->find('list');
		$this->set(compact('users'));
	}
		
	
	

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Codigo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Codigo->del($id, true )) 
		{
			$this->Session->setFlash(__('Codigo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

	
	
	
	
	
	
	
	/**
	 * O rastreamento é realizado na action add
	 *
	 * @param String $strCodigo código de rastreamento dos Correios
	 */
	function rastrear( $strCodigo = null )
	{
		
		
		$title_for_layout = "Rastreamento ". $strCodigo;
		
		
		if( $strCodigo )
		{
			$codigos = $this->Rastreamento->inicia( $strCodigo );
		}else{
			
			$this->redirect( array( 'action' => 'add' ) );
		}
		
		$this->set( compact( 'title_for_layout', 'codigos' ) );
	}
	
	

	
	
	

	function add( $strCodigo = null ) 
	{
		
		//print_r( $this->data );
		
		$this->set( 'title_for_layout', "rastreamento de pedido" );
		
		
		
		
		if( $strCodigo != null )
		{
			$this->data['Codigo']['codigo'] = $strCodigo;
		}
		
		
		
		if (!empty($this->data)) 
		{
			
			
			/**
			 * Vai continuar salvando automaticamente
			 * posteriormente retirar o autolog
			 */
			$this->set( 'codigos', $this->Rastreamento->inicia( $this->data['Codigo']['codigo'] ) );
			
			
			
			if( empty( $this->data['Codigo']['rastrear'] ) )
			{
				
				$this->data['Codigo']['users_id'] = 0;
			}else{

				$userData = $this->Session->read( 'Auth.User' );
				$this->data['Codigo']['users_id'] = $userData['id'];
			}
			
			
			$codigosr = $this->Codigo->find( 'all', array( 
				'conditions' => array( 
					'Codigo.codigo' => $this->data['Codigo']['codigo'], 
					'Codigo.users_id' => $this->data['Codigo']['users_id'] 
				) 
			) );
			

			
			
			/**
			 * Verifica se o código já existe, se existir não adiciona
			 */
			if( $this->Codigo->getNumRows() == 0 )
			{
				
				
				$this->Codigo->create();
				$this->data['Codigo']['codigo'] = strtoupper( $this->data['Codigo']['codigo'] );
				if ($this->Codigo->save($this->data)) {
					$this->Session->setFlash(__('The Codigo has been saved', true));
					

					
					
					/**
					 * Adicionando o rastreamento
					 */
					if( isset( $this->data['Codigo']['rastrear'] ) && !empty( $this->data['Codigo']['rastrear'] ) )
					{
						

						
						/**
						 * Dados do usuário
						 */
						$userData = $this->Session->read( 'Auth.User' );
						
						
						
						$this->Aviso->id = null;
						$arrAviso['Aviso']['users_id'] = $userData['id'];
						$arrAviso['Aviso']['codigos_id'] = $this->Codigo->getLastInsertID();
						$arrAviso['Aviso']['estatus'] = "Aguardando atualização";
						$this->Aviso->save( $arrAviso );
						
					}
					
					
					
					
				} else {
					$this->Session->setFlash(__('The Codigo could not be saved. Please, try again.', true));
				}
				
			}// Se já existe não será salvo apenas exibe o rastreamento
			
			
			$this->redirect( array( 'action' => 'rastrear', $this->data['Codigo']['codigo'] ) );
			
			
		}// nao precisa exibir mensagem quando entra na pagina
		
		
	}



	function admin_index() 
	{
		
		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
		/**
		 * Evitando erros com variavel nao definida
		 */
		$conditions = array();
		
		if( $userData['role_id'] != 1 )
		{
			
			$conditions = array( 'Codigo.users_id' => $userData['id'] );
		}
		
		
		
		
		
		$this->Codigo->recursive = 0;
		$this->paginate = array( 'conditions' => $conditions );
		$this->set('codigos', $this->paginate());
	}

	
	
	
	
	
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Codigo.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$arrCodigo = $this->Codigo->read(null, $id);
		$this->set('codigo', $arrCodigo );
		$this->set('users', $this->Aviso->find( 'all', array( 'conditions' => array( 'Aviso.codigos_id' => $arrCodigo['Codigo']['id'] ) ) ) );
	}

	
	
	
	
	function admin_rastrear( $strCodigo = null )
	{
		
		
		$title_for_layout = "Rastreamento ". $strCodigo;
		
		
		if( $strCodigo )
		{
			$codigos = $this->Rastreamento->inicia( $strCodigo );
		}else{
			
			$this->redirect( array( 'action' => 'index' ) );
		}
		
		$this->set( compact( 'title_for_layout', 'codigos' ) );
	}
	
	
	
	
	
	
	function _avisar_cliente( $codigo_id = null )
	{
		
		if( !empty($codigo_id) )
		{

			
			/**
			 * Consulta o código existente
			 */
			$codigo_data = $this->Codigo->find( 'first', array( 
				'conditions' => array( 'Codigo.codigo' => $codigo_id ),
			));
			
			
						/**
						 * Verificando se foi informado um cliente para receber o aviso
						 */
						if( ( $this->Codigo->getNumRows()!= 0 ) && !empty( $this->data['Codigo']['cliente_nome'] ) && ( !empty( $this->data['Codigo']['cliente_email'] ) ) )
						{
								
								
				            $this->data['User']['role_id'] = 2; // Registered
				            $this->data['User']['activation_key'] = md5(uniqid());
				            $this->data['User']['status'] = 0;
				            $this->data['User']['username'] = htmlspecialchars( strtolower( reset( explode( ' ', trim($this->data['Codigo']['cliente_nome']) ) ) .'_'. date( 'dmY' ) ));
				            $this->data['User']['username'] = date( 'dmY' );
				            //$this->data['User']['website'] = htmlspecialchars($this->data['User']['website']);
				            $this->data['User']['name'] = htmlspecialchars($this->data['Codigo']['cliente_nome']);
				            $this->data['User']['email'] = $this->data['Codigo']['cliente_email'];
				            $this->data['User']['password'] = $this->data['Codigo']['codigo'];
							
				            
				            
				            $this->User->create();
				            if( $this->User->save( $this->data ) )
				            {
				            	$this->Session->setFlash( "Cliente adicionado corretamente");
				            }else{
				            	$this->Session->setFlash( "Ocorreu um erro inesperado");
				            }
				            
							
							$this->Aviso->id = null;
							$arrAviso['Aviso']['users_id'] = $this->User->getLastInsertID();
							$arrAviso['Aviso']['codigos_id'] = $codigo_data['Codigo']['id'];
							$arrAviso['Aviso']['estatus'] = "Aguardando atualização";
							$this->Aviso->save( $arrAviso );
							
						}
		}
					
	}
	
	
	
	
	function admin_add( $strCodigo = null ) 
	{
		
		
		
		$this->set( 'title', 'Rastrear pedido - rastreamento' );
		$this->set( 'title_for_content', "rastreamento de pedido" );
		
		
		
		
		if( $strCodigo != null )
		{
			$this->data['Codigo']['codigo'] = $strCodigo;
		}
		
		
		
		
		
		if (!empty($this->data)) 
		{
			
			
			
			/**
			 * Verifica se os dados foram informados para avisar 
			 * o cliente
			 */
			$this->_avisar_cliente( $this->data['Codigo']['codigo'] );
			//$this->user_add();
			
			
			
			$this->Codigo->find( 'first', array( 'conditions' => array( 'Codigo.codigo' => $this->data['Codigo']['codigo'], 'Codigo.users_id' => $this->data['Codigo']['users_id'] ) ) );
			
			
			/**
			 * Verifica se o código já existe, se existir não adiciona
			 */
			if( $this->Codigo->getNumRows() == 0 )
			{
				
				
				$this->Codigo->create();
				$this->data['Codigo']['codigo'] = up( $this->data['Codigo']['codigo'] );
				if ($this->Codigo->save($this->data)) {
					$this->Session->setFlash(__('The Codigo has been saved', true));
					
					
					
					/**
					 * Adicionando o rastreamento
					 */
					if( isset( $this->data['Codigo']['rastrear'] ) )
					{
						
						
						/**
						 * Dados do usuário
						 */
						$userData = $this->Session->read( 'Auth.User' );
						
						
						
						$this->Aviso->id = null;
						$arrAviso['Aviso']['users_id'] = $userData['id'];
						$arrAviso['Aviso']['codigos_id'] = $this->Codigo->getLastInsertID();
						$arrAviso['Aviso']['estatus'] = "Aguardando atualização";
						$this->Aviso->save( $arrAviso );
						
					}
						
					
					$this->redirect( array( 'action' => 'rastrear', $this->data['Codigo']['codigo'] ) );
					
				} else {
					$this->Session->setFlash(__('The Codigo could not be saved. Please, try again.', true));
				}
				
			}// Se já existe não será salvo apenas exibe o rastreamento
			
			
			
			
			//$this->redirect( array( 'action' => 'rastrear', $this->data['Codigo']['codigo'] ) );
			
			
		}// nao precisa exibir mensagem quando entra na pagina
		
		
		$users = $this->Codigo->User->find('list', array( 'fields' => array( 'User.id', 'User.name' ) ));
		$this->set(compact('users'));
		
		//print_r( $this->Session->read( 'Auth.User' ) );
	}

	
	
	
	
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Codigo', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Codigo->save($this->data)) {
				$this->Session->setFlash(__('The Codigo has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Codigo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Codigo->read(null, $id);
		}
		$users = $this->Codigo->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Codigo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Codigo->delete($id)) {
			$this->Session->setFlash(__('Codigo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>