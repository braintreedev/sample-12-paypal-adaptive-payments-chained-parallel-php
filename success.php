<?php
session_start();
require('includes/config.php');
require('includes/paypal/adaptive-payments.php');

$paypal = new PayPal($config);

$result = $paypal->call(
  array(
    'actionType'  => 'Pay',
    'payKey'  => $_SESSION['payKey'],
  ), "PaymentDetails"
);

if ($result['responseEnvelope']['ack'] == "Success" && $result['status'] == "COMPLETED") {
  echo 'Payment completed';
} else {
  echo 'Handle payment execution failure';
}
