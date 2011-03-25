<?php

require_once 'BaseItem.class.php';

class AtomItem extends BaseItem {

	public function parse() {
		$summary = isset($this->item['summary']) ? 'summary' : 'content';
		$this->item = array(
			'title'        => (string) $this->item['title'],
			'description'  => (string) $this->item[$summary],
			'link'         => $this->getLink($this->item['link']),
			'date'         => $this->item['updated'],
			'timestamp'    => strtotime($this->item['updated']),
		);
	}

	private function getLink($links) {
		if (is_array($links)) {
			foreach ($links as $l) {
				$a = $l->attributes();
				if (!isset($a['rel'])) {
					break;
				}
			}
			$a = $links[0]->attributes();
		}
		else {
			$a = $links->attributes();
		}
		return (string) $a['href'];
	}

}
