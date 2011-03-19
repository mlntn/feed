<?php

require_once 'BaseParser.class.php';

class AtomParser extends BaseParser {

	public function  __construct($xml) {
		// because SimpleXML won't pass $xml->entry as an array
		foreach ($xml->entry as $this->items[]);

		$this->credit_link = (string) $this->getLink($xml->link);
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
