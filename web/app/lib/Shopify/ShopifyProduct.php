<?php

namespace Shopify;

class ShopifyProduct extends ShopifyObject{

  public $collects;
  public $variants;
  public $objectType  = 'product';
  public $objectsType = 'products';
  public $endpoint    = '/admin/products/{id}';

  public function variantMetafields($id) {

    $json = $this->api->get("/admin/variants/".$id."/metafields.json");

    return $json->metafields;

  }

  public function collects() {

    if (!$this->collects) {
      $this->collects = new ShopifyCollectsProduct($this->api);
      $this->collects->product = $this->object;
    }

    return $this->collects;

  }

  public function variants() {

    if (!$this->variants) {
      $this->variants = new ShopifyVariants($this->api);
      $this->variants->product 	= $this->object;
  		$this->variants->endpoint = str_replace("{product_id}", $this->object->id, $this->variants->endpoint);
    }

    return $this->variants;

  }

}
