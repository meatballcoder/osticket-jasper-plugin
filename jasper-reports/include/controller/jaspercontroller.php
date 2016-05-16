<?PHP
namespace controller;

class JasperController extends JasperMasterController {
	function __construct() {
		
     	//Remember that you don't have to declare "new" to get the class to instiate.  osTicket does that already;
    }
	public function searchAction(){
		global $ost, $msg, $cfg; //I had to put these in all the functions
		$ost->setPluginInstance(OST_WEB_ROOT.'scp/');
		require('staff.inc.php');
		include(STAFFINC_DIR.'header.inc.php');
		require(JASPER_REPORTS_VIEWS.'osticket-reports.html');
		//include(STAFFINC_DIR.'footer.inc.php');
	}
	//this is how you get the URL querystring, in order, based upon your regex in the initial callbackDispatch function, initial plugin file, for the scp signal;
	public function getTicketStats($start_date = 0, $end_date=1,$args = array()){
		//kept the variables in for posterity; I changed it to post;
		global $ost, $msg, $cfg;
		$ost->setPluginInstance(OST_WEB_ROOT.'scp/');  //based upon my changing the $ost class
		require('staff.inc.php');
		include(STAFFINC_DIR.'header.inc.php');
		require(JASPER_REPORTS_VIEWS.'help-topics.php');
		//include(STAFFINC_DIR.'footer.inc.php');
	}
	/**
	* Returns the calling function through a backtrace
	*/
	//put this in for debugging
	function get_calling_function() {
		// a funciton x has called a function y which called this
		// see stackoverflow.com/questions/190421
		$caller = debug_backtrace();
		$caller = $caller[2];
		$r = $caller['function'] . '()';
		if (isset($caller['class'])) {
			$r .= ' in ' . $caller['class'];
		}
		if (isset($caller['object'])) {
			$r .= ' (' . get_class($caller['object']) . ')';
		}
		return $caller['class'] . '->' . $r;
	}
}
?>
