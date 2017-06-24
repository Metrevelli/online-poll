<?php
spl_autoload_register(function($class) {
	if(file_exists('/var/www/html/online-poll/Classes/' . $class . '.php')){
		require_once '/var/www/html/online-poll/Classes/' . $class . '.php';
	}else if(file_exists('/var/www/html/online-poll/Controllers/' . $class . '.php')){
		require_once '/var/www/html/online-poll/Controllers/' . $class . '.php';
	}
});
?>