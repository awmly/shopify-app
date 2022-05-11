<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyCollectsCollection extends ShopifyObjects{

	public $api;
	public $collects;
	public $collection;
	public $products;

	public function add($prod) {

    $data = array(
    	"product_id"     => is_object($prod) ? $prod->id : $prod,
    	"collection_id"  => $this->collection->id
    );

    return $this->collects()->add($data);

  }

  public function remove($prod) {

    $params = array(
    	"product_id"     => is_object($prod) ? $prod->id : $prod,
    	"collection_id"  => $this->collection->id
    );

    $collects = $this->collects()->search($params, true);

    $collects[0]->delete();

  }

  public function search($params = array(), $createObjects = true) {

    $params['collection_id'] = $this->collection->id;

    $results = $this->collects()->search($params);

    if (is_array($results) && $createObjects) {

      $products = array();

      foreach ($results as $collect) {
          $products[] = $this->products()->get($collect->product_id);
      }

    	return $products;

		} else {

			return $results;

		}

  }

  public function total($params = array()) {

		$params['collection_id'] = $this->collection->id;

    return $this->collects()->total($params);

  }

  public function products() {

    if (!$this->products) {
      $this->products = new ShopifyProducts($this->api);
    }

    return $this->products;

  }

	public function collects() {

    if (!$this->collects) {
      $this->collects = new ShopifyCollects($this->api);
    }

    return $this->collects;

  }

}
