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
$url_retorno = 
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
				if( $opcao['chave'] == 'envio_esedex' && !empty( $opcao['valor'] ) ): $envio_esedex = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_sedexacobrar' && !empty( $opcao['valor'] ) ): $envio_sedexacobrar = $opcao['valor']; endif;
				if( $opcao['chave'] == 'envio_pac' && !empty( $opcao['valor'] ) ): $envio_pac = $opcao['valor']; endif;
				
				
				
				// Refente a quantidade máxima por pacote (itens no mesmo pacote)
				if( $opcao['chave'] == 'envio_maximo' && !empty( $opcao['valor'] ) ): $envio_maximo = $opcao['valor']; else: $envio_maximo = 1; endif;
				
				
				

				// Imagem do produto no calculo de frete
				if( empty( $produto_imagem ) )
				{
					
					if( $opcao['chave'] == 'produto_imagem' && !empty( $opcao['valor'] ) ): $produto_imagem = $opcao['valor']; else: $produto_imagem = $produto_imagem; endif;
				}
				
				
				
				
				// Imagem do produto no calculo de frete
				if( $opcao['chave'] == 'produto_imagem' && !empty( $opcao['valor'] ) ): 
					$produto_imagem = $opcao['valor']; 
				endif;
				
				//echo $this->Form->input( 'Opcao.'. $opcao['chave'], array( 'value' => $opcao['valor'] ) );
			}
		}else{
			
			$preco = $this->data['Produto']['preco'];
		}

?>

	
	
<?php

if( $freteAtivo == 0 )
{

	echo "<h2>Este produto está indisponível no momento</h2>";
	
}else{
?>
	
	
	

	

		
		
		<?php
		if( !empty( $pac['Erro'] ) )
		{
			echo "<h2 style='color:red;'>&rsaquo; ". $pac['Erro'] ." ". $pac['MsgErro'] ."</h2>";
		}
		
		//'controller' => 'calcular',
		?>
		
		
		<h2>&rsaquo; <?php echo $form->value('Produto.nome' ); ?></h2>
		
		
		<div class="imagem">
		<?php 
		//pr( $produto_imagem );
		?>
		<?php if( ( !empty( $produto_imagem ) && stristr( $produto_imagem, '.' ) ) || ( isset( $this->data['Produto']['imagem'] ) && !empty( $this->data['Produto']['imagem'] ) ) ): ?>
		
			<?php 
			$produto_imagem = ( !empty( $this->data['Produto']['imagem'] ) )? $this->data['Produto']['imagem']:$produto_imagem;
			?>
			<?php echo $html->image( "/produto/". $produto_imagem, array( 'width' => 180, 'height' => 180, 'alt' => $form->value( 'Produto.nome' ), 'title' => $form->value( 'Produto.nome' ) ) ); ?>
			
		<?php endif; ?>
		</div>
		
		
		
		<div class="data">
	
			<?php echo $form->create('Produto', array( 'url' => array( 'controller' => 'produtos', 'action' => 'frete', $form->value('Produto.id' ) ), 'id' => 'calculo' ) );?>
			<?php echo $form->input( 'imagem', array( 'value' => $produto_imagem, 'type' => 'hidden' ) ); ?>
				<dl>
	
					<dt><label>Valor do produto</label></dt>
					<dd><p><?php echo $number->currency( $preco , 'R$ ', array( 'zero' => '0,00', 'places' => 2, 'thousands' => '.', 'decimals' => ',','negative' => '()') ); ?></p></dd>
					<?php echo $form->input('preco', array( 'type' => 'hidden', 'value' => $preco ) ); ?>
					<?php echo $form->input('nome', array( 'type' => 'hidden' ) ); ?>
	
					<dt><label for="quantidade">Quantidade</label></dt>
					<dd>
						<?php echo $form->input('quantidade', array( 'size' => 6, 'id' => "quantidade", 'label' => false ) ); ?>
						<span>&bull; Informe a quantidade de produtos que voc&ecirc; est&aacute; comprando</span>
					</dd>	
	
					<dt><label for="cep">Informe o cep</label></dt>
					<dd>
						<?php echo $form->input( 'cepdestino', array( 'size' => 6, 'id' => "cep", 'label' => false  ) ); ?>
						<span>&bull; Informe o CEP da localidade onde ser&aacute; efetuada a entrega</span>
					</dd>	
					
					
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
						
			
						

						
						
					<dt>&nbsp;</dt>
					<dd>
						<?php echo $form->input( 'id', array( 'type' => 'hidden' ) ); ?>
						<?php echo $form->submit( 'calcular frete', array( 'id' => "calcular_frete", 'name' => "calcular_frete" ) ); ?>
						<?php if( isset( $retornar_url ) ){	echo $this->element( 'botao_retorno', array( 'retornar_url' => $retornar_url ) ); } ?>
					</dd>
	
				</dl>
	
			<?php echo $form->end();?>

			</div>
			
						<?php 
						
						//pr( $sedex );
						//if( ( isset( $this->data['Produto']['cepdestino'] ) ) && ( empty( $sedex['Erro'] ) ) )
						if( ( isset( $this->data['Produto']['cepdestino'] ) ) )
						{
						?>
						
						<table id="frete" border="0">
						
							<thead>
								<tr>
									<th width="450px">Servi&ccedil;o</th>
									<th width="190px">Frete</th>
									<th width="194px">Frete + Produto</th>
								</tr>
							</thead>
							
							<tbody>
							<?php
							
							if( isset( $esedex ) )
							{
								echo $this->element( 'calculo', array( 'resultado' => $esedex, 'servico' => 'ESEDEX', 'seguro' => false ) );
							}
							
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
							</tbody>
						
						</table>
						
						<?php } ?>
		
		
		
<?php } ?>


<style>
.invisivel { display:none; }							
</style>
<script type="text/javascript">

//$("#frete").hide();
//$( document ).ready(function(){
/*
	$("#calculo").validate({
	    submitHandler: function( form ){
			$(form).submit(function(){  
			alert('todos os dados foram preenchidos corretamente');  
			return false;
	    });
	   }
	});
	*/
	
//});

$("#cep").mask('99999-999');
$("#quantidade").numeric();

</script>
<?php
/*
debug( $this->params );

debug( $this->data );
*/
?>