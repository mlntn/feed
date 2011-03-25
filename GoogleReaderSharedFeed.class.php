<?php

require_once 'BaseFeed.class.php';
require_once 'item/GoogleReaderSharedItem.class.php';

class GoogleReaderSharedFeed extends BaseFeed {

	public function __construct($user_id) {
		$this->setUrl("http://www.google.com/reader/public/atom/user/{$user_id}/state/com.google/broadcast");

		$this->initCache("google_reader_shared_{$user_id}");
	}

	public function getItemObject(SimpleXMLElement $xml) {
		$item = new GoogleReaderSharedItem($xml);

		return $item;
	}

}
