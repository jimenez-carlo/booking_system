<?php
require('../database/connection.php');
require_once('../class/base.php');
require_once('../class/user.php');
require_once('../class/customer.php');
require_once('../class/invoice.php');
require_once('../class/payment.php');
require_once('../class/disbursement.php');
require_once('common.php');

$result = def_response();

if (!$_POST || !isset($_POST['form'])) {
  echo json_encode($result);
  die;
}

$form = $_POST['form'];
$base_instance = new Base($conn);
$user_instance = new User($conn);
$customer_instance = new Customer($conn);
$invoice = new Invoice($conn);
$payment = new Payment($conn);
$disbursement = new Disbursement($conn);

// Forms


switch ($form) {
  case 'create_invoice':
    $result = $invoice->create();
    break;
  case 'create_payment':
    $result = $payment->create();
    break;
  case 'create_disbursement':
    $result = $disbursement->create();
    break;
    // Customer
  case 'create_customer':
  case 'create_customer':
    $result = $customer_instance->create();
    break;
  case 'edit_customer':
    $result = $customer_instance->update();
    break;
  case 'update_cart_count':
    $result = $shop->get_cart_count();
    break;
  case 'remove_from_cart':
    $result = $shop->remove_from_cart();
    break;
}
echo json_encode($result);
die;
