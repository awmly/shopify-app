<?php

namespace Shopify;

class ShopifyAPI{

	public function __construct($shop, $token) {

		$this->shop = $shop;
		$this->token = $token;

  }

	public function buildQuery($params) {

		$query = http_build_query($params);

		$query = str_replace(array('%5B','%5D'), array('[',']'), $query);

		$query = preg_replace("/\[[0-9]+\]/i", "[]", $query);

		return $query;

	}

	public function post($endpoint, $data = array()) {

		return $this->curl($endpoint, 'POST', $data);

	}

	public function put($endpoint, $data = array()) {

		return $this->curl($endpoint, 'PUT', $data);

	}

	public function delete($endpoint) {

		return $this->curl($endpoint, 'DELETE');

	}

	public function get($endpoint) {

		return $this->curl($endpoint);

	}

	public function checkHeaders($curl, $header_line) {

		if (strstr($header_line, "HTTP_X_SHOPIFY_SHOP_API_CALL_LIMIT")){
			$calls = cutstr($header_line,"LIMIT: ","/40");
			//echo date('H:i:s') . " - " . $calls . "/40\n";

			if ($calls > 35) {
				logfile($this->shop . " limit hit " . $calls, "api-limit");
				usleep(500000);
			}

		}

	 return strlen($header_line);
	}

	public function curl($endpoint, $method = 'GET', $data = array()) {

		// Init curl
		$ch = curl_init();

		//logfile($method . " - https://" . $this->shop . $endpoint . $this->token, "api");

		//usleep(500000);

    // Set options
    curl_setopt_array($ch, array(
			CURLOPT_URL				       	=> 'https://' . $this->shop . $endpoint,
			CURLOPT_CONNECTTIMEOUT	 	=> 5,
			CURLOPT_TIMEOUT 		     	=> 5,
			CURLOPT_RETURNTRANSFER   	=> true,
			CURLOPT_CUSTOMREQUEST			=> $method,
			//CURLOPT_HEADER						=> true,
			//CURLOPT_HEADERFUNCTION		=> array($this, 'checkHeaders'),
		  CURLOPT_HTTPHEADER 				=> array(
		    'X-Shopify-Access-Token: ' . $this->token,
				'Content-Type: application/json; charset=utf-8'
		  )
		));

		// Add data
    if (count($data)) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    // Execute
    $return = curl_exec($ch);

		// Return decoded json
		if ($return) {

			$json = json_decode($return);

			if (is_object($json)) {

				return $json;

			}
		}

		return false;


	}

}
