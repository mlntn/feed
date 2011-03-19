<?php

require_once 'BaseFeed.class.php';
require_once 'item/RssItem.class.php';

class RssFeed extends BaseFeed {

	public function __construct($url) {
		$this->setUrl($url);
	}

	protected function getItemObject(SimpleXMLElement $xml) {
		return new RssItem($xml);
	}

}
