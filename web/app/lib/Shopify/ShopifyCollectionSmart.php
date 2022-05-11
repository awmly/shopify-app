<?php

namespace Shopify;

class ShopifyCollectionSmart extends ShopifyObject{

  public $objectType  = 'smart_collection';
  public $objectsType  = 'smart_collections';
  public $endpoint    = '/admin/smart_collections/{id}';


  public function order($params = array()) {

		$json = $this->api->put($this->endpoint . '/order.json?' . $this->api->buildQuery($params));

		return $json;

	}

}
