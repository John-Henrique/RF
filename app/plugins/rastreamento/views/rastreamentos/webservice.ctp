<?php 
// WebService Rest de uso da classe com cache
// use: 
//  http://rastreamentopedido.com/webservice/SZ843766706BR
//  http://rastreamentopedido.com/webservice/SZ843766706BR/xml
//  http://rastreamentopedido.com/webservice/SZ843766706BR/dump
//  http://rastreamentopedido.com/webservice/SZ843766706BR/serial
//  e finalmente, para amantes de Ajax:
//  http://rastreamentopedido.com/webservice/SZ843766706BR/minhaFuncJs

if( !$correio )
{
	// Retorna erro de código inválido
	$correio = json_decode('{"hash":null,"track":null,"status":null,"erro":true,"formato":"json","erro_msg":"C\u00f3digo de encomenda Inv\u00e1lido!"}');
}

	
// Muda cabeçalho padrão de content para texto simples
header("Content-Type: text/plain");

		
	// Retorna no formato solicitado
	switch ($formato){
		case 'serial':
			exit (serialize($correio));
		case 'dump':
			print_r($correio);
			exit ();
		case 'xml':
			header("Content-Type: text/xml");
			
			App::import( 'Vendor', "Rastreamento.correios/x2xml" );
			
			exit(x2xml($correio));
		case 'json':
		default:
			if ($callback) exit ($callback . '(' . json_encode($correio) . ')');
			exit (json_encode($correio));
	}

?>