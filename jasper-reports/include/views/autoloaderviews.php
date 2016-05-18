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
			if (file_exists (JASPER_REPORTS_INCLUDE . $fileName)) {
				require_once $fileName;
			}
	}
}
spl_autoload_register('Autoloader::loader');
