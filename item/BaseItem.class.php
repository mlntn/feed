<?php

class BaseItem {

	public $item = array();
	public $type = '';
	public $credit_url   = '';
	public $credit_text  = '';

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

	public function getCreditLink($new_window = true, $nofollow = true) {
		$link = $this->credit_text;
		if ($this->credit_url) {
			$target  = ($new_window) ? 'target="_blank"' : '';
			$rel     = ($nofollow) ? 'rel="nofollow"' : '';
			$link    = "<a href=\"{$this->credit_url}\" {$target} {$rel}>{$link}</a>";
		}
		return $link;
	}

}
