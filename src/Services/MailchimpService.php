<?php

namespace Go\Sample\Services;

use Go\Sample\Contracts\Mail;

/**
 * Gmail Service
 */
class MailchimpService implements Mail {

	public $mail;

	public function setup() {
		// Do Mailchimp Config
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
			return json_encode([
				'status' => 200,
				'message' => 'Send Mailchimp successful',
			]);
		} catch (Exception $e) {
			json_encode($e);
		}
	}
}