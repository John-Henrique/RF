<?php
class ProdutosController extends AppController {

	var $name = 'Produtos';
	var $uses = array( 'Produto', 'Opcao', 'Company' );
	var $helpers = array('Html', 'Form', 'Javascript', 'Number', 'Layout', 'Custom' );
	var $components = array( 'Botao', 'Frete', 'RequestHandler', 'Security' );


	
	
  	/**
  	 * API Rest permite listar os registros dos produtos
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
			if( ( $userData['role_id'] != 1 ) && ( $userData['role_id'] != 1 ) )
			{
				
				$conditions[] = array( 'Produto.users_id' => 1 );
			}
			
			
			$this->Produto->recursive = 1;
	    	$produtos = $this->Produto->find( 'all', array( 'fields' => array( 'Produto.id', 'Produto.nome', 'Produto.created', 'User.id', 'User.username', 'User.name' ), 'conditions' => array( 'Produto.flag' => 1, $conditions ) ) );
	    	
		
    	$this->set(compact('produtos'));
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
					
					$conditions[] = array( 'Produto.users_id' => $userData['id'] );
				}
				
				
				
				
				/**
				 * Localizando o produto do usuário e id informado
				 */
				//$produto = $this->Produto->find( 'first', array( 'fields' => array( 'Produto.id', 'Produto.nome', 'Produto.created', 'User.id', 'User.username', 'User.name' ), 'conditions' => array( 'Produto.id' => $id, $conditions ) ) );
				$produto = $this->Produto->find( 'first', array( 'fields' => array( 'Produto.id', 'Produto.nome', 'Produto.created', 'User.id', 'User.username', 'User.name'), 'conditions' => array( 'Produto.id' => $id, $conditions ) ) );
				
				
				/**
				 * Se for encontrado registro
				 */
				if( $this->Produto->getNumRows() != 0 )
				{
						
					/**
					 * Alterna a mensagem de erro para o objeto de produtos
					 */
					$message = $produto;
					$this->set(compact('produto'));
				}

				$this->set(compact('produto'));
					
		//'conditions' => array( 'Produto.flag' => 1, $conditions ) ), 
		//$produto = $this->Produto->read( array( 'Produto.id', 'Produto.nome', 'Produto.created', 'User.id', 'User.username', 'User.name' ), $id );

		$this->set(compact('message'));
	}
	
	

	
	
  	/**
  	 * API Rest permite editar o registro do produto informado por ID
  	 *
  	 * @param Integer $id
  	 */
	function edit($id) 
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
				
				/**
				 * Localizando o produto do usuário e id informado
				 */
				$this->Produto->find( 'first', array( 'fields' => array( 'Produto.id' ), 'conditions' => array( 'Produto.users_id' => $userData['id'], 'Produto.id' => $id ) ) );
				
				
				/**
				 * Se for encontrado registro
				 */
				if( $this->Produto->getNumRows() == 1 )
				{
						
					$this->Produto->id = $id;
					if ($this->Produto->save($this->data)) {
						$message = 'Saved';
					} else {
						$message = 'Error';
					}
				}
			}
			
			
		$this->set(compact("message"));
  	}

  	
  	
  	
  	
  	/**
  	 * API Rest permite apagar o registro do produto informado por ID
  	 *
  	 * @param Integer $id
  	 */
	function delete($id) 
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
				
				/**
				 * Localizando o produto do usuário e id informado
				 */
				$this->Produto->find( 'first', array( 'fields' => array( 'Produto.id' ), 'conditions' => array( 'Produto.users_id' => $userData['id'], 'Produto.id' => $id ) ) );
				
				
				/**
				 * Se for encontrado registro
				 */
				if( $this->Produto->getNumRows() == 1 )
				{
						
					if($this->Produto->delete($id)) {
						$message = 'Deleted';
					} else {
						$message = 'Error';
					}
				}
			}
			

		$this->set(compact("message"));
	}
	
	

	
	
	
	
	
	function frete( $id = null, $strProdutoNome = null ) 
	{
		
		
		$this->set( 'title_for_layout', "Calcular frete - Cálculo de frete - Cálculo de frete correios - Calculo sedex - Calculo pac" );
		$this->set( 'title_for_content', "Calcular frete" );
				
		
		
		/**
		 * Corrigindo os URLs antigos da versão WordPress
		 */
		if( isset( $this->params['url']['id'] ) )
		{
			
			$id = $this->params['url']['id'];
		}
		
		
		
		/**
		 * Corrigindo para fazer o cálculo exemplo
		 */
		if( $strProdutoNome != 'calculo-de-frete.html' )
		{
			
			$this->layout = "calculo_frete";
		}
		
		
		

					
					
					/**
					 * Buscando o registro
					 */
					//$objOpcoes = $this->Opcao->find( 'all', array( 'conditions' => array( 'Opcao.produtos_id' => $id ), 'order' => array( 'Opcao.id' => 'ASC' ) ) );
					
					
					/**
					 * Verificando se foi encontrado algum registro
					 */
					//if( $this->Opcao->getNumRows() != 0 )
					if( !empty( $this->data['Produto']['cepdestino'] ) )
					{
						
						
						//print_r( $this->data );
							
							/**
							 * SEDEX
							 */
							$this->Frete->entrada['nCdServico']     = 40010;
							$this->Frete->entrada['sCepOrigem']     = $this->data['Produto']['cep'];
							$this->Frete->entrada['sCepDestino']    = $this->data['Produto']['cepdestino'];
							$this->Frete->entrada['nVlPeso']        = $this->data['Produto']['peso'];
							$this->Frete->entrada['nVlComprimento'] = $this->data['Produto']['comprimento'];
							$this->Frete->entrada['nVlAltura']      = $this->data['Produto']['altura'];
							$this->Frete->entrada['nVlLargura']     = $this->data['Produto']['largura'];
							$this->Frete->entrada['nCdFormato']     = 1;
							$this->Frete->entrada['nVlValorDeclarado'] = r( '.', ',', $this->data['Produto']['preco'] );	
							$this->Frete->entrada['quantidade'] = $this->data['Produto']['quantidade'];	
							
						
							$this->set( 'sedex', $this->Frete->requisicao() );
							$this->Frete->entrada = null;
							
													
							
							/**
							 * SEDEX A COBRAR
							 */
							$this->Frete->entrada['nCdServico']     = 40045;
							$this->Frete->entrada['sCepOrigem']     = $this->data['Produto']['cep'];
							$this->Frete->entrada['sCepDestino']    = $this->data['Produto']['cepdestino'];
							$this->Frete->entrada['nVlPeso']        = $this->data['Produto']['peso'];
							$this->Frete->entrada['nVlComprimento'] = $this->data['Produto']['comprimento'];
							$this->Frete->entrada['nVlAltura']      = $this->data['Produto']['altura'];
							$this->Frete->entrada['nVlLargura']     = $this->data['Produto']['largura'];
							$this->Frete->entrada['nCdFormato']     = 1;
							$this->Frete->entrada['nVlValorDeclarado'] = r( '.', ',', $this->data['Produto']['preco'] );	
							$this->Frete->entrada['quantidade'] = $this->data['Produto']['quantidade'];	
							
						
							$this->set( 'sedexacobrar', $this->Frete->requisicao() );
							$this->Frete->entrada = null;
							
							
							
							
							/**
							 * PAC
							 */
							$this->Frete->entrada['nCdServico']     = 41106;
							$this->Frete->entrada['sCepOrigem']     = $this->data['Produto']['cep'];
							$this->Frete->entrada['sCepDestino']    = $this->data['Produto']['cepdestino'];
							$this->Frete->entrada['nVlPeso']        = ( !empty( $this->data['Produto']['peso'] ) )? $this->data['Produto']['peso']: 0;
							$this->Frete->entrada['nVlComprimento'] = ( !empty( $this->data['Produto']['comprimento'] ) )? $this->data['Produto']['comprimento']: 0;
							$this->Frete->entrada['nVlAltura']      = ( !empty( $this->data['Produto']['altura'] ) )? $this->data['Produto']['altura']: 0;
							$this->Frete->entrada['nVlLargura']     = ( !empty( $this->data['Produto']['largura'] ) )? $this->data['Produto']['largura']: 0;
							$this->Frete->entrada['nCdFormato']     = 1;
							$this->Frete->entrada['nVlValorDeclarado'] =  ( !empty( $this->data['Produto']['largura'] ) )? r( '.', ',', $this->data['Produto']['preco'] ): 0;	
							$this->Frete->entrada['quantidade'] = $this->data['Produto']['quantidade'];	
							
						
							$this->set( 'pac', $this->Frete->requisicao() );
							$this->Frete->entrada = null;
			
			
					}else{
				
					
						
						/**
						 * Localizando itens do produto
						 */
						$arrProduto = $this->Opcao->find( 'all', array( 'conditions' => array( 'Opcao.produtos_id' => $id, 'Produto.flag' => 1 ), 'order' => array( 'Opcao.id' => 'ASC' ) ) );
						
						
						/**
						 * Conta a quantidade de registros encontrados
						 */
						$numRows = $this->Opcao->getNumRows();
						
						
						/**
						 * Permitindo o bloqueio no frete
						 */
						$this->set( 'freteAtivo', $numRows );
						
						
						if( $numRows != 0 )
						{
							
							$this->data['Produto'] = $arrProduto[0]['Produto'];
							
							/**
							 * Aparentemente existe um bug
							 * sempre que fica no cache nao realiza a consulta das
							 * opcoes do produto
							 */
							//print_r( $arrProduto );
						}
				
					
					}
				
				
				
				
				/**
				 * Informando valor para o campo quantidade
				 */
				if( !isset( $this->data['Produto']['quantidade'] ) )
				{
					$this->data['Produto']['quantidade'] = 1;
				}
				
				
				
				
				
				
					
						
						/**
						 * Localizando itens do produto
						 */
						$arrProduto = $this->Opcao->find( 'all', array( 'fields' => array( 'Produto.id' ), 'conditions' => array( 'Opcao.produtos_id' => $id, 'Produto.flag' => 1 ), 'order' => array( 'Opcao.id' => 'ASC' ) ) );
						
						
						/**
						 * Conta a quantidade de registros encontrados
						 */
						$numRows = $this->Opcao->getNumRows();
						
						
						/**
						 * Permitindo o bloqueio no frete
						 */
						$this->set( 'freteAtivo', $numRows );
						//$this->data['Produto'] = $arrProduto[0]['Produto'];
						
						
				
						
						// botão de retorno ao anuncio
						$this->_botao_retorno();

	}


	
	
	/**
	 * Exibe o botão com link de retorno 
	 * para o produto do anúncio
	 *
	 */
	function _botao_retorno()
	{
		
						
				/**
				 * verificando se este usuário veio do Mercado Livre 
				 * se veio vamos adicionar o código de afiliado
				 */
				$site_alvo = 'produto.mercadolivre.com';
				
				
				$sessao_retorno = $this->Session->read( 'site_retorno' );

				if( isset( $_SERVER['HTTP_REFERER'] ) && ( stristr( $_SERVER['HTTP_REFERER'], $site_alvo ) != false ) && ( $sessao_retorno != $_SERVER['HTTP_REFERER'] ) )
				{
					
					$site_retorno = $_SERVER['HTTP_REFERER'];
					/**
					 * Grava o endereço de retorno na sessão
					 * caso aconteça o cálculo de frete o usuário 
					 * pode retornar normalmente
					 */
					$this->Session->write( 'site_retorno', $site_retorno );
				}
				
				
				
				/**
				 * Se o referer possuir um valor (não vazio) 
				 */
				if( isset( $_SERVER['HTTP_REFERER'] ) && ( !empty( $_SERVER['HTTP_REFERER'] ) ))
				{
					
					$sessao_retorno = $this->Session->read( 'site_retorno' );
					
					// soluçoes para comercio social
					$str_afiliado = "http://pmstrk.mercadolivre.com.br/jm/PmsTrk?tool=5820923&go=";
					$this->set( 'retornar_url', $str_afiliado . $sessao_retorno );
				}else{
					
					/**
					 * Redireciona para a página principal do 
					 * Mercado Livre, evitando a página de idiomas 
					 * do ML.					 
					 * 
					 * Direcionando para a página de mais vendidos 
					 */
					// soluçoes para comercio social
					$str_afiliado = "http://pmstrk.mercadolivre.com.br/jm/PmsTrk?tool=5820923&go=http://lista.mercadolivre.com.br/_DisplayType_G_FilterId_MAS*VND";
					$this->set( 'retornar_url', $str_afiliado . $sessao_retorno );
				}
	}
	
	
	
	
	
	function admin_botoes( $intProdutoId = null, $strLink = null )
	{
		
		$this->set( 'title_for_content', 'Botões de cálculo' );
		
		
		/**
		 * Contornando erros com variáveis não declaradas
		 */
		$this->set( 'intProdutoId', $intProdutoId );
		//$intProdutoId = $intProdutoId;
		$this->set( 'strLink', $strLink );
		
		
		
		/**
		 * Adicionando parametros de cor
		 */
		$strCor = ( isset( $this->params['named']['cor'] ) )? $this->params['named']['cor']:'';
		
		
		
		/**
		 * Lista os botões existentes
		 */
		$this->set( 'botoes', $this->Botao->listar( $strCor ) );
	
	}
	
	
	
	
	
	
	
	function admin_index() 
	{
		
		
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
			
			$conditions[] = array( 'Produto.flag' => $this->params['named']['flag'] );
		}else{
			$conditions[] = array( 'Produto.flag' => 1 );
		}
		
		
		
		/**
		 * Condição para permitir o admin visualizar todos os registros
		 */
		if( $userData['role_id'] != 1 )
		{
			
			$conditions[] = array( 'Produto.users_id' => $userData['id'] );
		}
		
		
		
		
		
		$this->Produto->recursive = 0;
		$this->paginate = array( 'conditions' => $conditions );
		$this->set('produtos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Produto.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('produto', $this->Produto->read(null, $id));
		
		
		$this->set( 'opcoes', $this->Opcao->find( 'all', array( 'conditions' => array( 'Opcao.produtos_id' => $id ) ) ) );
	}

	
	
	function admin_add() {
		
		
		if (!empty($this->data))
		{

		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
		/**
		 * Quando não for administrador, informar o ID
		 */
		if( $userData['role_id'] != 1 )
		{
			$this->data['Produto']['users_id'] = $userData['id'];
			
			/**
			 * Informa para a view o ID do usuário
			 */
			$this->set( 'badeco', $userData['id'] );
			
		}
		
		

			$this->Produto->create();
			
			$this->data['Produto']['flag'] = 1;
			if ($this->Produto->save($this->data)) {
				//$this->Session->setFlash(__('The Produto has been saved', true));
				
				
				/**
				 * Aviso
				 */
				$this->Session->setFlash(__('The Produto has been saved', 'aviso' ) );
				
				
				/**
				 * Adicionando opcoes do produto
				 */
				$opcao['Opcao']['produtos_id'] = $this->Produto->getLastInsertId();
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'cep';
				$opcao['Opcao']['valor'] = $this->data['Produto']['cep'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'peso';
				$opcao['Opcao']['valor'] = $this->data['Produto']['peso'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'preco';
				$opcao['Opcao']['valor'] = $this->data['Produto']['preco'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'largura';
				$opcao['Opcao']['valor'] = $this->data['Produto']['largura'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'altura';
				$opcao['Opcao']['valor'] = $this->data['Produto']['altura'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'comprimento';
				$opcao['Opcao']['valor'] = $this->data['Produto']['comprimento'];
				$this->Opcao->save( $opcao );
				

				
				/**
				 * O flag 2 é virtual 
				 * sempre que existente será exibida a mensagem para novos produtos
				 */
				$this->redirect(array('action'=>'index', 'flag:2' ) );
				
			} else {
				$this->Session->setFlash(__('The Produto could not be saved. Please, try again.', true));
			}
		}
		
		
		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
		/**
		 * Quando não for administrador, informar o ID
		 */
		if( $userData['role_id'] != 1 )
		{
			$this->data['Produto']['users_id'] = $userData['id'];
			
			/**
			 * Informa para a view o ID do usuário
			 */
			$this->set( 'badeco', $userData['id'] );
			
		}
		
		
		$users = $this->Produto->User->find('list', array( 'fields' => array( 'User.id', 'User.username' ) ) );
		$this->set(compact('users'));

	}
	
	
	

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Produto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			
			

		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
		/**
		 * Quando não for administrador, informar o ID
		 */
		if( $userData['role_id'] != 1 )
		{
			$this->data['Produto']['users_id'] = $userData['id'];
			
			/**
			 * Informa para a view o ID do usuário
			 */
			$this->set( 'badeco', 'porra' );
			
		}
		
		
		
			
			if ($this->Produto->save($this->data)) {
				$this->Session->setFlash(__('The Produto has been saved', true));
				
				
				
				/**
				 * Adicionando opcoes do produto
				 * Remove os antigos e adiciona os novos
				 */
				$this->Opcao->deleteAll( array( 'Opcao.produtos_id' => $id ) );
				
				$opcao['Opcao']['produtos_id'] = $id;
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'cep';
				$opcao['Opcao']['valor'] = $this->data['Produto']['cep'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'peso';
				$opcao['Opcao']['valor'] = $this->data['Produto']['peso'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'preco';
				$opcao['Opcao']['valor'] = $this->data['Produto']['preco'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'largura';
				$opcao['Opcao']['valor'] = $this->data['Produto']['largura'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'altura';
				$opcao['Opcao']['valor'] = $this->data['Produto']['altura'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'comprimento';
				$opcao['Opcao']['valor'] = $this->data['Produto']['comprimento'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'envio_local';
				$opcao['Opcao']['valor'] = $this->data['Produto']['envio_local'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'envio_pac';
				$opcao['Opcao']['valor'] = $this->data['Produto']['envio_pac'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'envio_sedex';
				$opcao['Opcao']['valor'] = $this->data['Produto']['envio_sedex'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'envio_sedexacobrar';
				$opcao['Opcao']['valor'] = $this->data['Produto']['envio_sedexacobrar'];
				$this->Opcao->save( $opcao );
				
				
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'envio_maximo';
				$opcao['Opcao']['valor'] = $this->data['Produto']['envio_maximo'];
				$this->Opcao->save( $opcao );
				

				

				
				/**
				 * O flag 2 é virtual 
				 * sempre que existente será exibida a mensagem para novos produtos
				 */
				$this->redirect(array('action'=>'index', 'flag:2' ) );
				
				
			} else {
				$this->Session->setFlash(__('The Produto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Produto->read(null, $id);
			
			//$this->data['Opcao'] = $this->Opcao->
			
		}
		
		
		
		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
		/**
		 * Quando não for administrador, informar o ID
		 */
		if( $userData['role_id'] != 1 )
		{
			$this->data['Produto']['users_id'] = $userData['id'];
			
			/**
			 * Informa para a view o ID do usuário
			 */
			$this->set( 'badeco', 'porra' );
			
		}
		
		
		
		$produto_read = $this->Produto->read( null, $id );
		$produto_read['Produto']['peso'] = $produto_read['Opcao'][0]['valor'];
		$produto_read['Produto']['preco'] = $produto_read['Opcao'][1]['preco'];
		$produto_read['Produto']['cep'] = $produto_read['Opcao'][2]['cep'];
		$this->set( 'produtos', $produto_read );
		
		$users = $this->Produto->User->find('list', array( 'fields' => array( 'User.id', 'User.username' ) ) );
		
		$opcoes = $this->Opcao->find( 'all', array( 'conditions' => array( 'Opcao.produtos_id' => $id ), 'order' => array( 'Opcao.id' => 'ASC' ) ) );
		$this->set(compact('users', 'opcoes'));
	}

	function admin_delete($id = null) 
	{
		
		
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Produto', true));
			$this->redirect(array('action'=>'index'));
		}else{
		
		
					
			
			/**
			 * Usuário com permissão de acesso restrito?
			 */
			$userData = $this->Session->read( 'Auth.User' );
			
			
			/**
			 * Quando não for administrador, informar o ID
			 */
			if( $userData['role_id'] != 1 )
			{
				
				$this->Produto->id = $id;
				$this->data['Produto']['flag'] = 0;
				if ($this->Produto->save( $this->data ) )
				{
					$this->Session->setFlash(__('Produto deleted', true));
					$this->redirect(array('action'=>'index'));
				}
				
			}else{
				
				if ($this->Produto->del($id)) {
					$this->Session->setFlash(__('Produto deleted', true));
					$this->redirect(array('action'=>'index'));
				}
			}
		}
	}

}
?>