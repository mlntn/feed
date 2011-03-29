<?php

require_once 'BaseFeed.class.php';
require_once 'item/PosterousItem.class.php';

class PosterousFeed extends BaseFeed {

	private $credit_text = '';

	public function __construct($domain, $credit_text = 'Posterous') {
		$this->setUrl("http://{$domain}/rss.xml");

		$this->credit_text = $credit_text;

		$this->initCache("posterous_" . strtr($domain, './', '_-'));
	}

	public function getItemObject(SimpleXMLElement $xml) {
		$item = new PosterousItem($xml);

		$item->credit_text = $this->credit_text;

		return $item;
	}

}
