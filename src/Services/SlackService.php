<?php

namespace Go\Sample\Services;

use Go\Sample\Contracts\Notification;
use Go\Sample\Contracts\NotificationAddOn;

/**
 * Slack notification
 */
class SlackService implements NotificationAddOn {
	protected $notification;

	function __construct(Notification $notification) {
		$this->notification = $notification;
	}

	public function send(array $message = []) {
		$this->notification->send($message);

		echo json_encode([
			'status' => 200,
			'message' => 'Send slack successful',
		]);
	}
}