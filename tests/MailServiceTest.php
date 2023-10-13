<?php

use Go\Sample\Contracts\Mail;
use Go\Sample\Contracts\Notification;
use Go\Sample\ServicesContainer\Container;
use Go\Sample\Services\GmailService;
use Go\Sample\Services\MailchimpService;
use Go\Sample\Services\NotificationService;
use PHPUnit\Framework\TestCase;

/**
 * Mail Service Tests
 */
class MailServiceTest extends TestCase {
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

		$this->mail = $this->createMock(Mail::class);
		$this->container = (new Container());
	}

	public function testInitServiceThatImplementMailService() {
		// Gmail
		$this->container->bind(Mail::class, GmailService::class);
		$gmailService = $this->container->resolve(Mail::class);

		$this->assertInstanceOf(GmailService::class, $gmailService);

		// Mailchimp
		$this->container->bind(Mail::class, MailchimpService::class);
		$mailchimpService = $this->container->resolve(Mail::class);

		$this->assertInstanceOf(MailchimpService::class, $mailchimpService);
	}

	public function testMailServiceMustBeContainsRequiredMethods() {
		// Mail Service
		$mailServiceMethods = get_class_methods($this->createMock(Mail::class));

		$this->assertContains('setup', $mailServiceMethods);
		$this->assertContains('send', $mailServiceMethods);
	}

	public function testGmailMustBeSend() {
		$this->container->bind(Mail::class, GmailService::class);
		$this->container->bind(Notification::class, NotificationService::class);

		$this->mail->expects($this->once())->method('setup');
		$this->mail->expects($this->once())->method('send')->with($this->equalTo(["subject" => "Notification Gmail Test"]));

		$payload = ["subject" => "Notification Gmail Test"];
		$notificationService = $this->container->resolve(Notification::class, $this->mail);
		$notificationService->send($payload);
	}

	public function testMailchimpMustBeSend() {
		$this->container->bind(Mail::class, MailchimpService::class);
		$this->container->bind(Notification::class, NotificationService::class);

		$this->mail->expects($this->once())->method('setup');
		$this->mail->expects($this->once())->method('send')->with($this->equalTo(["subject" => "Notification Gmail Test"]));

		$payload = ["subject" => "Notification Gmail Test"];
		$notificationService = $this->container->resolve(Notification::class, $this->mail);
		$notificationService->send($payload);
	}
}