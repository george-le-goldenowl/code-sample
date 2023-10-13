<?php

require_once __DIR__ . '/vendor/autoload.php';

// Interfaces
use Go\Sample\Contracts\NotificationAddOn;
use Go\Sample\ServicesContainer\Container;

// Services
use Go\Sample\Services\GmailService;
use Go\Sample\Services\SlackService;
use \Go\Sample\Services\NotificationService;

//     / /                                         //   / /
//    / /         ___      ___      ___   /       //____      __
//   / /        //   ) ) //   ) ) //   ) /       / ____    //   ) ) ||  / /
//  / /        //   / / //   / / //   / /       //        //   / /  || / /
// / /____/ / ((___/ / ((___( ( ((___/ /       //____/ / //   / /   ||/ /

if (!file_exists('.env')) {
	die("Lack of environment. <br/>Please run: <code>make env</code> to create one");
}

(Dotenv\Dotenv::createImmutable(__DIR__))->load();

//     //   ) )                                                              //   ) )
//    ((         ___      __             ( )  ___      ___      ___         //___/ /  ( )   __      ___   / ( )   __      ___
//      \\     //___) ) //  ) ) ||  / / / / //   ) ) //___) ) ((   ) )     / __  (   / / //   ) ) //   ) / / / //   ) ) //   ) )
//        ) ) //       //       || / / / / //       //         \ \        //    ) ) / / //   / / //   / / / / //   / / ((___/ /
// ((___ / / ((____   //        ||/ / / / ((____   ((____   //   ) )     //____/ / / / //   / / ((___/ / / / //   / /   //__

$container = (new Container());

// Gmail
$container->bind(Mail::class, GmailService::class);
// Mailchimp
// $container->bind(Mail::class, MailchimpService::class);
// Mail Service
$mailService = $container->resolve(Mail::class);

// Notification service: assuming system has Mail service as default
$container->bind(Notification::class, NotificationService::class);
$notificationService = $container->resolve(Notification::class, $mailService);

// Add-on service: Slack
$container->bind(NotificationAddOn::class, SlackService::class);
$slackAddOn = $container->resolve(NotificationAddOn::class, $notificationService);

// $notificationService->send([
// 	'name' => "George",
// ]);

$slackAddOn->send([
	'name' => "george",
]);