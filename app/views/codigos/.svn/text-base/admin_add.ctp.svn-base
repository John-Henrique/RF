<div class="codigos form">
<h2><?php __('Adicionar código');?></h2>





<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar códigos', true), array('action' => 'index'));?></li>
	</ul>
</div>




<?php echo $form->create('Codigo');?>
	<fieldset>
 		
 		<p>Informe o código de rastreamento do seu pedido e clique no botão "Rastrear pedido", o sistema irá exibir as informações importantes referentes ao seu pedido.</p>
 		
 		
	<?php	
		/**
		 * Usuário com permissão de acesso restrito?
		 */
		$userData = $this->Session->read( 'Auth.User' );
		
		
		echo $form->input( 'users_id', array( 'type' => ( isset( $userData['id'] ) )? 'hidden': 'text', 'value' =>  $userData['id'] ) );
		
		echo $form->input( 'codigo', array( 'class' => 'codigo campo inputSize', 'label' => 'Código de rastreamento' ) );
		echo $form->input( 'rastrear', array( 'type' => 'checkbox', 'class' => 'campo', 'value' => 1 , 'label' => '', 'between' => 'Acompanhar andamento da entrega via email' ) );
	?>
	

		<div class="CodigoNome">
			<?php echo $form->input( 'nome', array( 'class' => 'campo inputSize', 'label' => 'Nome para identificar a encomenda', 'after' => "(Você pode informar o nome do produto ou modelo, este nome irá aparecer no rastreamento)" ) ); ?>
		</div>
		
		
	<?php
		echo $form->input( 'avisar', array( 'type' => 'checkbox', 'class' => 'campo', 'value' => 1 , 'label' => '', 'between' => 'Avisar o cliente via email' ) );
	?>
		
		
		<div class="CodigoCliente">
		
		<div id="flashMessage" class="success">
			<p>No campo Nome do cliente e Email do cliente você deve informar o nome e email do cliente para o qual você deseja que seja enviada uma cópia do rastreamento automático via email.</p>
			<p>Sempre que houver uma atualização do status de entrega da encomenda enviaremos um email para você e outro para o cliente.</p>
		</div>
		
			
			<?php echo $form->input( 'cliente_nome', array( 'class' => 'campo inputSize', 'label' => 'Nome do cliente' ) ); ?>
			<?php echo $form->input( 'cliente_email', array( 'class' => 'campo inputSize', 'label' => 'Email do cliente' ) ); ?>
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
}

//print_r( $codigos );
?>


<?php
echo $html->css( '/theme/rastreamento/css/admin_style' );
$javascript->link( '/theme/rastreamento/js/funcoes', false );
?>