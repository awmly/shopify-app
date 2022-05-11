<?php

namespace Shopify;

class Helpers{

	public static function getToken($shop, $code) {

    // Get token
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://' . $shop . '/admin/oauth/access_token');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=" . SHOPIFY_KEY . "&client_secret=" . SHOPIFY_SECRET . "&code=" . $code);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $token = json_decode(curl_exec($ch));

    return $token;

	}

	public static function generateHash($string) {

		return hash_hmac('sha256', $string, SHOPIFY_SECRET, false);

	}

	public static function generateHMAC($data) {

		ksort($data);

		$params = [];

  	foreach ($data as  $key => $val) {

      $key = str_replace(array('%','&','='),  array('%25','%26','%3D'), $key);
      $val = str_replace(array('%','&'),      array('%25','%26'),       $val);

			$params[] = $key . "=" . $val;

    }

		$qs = implode("&", $params);

  	$hmac = hash_hmac('sha256' , $qs, SHOPIFY_SECRET, false);

		return $qs . "&hmac=" . $hmac;

	}

	public static function validateHMAC($data) {

		ksort($data);

    $hmac = $data['hmac'];

    unset($data['signature']);
  	unset($data['hmac']);

		$params = [];

  	foreach ($data as  $key => $val) {

      $key = str_replace(array('%','&','='),  array('%25','%26','%3D'), $key);
      $val = str_replace(array('%','&'),      array('%25','%26'),       $val);

			$params[] = $key . "=" . $val;

    }

  	return $hmac == hash_hmac('sha256' , implode("&", $params), SHOPIFY_SECRET, false) ? true : false;

	}

	public static function validateWebhook($hmac, $data) {
		
  	return $hmac == base64_encode(hash_hmac('sha256' , $data, SHOPIFY_SECRET, true)) ? true : false;

	}

	public static function parseData($params) {

		foreach ($params as &$value) {
				if (is_string($value)) {
					$value = html_entity_decode($value, ENT_QUOTES);
				}else if (is_array($value)) {
					$value = self::parseData($value);
				}
		}

		return $params;

	}

}
