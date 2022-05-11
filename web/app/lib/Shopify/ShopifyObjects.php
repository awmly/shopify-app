<?php

namespace Shopify;

class ShopifyObjects {

	public $api;
	public $objectClass;
	public $objectType;
	public $objectsType;
	public $endpoint;
	public $endpointSearch;
	public $errorClass = '\Shopify\ShopifyError';

	public function __construct($api) {

    $this->api = $api;

	}


	public function search($params = array(), $createObjects = true) {

		$query = http_build_query($params);

		$json = $this->api->get(($this->endpointSearch ?: $this->endpoint) . '.json?' . $query);

		if ($json->errors) {

			return new $this->errorClass($this->api, $json->errors);

		} else {

			if ($createObjects) {

				$results = [];

				if (is_array($json->{$this->objectsType})) {
					foreach ($json->{$this->objectsType} as $object) {
						$results[] = $this->initObject($object);
					}
				}

			} else {
				$results = $json->{$this->objectsType};
			}

			return $results;

		}

	}


	public function total($params = array()) {

		$query = http_build_query($params);

		$json = $this->api->get($this->endpoint . '/count.json?' . $query);

		return $json->count;

	}


	public function get($id) {

		$json = $this->api->get($this->endpoint . '/' . $id . '.json');

		return $this->initObject($json);

	}


	public function add($data) {

		$helpers = new Helpers();

		$data = $helpers->parseData($data);

		$json = $this->api->post($this->endpoint . '.json', array($this->objectType => $data));

		return $this->initObject($json);

	}


	public function initObject($object) {

		if ($object->errors) {

			$object = new $this->errorClass($this->api, $object->errors);
			return $object;

		} else if ($object) {

			$object = new $this->objectClass($this->api, ($object->{$this->objectType} ?: $object));
			return $object;

		} else {

			return false;

		}

	}

}
