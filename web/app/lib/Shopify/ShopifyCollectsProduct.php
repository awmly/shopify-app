<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyCollectsProduct extends ShopifyObjects{

	public $api;
	public $collects;
	public $collections;
	public $product;

	public function add($collection) {

    $data = array(
    	"product_id"     => $this->product->id,
    	"collection_id"  => is_object($collection) ? $collection->id : $collection,
    );

    return $this->collects()->add($data);

  }

  public function remove($collection) {

    $params = array(
    	"product_id"     => $this->product->id,
    	"collection_id"  => is_object($collection) ? $collection->id : $collection,
    );

    $collects = $this->collects()->search($params, true);

    $collects[0]->delete();

  }

  public function search($params = array(), $createObjects = true) {

    $params['product_id'] = $this->product->id;

    $results = $this->collects()->search($params);

    if (is_array($results) && $createObjects) {

      $collections = array();

      foreach ($results as $collect) {
          $collections[] = $this->collections()->get($collect->collection_id);
      }

			return $collections;

    } else {

			return $results;

		}

  }

  public function total($params = array()) {

		$params['product_id'] = $this->product->id;

    return $this->collects()->total($params);

  }

  public function collections() {

    if (!$this->collections) {
      $this->collections = new ShopifyCollectionsCustom($this->api);
    }

    return $this->collections;

  }

	public function collects() {

    if (!$this->collects) {
      $this->collects = new ShopifyCollects($this->api);
    }

    return $this->collects;

  }

}
