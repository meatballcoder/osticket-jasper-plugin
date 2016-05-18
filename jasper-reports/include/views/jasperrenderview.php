<?PHP 
namespace views;


class JasperRenderView extends JasperMasterView {
	
	function __construct(){
		
	}
	
	public function render_view($data, $report_format){
		global $ost, $msg, $cfg; //I had to put these in all the functions

		$ost->setPluginInstance(OST_WEB_ROOT.'scp/');
		
		require('staff.inc.php');
		include(STAFFINC_DIR.'header.inc.php');
		echo $data;		
	}
}	
 
?>