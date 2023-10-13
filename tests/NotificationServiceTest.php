<?php

use Go\Sample\Contracts\Mail;
use Go\Sample\Contracts\Notification;
use Go\Sample\ServicesContainer\Container;
use Go\Sample\Services\NotificationService;
use Go\Sample\Services\SlackService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Notification Service tests
 */
class NotificationServiceTest extends TestCase {
	/**
	 * @var Mail|MockObject
	 */
	private $mail;

	/**
	 * @var Container|MockObject
	 */
	private $container;

	protected function setup(): void {
		parent::setup();

		// create a mock of Mail interface
		$this->mail = $this->createMock(Mail::class);
		// create a mock of Container interface (binding class)
		$this->container = (new Container());
	}

	public function testNotificationService() {
		// Bind the NotificationService to the Notification interface
		$this->container->bind(Notification::class, NotificationService::class);
		$notificationService = $this->container->resolve(Notification::class, $this->mail);

		$this->assertInstanceOf(NotificationService::class, $notificationService);
	}

	public function testSetupCallMailSetup() {
		$notificationService = new NotificationService($this->mail);

		// Expect that the setup method of the Mail interface will be called once
		$this->mail->expects($this->once())->method('setup');

		$notificationService->setup();
	}

	public function testSendCallMailSend() {
		$notificationService = new NotificationService($this->mail);

		$payload = ["subject" => "Test", "message" => "UNIT TEST: NotificationServiceTest"];

		// Expect that the send method of the Mail interface will be called once
		$this->mail->expects($this->once())->method('send')->with($payload);
		$notificationService->send($payload);
	}

	public function testAddOnServices() {
		$notificationService = new NotificationService($this->mail);

		// Slack add-on
		$slackAddOn = new SlackService($notificationService);

		// Expect that send method of Mail interface will be called once when we're call send method on SlackAddOn
		$this->mail->expects($this->once())->method('send');

		$slackAddOn->send();
	}
}