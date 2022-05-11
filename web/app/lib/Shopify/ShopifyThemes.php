<?php

namespace Shopify;

class ShopifyThemes extends ShopifyObjects{

	public $api;
	public $objectClass = '\Shopify\ShopifyTheme';
	public $objectType 	= 'theme';
	public $objectsType = 'themes';
	public $endpoint 		= '/admin/themes';


	public function getMain() {

		$themes = $this->search();

		foreach($themes as $theme) {
			if ($theme->role == 'main') {
				return $this->initObject($theme);
			}
		}

		return false;

	}

}
