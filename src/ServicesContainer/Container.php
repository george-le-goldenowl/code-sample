<?php

namespace Go\Sample\ServicesContainer;

/**
 * Services Container
 */
class Container {
	private $binding = [];

	public function bind($interface, $implementation) {
		$this->binding[$interface] = $implementation;
	}

	public function resolve($interface, $depends = false) {
		if (isset($this->binding[$interface])) {

			if ($depends) {
				return (new $this->binding[$interface]($depends));
			}

			return (new $this->binding[$interface]());
		}

		return;
	}
}