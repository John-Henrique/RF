<?php
header('Content-Type: application/xml; charset=utf-8');
/*
// Exemplo de uso:
// http://ferrari.eti.br/correios/rss/?PB151832535BR

*/
$server = "http://". $_SERVER['HTTP_HOST'];
?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" version="2.0">
    <channel>
		<title>Rastreando encomenda: <?php echo $codigo ?></title>
		<link><?php echo $server; ?></link>
		<guid><?php echo $server; ?></guid>
		<description>Rastreamento de encomenda via RSS oferecido por <?php echo Configure::read("Site.title"); ?></description>
		<language>pt-BR</language>
		<?php if (!$correio->erro): ?>
		<?php $correio->track = array_reverse($correio->track) ?>
		<?php foreach ($correio->track as $info): ?>	
		<item>
			<?php if ($info->acao == 'encaminhado'): ?>
			<title><![CDATA[Encomenda: <?php echo $codigo ?>: <?php echo $info->detalhes ?>]]></title>
			<?php else: ?>
			<title><![CDATA[Encomenda: <?php echo $codigo ?>: <?php echo $info->acao ?>]]></title>
			<?php endif; ?>
			<link>
			<?php echo $server . Router::url( array(
				'plugin' => 'rastreamento', 
				'controller' => 'rastreamentos',
				'action' => 'view', 
				$codigo
			));
			?></link>
			<description><![CDATA[Status da encomenda: <?php echo $codigo ?> alterado para <?php echo $info->acao ?>. <?php echo $info->detalhes ?>]]></description>
		</item>
		<?php endforeach; ?>
		
		<?php else: ?>
			<item>
				<title><![CDATA[<?php echo $correio->erro_msg ?>]]></title>
				<description><![CDATA[Dúvidas sobre esta informação? Acesse para exclarecimentos. ]]></description>
				<link><?php echo $server . Router::url( array(
					'plugin' => 'rastreamento', 
					'controller' => 'rastreamentos',
					'action' => 'view', 
					$codigo
				));
				?></link>
			</item>
		<?php endif; ?>
		
	</channel>
</rss>
	


<?php 
//pr( $correio );
?>
