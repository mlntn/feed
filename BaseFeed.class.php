<?php

require_once dirname(__FILE__) . '/../cache/FileCache.class.php';

class BaseFeed {

	private $url = '';

	protected $items = array();
	protected $cache = null;

	protected function setUrl($url) {
		$this->url = $url;
	}

	public function getUrl() {
		return $this->url;
	}

	public function get($count = 10) {
		$url = $this->getUrl();

		if ($this->isCacheEnabled() && $this->cache->has($url)) {
			$this->items = $this->cache->get($url);
		}
		else {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla 4');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);

			if ($response) {
				$xml = simplexml_load_string($response);
				if ($xml) {
					$item_count = 0;
					foreach ($xml->channel->item as $x) {
						if ($item_count == $count) break;

						$item = $this->getItemObject($x);
						$item->parse();
						$this->items[] = $item;
						$item_count++;
					}
					if (count($this->items) && $this->isCacheEnabled()) {
						$this->cache->set($url, $this->items);
					}
				}
			}
		}

		return $this->items;
	}

	protected function getItemObject(SimpleXMLElement $xml) {
		return new BaseItem($xml);
	}

	protected function initCache($prefix, $lifetime = 3600) {
		$this->cache = new FileCache($prefix, $lifetime);
	}

	private function isCacheEnabled() {
		return $this->cache !== null;
	}

	public function getCreditLink() {
		return '';
	}

}
