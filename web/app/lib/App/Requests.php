<?php

namespace App;

class Requests {

	public static function get() {

    $get = new \stdClass();

    foreach ($_GET as $var => $val) {

      $get->{$var} = self::clean($val);

    }

    return $get;

	}

  public static function clean($v) {

    $v = trim($v);
    $v = htmlentities($v, ENT_QUOTES, "utf-8");
    $v = str_replace(array("\r\n", "\n\r", "\r", "\n"), "<br/>", $v);
    $v = stripslashes($v);

    return $v;

  }

}
