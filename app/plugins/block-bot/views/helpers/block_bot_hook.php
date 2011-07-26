<?php
/**
 * ExampleHook Helper
 *
 * An example hook helper for demonstrating hook system.
 *
 * @category Helper
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class BlockBotHookHelper extends AppHelper {
/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
    public $helpers = array(
        'Html',
        'Layout',
    );
/**
 * Called after activating the hook in ExtensionsHooksController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onActivate(&$controller) {
    }
/**
 * Called after deactivating the hook in ExtensionsHooksController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
    public function onDeactivate(&$controller) {
    }
/**
 * Before render callback. Called before the view file is rendered.
 * Antes do arquivo view ser processado é realizado o bloqueio
 *
 * @return void
 */
    public function beforeRender()
    {
    	
    	// Recebe os user agents proibidos
    	$userAgents = Configure::read( 'BlockBot.users' );
    	
    print_r( $userAgents );
    	
    	if( isset( $_SERVER['HTTP_USER_AGENT'] ) )
    	{
    		
    		// identifica o user agent atual
    		$userAgent = $_SERVER['HTTP_USER_AGENT'];
    		
    		
$userAgents = array(
  array('nome'=>'\"mozilla'),
  array('nome'=>'<?'),
  array('nome'=>'<?php'),
  array('nome'=>'acquia-crawler'),
  array('nome'=>'adultsvisitus'),
  array('nome'=>'alexa'),
  array('nome'=>'ant'),
  array('nome'=>'atrax'),
  array('nome'=>'baiduspider'),
  array('nome'=>'bdfetch'),
  array('nome'=>'betabot'),
  array('nome'=>'bitlybot'),
  array('nome'=>'biz360'),
  array('nome'=>'blogblogs'),
  array('nome'=>'blogcop'),
  array('nome'=>'blogsearch'),
  array('nome'=>'blogshares.com'),
  array('nome'=>'boardreader'),
  array('nome'=>'btwebclient'),
  array('nome'=>'buzzzy.com'),
  array('nome'=>'camontspider'),
  array('nome'=>'casper'),
  array('nome'=>'ccbot'),
  array('nome'=>'cfnetwork'),
  array('nome'=>'chen'),
  array('nome'=>'cityreview'),
  array('nome'=>'comodospider'),
  array('nome'=>'core-project'),
  array('nome'=>'curl'),
  array('nome'=>'cyberpatrol'),
  array('nome'=>'czxt2s'),
  array('nome'=>'davclnt'),
  array('nome'=>'description:'),
  array('nome'=>'docomo'),
  array('nome'=>'duckduckpreview;'),
  array('nome'=>'ecairn-grabber'),
  array('nome'=>'elinks'),
  array('nome'=>'exactsearch'),
  array('nome'=>'explorer'),
  array('nome'=>'facebookexternalhit'),
  array('nome'=>'fdm'),
  array('nome'=>'finly'),
  array('nome'=>'firebat'),
  array('nome'=>'fj'),
  array('nome'=>'gaisbot'),
  array('nome'=>'gbplugin'),
  array('nome'=>'geohasher'),
  array('nome'=>'gigabot'),
  array('nome'=>'http://networktools'),
  array('nome'=>'http::lite'),
  array('nome'=>'ia_archiver'),
  array('nome'=>'internet'),
  array('nome'=>'jakarta'),
  array('nome'=>'java'),
  array('nome'=>'jayde'),
  array('nome'=>'jigsaw'),
  array('nome'=>'jomjaibot'),
  array('nome'=>'kmccrew'),
  array('nome'=>'lexxebot'),
  array('nome'=>'libwww-perl'),
  array('nome'=>'linkedinbot'),
  array('nome'=>'linkwithin'),
  array('nome'=>'loadimpactpageanalyzer'),
  array('nome'=>'longurl'),
  array('nome'=>'lwp-request'),
  array('nome'=>'lwp-trivial'),
  array('nome'=>'lynx'),
  array('nome'=>'magent'),
  array('nome'=>'magpie-crawler'),
  array('nome'=>'mail.ru'),
  array('nome'=>'mama'),
  array('nome'=>'maui'),
  array('nome'=>'metauri'),
  array('nome'=>'mlbot'),
  array('nome'=>'moreoverbot'),
  array('nome'=>'motorokr'),
  array('nome'=>'msft_bi'),
  array('nome'=>'msie'),
  array('nome'=>'msproxy'),
  array('nome'=>'msr-isrccrawler'),
  array('nome'=>'myapp'),
  array('nome'=>'netestate'),
  array('nome'=>'noopsis'),
  array('nome'=>'orbitscripts.com'),
  array('nome'=>'ossproxy'),
  array('nome'=>'page_test'),
  array('nome'=>'panscient.com'),
  array('nome'=>'pear'),
  array('nome'=>'php'),
  array('nome'=>'pirst;'),
  array('nome'=>'plagger'),
  array('nome'=>'planetwork'),
  array('nome'=>'ppc;'),
  array('nome'=>'psbot'),
  array('nome'=>'puxarapido'),
  array('nome'=>'python-urllib'),
  array('nome'=>'r6_commentreader'),
  array('nome'=>'r6_feedfetcher'),
  array('nome'=>'research-scan-bot'),
  array('nome'=>'rt240x320'),
  array('nome'=>'s2bot'),
  array('nome'=>'sch-u450'),
  array('nome'=>'semtobot'),
  array('nome'=>'sheenbot'),
  array('nome'=>'simplepie'),
  array('nome'=>'slimbrowser'),
  array('nome'=>'snapbot'),
  array('nome'=>'snk'),
  array('nome'=>'soap::lite/perl'),
  array('nome'=>'sogou'),
  array('nome'=>'sogou+web+robot'),
  array('nome'=>'sogou-test-spider'),
  array('nome'=>'sosospider'),
  array('nome'=>'space'),
  array('nome'=>'sphider'),
  array('nome'=>'statoolsbot'),
  array('nome'=>'str:\'mozilla/5.0'),
  array('nome'=>'survey'),
  array('nome'=>'teleca'),
  array('nome'=>'teoma'),
  array('nome'=>'test.buzzz'),
  array('nome'=>'testbot'),
  array('nome'=>'the'),
  array('nome'=>'twengabot-discover'),
  array('nome'=>'twitturly'),
  array('nome'=>'typhoeus'),
  array('nome'=>'udmsearch'),
  array('nome'=>'untiny'),
  array('nome'=>'url_test'),
  array('nome'=>'user-agent:'),
  array('nome'=>'vb'),
  array('nome'=>'voyager'),
  array('nome'=>'w3c_validator'),
  array('nome'=>'webcollage'),
  array('nome'=>'webcorp'),
  array('nome'=>'webmoney.advisor'),
  array('nome'=>'website'),
  array('nome'=>'webvox'),
  //array('nome'=>'wget/1.10.2'), // verificar se ao bloquear os acessos do cron job param de funcionar
  array('nome'=>'wordpress.com'),
  array('nome'=>'wtabot'),
  array('nome'=>'www-mechanize'),
  array('nome'=>'yahoo'),
  array('nome'=>'yandex'),
  array('nome'=>'yeti'),
  array('nome'=>'ytunnelpro'),
  array('nome'=>'zschobot'),
  array('nome'=>'zte-g-n290-base')
);

			$userAgent = strtolower( reset( explode( '/', reset( explode( ' ', $userAgent ) ) ) ) );
    		//echo $userAgent;
    		
    		
    		foreach ( $userAgents as $userAgentBlock ):
    		

	    		// verificando se o user agent existe no indice
	    		if( $userAgent == $userAgentBlock['nome'] )
	    		//if( preg_match( "/$userAgent/", $userAgentBlock['nome'] ) )
	    		{
	    			
	
					/**
					 * Retorna um erro 401 "não autorizado"
					 * Teoricamente o bot não deverá continuar na página
					 */
					header( "HTTP/1.0 401 Unauthorized" );
					
					
					/**
					 * Mata o processamento do script 
					 * desta forma não será apresentado o conteúdo 
					 * apenas uma mensagem de erro será exibida ao bot
					 */
					die( 0 );
	    		}
	    		
    		endforeach;
    	}
    	
    	
    }
/**
 * After render callback. Called after the view file is rendered
 * but before the layout has been rendered.
 *
 * @return void
 */
    public function afterRender()
    {
    }
/**
 * Before layout callback. Called before the layout is rendered.
 *
 * @return void
 */
    public function beforeLayout() {
    }
/**
 * After layout callback. Called after the layout has rendered.
 *
 * @return void
 */
    public function afterLayout() {
    }
/**
 * Called after LayoutHelper::setNode()
 *
 * @return void
 */
    public function afterSetNode() {
        // field values can be changed from hooks
        $this->Layout->setNodeField('title', $this->Layout->node('title') );
    }
/**
 * Called before LayoutHelper::nodeInfo()
 *
 * @return string
 */
    public function beforeNodeInfo() {
        //return '<p>beforeNodeInfo</p>';
    }
/**
 * Called after LayoutHelper::nodeInfo()
 *
 * @return string
 */
    public function afterNodeInfo() {
        //return '<p>afterNodeInfo</p>';
    }
/**
 * Called before LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function beforeNodeBody() {
        //return '<p>beforeNodeBody</p>';
    }
/**
 * Called after LayoutHelper::nodeBody()
 *
 * @return string
 */
    public function afterNodeBody() {
        //return '<p>afterNodeBody</p>';
    }
/**
 * Called before LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function beforeNodeMoreInfo() {
        //return '<p>beforeNodeMoreInfo</p>';
    }
/**
 * Called after LayoutHelper::nodeMoreInfo()
 *
 * @return string
 */
    public function afterNodeMoreInfo() {
        //return '<p>afterNodeMoreInfo</p>';
    }
}
?>