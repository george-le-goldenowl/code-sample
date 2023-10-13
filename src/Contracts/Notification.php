<?php

namespace Go\Sample\Contracts;

interface Notification {
	public function send(array $message);
}