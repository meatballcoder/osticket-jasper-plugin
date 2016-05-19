<?php

require_once (INCLUDE_DIR . 'class.plugin.php');
require_once (INCLUDE_DIR . 'class.signal.php');
require_once (INCLUDE_DIR . 'class.app.php');
require_once (INCLUDE_DIR . 'class.dispatcher.php');
require_once (INCLUDE_DIR . 'class.dynamic_forms.php');
require_once (INCLUDE_DIR . 'class.osticket.php');
require_once (INCLUDE_DIR . 'class.config.php');

require_once ('config.php');

define ( 'OST_WEB_ROOT', osTicket::get_root_path ( __DIR__ ) );

define ( 'JASPER_REPORTS_WEB_ROOT', OST_WEB_ROOT . 'scp/dispatcher.php/jasper-reports/' );

define ( 'OST_ROOT', INCLUDE_DIR . '../' );

define ('JASPER_REPORTS_RELATIVE_ROOT','/jasper-reports/');
define ('JASPER_REPORTS_OSTICKET_PLUGIN_VERSION', '0.1');
define ('JASPER_REPORTS_PLUGIN_ROOT', __DIR__ . '/');
define ('JASPER_REPORTS_INCLUDE', JASPER_REPORTS_PLUGIN_ROOT.'include/');
define ('JASPER_REPORTS_VIEWS', JASPER_REPORTS_INCLUDE . 'views/');
define ('JASPER_REPORTS_CONTROLLERS', JASPER_REPORTS_INCLUDE . 'controllers/');
define ('JASPER_REPORTS_ASSETS', JASPER_REPORTS_PLUGIN_ROOT . 'assets/');
spl_autoload_register (array (
		'JasperReportPlugin',
		'autoload' 
));
class JasperReportPlugin extends Plugin {

	var $config_class = 'JasperReportsConfig';

	public static $jasper_server;
	public static $jasper_server_ssl;
	public static $jasper_server_username;
	public static $jasper_server_password;
	public static $jasper_server_report_path;

		public static function autoload($className) {
		$className = ltrim ($className, '\\');
		$fileName = '';
		$namespace = '';
		if ($lastNsPos = strrpos ($className, '\\')) {
			$namespace = substr ($className, 0, $lastNsPos);
			$className = substr ($className, $lastNsPos + 1);
			$fileName = str_replace ('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
		}
		$fileName .= str_replace ('_', DIRECTORY_SEPARATOR, $className) . '.php';
		if (file_exists (JASPER_REPORTS_INCLUDE . $fileName)) {
			require_once $fileName;
		}
	}
	static public function callbackDispatch($object, $data) {
		/* this is all naming conventions
			jaspercontroller in the pattern is the same as the file namespace;
			I needed the trailing slash in my url;
		*/
		
		
		$search_url = url ('^/jasper-reports/', 
			patterns ('controllers\jaspercontroller', 
				url_get ('^search$', 'searchAction'),
				url_post ('^jasper-stats$', 'getTicketStats')
			)
		);


		//the truth is I ended up having to dump all my resources into the assets folder.  some of these would work while others didn't;
		//frustrated I put them in one folder.  it doesn't change much;
		//this captures the group .* and names it url; This is a php regex sub pattern.
		//you may not need all of this anymore; haven't cleaned it up yet.
		
		$jasper_media_url = url ( '^/jasper-reports.*assets/', patterns ( 'controller\JasperMediaController', url_get ( '^(?P<url>.*)$', 'defaultAction' ) ) );
		$js_media_url = url ( '^/jasper-reports.*js/', patterns ( 'controller\JasperMediaController', url_get ( '^(?P<url>.*)$', 'defaultAction' ) ) );
		$ost_media_url = url ( '^/osticketdev.*js/', patterns ( 'controller\JasperMediaController', url_get ( '^(?P<url>.*)$', 'scpAction' ) ) );
		$image_media_url = url ( '^/jasper-reports.*images/', patterns ( 'controller\JasperMediaController', url_get ( '^(?P<url>.*)$', 'defaultAction' ) ) );
		$css_media_url = url ( '^/jasper-reports.*css/', patterns ( 'controller\JasperMediaController', url_get ( '^(?P<url>.*)$', 'defaultAction' ) ) );
		
		//in this order
		$object->append ($js_media_url);
		$object->append ($ost_media_url);
		$object->append ($css_media_url);
		$object->append ($image_media_url);
		$object->append ($jasper_media_url);

		$object->append ($search_url);

	}

	//bootstrap required by interface
	function bootstrap(){


		
	  if ($this->firstRun ()) {
            if (! $this->configureFirstRun ()) {
                return false;
            }
        }       
        else if ($this->needUpgrade ()) {
            $this->configureUpgrade ();
        }

        $config = $this->getConfig ();
		self::$jasper_server = $config->get('url_jasper_server');
		self::$jasper_server_ssl = $config->get('ssl_jasper_server');
		self::$jasper_server_username = $config->get('username_jasper_server');
		self::$jasper_server_password = $config->get('password_jasper_server');
		self::$jasper_server_report_path = $config->get('report_path_jasper_server');
		
        if ($config->get ('url_jasper_server')) {
            $this->createStaffMenu ();
        }

        Signal::connect ('apps.scp', array (
                'JasperReportPlugin',
				'callbackDispatch'
       ));
	}
	   /**
     * Creates menu links in the staff backend.
     */
    function createStaffMenu() {
				// Set the url so other code can find it.
	
        Application::registerStaffApp ('Jasper Reports', 'dispatcher.php/jasper-reports/search', array (
                iconclass => 'faq-categories' 
       ));
    }
	  /**
     * Checks if this is the first run of our plugin.
     *
     * @return boolean
     */
    function firstRun() {

    }
    function needUpgrade() {

        return false;
    }
    function configureUpgrade() {

    }

    /**
     * Necessary functionality to configure first run of the application
     */
    function configureFirstRun() {

        return true;
    }

    /**
     * Kicks off database installation scripts
     *
     * @return boolean
     */
    function createDBTables() {

    }

    /**
     * Uninstall hook.
     *
     * @param type $errors          
     * @return boolean
     */
    function pre_uninstall(&$errors) {

    }

}



?>
