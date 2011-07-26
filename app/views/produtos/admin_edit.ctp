<?php
// Declarando variaveis
$preco = 
$cep =
$peso =
$altura =
$largura =
$comprimento =
$envio_maximo =
null;
$envio_local =
$envio_sedex =
$envio_esedex =
$envio_sedexacobrar = 
$url_retorno = 
$envio_pac = 0;

								$arrOptions = array(
									/**
									 * Deu um problema com o Security 
									 * alterei de . para , para tentar resolver 
									 * FUNCIONOU
									 */
									'0.300'	=>	'Até 0,300 gramas', 
									1 		=>	'Até 1 quilo', 
									2 		=>	'Até 2 quilos', 
									3 		=>	'Até 3 quilos', 
									4 		=>	'Até 4 quilos', 
									5 		=>	'Até 5 quilos', 
									6 		=>	'Até 6 quilos', 
									7 		=>	'Até 7 quilos', 
									8 		=>	'Até 8 quilos', 
									9 		=>	'Até 9 quilos', 
									10 		=>	'Até 10 quilos', 
									11 		=>	'Até 11 quilos', 
									12 		=>	'Até 12 quilos', 
									13 		=>	'Até 13 quilos', 
									14 		=>	'Até 14 quilos', 
									15 		=>	'Até 15 quilos', 
									16 		=>	'Até 16 quilos', 
									17 		=>	'Até 17 quilos', 
									18 		=>	'Até 18 quilos', 
									19 		=>	'Até 19 quilos', 
									20 		=>	'Até 20 quilos', 
									21 		=>	'Até 21 quilos', 
									22 		=>	'Até 22 quilos', 
									23 		=>	'Até 23 quilos', 
									24 		=>	'Até 24 quilos', 
									25 		=>	'Até 25 quilos', 
									26 		=>	'Até 26 quilos', 
									27 		=>	'Até 27 quilos', 
									28 		=>	'Até 28 quilos', 
									29 		=>	'Até 29 quilos', 
									30 		=>	'Até 30 quilos', 
								);

								
								
/**
 * Corrige problemas com opções extras do produto
 */
		if( isset( $this->data['Opcao'] ) )
		{
			
			foreach ( $this->data['Opcao'] as $opcao )
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
				if( $opcao['chave'] == 'envio_esedex' && !empty( $opcao['valor'] ) ): $envio_esedex = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_sedexacobrar' && !empty( $opcao['valor'] ) ): $envio_sedexacobrar = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_pac' && !empty( $opcao['valor'] ) ): $envio_pac = $opcao['valor']; endif;
				
				
				
				// Refente a quantidade máxima por pacote (itens no mesmo pacote)
				if( $opcao['chave'] == 'envio_maximo' && !empty( $opcao['valor'] ) ): $envio_maximo = $opcao['valor']; else: $envio_maximo = 1; endif;
				
				
				
				/**
				 * URL de retorno do produto
				 * É opcional e o cliente adiciona se quiser
				 */
				if( $opcao['chave'] == 'url_retorno' && !empty( $opcao['valor'] ) ): $url_retorno = $opcao['valor']; endif;
				
				//echo $this->Form->input( 'Opcao.'. $opcao['chave'], array( 'value' => $opcao['valor'] ) );
			}
		}

?>


<h2><?php __('Editar produto');?></h2>

<p>Você pode cadastrar produtos, para isso informe o nome do produto, o CEP de origem, o peso, o preço, a largura, a altura e o comprimento.</p>

<div class="clear"></div>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Produtos', true), array('action' => 'index'));?></li>

	</ul>
</div>


<div class="produtos form">



<?php echo $this->Form->create('Produto');?>


<div class="tabs">

	<ul>
		<li><?php echo $this->Html->link( "Produto", '#produto' ); ?></li>
		<li><?php echo $this->Html->link( "Frete", '#frete' ); ?></li>
		<li><?php echo $this->Html->link( "Opções", '#opcoes' ); ?></li>
	</ul>


	<div id="produto">
	<?php echo $form->input('id'); ?>
	<fieldset>



		<div class="blocoCodigo">
		
		

			<div class="alignleft">
			
			    				
					<?php //echo $form->input('users_id', ( isset( $badeco ) )? array( 'type' => 'hidden' ): null ); ?>
					<?php echo $this->Form->input('users_id', ( isset( $badeco ) )? array( 'type' => 'hidden' ): array( 'type' => 'select' ) ); ?>
					
					
					<?php echo $this->Form->input('nome', array( 'label' => 'Nome do produto', 'after' => __( '<p>(Informe o nome do produto)</p>', true) )); ?>
					
					
					<?php echo $this->Form->input('cep', array( 'value' => $cep, 'after' => __( '<p>(Informe o CEP de onde o produto será enviado)</p>', true) )); ?>
					
				
					
					<?php echo $this->Form->input('peso', array( 'value' => $peso, 'type' => 'select', 'options' => $arrOptions, 'class' => 'campo', 'after' => __( '<p>(Selecione o peso aproximado do produto)</p>', true) )); ?>

					
				
					<?php echo $this->Form->input('preco', array( 'value' => $preco, 'after' => __( '<p>(Digite o preço de venda do produto)</p>', true) )); ?>
					
					
	      	</div>
			
			
		</div>



		<div class="blocoCodigo">

		
		
		<div id="flashMessage" class="message alignleft">
			Para que o cálculo de frete retorne o valor exato cobrado pelos correios é importante informar as medidas exatas do objeto (produto), as medidas da embalagem de envio devem ser informadas em centímetros.
		</div>

 


		
		<div class="clear"></div>
		
		
			<div>
			
				<div class="caixa">
				
				
				<div class="clear"></div>
				
				
					
				<div class="ProdutoAltura">
					<?php echo $this->Form->input('altura', array( 'value' => $altura )); ?>
				</div>
				
				
					<div class="clean"></div>
				
					<div class="blocoVirtual">
					
					<div class="clear"></div>
					
						<div class="ProdutoLargura">
							<?php echo $this->Form->input('largura', array( 'value' => $largura )); ?>
						</div>
						
						<div class="ProdutoComprimento">
							<?php echo $this->Form->input('comprimento', array( 'value' => $comprimento )); ?>
						</div>
					
					</div>
					
				
				</div>
				
			</div>
			
			

		</div>



	</fieldset>
	
	</div>
	
	
	
	<div id="frete">

		
	<h2><?php __("Frete"); ?></h2>
	<div id="flashMessage" class="message alignleft">
		As opções abaixo permitem que você habilite ou desabilite formas de envio, exiba informações adicionais e selecione fotos do produto.
	</div>
	<?php
		
		echo $this->Form->input('envio_local', array( 'selected' => $envio_local, 'options' => array( 1 => 'Sim, pode retirar no local', 0 => 'Não, não é possível retirar no local' ), 'label' => 'Pode retirar no local?', 'class' => 'campo', 'after' => __('<p>(Escolhendo não, a opção retirar no local não será exibida no momento do cálculo de frete.)</p>', true) ));
		echo $this->Form->input('envio_pac', array( 'selected' => $envio_pac, 'options' => array( 1 => 'Sim, envio PAC', 0 => 'Não, não envio PAC' ), 'label' => 'Envia por PAC?', 'class' => 'campo', 'after' => __('<p>(Escolhendo não, a opção PAC não será exibida no momento do cálculo de frete.)</p>', true)  ));
		echo $this->Form->input('envio_sedex', array( 'selected' => $envio_sedex, 'options' => array( 1 => 'Sim, envio SEDEX', 0 => 'Não, não envio SEDEX' ), 'label' => 'Envia por SEDEX convencional?', 'class' => 'campo', 'after' => __('<p>(Escolhendo não, a opção SEDEX convencional não será exibida no momento do cálculo de frete.)</p>', true)  ));
		echo $this->Form->input('envio_sedexacobrar', array( 'selected' => $envio_sedexacobrar, 'options' => array( 1 => 'Sim, envio SEDEX a cobrar', 0 => 'Não, não envio SEDEX a cobrar' ), 'label' => 'Envia por SEDEX a cobrar?', 'class' => 'campo', 'after' => __('<p>(Escolhendo não, a opção SEDEX a cobrar não será exibida no momento do cálculo de frete.)</p>', true)  ));
		echo $this->Form->input('envio_maximo', array( 'value' => $envio_maximo, 'after' => __('<p>(Neste campo você poderá informar quantas unidades deste produto podem ser enviados numa encomenda.)</p>', true)  ));
		

		
		/**
		 * Apenas o usuário FOKS possui acesso 
		 * então todos os outros ficam com água 
		 * na boca, podem ver mas não podem 
		 * escolher
		 */
		if( ( $userData['id'] == 3913 ) || ( $userData['id'] == 1 ) )
		{
			echo $this->Form->input('envio_esedex', array( 'selected' => $envio_esedex, 'options' => array( 1 => 'Sim, envio E-SEDEX', 0 => 'Não, não envio E-SEDEX' ), 'label' => 'Envia por E-SEDEX?', 'class' => 'campo', 'after' => __('<p>(Escolhendo não, a opção E-SEDEX não será exibida no momento do cálculo de frete.)</p>', true)  ));
		}else{
			
			// não é possível escolher a opção
			echo $this->Form->input('envio_esedex', array( 'selected' => $envio_esedex, 'options' => array( 0 => 'Sim, envio E-SEDEX (não disponível para sua conta)', 0 => 'Não, não envio E-SEDEX' ), 'label' => 'Envia por E-SEDEX?', 'class' => 'campo', 'after' => __('<p>(Escolhendo não, a opção E-SEDEX não será exibida no momento do cálculo de frete.)</p>', true)  ));
			echo "<div id='flashMessage' class='message alignleft'>A versão premium fornece a opção para calculo de E-SEDEX. Solicite</div><div class='clear'></div>";
		}
		
	?>
	
	</div>
	
	
	<div id="opcoes">
		
		<h2><?php __("Opções"); ?></h2>
		<div id="flashMessage" class="message alignleft">
			No campo 'Endereço do anúncio' você deve informar o endereço do seu anúncio no Mercado Livre, este campo irá permitir que o cliente após realizar o cálculo do frete
			possa retornar diretamente para seu anuncio no Mercado Livre. O Prenchimento não é obrigatório.
		</div>
		
		
		<?php echo $this->Form->input( 'url_retorno', array( 'after' => __( "<p>Informe o endereço do seu anúncio no Mercado Livre.</p>", true ))); ?>
		
	</div>
	
	
</div>
	
<?php echo $this->Form->end(__('Salvar alterações', true));?>
</div>



<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
$this->Html->link( '/theme/rastreamento/js/funcoes', false );

//debug( $this->data );
?>