<?php

namespace Shopify;

class ShopifyAssets extends ShopifyObjects{

	public $api;
	public $theme;
	public $objectClass = '\Shopify\ShopifyAsset';
	public $objectType 	= 'asset';
	public $objectsType = 'assets';
	public $endpoint 		= '/admin/themes/{theme_id}/assets';


	public function search($params = array(), $createObjects = true) {

		$results = parent::search($params, $createObjects);

		if ($params['bucket']){
			foreach ($results as $id => $asset) {
				if (!strstr($asset->key, $params['bucket'] . '/')) {
					unset($results[$id]);
				}
			}

			$results = array_filter($results);
		}

		return $results;

	}


	public function get($key) {

		$json = $this->api->get($this->endpoint . '.json?asset[key]='. $key."&theme_id=" . $this->theme->id);

		return $this->initObject($json->{$this->objectType});

	}


	public function add($data) {

		$json = $this->api->put($this->endpoint . '.json', array('asset' => $data));

		return $this->initObject($json->{$this->objectType});

	}

	public function put($key, $value, $overwrite = true) {

		// Check if snippet exists
    $asset = $this->get($key);


    if ($asset) {

      // Update
      $asset->value = $value;
      $asset->save();

    } else {

      // Add asset
      $asset = $this->add(array(
        'key'   => $key,
        'value' => $value
      ));

    }

		return $asset;

	}

}
