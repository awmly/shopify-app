<?php

namespace Shopify;

class ShopifyObject{

  public $api;
  public $object;
  public $endpoint;
  public $metafields;
  public $isError = false;
  public $errorClass = '\Shopify\ShopifyError';

	public function __construct($api, $object) {

    $this->api    = $api;
		$this->object = $object;

    $this->endpoint = str_replace("{id}", $this->object->id, $this->endpoint);

    $this->init();

  }

  public function init() { }

	public function __get($var) {

		return $this->object->$var;

	}

	public function __set($var, $val) {

		$this->object->{$var} = is_string($val) ? html_entity_decode($val, ENT_QUOTES) : $val;

	}

  public function set($params) {

    $params = Helpers::parseData($params);

    foreach ($params as $param => $value) {

      $this->object->{$param} = $value;

    }

  }



  public function delete() {

    $json = $this->api->delete($this->endpoint . ".json");

    if ($json->errors) {

			return new $this->errorClass($this->api, $json->errors);

		} else {

      return $json;

    }

  }


  public function metafields() {

    if (!$this->metafields) {
      $this->metafields = new ShopifyMetafields($this->api);
      $this->metafields->object 	= $this->object;
  		$this->metafields->endpoint = str_replace(array("{object_id}", "{object_type}"), array($this->object->id, $this->objectsType), $this->metafields->endpoint);
    }

    return $this->metafields;

  }


  public function save() {

    $json = $this->api->put($this->endpoint . ".json", array($this->objectType => $this->object));

    if ($json->errors) {

			return new $this->errorClass($this->api, $json->errors);

		} else {

      $this->object = $json->{$this->objectType};
      return true;

    }

  }

}
