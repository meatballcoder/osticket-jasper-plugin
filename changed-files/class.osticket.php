//This is what I added to the ost class; drop where you want as needed; mc

//line 52
var $plugin_instance=false;

//line 81-86
	function isPlugin(){
		return $this->plugin_instance;
	}
	function setPluginInstance($plugin_path){
		$this->plugin_instance=$plugin_path;
	}
