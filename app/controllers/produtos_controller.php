<?php
class ProdutosController extends AppController {

	var $name = 'Produtos';
	var $uses = array( "Produto", 'Opcao' );
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

	
	
	
	function admin_view($id = null) 
	{
		$conditions = array();
		
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
			$conditions = array( 'Produto.users_id' => $userData['id'] );
			
		}
		
		
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid produto', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->set('produto', $this->Produto->read(null, $id));
		$this->set('produto', $this->Produto->find( 'first', array( 
			'conditions' => array( 'Produto.id' => $id, $conditions )
		)));
	}

	
	
	
	
	function frete( $id = null, $strProdutoNome = null ) 
	{
		
		
		$this->set( 'title_for_layout', "Calcular frete - Cálculo de frete - Cálculo de frete correios - Calculo sedex - Calculo pac" );
		$this->set( 'title_for_content', "Calcular frete" );
				
		
		
		// Declarando variaveis
		$preco = 
		$cep =
		$peso =
		$altura =
		$largura =
		$comprimento =
		$envio_local =
		$envio_sedex =
		$envio_esedex =
		$envio_sedexacobrar =
		$envio_pac = 
		$envio_maximo =
		$url_retorno = 
		$produto_imagem =
		null;
		
		

		
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
		 * Buscando produto na versão mais recente sem POG
		 */
		$produto = $this->Produto->read( null, $id );
		
		
		
		/**
		 * Corrige problemas com opções extras do produto
		 */
		if( isset( $produto['Opcao'] ) )
		{
			
			foreach ( $produto['Opcao'] as $opcao )
			{
				
				// Refente ao basico do produto
				if( $opcao['chave'] == 'preco' && !empty( $opcao['valor'] ) ): $preco = $opcao['valor']; endif;
				if( $opcao['chave'] == 'cep' && !empty( $opcao['valor'] ) ): $cep = $opcao['valor']; endif;
				if( $opcao['chave'] == 'peso' && !empty( $opcao['valor'] ) ): $peso = $opcao['valor']; endif;
				
				
				
				// Referencia ao tamanho
				if( $opcao['chave'] == 'altura' && !empty( $opcao['valor'] ) ): $altura = $opcao['valor']; endif;
				if( $opcao['chave'] == 'largura' && !empty( $opcao['valor'] ) ): $largura = $opcao['valor']; endif;
				if( $opcao['chave'] == 'comprimento' && !empty( $opcao['valor'] ) ): $comprimento = $opcao['valor']; endif;
				

				
				// Referencia ao tipo de envio
				if( $opcao['chave'] == 'envio_local' && !empty( $opcao['valor'] ) ): $envio_local = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_sedex' && !empty( $opcao['valor'] ) ): $envio_sedex = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_sedexacobrar' && !empty( $opcao['valor'] ) ): $envio_sedexacobrar = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_pac' && !empty( $opcao['valor'] ) ): $envio_pac = $opcao['valor']; endif;
				
				
				/**
				 * Para usar e-sedex precisa ter contrato com os Correios.
				 * Só irá aparecer resultado se a o código da empresa e senha 
				 * estiverem corretos e a rota (origem e destino) forem atendidos 
				 * pelo serviço de e-sedex
				 */
				if( $opcao['chave'] == 'envio_esedex' && !empty( $opcao['valor'] ) ): $envio_esedex = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_esedex_cCdEmpresa' && !empty( $opcao['valor'] ) ): $envio_esedex_cCdEmpresa = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_esedex_sDsSenha' && !empty( $opcao['valor'] ) ): $envio_esedex_sDsSenha = $opcao['valor']; endif;
				
				
				// Refente a quantidade máxima por pacote (itens no mesmo pacote)
				if( $opcao['chave'] == 'envio_maximo' && !empty( $opcao['valor'] ) ): $envio_maximo = $opcao['valor']; else: $envio_maximo = 1; endif;
				

				// Imagem do produto no calculo de frete
				if( $opcao['chave'] == 'produto_imagem' && !empty( $opcao['valor'] ) ): 
					$produto_imagem_null = "imagem?"; 
				endif;
				
				
				/**
				 * URL de retorno do produto
				 * É opcional e o cliente adiciona se quiser
				 */
				if( $opcao['chave'] == 'url_retorno' && !empty( $opcao['valor'] ) ): $url_retorno = $opcao['valor']; endif;
				
				//echo $this->Form->input( 'Opcao.'. $opcao['chave'], array( 'value' => $opcao['valor'] ) );
			}
		}
		
		
		
			
		
			if( isset( $this->data ) && !empty($this->data['Produto']['cepdestino']))
			{
				
				
				
				
				/**
				 * Para evitar não mostrar as opções de frete 
				 * quando o produto não foi adicionado com a versão 
				 * nova.
				 */
				if( empty($envio_local) && empty($envio_sedex) && empty($envio_esedex) && empty($envio_sedexacobrar) && empty($envio_pac) )
				{
					$envio_pac = 
					$envio_sedex = 
					$envio_esedex = 
					$envio_sedexacobrar =
					1;
				}	
				
				
				
				
				
					/**
					 * Verificando se SEDEX é aceito
					 */
					if( !empty( $envio_sedex ) )
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
							
						
							$this->set( 'sedex', $this->Frete->requisicao( $envio_maximo ) );
							$this->Frete->entrada = null;
					}
					
					
				
				
					/**
					 * Verificando se E-SEDEX é aceito
					 */
					if( !empty( $envio_esedex ) )
					{
						
						
						//print_r( $this->data );
							
							/**
							 * E-SEDEX
							 */
							$this->Frete->entrada['nCdServico']     = 81019;
							$this->Frete->entrada['nCdEmpresa']		= Configure::read( "Ect.cCdEmpresa" );
							$this->Frete->entrada['sDsSenha']		= Configure::read( "Ect.sDsSenha" );
							$this->Frete->entrada['sCepOrigem']     = $this->data['Produto']['cep'];
							$this->Frete->entrada['sCepDestino']    = $this->data['Produto']['cepdestino'];
							$this->Frete->entrada['nVlPeso']        = $this->data['Produto']['peso'];
							$this->Frete->entrada['nVlComprimento'] = $this->data['Produto']['comprimento'];
							$this->Frete->entrada['nVlAltura']      = $this->data['Produto']['altura'];
							$this->Frete->entrada['nVlLargura']     = $this->data['Produto']['largura'];
							$this->Frete->entrada['nCdFormato']     = 1;
							$this->Frete->entrada['nVlValorDeclarado'] = r( '.', ',', $this->data['Produto']['preco'] );	
							$this->Frete->entrada['quantidade'] = $this->data['Produto']['quantidade'];
							
						
							$this->set( 'esedex', $this->Frete->requisicao( $envio_maximo ) );
							$this->Frete->entrada = null;
					}
					
					
					
					
					/**
					 * Verificando se SEDEX A COBRAR é aceito
					 */
					if( !empty( $envio_sedexacobrar ) )
					{
						
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
							
						
							$this->set( 'sedexacobrar', $this->Frete->requisicao( $envio_maximo ) );
							$this->Frete->entrada = null;
					}
					
					
					
					/**
					 * Verificando se PAC é aceito
					 */
					if( !empty( $envio_pac ) )
					{
						
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
							
						
							$this->set( 'pac', $this->Frete->requisicao( $envio_maximo ) );
							$this->Frete->entrada = null;
					}
					
					
			}else{// fim do if $this->data e empty( $this->data['Produto']['cepdestino']
		
		
		
		
				$this->data = $produto;
						
			}
			
			$this->set( 'produto_imagem', $produto_imagem );
			//$this->data = $produto;
		
				/**
				 * Informando valor para o campo quantidade
				 */
				if( !isset( $this->data['Produto']['quantidade'] ) )
				{
					$this->data['Produto']['quantidade'] = 1;
				}
				
				
		$this->set( 'freteAtivo', true );
						
						// botão de retorno ao anuncio
						$this->_botao_retorno( $url_retorno );

	}

	
	/**
	 * Exibe o botão com link de retorno 
	 * para o produto do anúncio
	 *
	 * @param String $url_retorno URL para onde deverá retornar o usuário quando clicar em 'voltar ao produto'
	 */
	function _botao_retorno( $url_retorno = null)
	{
		
						
				/**
				 * verificando se este usuário veio do Mercado Livre 
				 * se veio vamos adicionar o código de afiliado
				 */
				$site_alvo = 'produto.mercadolivre.com';
				

				// soluçoes para comercio social
				$str_afiliado = "http://pmstrk.mercadolivre.com.br/jm/PmsTrk?tool=5820923&go=";

				
				
				$sessao_retorno = $this->Session->read( 'site_retorno' );

				if( isset( $_SERVER['HTTP_REFERER'] ) && ( stristr( $_SERVER['HTTP_REFERER'], $site_alvo ) ) && ( !stristr( $sessao_retorno, $site_alvo ) ) )
				{
					
					$site_retorno = $this->referer();
					/**
					 * Grava o endereço de retorno na sessão
					 * caso aconteça o cálculo de frete o usuário 
					 * pode retornar normalmente
					 */
					$this->Session->write( 'site_retorno', $site_retorno );
				}
				
				
				
				/**
				 * Se a sessao possuir um valor (não vazio) 
				 * Lê novamente por causa da gravação acima
				 */
				$sessao_retorno = $this->Session->read( 'site_retorno' );
				
				if( isset( $sessao_retorno ) && ( !empty( $sessao_retorno ) ) )
				{
					
					
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
					$sessao_retorno = "http://lista.mercadolivre.com.br/_DisplayType_G_FilterId_MAS*VND";
					$this->set( 'retornar_url', $str_afiliado . $sessao_retorno );
				}
				
				
				
				
				
				
				
				
				
				
				
				/**
				 * Pulando tudo para evitar problemas de 
				 * interpretação com os códigos anteriores
				 */
				if( !empty( $url_retorno ) )
				{
					
					// Monta a URL de retorno com código de afiliado
					$this->set( 'retornar_url', $str_afiliado . $url_retorno );
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
	
	
	

	
	
	function admin_add() {		
		
		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		

		if (!empty($this->data)) {


			$this->Produto->create();
			
			$this->data['Produto']['flag'] = 1;
			$this->data['Produto']['preco'] = str_replace( ',', '.', $this->data['Produto']['preco'] );
			if ($this->Produto->save($this->data)) {
				//$this->Session->setFlash(__('The Produto has been saved', true));
				
				
				/**
				 * Aviso
				 */
				$this->Session->setFlash(__('The Produto has been saved', 'aviso' ) );
				
				
				/**
				 * Adicionando opcoes do produto
				 * Remove os antigos e adiciona os novos
				 */
				$this->_campos_opcoes( $this->Produto->getLastInsertId() );
				

				
				/**
				 * O flag 2 é virtual 
				 * sempre que existente será exibida a mensagem para novos produtos
				 */
				$this->redirect(array('action'=>'index', 'flag:2' ) );
			} else {
				$this->Session->setFlash(__('The produto could not be saved. Please, try again.', true));
			}
		}
		
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
		
		
		$users = $this->Produto->User->find('list');
		$this->set(compact('users', 'userData'));
	}

	
	
	
	
	function admin_edit($id = null) 
	{
		
		
		
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
		
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid produto', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data))
		{
			
			$this->data['Produto']['preco'] = str_replace( ',', '.', $this->data['Produto']['preco'] );
			if ($this->Produto->save($this->data)) {
				$this->Session->setFlash(__('The produto has been saved', true));

				
				/**
				 * Adicionando opcoes do produto
				 * Remove os antigos e adiciona os novos
				 */
				$this->_campos_opcoes( $id );
				
				
				
				/**
				 * O flag 2 é virtual 
				 * sempre que existente será exibida a mensagem para novos produtos
				 */
				$this->redirect(array('action'=>'index', 'flag:2' ) );
				
			} else {
				$this->Session->setFlash(__('The produto could not be saved. Please, try again.', true));
			}
		}
		
		
		if (empty($this->data)) {
			$this->data = $this->Produto->read(null, $id);
			
		}
		
		
		/**
		 * Quando não for administrador, informar o ID
		 */
		if( $userData['role_id'] != 1 )
		{
			//$this->data['Produto']['users_id'] = $userData['id'];
			
			/**
			 * Informa para a view o ID do usuário
			 */
			$this->set( 'badeco', $userData['id'] );
			
		}
		
		
		$users = $this->Produto->User->find('list');
		$this->set(compact('users', 'userData'));
	}

	
	
	
	function admin_delete($id = null) {
		
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
				if ($this->Produto->saveField( 'flag', 0 ) )
				{
					$this->Session->setFlash(__('Produto deleted', true));
					$this->redirect(array('action'=>'index'));
				}else{
					$this->Session->setFlash( __('Problema ao remover produto', true ));
					$this->redirect(array('action'=>'index'));
				}
				
			}else{
				
				if ($this->Produto->delete($id)) {
					$this->Session->setFlash(__('Produto deleted', true));
					$this->redirect(array('action'=>'index'));
				}
			}
		}
	}
	
	
	
	
	

	/**
	 * Altera as informações das opções
	 *
	 * @param Array $opcao do produto
	 * @param Integer $id do produto
	 */
	function _campos_opcoes( $id )
	{
		
				
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
				$opcao['Opcao']['chave'] = 'envio_esedex';
				$opcao['Opcao']['valor'] = $this->data['Produto']['envio_esedex'];
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
				 * URL de retorno ao produto
				 */
				$this->Opcao->id = null;
				$opcao['Opcao']['chave'] = 'url_retorno';
				$opcao['Opcao']['valor'] = $this->data['Produto']['url_retorno'];
				$this->Opcao->save( $opcao );

	}
	
	
}
?>