<?php

class Autoload{

	public static function Init(){

		spl_autoload_extensions('.php');

		spl_autoload_register('self::App');

	}

	public static function Load($file){

		if (is_file($file)) {
			include($file);
		}

	}

	public static function App($class){

		$file = PATH_LIB . str_replace("\\", "/", $class) . '.php';

		return self::Load($file);

	}

}
