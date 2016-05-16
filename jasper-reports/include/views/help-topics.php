<?PHP 
//cheap debugger;
// echo '<pre>';
// print_r($ost->plugins);
// echo '</pre>';
// die();

//YOU MUST INSTALL THE Jasper Report library
require_once JASPER_REPORTS_PLUGIN_ROOT . "/vendor/autoload.php";
 
use Jaspersoft\Client\Client;

$c = new Client(
				"http://localhost:8080/jasperserver",
				"jasperadmin",
				"jasperadmin"
			);

$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];

$js = $c->jobService();               
$c->setRequestTimeout(60); 
$info = $c->serverInfo();

$controls = array(
   'ticketStartDate' => array($start_date),
   'ticketEndDate' => array($end_date)
   );

//This path may not match yours; correct as needed; mc;
$report = $c->reportService()->runReport('/reports/osTicket/HelpTopics', 'html', null, null, $controls);

// if you wanted pdf instead;
// header('Cache-Control: must-revalidate');
// header('Pragma: public');
// header('Content-Description: File Transfer');
// header('Content-Disposition: attachment; filename=report.pdf');
// header('Content-Transfer-Encoding: binary');
// header('Content-Length: ' . strlen($report));
// header('Content-Type: application/pdf');
 
echo $report;		
 
?>
