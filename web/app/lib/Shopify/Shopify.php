<?php

namespace Shopify;

class Shopify{

	public function __construct($shop = false, $token = false) {

		if ($shop && $token) {

			$this->setAPI($shop, $token);

		}

  }

	public function setAPI($shop, $token) {

		$this->shop = $shop;
		$this->token = $token;

		$this->api = new ShopifyAPI($shop, $token);

	}

	public function carrierServices() {

		return new ShopifyCarrierServices($this->api);

	}


	public function collections($type = 'smart') {

		if ($type == 'smart') {
			return new ShopifyCollectionsSmart($this->api);
		} else {
			return new ShopifyCollectionsCustom($this->api);
		}

	}

	public function collects() {

		return new ShopifyCollects($this->api);

	}

	public function customers() {

		return new ShopifyCustomers($this->api);

	}


	public function pages() {

		return new ShopifyPages($this->api);

	}


	public function orders() {

		return new ShopifyOrders($this->api);

	}


	public function products() {

		return new ShopifyProducts($this->api);

	}

	public function redirects() {

		return new ShopifyRedirects($this->api);

	}

	public function shop() {

		return $this->api->get('/admin/shop.json');

		//return new ShopifyShop($this->api, $json);

	}

	public function scriptTags() {

		return new ShopifyScriptTags($this->api);

	}


	public function themes() {

		return new ShopifyThemes($this->api);

	}


	public function webhooks() {

		return new ShopifyWebhooks($this->api);

	}

}
