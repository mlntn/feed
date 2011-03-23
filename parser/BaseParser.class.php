<?php

class BaseParser {

	public $credit_text  = '';
	public $credit_url   = '';
	public $items        = array();
	public $xml_items    = array();

	protected function getItems(BaseFeed $feed) {
		foreach ($this->xml_items as $i) {
			$item = $feed->getItemObject($i);
			$item->parse();
			$item->credit_text  = $this->credit_text;
			$item->credit_url   = $this->credit_url;
			$this->items[] = $item;
		}
	}

}
