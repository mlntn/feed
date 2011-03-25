<?php

require_once 'AtomItem.class.php';

class GoogleReaderSharedItem extends AtomItem {

	public $type      = 'google-reader';

	public function parse() {
		parent::parse();

		$this->item['description'] = "Shared <a href=\"{$this->item['link']}\" rel=\"nofollow\" target=\"_blank\">{$this->item['title']}</a>";
	}

	public function getCreditLink() {
		return 'Google Reader';
	}

}
