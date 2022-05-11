<?php

namespace Shopify;

class ShopifyTheme extends ShopifyObject{

  public $assets;
  public $objectType  = 'theme';
  public $endpoint    = '/admin/themes/{id}';


  public function assets() {

    if (!$this->assets) {
      $this->assets = new ShopifyAssets($this->api);
      $this->assets->theme = $this->object;
  		$this->assets->endpoint = str_replace("{theme_id}", $this->object->id, $this->assets->endpoint);
    }

    return $this->assets;

  }

}
