<?php

require_once 'BaseParser.class.php';

class RssParser extends BaseParser {

	public function  __construct($xml, BaseFeed $feed) {
		// because SimpleXML won't pass $xml->channel->items as an array
		foreach ($xml->channel->item as $this->xml_items[]);

		$this->credit_url   = (string) $xml->channel->link;
		$this->credit_text  = (string) $xml->channel->title;

		$this->getItems($feed);
	}



}
