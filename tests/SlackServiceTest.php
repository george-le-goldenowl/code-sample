<?php

use Go\Sample\Services\NotificationService;
use Go\Sample\Services\SlackService;
use PHPUnit\Framework\TestCase;

/**
 * Slack Service tests
 */
class SlackServiceTest extends TestCase {

	/**
	 * @var NotificationService|MockObject
	 */
	private $notificationService;

	protected function setup(): void {
		parent::setup();

		// Create a mock of NotificationService interface
		$this->notificationService = $this->createMock(NotificationService::class);
	}

	public function testSendCallsNotificationService() {
		$slackService = new SlackService($this->notificationService);

		$payload = ["message" => "UNIT TEST SlackService"];

		// Expect that the send method of NotificationService will be called
		$this->notificationService->expects($this->once())->method('send')->with($payload);

		$slackService->send($payload);
	}
}