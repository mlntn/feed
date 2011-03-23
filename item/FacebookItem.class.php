<?php

require_once 'BaseItem.class.php';

class FacebookItem extends BaseItem {

	public $username  = '';
	public $type      = 'facebook';

	public function parse() {
		parent::parse();

		$intro = preg_match('/[A-Z]/', $this->item['description'][0]) ? '' : str_replace(strip_tags($this->item['description']), '', $this->item['title']);
		$this->item['description'] = $intro . preg_replace('/onmousedown=".*?" /', '', $this->item['description']);
	}

	public function getCreditLink() {
		return '<a href="http://facebook.com/' . $this->username . '" target="_blank" rel="nofollow">Facebook</a>';
	}

}
