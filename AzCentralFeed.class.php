<?php

require_once 'RssFeed.class.php';
require_once 'item/AzCentralItem.class.php';

class AzCentralFeed extends RssFeed {
	
	private $with_summary = false;

	public function __construct($username, $with_summary = false) {
		parent::__construct("http://www.azcentral.com/members/Blog~/{$username}");
		$this->with_summary = $with_summary;
	}

	public function getItemObject(SimpleXMLElement $xml) {
		$item = new AzCentralItem($xml);
		$item->with_summary = $this->with_summary;
		
		return $item;
	}

}
