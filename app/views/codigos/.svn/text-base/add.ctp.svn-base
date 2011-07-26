<div class="codigos form">



<?php echo $form->create('Codigo');?>
	<fieldset>
 		
 		<p>Informe o código de rastreamento do seu pedido e clique no botão “Rastrear pedido”, o sistema irá exibir as informações importantes referentes ao seu pedido.</p>
 		
 		
	<?php
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
	
		echo $form->input('users_id', array( 'type' => 'hidden' ) );
		echo $form->input( 'codigo', array( 'class' => 'codigo campo inputSize', 'label' => 'Código de rastreamento' ) );
		echo $form->input( 'rastrear', array( 'type' => ( !isset( $userData['id'] ) )? 'hidden': 'checkbox', 'class' => 'campo', 'value' => 1 , 'label' => '', 'between' => 'Acompanhar andamento da entrega via email<br />(somente para usuários registrados e logados)' ) );
		
		?>
		<div class="CodigoNome">
			<?php echo $form->input( 'nome', array( 'type' => ( !isset( $userData['id'] ) )? 'hidden': 'text', 'class' => 'campo inputSize', 'label' => 'Nome para identificar a encomenda' ) ); ?>
		</div>
		<?php
		
		echo $form->submit( '/theme/rastreamento/img/btnRastrearPedido.jpg', array( 'class' => 'alignright') );
		
		//print_r( $userData );
	?>
	</fieldset>
	
<?php echo $form->end( );?>
</div>



<?php 
if( isset( $codigos ) && !stristr( $codigos, 'o encontrado' ) )
{	
	
	$htmls = null;
				$htmls .= "<p>Resultado do rastreamento do objeto <strong>". $this->data['Codigo']['codigo'] ."</strong></p>";
				//$htmls .= '<p>Cadastre-se para utilizar a função <a href="'. SITEURL .'/wp-login.php?action=register" class="button add-new-h2">Salvar Rastreamento</a></p>';
				$htmls .= "<table border=\"1\" class=\"rastreamento\" width=\"100%\">";
				$htmls .= "	<tr>";
				$htmls .= "		<th scope=\"col\">Data</th>";
				$htmls .= "		<th scope=\"col\">Local</th>";
				$htmls .= "		<th scope=\"col\">Situação</th>";
				$htmls .= "	</tr>";
				$htmls .= $codigos;
				$htmls .= "	</tr>";
				$htmls .= "</table>";
				$htmls .= "<div id=\"clear\"></div>";
				
	echo $htmls;
}else{
	
	
	
	if( isset( $codigos ) )
	{
		
		/**
		 * Quando o código não for encontrado será exibida a mensagem de erro padrão dos Correios
		 */
		echo $codigos;
	}
}

//print_r( $codigos );
?>


