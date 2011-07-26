<?php
// Declarando variaveis
$preco = 
$cep =
$peso =
$altura =
$largura =
$comprimento =
$envio_local =
$envio_sedex =
$envio_sedexacobrar =
$envio_pac = 
$envio_maximo =
$produto_imagem =
null;

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
				if( $opcao['chave'] == 'envio_sedexacobrar' && !empty( $opcao['valor'] ) ): $envio_sedexacobrar = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_pac' && !empty( $opcao['valor'] ) ): $envio_pac = $opcao['valor']; endif;
				
				
				
				// Refente a quantidade máxima por pacote (itens no mesmo pacote)
				if( $opcao['chave'] == 'envio_maximo' && !empty( $opcao['valor'] ) ): $envio_maximo = $opcao['valor']; else: $envio_maximo = 1; endif;
				

				// Imagem do produto no calculo de frete
				if( $opcao['chave'] == 'produto_imagem' && empty( $opcao['valor'] ) ): $produto_imagem_null = __( "Não foram adicionadas imagens do produto", true ); endif;
				
				
				//echo $this->Form->input( 'Opcao.'. $opcao['chave'], array( 'value' => $opcao['valor'] ) );
			}
		}else{
			
			$preco = $this->data['Produto']['preco'];
		}

?>
<div class="produtos form">
	
	
<?php

if( $freteAtivo == 0 )
{

	echo "<h2>Este produto está indisponível no momento</h2>";
	
}else{
?>
	
	
	

	<div class="entry">
	

		
		
		<?php
		if( !empty( $pac['Erro'] ) )
		{
			echo "<h2>". $pac['Erro'] ." ". $pac['MsgErro'] ."</h2>";
		}
		
		//'controller' => 'calcular',
		?>
		
		
		<h2><?php echo $form->value('Produto.nome' ); ?></h2>
		
		<?php echo $form->create('Produto', array( 'url' => array( 'controller' => 'produtos', 'action' => 'frete', $form->value('Produto.id' ) ), 'id' => 'formCalculoFrete' ) );?>
			<fieldset>
		 		
		 		
		 		
		 		<?php echo $form->input( 'id', array( 'type' => 'hidden' ) ); ?>
		 		<?php echo $form->input( 'nome', array( 'type' => 'hidden' ) ); ?>
				<?php echo $form->input('quantidade', array( 'label' => 'Quantidade de produtos', 'size' => 5, 'class' => 'campo', 'after' => '(Quantidade de produtos que deseja adquirir)' ) ); ?>
				
				<label>Preço do produto</label><span class="valor"><?php echo $number->currency( $preco , 'R$ ', array( 'zero' => '0,00', 'places' => 2, 'thousands' => '.', 'decimals' => ',','negative' => '()') ); ?></span>
				<?php echo $form->input('preco', array( 'type' => 'hidden', 'label' => 'Preço', 'size' => 5, 'value' => $preco, 'class' => 'campo', 'after' => '(Valor de uma unidade. Exemplo: 1.540,00)' ) ); ?>
				
				
				
				
				
						<p class="aviso invisivel">* Se o valor do produto estiver diferente do valor anunciado, informe o valor do anúncio.</p>
						<p class="aviso invisivel">* Se o produto estiver na modalidade de leilão informe o valor que deseja dar de lance.</p>
				
				
				<?php echo $form->input( 'cepdestino', array( 'label' => 'Seu CEP (destino)', 'size' => 5, 'class' => 'campo', 'after' => '(Informe o CEP de sua cidade ou localidade onde será realizada a entrega)' ) ); ?>
				
				
		
								
				
						<fieldset <?php if( ( !empty( $peso ) ) || ( !empty( $this->data['Produto']['peso'] ) ) ){ echo "class='invisivel'"; } ?>>
							<legend>Adicionar informações de peso e origem</legend>
							
							
							<hr  />
							
							<div id="opcoes">
								
								<?php echo $form->input( 'peso', array( 'type' => 'select', 'options' => $arrOptions, 'label' => 'Peso', 'selected' => ( $peso == 0.300 )? '0,300': $peso, 'class' => 'campo', 'after' => '<br />(Selecione o peso aproximado do produto)' ) ); ?>
								
								
								<?php echo $form->input( 'cep', array( 'label' => 'CEP origem', 'size' => 5, 'value' => $cep, 'class' => 'campo', 'after' => '(Informe o CEP de origem)' ) ); ?>
								<?php echo $form->input( 'largura', array( 'label' => 'Largura', 'size' => 5, 'value' => $largura, 'class' => 'campo', 'after' => '(Informe a largura)' ) ); ?>
								<?php echo $form->input( 'altura', array( 'label' => 'altura', 'size' => 5, 'value' => $altura, 'class' => 'campo', 'after' => '(Informe a altura)' ) ); ?>
								<?php echo $form->input( 'comprimento', array( 'label' => 'comprimento', 'size' => 5, 'value' => $comprimento, 'class' => 'campo', 'after' => '(Informe o comprimento)' ) ); ?>
								
							</div>
						</fieldset>
		
				
				
				
			</fieldset>
			
			<div class="clears"></div>
			
		
		
		<?php 
		
		//print_r( $pac );
		if( ( isset( $this->data['Produto']['cepdestino'] ) ) && ( empty( $sedex['Erro'] ) ) )
		{
		?>
		
			<table class="rastreamento">
				<tr>
					<th>Serviço</th>
					<th>Frete</th>
					<th>Frete + produto</th>
				</tr>
			<?php
			if( isset( $sedex ) )
			{
				echo $this->element( 'calculo', array( 'resultado' => $sedex, 'servico' => 'SEDEX', 'seguro' => false ) );
			}
			
			
			if( isset( $sedexacobrar ) )
			{
				echo $this->element( 'calculo', array( 'resultado' => $sedexacobrar, 'servico' => 'SEDEX a cobrar', 'seguro' => false ) );
			}
			
			
			if( isset( $pac ) )
			{
				echo $this->element( 'calculo', array( 'resultado' => $pac, 'servico' => 'PAC', 'seguro' => false ) );
			}
			?>
			</table>
		
		<?php } ?>
	
	
		
		
		
			<div class="clear"></div>
			
				<?php echo $form->submit( 'btnCalcularFrete.jpg', array( 'class' => 'alignleft' ) ); ?>
				<?php if( isset( $retornar_url ) ){	echo $this->element( 'botao_retorno', array( 'retornar_url' => $retornar_url ) ); } ?>
			
			
			
			
		<?php echo $form->end();?>
		
		
	
	</div>
	
		
		
<?php } ?>


</div>
<?php
//debug( $this->data );
?>