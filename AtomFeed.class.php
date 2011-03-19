<?php

require_once 'BaseFeed.class.php';
require_once 'item/AtomItem.class.php';

class AtomFeed extends BaseFeed {

	public function __construct($url) {
		$this->setUrl($url);
	}

	protected function getItemObject(SimpleXMLElement $xml) {
		return new AtomItem($xml);
	}

}
