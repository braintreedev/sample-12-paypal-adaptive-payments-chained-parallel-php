<?php
session_start();
require('includes/config.php');
require('includes/paypal/adaptive-payments.php');

$paypal = new PayPal($config);

$result = $paypal->call(
  array(
    'actionType'  => 'PAY',
    'currencyCode'  => 'USD',
    'feesPayer'  => 'EACHRECEIVER',
    'memo'  => 'Order number #123',
    'receiverList' => array(
    'receiver' => array(
        array(
          'amount'  => '21.00',
          'email'  => 'customer@commercefactory.org',
          'primary'  => 'true',
        ),
        array(
          'amount'  => '11.00',
          'email'  => 'tester@commercefactory.org',
        )
      ),
    ),
    'returnUrl' => 'success.php',
    'cancelUrl' => 'cancel.php',
  ), "Pay");

if ($result['responseEnvelope']['ack'] == 'Success') {
  $_SESSION['payKey'] = $result["payKey"];
  $paypal->redirect($result);
} else {
  echo 'Handle the payment creation failure';
}
