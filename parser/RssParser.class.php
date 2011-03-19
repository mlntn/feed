<?php

require_once 'BaseParser.class.php';

class RssParser extends BaseParser {

	public function  __construct($xml) {
		// because SimpleXML won't pass $xml->channel->items as an array
		foreach ($xml->channel->item as $this->items[]);

		$this->credit_link = (string) $xml->channel->link;
	}



}
