<?php
require('../database/connection.php');
require_once('../class/base.php');
require_once('../class/account.php');
require_once('../class/tax.php');
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
$account_instance = new Account($conn);
$tax_instance = new Tax($conn);

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
    // Account
  case 'create_account':
    $result = $account_instance->create();
    break;
  case 'edit_account':
    $result = $account_instance->update();
    break;
  case 'delete_account':
    $result = $account_instance->delete();
    break;
    // Tax
  case 'create_tax':
    $result = $tax_instance->create();
    break;
  case 'edit_tax':
    $result = $tax_instance->update();
    break;
  case 'delete_tax':
    $result = $tax_instance->delete();
    break;
    // Customer
  case 'create_customer':
    $result = $customer_instance->create();
    break;
  case 'edit_customer':
    $result = $customer_instance->update();
    break;
  case 'delete_customer':
    $result = $customer_instance->delete();
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
