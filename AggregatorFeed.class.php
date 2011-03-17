<?php

require_once 'BaseFeed.class.php';

class AggregatorFeed extends BaseFeed {

	private $feeds  = array();

	public function  __construct($cache_key = 'aggregator') {
		$this->initCache($cache_key);
	}

	public function addFeed(BaseFeed $feed) {
		$this->feeds[]  = $feed;
		
		return $this;
	}

	public function getItems($count = 10) {
		$key = serialize($this->feeds);

		if ($this->cache->has($key)) {
			$this->items = $this->cache->get($key);
		}
		else {
			foreach ($this->feeds as $feed) {
				$this->items = array_merge($this->items, $feed->get());
			}

			$this->sortItems();

			$this->cache->set($key, $this->items);
		}

		return array_slice($this->items, 0, $count);
	}

	private function sortItems($field = 'timestamp', $ascending = false) {
		$sort_method = ($ascending) ? 'ksort' : 'krsort';

		$items = array();
		foreach ($this->items as $i) {
			$items[$i->item[$field]] = $i;
		}

		$sort_method($items);
		
		$this->items = array_values($items);
	}

}