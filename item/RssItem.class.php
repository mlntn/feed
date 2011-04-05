<?php

require_once 'BaseItem.class.php';

class RssItem extends BaseItem {
	
	public function parse() {
		parent::parse();
		
		$this->item['pubDate'] = (string) $this->item['pubDate'];
	}
	
}
