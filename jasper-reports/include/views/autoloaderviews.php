<?php
class Autoloader {
	public static function loader($className) {
		echo 'hi '.$className . '</br>';
			$className = ltrim ($className, '\\');
			$fileName = '';
			$namespace = '';
			if ($lastNsPos = strrpos ($className, '\\')) {
				$namespace = substr ($className, 0, $lastNsPos);
				$className = substr ($className, $lastNsPos + 1);
				$fileName = str_replace ('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
			}
			$fileName .= str_replace ('_', DIRECTORY_SEPARATOR, $className) . '.php';
			echo $fileName."</br>";
			//echo '</br>'.__DIR__.'/'.'</br>';
			// echo '</br>'.JASPER_REPORTS_PLUGIN_ROOT.'+'.$fileName.'</br>';
			echo '</br>'.JASPER_REPORTS_INCLUDE.'+'.$fileName.'</br>';
			// echo '</br>'.JASPER_REPORTS_PLUGIN_ROOT . $fileName.'</br>';
			if (file_exists (JASPER_REPORTS_INCLUDE . $fileName)) {
				echo 'i exist';
				require_once $fileName;
			}
			echo 'bye';
	}
}
spl_autoload_register('Autoloader::loader');