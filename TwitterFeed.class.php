<?php

require_once 'BaseFeed.class.php';
require_once 'item/TwitterItem.class.php';

class TwitterFeed extends BaseFeed {

	private $username = '';

	public function __construct($username) {
		$this->setUrl("http://www.twitter.com/statuses/user_timeline/{$username}.rss?source=twitterandroid");

		$this->username = $username;

		$this->initCache("twitter_{$username}");
	}

	public function getItemObject(SimpleXMLElement $xml) {
		$item = new TwitterItem($xml);
		$item->username = $this->username;

		return $item;
	}

}
