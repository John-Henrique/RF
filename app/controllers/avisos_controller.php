<?php
class AvisosController extends AppController {

	var $name = 'Avisos';
	var $helpers = array('Html', 'Form', 'Javascript');
	var $components = array( 'Email', 'Rastreamento' );
	
	
	

	function index() {
		/*
		$this->Aviso->recursive = 0;
		$this->set('avisos', $this->paginate());
		*/
		
		$this->layout = 'webservice';
		
		
		/**
		 * Resgatando os últimos 500 registros 
		 * para não sobrecarregar o site dos correios
		 * e o processador do servidor (nosso servidor)
		 * 
		 * , ""
		 *  AND 
		 * Aviso.estatus NOT LIKE => "%entregue%"
		 */
		$arrObjs = $this->Aviso->find( 'all', array( 
			'conditions' => array( "TIMEDIFF( NOW( ), Aviso.updated ) < '3:00:00'" ), 
			'order' => array( 'Aviso.id' => 'DESC' ), 
			'limit' => 5
		) );
		
		$this->set( 'avisos', $arrObjs );
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Aviso.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('aviso', $this->Aviso->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Aviso->create();
			if ($this->Aviso->save($this->data)) {
				$this->Session->setFlash(__('The Aviso has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Aviso could not be saved. Please, try again.', true));
			}
		}
		
		
		
		$codigos = $this->Aviso->Codigo->find('list', array( 'fields' => array( 'Codigo.id', 'Codigo.codigo' ) ) );
		$users = $this->Aviso->User->find('list', array( 'fields' => array( 'User.id', 'User.name' ) ) );
		$this->set(compact('codigos', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Aviso', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Aviso->save($this->data)) {
				$this->Session->setFlash(__('The Aviso has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Aviso could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Aviso->read(null, $id);
		}
		$codigos = $this->Aviso->Codigo->find('list', array( 'fields' => array( 'Codigo.id', 'Codigo.nome' ) ) );
		$users = $this->Aviso->User->find('list', array( 'fields' => array( 'User.id', 'User.name' ) ) );
		$this->set(compact('codigos','users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Aviso', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Aviso->del($id)) {
			$this->Session->setFlash(__('Aviso deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	
	
	
	
	/**
	 * Verifica o status das encomendas e atualiza o registro
	 * envia um email ao usuário
	 *
	 */
	function atualiza()
	{
		
		
		$this->layout = "webservice";
		
		
		
				
				// tentando solucionar o problema de memoria
				ini_set('memory_limit', '-1');
				
				// tentando solucionar o problema de tempo
				ini_set('max_execution_time', '-1');
				
				// tentando solucionar o problema do post
				ini_set('post_max_size', '-1');
				
				
				
				
				
		
		/**
		 * Definindo variaveis
		 */
		$arrConditions = 
		$strStatus = 
		$strData = 
		$strLocal = 
		$arrAviso = 
		$strTabela = null;
		
		
		/**
		 * Resgatando os últimos 5 registros 
		 * para não sobrecarregar o site dos correios
		 * e o processador do servidor (nosso servidor)
		 * 
		 * , ""
		 *  AND
		 */
		$arrObjs = $this->Aviso->find( 'all', array( 
			'conditions' => array( 
				"OR" => array(
					array( "Aviso.estatus" => "NULL" ), 
					array( "Aviso.estatus NOT LIKE" => "%entregue%" )
				),
				/** /
				"TIMESTAMPDIFF( HOUR, Aviso.updated, NOW( ) ) > 3",
				/ **/
			),
			//'order' => array( 'Aviso.id' => 'ASC' ), 
			'order' => array( 'Codigo.codigo' => 'ASC' ), 
			'limit' => 15
		) );
		
		//print_r( $arrObjs );
		
		
		
		if( count( $arrObjs ) != 0 )
		{
		
			/**
			 * Percorre os objetos verficando o status nos Correios
			 */
			foreach ( $arrObjs as $arrObj )
			{
				
				
				
				echo $arrObj['User']['email'] .'<br>';
				echo $arrObj['Codigo']['codigo'] .'<br>';
				echo $arrObj['Codigo']['id'] .'<br>';
				echo $arrObj['Aviso']['id'] .'<br>';
				echo '--------------<br>';
				
				
				/**
				 * Acessa os Correios
				 */
				$requisicao = $this->Rastreamento->inicia( $arrObj['Codigo']['codigo'], false );
				
				
				//print_r( $requisicao );
				
				$arrSearch = array( '<td>', '</td>', 'td rowspan=', '<tr>', '</tr>', '<str1>' );
				$arrReplace = array( '', '', 'str', '', '', '' );
				
				if( isset( $requisicao[3] ) )
				{
					$strData = str_replace( $arrSearch, $arrReplace, $this->Rastreamento->replace( $requisicao[3] ) );
				}
				
				if( isset( $requisicao[4] ) )
				{
					$strLocal = str_replace( $arrSearch, $arrReplace, $this->Rastreamento->replace( $requisicao[4] ) );
				}
				
				if( isset( $requisicao[5] ) )
				{
					$strStatus = str_replace($arrSearch, $arrReplace, $this->Rastreamento->replace( $requisicao[5] ) );
					
					/**
					 * Converte os Arrays da requisição em tabela visual
					 */
					$strTabela = "<table border='1'>". $this->Rastreamento->processa( $requisicao ) ."</table>";
					//print_r( $strTabela );
					$arrConditions = array( 'Aviso.estatus' => $strTabela );
				}
				
				
				
				/**
				 * Não exibir o registro caso já exista o status no registro
				 */
				$this->Aviso->find( 'first', array( 
					'conditions' => array( 'Aviso.codigos_id' => $arrObj['Codigo']['id'], $arrConditions ) 
				) );
				if( $this->Aviso->getNumRows() == 0 )
				{
					
					
					
					
					/**
					 * Atualiza o registro 
					 */
					$this->Aviso->id = $arrObj['Aviso']['id'];
					//$arrAviso['Aviso']['estatus'] = $strStatus;
					$arrAviso['Aviso']['estatus'] = $strTabela;
					$this->Aviso->save( $arrAviso );
					
					
					
					$this->Email->lineLength = 1020;
					$this->Email->sendAs = "html";
					$this->Email->xMailer = "Mídia Negócios - Ecommerce";
					
					
					//$this->Email->headers = 'MIME-Version: 1.0\r\n';
					//$this->Email->headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
					
					
					/**
					 * Cópia para mim :D
					 */
					//$this->Email->bcc = 'john@midianegocios.com.br';
					
					
			//$arrObj['User']['email'] = "user@localhost";
					
					
					//$this->Email->to = $arrObj['User']['username'] ."<". $arrObj['User']['email'] .">";
					$this->Email->to = $arrObj['User']['email'];
					$this->Email->from = "rastreamento@midianegocios.com.br";
					$this->return = "john@midianegocios.com.br";
					$this->Email->replyTo = "john@midianegocios.com.br";
					
					
					$this->Email->subject = "Rastreamento ". $arrObj['Codigo']['codigo'];
					$strMensagem  = "Olá ". $arrObj['User']['username'] .",<br />";
					$strMensagem .= "<p>O rastreamento de sua encomenda identificada por '". $arrObj['Codigo']['nome'] ."' <b>(". $arrObj['Codigo']['codigo'] .")</b> ";
					$strMensagem .= "foi alterado. Isso lhe agradou? Esperamos que sim.</p>";
					
					$strMensagem ."<p>Veja o atual status de rastreamento de sua encomenda.</p>";
					
					
					
					/**
					 * Adiciona a tabela do rastreamento
					 */
					$strMensagem .= str_replace( '<table ', '<table style="border:1px solid #c1c1c1;" ', $strTabela );
					
					$strMensagem .= "<p>Enviaremos a você um novo email sempre que houver alterações no status de entrega desta encomenda até que ela seja entregue. ";
					$strMensagem .= "Para cancelar o acompanhamento desta encomenda <a href=\"http://". $_SERVER['HTTP_HOST'] ."/avisos/admin/delete/". $arrObj['Aviso']['id'] ."/". $arrObj['Codigo']['nome'] ."\">clique aqui</a>.</p>";
					
					
					$strMensagem .= "<p color=\"red\">Se você ainda não tem seus dados de acesso ao sistema de rastreamento, <a href=\"http://". $_SERVER['HTTP_HOST'] ."/users/forgot\">clique aqui</a> e informe este login (username) <b>". $arrObj['User']['username'] ."</b> no campo a seguir.</p>";
					
					
					$strMensagem .= "<p>Caso você tenha alguma dúvida entre em <a href=\"http://". $_SERVER['HTTP_HOST'] ."/contact\">contato conosco</a>.</p>";
					
					$strMensagem .= "<p><img src=\"http://". $_SERVER['HTTP_HOST'] ."/theme/rastreamento/img/logo-midia-negocios.jpg\" /></p>";
					$strMensagem .= "<address>Mídia Negócios - Soluções para comércio social.</address>";
					$this->Email->send( $strMensagem );
					
					
					$this->Email->reset();

					
					
					//echo $strMensagem;
					//echo  nl2br( print_r( $arrObjs,true ) );
					//echo "Enviado ". $arrObj['Codigo']['codigo'] ."<BR>";
					//echo "Data: ". $strData ." local: ". $strLocal ." Status: ". $strStatus ."<br /><hr />";
				}else{
					
					
					/**
					 * Atualiza o registro não atualizado 
					 * Evita o bug com registros antigos
					 */
					$this->Aviso->id = $arrObj['Aviso']['id'];
					//$arrAviso['Aviso']['estatus'] = $strStatus;
					$arrAviso['Aviso']['estatus'] = $strTabela;
					$this->Aviso->save( $arrAviso );
					
					
					//echo $arrObj['Codigo']['codigo'] ." sem modificação de estatus.<br>";
					//echo "Data: ". $strData ." local: ". $strLocal ." Status: ". $strStatus ."<br /><hr />";
					
				}
				
				$strStatus = null;
				$strLocal = null;
				$strData = null;
			}
		}
		
		
		print_r( $arrObjs );
	}
	
	
	
	
	
	
	
	


	function admin_index() {
		
		
		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		//print_r( $userData );
		
		/**
		 * Evitando erros com variavel nao definida
		 */
		$conditions = array();
		
		
		
		/**
		 * Condição para filtrar itens
		 */
		if( isset( $this->params['named']['flag'] ) )
		{
			
			$conditions[] = array( 'Aviso.estatus LIKE "%'. $this->params['named']['flag'] .'%"' );
		}else{
			//$conditions[] = array( 'Aviso.estatus' => 1 );
		}
		
		
		
		/**
		 * Condição para permitir o admin visualizar todos os registros
		 */
		if( $userData['role_id'] != 1 )
		{
			
			$conditions[] = array( 'Aviso.users_id' => $userData['id'] );
		}
		
		
		
		
		
		$this->Aviso->recursive = 0;
		$this->paginate = array( 'conditions' => $conditions );
		$this->set('avisos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Aviso.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('aviso', $this->Aviso->read(null, $id));
	}
	
	
	
	
	
	
	
    function user_add()
    {
        //$this->set('title_for_layout', __('Register', true));
        if (!empty($this->data)) {
            $this->User->create();
            $this->data['User']['role_id'] = 2; // Registered
            $this->data['User']['activation_key'] = md5(uniqid());
            $this->data['User']['status'] = 0;
            $this->data['User']['username'] = htmlspecialchars($this->data['User']['username']);
            $this->data['User']['website'] = htmlspecialchars($this->data['User']['website']);
            $this->data['User']['name'] = htmlspecialchars($this->data['User']['name']);
            if ($this->User->save($this->data)) {
                $this->data['User']['password'] = null;
                $this->Email->from = Configure::read('Site.title') . ' '
                    . '<croogo@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])).'>';
                $this->Email->to = $this->data['User']['email'];
                $this->Email->subject = __('[' . Configure::read('Site.title') . '] Please activate your account', true);
                $this->Email->template = 'register';
                $this->set('user', $this->data);
                $this->Email->send();

                $this->Session->setFlash(__('You have successfully registered an account. An email has been sent with further instructions.', true), 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('The User could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
            }
        }
    }
	
	
	

	/**
	 * Adiciona o aviso para ADM
	 *
	 */
	function admin_add() {
		if (!empty($this->data)) {
			$this->Aviso->create();
			if ($this->Aviso->save($this->data)) {
				$this->Session->setFlash(__('The Aviso has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Aviso could not be saved. Please, try again.', true));
			}
		}
		$codigos = $this->Aviso->Codigo->find('list', array( 'fields' => array( 'Codigo.id', 'Codigo.codigo' ) ) );
		$users = $this->Aviso->User->find('list', array( 'fields' => array( 'User.id', 'User.name' ) ) );
		$this->set(compact('codigos', 'users'));
	}
	
	
	
	

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Aviso', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Aviso->save($this->data)) {
				$this->Session->setFlash(__('The Aviso has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Aviso could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Aviso->read(null, $id);
		}
		$codigos = $this->Aviso->Codigo->find('list', array( 'fields' => array( 'Codigo.id', 'Codigo.codigo' ) ) );
		$users = $this->Aviso->User->find('list', array( 'fields' => array( 'User.id', 'User.name' ) ) );
		$this->set(compact('codigos','users'));
	}
	
	
	

	function admin_delete($id = null)
	{
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Aviso', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Aviso->del($id)) {
			$this->Session->setFlash(__('Aviso deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>