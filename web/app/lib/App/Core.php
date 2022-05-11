<?php

namespace App;

class Core{

	public function load() {

		$url = explode("?", $_SERVER['REQUEST_URI']);

		$url = str_replace(APP_PATH, "", $url);

		$route = substr( html_entity_decode( urldecode( reset( $url ) ) ), 1);

		$file = PATH_ROUTES . $route . '.php';

		if (is_file($file))
		{
			include($file);
		}
		else
		{
			exit('Route not found');
		}

	}

}
