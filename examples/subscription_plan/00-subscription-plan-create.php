<?php

require_once __DIR__ . '/..' . '/..' . '/vendor/autoload.php';

use Ipag\Sdk\Core\IpagClient;
use Ipag\Sdk\Core\IpagEnvironment;
use Ipag\Sdk\Exception\HttpException;

$ipagClient = new IpagClient(
    'wayne1',
    'D3F8-E3D981DF-C2766F07-9AC79BD7-A729',
    IpagEnvironment::LOCAL,
);

$subscriptionPlan = new \Ipag\Sdk\Model\SubscriptionPlan(
    [
        'name' => 'PLANO GOLD',
        'description' => 'Plano Gold com até 4 treinos por semana',
        'amount' => 100,
        'frequency' => Ipag\Sdk\Core\Enums\Interval::MONTHLY,
        'interval' => 1,
        'cycles' => 0,
        'best_day' => true,
        'pro_rated_charge' => true,
        'grace_period' => 0,
        'callback_url' => 'https://ipag-sdk.requestcatcher.com/callback',
        'trial' => [
            'amount' => 0,
            'cycles' => 0
        ]
    ]
);

try {

    $responseSubscriptionPlan = $ipagClient->subscriptionPlan()->create($subscriptionPlan);
    $data = $responseSubscriptionPlan->getData();

    echo "<pre>" . PHP_EOL;
    print_r($data);
    echo "</pre>" . PHP_EOL;

} catch (HttpException $e) {
    $code = $e->getResponse()->getStatusCode();
    $errors = $e->getErrors();

    echo "<pre>" . PHP_EOL;
    var_dump($code, $errors);
    echo "</pre>" . PHP_EOL;

} catch (Exception $e) {
    $error = $e->getMessage();

    echo "<pre>" . PHP_EOL;
    var_dump($error);
    echo "</pre>" . PHP_EOL;

}