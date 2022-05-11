<?php

namespace Shopify;

use Helpers;

class ShopifyAsset extends ShopifyObject{

  public $objectType  = 'asset';
  public $endpoint    = '/admin/themes/{theme_id}/assets';


  public function init() {

    $this->endpoint = str_replace("{theme_id}", $this->object->theme_id, $this->endpoint);

	}


  public function delete() {

    $json = $this->api->delete($this->endpoint . ".json?asset[key]=" . $this->key);

		return $json;

  }

}
