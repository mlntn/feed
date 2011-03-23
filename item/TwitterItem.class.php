<?php

require_once 'BaseItem.class.php';

class TwitterItem extends BaseItem {

	public $username  = '';
	public $type      = 'twitter';

	public function parse() {
		parent::parse();

		$twittify = array(
			'/@(.+?)\b/' => '<a href="http://twitter.com/$1" target="_blank" rel="nofollow">$0</a>',
			'/#(.+?)\b/' => '<a href="http://twitter.com/search?q=%23$1" target="_blank" rel="nofollow">$0</a>',
			'/([^">])(https?\:.+?)(\s|$)/' => '$1<a href="$2" target="_blank" rel="nofollow">$2</a>',
		);

		$this->item['description'] = preg_replace(array_keys($twittify), array_values($twittify), $this->item['description']);
	}

	public function getCreditLink() {
		return '<a href="http://twitter.com/' . $this->username . '" target="_blank" rel="nofollow">Twitter</a>';
	}

}
