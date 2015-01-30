<?php

	session_start();
	define('DIRSEP', DIRECTORY_SEPARATOR);
	define('EXT', '.php');
	define('PATH', dirname (__FILE__) . DIRSEP);

	// class autoload
	function __autoload($classname) {
		$filename = PATH . 'packages' . DIRSEP . strtr ($classname, "\\", DIRSEP) . EXT;
		include_once ($filename);
	}

	// db connect (mysqli)
	\App\Core::connect();

	\App\Core::app ();

	//db disconnect
	\App\Core::disconnect();
