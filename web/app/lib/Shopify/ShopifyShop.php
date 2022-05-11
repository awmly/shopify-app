<?php

namespace Shopify;

use Helpers;

class ShopifyShop extends ShopifyObject{

  public $objectType  = 'shop';
  public $endpoint    = '/admin/shop.json';

  public function get() {

		$json = $this->api->get($this->endpoint);

		return $json->shop;

	}

  public function setHMAC($app) {

    $mf = $this->metafields();

    $hmac = $mf->get(array(
      'namespace'   => 'cxl-' . $app,
      'key'         => 'hmac'
    ));

    if (!$hmac->value) {

      $hmacValue = md5(rand(10000,99999).(time()-2783462).rand(10000,99999));

      $hmac = $mf->set(array(
        'namespace'   => 'cxl-' . $app,
        'key'         => 'hmac',
        'value'       => $hmacValue,
        'value_type'  => 'string'
      ));

    }

    return $hmac;

  }

}
