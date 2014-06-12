<?php

require('includes/config.php');
require('includes/paypal-ap.php');

if (!$_GET['payKey']) {
  echo 'payKey not available';
} else {

$paypal = new PayPal($config);

$result = $paypal->call(array(
  'actionType'  => 'Pay',
  'payKey'  => $_GET['payKey'],
  'requestEnvelope'  => array(
  'errorLanguage'  => 'en_US',
)
), "PaymentDetails");

if ($result['responseEnvelope']['ack'] == "Success" && $result['status'] == "COMPLETED") {
  echo 'Payment completed';
} else {
  echo 'Handle payment execution failure';
}

}