<?php

namespace Go\Sample\Services;

use Go\Sample\Contracts\Mail;
use Go\Sample\Contracts\Notification;

/**
 * Email notification service
 */
class NotificationService implements Notification, Mail {

	private $mail;

	function __construct(Mail $mail) {
		$this->mail = $mail;

		// config mail before send
		$this->setup();
	}

	public function setup() {
		$this->mail->setup();
	}

	public function send(array $payload) {
		// trigger mail adapter
		$this->mail->send($payload);
	}
}