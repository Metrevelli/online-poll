<?php
class redirect{
	public static function to($location = null){
		if($location){
			if(is_numeric($location)){
				switch($location){
					case 404:
						header('HTTP/1.0 404 Not Found');
						include 'Includes/Errors/404.php';
						die();
					break;
				}
			}
		}
		header('Location: '.$location);
		die();
	}
}