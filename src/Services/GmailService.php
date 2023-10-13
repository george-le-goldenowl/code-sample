<?php

namespace Go\Sample\Services;

use Go\Sample\Contracts\Mail;

/**
 * Gmail Service
 */
class GmailService implements Mail {

	public $mail;

	public function setup() {
		// Do Gmail Config
	}

	/**
	 * Send...
	 * Mail service adapter
	 *
	 * @param  string $mail
	 * @param  array $payload
	 * @return void
	 */
	public function send(array $payload) {
		try {
			echo json_encode([
				'status' => 200,
				'message' => 'Send Gmail successful',
			]);
		} catch (Exception $e) {
			json_encode($e);
		}
	}
}