<?php
require('includes/config.php');
require('includes/paypal-ap.php');

if (dirname($_SERVER['PHP_SELF']) == "/"){
  $folder = "";
} else {
  $folder = dirname($_SERVER['PHP_SELF']);
}

$paypal = new PayPal($config);

$result = $paypal->call(array(
  'actionType'  => 'PAY',
  'clientDetails.applicationId'  => 'APP-80W284485P519543T',
  'clientDetails.ipAddress'  => '127.0.0.1',
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
    'primary'  => 'false',
    )
  ),
),
'requestEnvelope' => array(
  'errorLanguage' => 'en_US',
),
  'returnUrl'  => 'http://'.$_SERVER['HTTP_HOST'].$folder.'/success.php?payKey=${payKey}',
  'cancelUrl'  => 'http://'.$_SERVER['HTTP_HOST'].$folder.'/cancel.php',
), "Pay");

if ($result['responseEnvelope']['ack'] == 'Success') {
  $paypal->redirect($result);
} else {
  echo 'Handle the payment creation failure <br>';
}