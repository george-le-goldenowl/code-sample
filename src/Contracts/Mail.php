<?php

namespace Go\Sample\Contracts;

interface Mail {
	public function setup();
	public function send(array $payload);
}