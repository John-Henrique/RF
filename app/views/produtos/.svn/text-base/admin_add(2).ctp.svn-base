<h2><?php __('Cadastrar produto');?></h2>

<p>Você pode cadastrar produtos, para isso informe o nome do produto, o CEP de origem, o peso, o preço, a largura, a altura e o comprimento.</p>

<div class="clear"></div>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Produtos', true), array('action' => 'index'));?></li>

	</ul>
</div>


<div class="produtos form">
<?php echo $form->create('Produto');?>


	<fieldset>



		<div class="blocoCodigo">
		
		

			<div class="alignleft">
			
			    				
					<?php //echo $form->input('users_id', ( isset( $badeco ) )? array( 'type' => 'hidden' ): null ); ?>
					
					
					<?php echo $form->input('nome'); ?>
					
					
					<?php echo $form->input('cep', array( 'label' => 'Cep' ) ); ?>
					
				
					
					<?php //$strPeso = $custom->campo( $form->value( 'Produto.id' ), 'peso' ); ?>
								<?php
								$arrOptions = array(
									/**
									 * Deu um problema com o Security 
									 * alterei de . para , para tentar resolver
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
								?>
								<?php echo $form->input( 'peso', array( 'type' => 'select', 'options' => $arrOptions, 'label' => 'Peso', 'selected' => ( $strPeso == 0.300 )? '0,300': $strPeso, 'class' => 'campo', 'after' => '(Selecione o peso aproximado do produto)' ) ); ?>

					
				
					<?php echo $form->input('preco', array( 'label' => 'Preço' ) ); ?>
					
					
	      	</div>
			
			
		</div>



		<div class="blocoCodigo">

		
		
		<div id="flashMessage" class="message alignleft">
			<p>Para que o cálculo de frete retorne o valor exato cobrado pelos correios é importante informar as medidas exatas do objeto (produto), as medidas devem ser informadas em centímetros.</p>
		</div>

 


		
		<div class="clear"></div>
		
		
			<div>
			
				<div class="caixa">
				
				
				<div class="clear"></div>
				
				
					
				<div class="ProdutoAltura">
					<?php echo $form->input('altura', array( 'label' => 'Altura' ) ); ?>
				</div>
				
				
					<div class="clean"></div>
				
					<div class="blocoVirtual">
					
					<div class="clear"></div>
					
						<div class="ProdutoLargura">
							<?php echo $form->input('largura', array( 'label' => 'Largura' ) ); ?>
						</div>
						
						<div class="ProdutoComprimento">
							<?php echo $form->input('comprimento', array( 'label' => 'Comprimento' ) ); ?>
						</div>
					
					</div>
					
				
				</div>
				
			</div>
			
			
		</div>






 		
	<?php 
	/*
		echo $form->input('users_id', ( isset( $badeco ) )? array( 'type' => 'hidden' ): null );
		echo $form->input('nome');
		
		
		//echo $form->input('produtos_id');
		echo $form->input('cep', array( 'label' => 'Cep' ) );
		
		echo $form->input('peso', array( 'label' => 'Peso' ) );
		
		echo $form->input('preco', array( 'label' => 'Preço' ) );
		
		echo $form->input('largura', array( 'label' => 'Largura' ) );
		
		echo $form->input('altura', array( 'label' => 'Altura' ) );
		
		echo $form->input('comprimento', array( 'label' => 'Comprimento' ) );
	*/
	?>
	</fieldset>
<?php echo $form->end('Cadastrar produto');?>
</div>

<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
$javascript->link( '/theme/rastreamento/js/funcoes', false );
?>