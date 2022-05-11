<?php

namespace Shopify;

use Helpers;

class ShopifyCustomer extends ShopifyObject{

  public $objectType  = 'customer';
  public $objectsType  = 'customers';
  public $endpoint    = '/admin/customers/{id}';

  public function setHMAC($key) {

    $mf = $this->metafields();

    $hmac = $mf->get(array(
      'namespace'   => 'cxl',
      'key'         => $key
    ));

    if (!$hmac->value) {

      $hmacValue = md5(rand(10000,99999).(time()-2783462).rand(10000,99999));

      $hmac = $mf->set(array(
        'namespace'   => 'cxl',
        'key'         => $key,
        'value'       => $hmacValue,
        'value_type'  => 'string'
      ));

    }

    return $hmac;

  }

}
