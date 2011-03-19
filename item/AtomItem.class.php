<?php

require_once 'BaseItem.class.php';

class AtomItem extends BaseItem {

	public function parse() {
		$this->item = array(
			'title'        => (string) $this->item['title'],
			'description'  => (string) $this->item['summary'],
			'link'         => $this->getLink($this->item['link']),
			'date'         => $this->item['updated'],
			'timestamp'    => strtotime($this->item['updated']),
		);
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
