<?php
class RastreamentosController extends RastreamentoAppController {

	public $name = 'Rastreamentos';
	
	public $components = array( 'Email');
	public $helpers = array( 'Javascript' );
	
	
	/**
	 * Realiza a verificação de rastreamento automatico 
	 * via email
	 *
	 */
	public function automatico()
	{
		
		App::import( 'Vendor', 'Rastreamento.correios/correio' );
		
		
		/**
		 * Verificar a data da ultima modificação para evitar
		 * overload e consulta do mesmo registro várias vezes 
		 * Será consultado a cada 3 horas
		 * 
		 * Rastreamento.flag => 0 a encomenda nao foi entregue
		 * Rastreamento.flag => 1 a encomenda foi entregue
		 */
		$this->Rastreamento->recursive = 0;
		$arrCodigos = $this->Rastreamento->find( 'all', array(
			'fields' => array(
				'Rastreamento.id', 
				'Rastreamento.hash', 
				'Rastreamento.email', 
				'Rastreamento.codigo', 
				'Rastreamento.situacao', 
			),
			'conditions' => array(
				"TIMEDIFF( NOW( ), Rastreamento.modified ) >= '03:00:00'", 
				//'Rastreamento.codigo IS NOT NULL', // por via das duvidas...
				'Rastreamento.codigo !=' => '', // por via das duvidas...
				//'Rastreamento.email IS NOT NULL', // por via das duvidas...
				'Rastreamento.email !=' => '', // por via das duvidas...
				'Rastreamento.flag' => 0, 
			), 
			'order' => array(
				'Rastreamento.modified' => 'DESC', // ordenar pelo mais velho
			),
			'limit' => 10
		));
		
		
		// se existir um valor no indice
		if( isset( $arrCodigos ) && !empty( $arrCodigos ) )
		{
			
			
			// percorre os indices
			foreach ( $arrCodigos as $arrCodigo )
			{
				
				// realiza o rastreamento
				$correio = new Correio( $arrCodigo['Rastreamento']['codigo'] );
				
				
				
				// verificando códigos alterados
				if( !isset( $correio->erro_msg ) )
				{
					
					//print_r( $correio );
					
					
					// salvando o resultado
					$this->Rastreamento->id = $arrCodigo['Rastreamento']['id'];
					if( $this->Rastreamento->saveField( 'hash', $correio->hash ) )
					{
						// não sei porque o Rastreamento::save() não estava funcionando
						$this->Rastreamento->saveField( 'situacao', $correio->status );
						
						
						
						// notifica via email
						$this->_envia_email( $correio, $arrCodigo );
						
						//print_r( $arrCodigo );
						
						
						//$this->Session->setFlash( __( "Salvo com sucesso", true ));
					}else{
						$this->Session->setFlash( __( "Problemas ao salvar", true ));
					}
				
					
				}else{
					
					$this->Session->setFlash( __( "Hash é identico ao existente, não houve alteração ", true ));
				}
			}
			
		}else{
			
			$this->Session->setFlash( __( "arrCodigos está vazio ou não existe", true ));
		}
	}
	
	
	
	
	protected function _envia_email( $correio, $rastreamento )
	{
 		
		// modo de debugar o email "debug"
		//$this->Email->delivery = 'mail';
		
	    $this->Email->to = $rastreamento['Rastreamento']['email'];
	    //$this->Email->to = 'john<johnhenrique@gmail.com>';
	    $this->Email->subject = 'Rastreamento '. $rastreamento['Rastreamento']['codigo'];
	    $this->Email->from = Configure::read('Site.email') .'<'. Configure::read( 'Site.email' ) .'>';
	    //$this->Email->from = 'john<johnhenrique@gmail.com>';
	    //$this->Email->replyTo = Configure::read('Site.email') .'<'. Configure::read( 'Site.email' ) .'>';
	    //$this->Email->return = Configure::read('Site.email') .'<'. Configure::read( 'Site.email' ) .'>';
	    $this->Email->template = 'aviso'; // note no '.ctp'
	    //Send as 'html', 'text' or 'both' (default is 'text')
	    $this->Email->sendAs = 'text'; // because we like to send pretty mail
	    //Set view variables as normal
	    $this->set( compact( "correio", "rastreamento" ));
	    //Do not pass any args to send()
	    if( $this->Email->send() )
	    {
	    	$this->Session->setFlash( __("Notificação enviada com sucesso", true ));
	    }else{
	    	
	    	$this->Session->setFlash( __("Problemas ao tentar enviar notificação", true ));
	    }
	    
	    
	    $this->Email->reset();
	}
	
	
	
	

	function index() {
		$this->Rastreamento->recursive = 0;
		$this->set('rastreamentos', $this->paginate());
	}


	
	/**
	 * WebService Rest de uso da classe com cache
	 * use: 
	 * http://rastreamentopedido.com/webservice/SZ843766706BR
	 * http://rastreamentopedido.com/webservice/SZ843766706BR/xml
	 * http://rastreamentopedido.com/webservice/SZ843766706BR/dump
	 * http://rastreamentopedido.com/webservice/SZ843766706BR/serial
	 * e finalmente, para amantes de Ajax:
	 * http://rastreamentopedido.com/webservice/SZ843766706BR/minhaFuncJs
	 *
	 * @param String $codigo código de rastreamento dos correios
	 * @param String $formato formato de retorno dos dados XML, Json, Serial e Dump. O padrão é Json
	 * @param String $callback função JavaScript a ser chamada após a execução da consulta
	 */
	function webservice($codigo = null, $formato = null, $callback = null ) 
	{
		
		if (!$codigo) {
			$this->Session->setFlash(__('Invalid rastreamento', true));
			$this->redirect(array('action' => 'index'));
		}
		
		
		// Configuração de cache para arquivos do webservice  
		Cache::set('websevice', array(  
		    'prefix'	=> 'cake_webservice_', 
		    'path'		=> CACHE . 'webservice' . DS,  
		    'duration'	=> '+30 minutes', 
		));
		
		
		
		
		// alterando o layout
		$this->layoutPath = "webservice";
		$this->layout = "default";
		
		
		// Cria nome de arquivo de cache
		$cache_file = $codigo;
	
		// Se o cache existir e tiver menos de 5 minutos de vida
		if (file_exists($cache_file) && date('U') - filemtime($cache_file) < 300)
		{
			
			// Retorna o cache
			$correio = unserialize( Cache::read( $cache_file ));
			$correio->cached = true;
			
		}else{

			// Senão, consulta...
			App::import( 'Vendor', 'Rastreamento.correios/correio' );
			
			// realiza o rastreamento
			$correio = new Correio( $codigo );
			
			// .. e renova o cache
			Cache::write( $cache_file, serialize( $correio ) );
	
			$correio->cached = false;
		}
		
		
		$this->set( compact( "correio", "formato", "callback" ) );
	}
	
	
	function rss($codigo = null) 
	{
		
		if (!$codigo) {
			$this->Session->setFlash(__('Invalid rastreamento', true));
			$this->redirect(array('action' => 'index'));
		}
		
		
		// alterando o layout
		$this->layoutPath = "rss";
		$this->layout = "default";
		
		$arrCodigo = $this->Rastreamento->findByCodigo($codigo);
		
		
		App::import( 'Vendor', 'Rastreamento.correios/correio' );
		
		// realiza o rastreamento
		$correio = new Correio( $arrCodigo['Rastreamento']['codigo'] );
		
		
		
		$this->set( compact( "correio", "codigo" ) );
	}
	
	
	
	
	function view($id = null) 
	{
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid rastreamento', true));
			$this->redirect(array('action' => 'index'));
		}
		
		
		$arrCodigo = $this->Rastreamento->findByCodigo($id);
		
		
		App::import( 'Vendor', 'Rastreamento.correios/correio' );
		
		// realiza o rastreamento
		$correio = new Correio( $arrCodigo['Rastreamento']['codigo'] );
		
		
		
		$this->set( compact( "correio", "id" ) );
	}
	
	
	
	

	/**
	 * Adiciona o código ao rastreamento
	 *
	 */
	function add() 
	{
		
		/**
		 * Se não foi informado o email 
		 * apenas redireciona para o view
		 */
		if( !empty($this->data) && empty( $this->data['Rastreamento']['email'] ) )
		{
			
			// redireciona para a view
			$this->redirect(array( 
				'action' => 'view', 
				$this->data['Rastreamento']['codigo']
			));
		}else{
		
			// cadastra o código para rastrear
			if (!empty($this->data)) {
				$this->Rastreamento->create();
				if ($this->Rastreamento->save($this->data)) {
					$this->Session->setFlash(__('The rastreamento has been saved', true));
					
					// redireciona para a view
					$this->redirect(array( 
						'action' => 'view', 
						$this->data['Rastreamento']['codigo']
					));
				} else {
					$this->Session->setFlash(__('The rastreamento could not be saved. Please, try again.', true));
				}
			}
		
				
		}// fim do if email
	}

	
	
	
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid rastreamento', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Rastreamento->save($this->data)) {
				$this->Session->setFlash(__('The rastreamento has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rastreamento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Rastreamento->read(null, $id);
		}
	}

	
	
	/**
	 * Remove o código de rastreamento
	 *
	 * @param Integer $id
	 * @param String $codigo
	 */
	function delete($id = null, $codigo = null ) 
	{
		// se não existe o ID e o código
		if (!$id || !$codigo) {
			$this->Session->setFlash(__('Invalid id for rastreamento', true));
			$this->redirect(array('action'=>'index'));
		}else{
			
			/**
			 * Apenas conto quantos registros foram 
			 * encontrados, não preciso retornar campos
			 */
			$intQtnEncontrada = $this->Rastreamento->find( 'count', array( 
				'conditions' => array(
					'Rastreamento.codigo' => $codigo, 
					'Rastreamento.id' => $id
				)
			));
			
			// se encontrou algum registro (somente 1 sempre)
			if( $intQtnEncontrada != 0 )
			{
				
				// tenta remover o registro
				if ($this->Rastreamento->delete($id)) {
					$this->Session->setFlash(__('Rastreamento deleted', true));
					$this->redirect(array('action'=>'index'));
				}
				
				// não conseguiu remover
				$this->Session->setFlash(__('Rastreamento was not deleted', true));
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	
	
	
	function admin_index() {
		$this->Rastreamento->recursive = 0;
		$this->set('rastreamentos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid rastreamento', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('rastreamento', $this->Rastreamento->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Rastreamento->create();
			if ($this->Rastreamento->save($this->data)) {
				$this->Session->setFlash(__('The rastreamento has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rastreamento could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid rastreamento', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Rastreamento->save($this->data)) {
				$this->Session->setFlash(__('The rastreamento has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rastreamento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Rastreamento->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for rastreamento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Rastreamento->delete($id)) {
			$this->Session->setFlash(__('Rastreamento deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Rastreamento was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>