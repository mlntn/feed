<?php

require_once 'BaseFeed.class.php';
require_once 'item/TwitterItem.class.php';

class TwitterFeed extends BaseFeed {

	private $username = '';

	public function __construct($username) {
		$this->setUrl("http://api.twitter.com/1/statuses/user_timeline.rss?screen_name={$username}");

		$this->username = $username;

		$this->initCache("twitter_{$username}");
	}

	public function getItemObject(SimpleXMLElement $xml) {
		$item = new TwitterItem($xml);
		$item->username = $this->username;

		return $item;
	}

}
