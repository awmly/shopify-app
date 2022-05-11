<?php

namespace Shopify;

class ShopifyCollectionCustom extends ShopifyObject{

  public $collects;
  public $objectType  = 'custom_collection';
  public $objectsType = 'custom_collections';
  public $endpoint    = '/admin/custom_collections/{id}';


  public function collects() {

    if (!$this->collects) {
      $this->collects = new ShopifyCollectsCollection($this->api);
      $this->collects->collection = $this->object;
    }

    return $this->collects;

  }

}
