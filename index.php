<?php

define('CLASSES', (string) (__DIR__ . '/'));

// Set include path
$path = (string) get_include_path();
$path .= (string) (PATH_SEPARATOR . CLASSES . 'controller/');
$path .= (string) (PATH_SEPARATOR . CLASSES . 'model/');
$path .= (string) (PATH_SEPARATOR . CLASSES . 'core/');
$path .= (string) (PATH_SEPARATOR . CLASSES . 'view/');

set_include_path($path);

spl_autoload_register(
	function ($className) {
		$className = (string) str_replace('\\', DIRECTORY_SEPARATOR, $className);
		include_once($className . '.php');
	}
);

Route::start();
?>