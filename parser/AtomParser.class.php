<?php

require_once 'BaseParser.class.php';

class AtomParser extends BaseParser {

	public function  __construct($xml, BaseFeed $feed) {
		// because SimpleXML won't pass $xml->entry as an array
		foreach ($xml->entry as $this->xml_items[]);

		$this->credit_url   = $this->getLink($xml->link);
		$this->credit_text  = (string) $xml->title;

		$this->getItems($feed);
	}

	private function getLink($links) {
		if (!($a = $links->attributes())) {
			foreach ($links as $l) {
				$a = $l->attributes();
				if (!isset($a['rel'])) {
					break;
				}
			}
			$a = $links[0]->attributes();
		}
		return (string) $a['href'];
	}

}
