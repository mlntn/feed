<?php

require_once 'BaseItem.class.php';

class AzCentralItem extends RssItem {
	
	public $with_summary = false;

	public function parse() {
		parent::parse();

		list($title, $description, $link) = preg_split('#<br />\s*<br />\s*#', $this->item['description']);

		$this->item['title']        = $title;
		$this->item['description']  = $description;
		unset($this->item['guid'], $this->item['pubDate']);

		if (!$this->with_summary) {
			unset($this->item['description']);
		}
	}


}
