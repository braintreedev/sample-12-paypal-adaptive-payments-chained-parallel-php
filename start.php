<?php
require('includes/config.php');
require('includes/paypal-ap.php');

$paypal = new PayPal($config);

$result = $paypal->call(
  array(
      'actionType'  => 'PAY',
      'currencyCode'  => 'USD',
      'feesPayer'  => 'EACHRECEIVER',
      'memo'  => 'Example',
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
    'requestEnvelope' => array(
      'errorLanguage' => 'en_US',
    ),
  ), "Pay");

if ($result['responseEnvelope']['ack'] == 'Success') {
  $paypal->redirect($result);
} else {
  echo 'Handle the payment creation failure <br>';
}
