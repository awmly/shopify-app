<?php

namespace Shopify;

use ShopifyProduct;

class ShopifyMetafields extends ShopifyObjects{

	public $api;
	public $product;
	public $objectClass = '\Shopify\ShopifyMetafield';
	public $objectType 	= 'metafield';
	public $objectsType = 'metafields';
	public $endpoint 		= '/admin/{object_type}/{object_id}/metafields';

	public $metafields;

	public function get($opt) {

		$namespace = $opt['namespace'];
		$key = $opt['key'];

		if (!$this->metafields) {
			$this->metafields = $this->search(array(
	    	"namespace" 	=> $namespace
	    ));
		}

		foreach ($this->metafields as $metafield) {
			if ($metafield->key == $key) {
				return $metafield;
			}
		}

		return false;

	}

	public function delete($data) {

		$metafield = $this->get($data);

		if ($metafield) {
			$metafield->delete();
		}

	}


	public function set($data) {

		if ($data['value']) {

			$metafield = $this->get($data);

			if ($metafield) {
				$metafield->set($data);
				$metafield->save();
			}else{
				$metafield = $this->add($data);
			}

			return $metafield;

		} else {

			return $this->delete($data);

		}

	}

}
