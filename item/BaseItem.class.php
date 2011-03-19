<?php

class BaseItem {

	public $item = array();
	public $type = '';
	public $credit_link = '';

	public function  __construct(SimpleXMLElement $xml) {
		$this->item = (array) $xml;
	}

	public function parse() {
		$this->item = array_merge($this->item, array(
			'timestamp' => strtotime($this->item['pubDate']),
		));
	}

	public final function get() {
		return $this->item;
	}

	public function getCreditLink() {
		return $this->credit_link;
	}

}
