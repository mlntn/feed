<?php

require_once 'BaseItem.class.php';

class PosterousItem extends BaseItem {

	public $type         = 'posterous';

	public function parse() {
		parent::parse();

		$this->item['description'] = "Posted <a href=\"{$this->item['link']}\" rel=\"nofollow\" target=\"_blank\">{$this->item['title']}</a>";
	}

}
