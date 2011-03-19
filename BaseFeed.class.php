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
					$this->parseFeed($xml, $count);
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

	private function parseFeed($xml, $count) {
		switch (true) {
			case $xml->entry:
				require_once 'parser/AtomParser.class.php';
				$parser = new AtomParser($xml);
				break;
			case $xml->channel:
			default:
				require_once 'parser/RssParser.class.php';
				$parser = new RssParser($xml);
				break;
		}

		$item_count = 0;
		foreach ($parser->items as $i) {
			if ($item_count == $count) break;

			$item = $this->getItemObject($i);
			$item->parse();
			$this->items[] = $item;
			$item_count++;
		}
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
