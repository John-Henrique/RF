<div class="rastreamentos form">
<?php echo $this->Form->create('Rastreamento');?>

	<h2><?php printf(__('Incluir %s', true), __('Rastreamento', true)); ?></h2>
	
	<p>Informe o código de rastreamento do seu pedido e clique no botão “Rastrear pedido”, o sistema irá exibir as informações importantes referentes ao seu pedido.</p>
	
	<?php echo $this->Form->input('codigo', array( 'class' => 'codigo campo inputSize', 'label' => 'Código de rastreamento' ) ); ?>
	<?php echo $this->Form->input('rastrear', array( 'type' => 'checkbox', 'class' => 'campo', 'value' => 1 , 'label' => '', 'between' => 'Acompanhar andamento da entrega via email' )); ?>
	<div class="CodigoNome">
		<?php echo $this->Form->input('email', array( 'class' => 'codigo campo inputSize', 'label' => 'Email para notificação' ) ); ?>
		<?php echo $this->Form->input('identificacao', array( 'class' => 'campo inputSize', 'label' => 'Nome para identificar a encomenda' ) ); ?>
	</div>
	
	
<?php echo $this->Form->end(__('Enviar', true));?>

	<p>Depois de cadastrado o código de rastreamento você poderá acompanhar a entrega através via 
	<?php echo $this->Html->link( 'FEED RSS', array( 'action' => 'rss', 'SC372537049BR' )); ?>.</p>
</div>



<?php
echo $this->Html->scriptBlock('
$(document).ready(function(){
	
	/**
	 * acoes para o cadastro de codigos para 
	 * rastreamento
	 */
	if( $( "#RastreamentoRastrear" ).get(0) )
	{
		
		$( ".CodigoNome" ).hide();
		
		
		// Se o checkbox for marcado 
		$( "#RastreamentoRastrear:checkbox" ).click( function()
		{
			
			// exibe o campo nome
			$( ".CodigoNome" ).toggle();
		});
	}
});
');
?>