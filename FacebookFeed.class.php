<?php

require_once 'BaseFeed.class.php';
require_once 'item/FacebookItem.class.php';

class FacebookFeed extends BaseFeed {

	private $username = '';

	public function __construct($user_id, $key, $username = '') {
		$this->setUrl("http://www.facebook.com/feeds/status.php?id={$user_id}&viewer={$user_id}&key={$key}&format=rss20");

		$this->username = $username;

		$this->initCache("facebook_{$username}");
	}

	public function getItemObject(SimpleXMLElement $xml) {
		$item = new FacebookItem($xml);
		$item->username = $this->username;

		return $item;
	}

}
