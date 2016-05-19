<?PHP
namespace controller;
		

require_once JASPER_REPORTS_PLUGIN_ROOT . "/vendor/autoload.php";
require_once JASPER_REPORTS_VIEWS . "autoloaderviews.php";

use Jaspersoft\Client\Client;
use Jaspersoft\Service\Criteria\RepositorySearchCriteria;
use views\JasperRenderView;

class JasperController extends JasperMasterController {
	private $renderer;
	
	private $c;
	
	function __construct() {
		global $ost, $msg, $cfg; //I had to put these in all the functions
		$this->c = new Client(
						"http://localhost:8080/jasperserver",
						"jasperadmin",
						"jasperadmin"
					);
		$this->renderer = new JasperRenderView();
    }
	public function searchAction(){
		global $ost, $msg, $cfg; //I had to put these in all the functions
		$ost->setPluginInstance(OST_WEB_ROOT.'scp/');
		
		$reports_available = $this->getReportsAvailable();
		
		require('staff.inc.php');
		include(STAFFINC_DIR.'header.inc.php');
		require(JASPER_REPORTS_VIEWS.'osticket-reports.html');
	}

	public function getTicketStats(){
		
		global $ost, $msg, $cfg; //I had to put these in all the functions
		$ost->setPluginInstance(OST_WEB_ROOT.'scp/');  //based upon my changing the $ost class

		$report_format=$_POST['report_format'];
		
		if ($report_format != "HTML"){
			$report_format="PDF";
		}

		$start_date=$_POST['start_date'];
		$end_date=$_POST['end_date'];
		$report_path = $_POST['report_name'];

		$js = $this->c->jobService();               
		$this->c->setRequestTimeout(60); 
		$info = $this->c->serverInfo();

		$controls = array(
		   'ticketStartDate' => array($start_date),
		   'ticketEndDate' => array($end_date)
		);

		$report = $this->c->reportService()->runReport($report_path, $report_format, null, null, $controls);
		$this->renderer->render_view($report, $report_format);
	}
	public function getReportsAvailable(){
		
		// Search for specific items in repository
		$criteria = new RepositorySearchCriteria();
		$criteria->folderUri="/reports/osTicket";
		//$criteria->q = "";
		 
		//it brings back objects, so no need to convert any json;
		return $this->c->repositoryService()->searchResources($criteria);
	 	
	}
}
?>