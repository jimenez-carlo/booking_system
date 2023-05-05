<?php
require('../database/connection.php');
require_once('../class/base.php');
require_once('../class/user.php');
require_once('../class/customer.php');
require_once('common.php');

$result = def_response();

if (!$_POST || !isset($_POST['form'])) {
  echo json_encode($result);
  die;
}

$form = $_POST['form'];
$user = new User($conn);
$customer = new Customer($conn);

switch ($form) {
    // Customer
  case 'create_customer':
    $result = $customer->create();
    break;
  case 'update_cart_count':
    $result = $shop->get_cart_count();
    break;
  case 'remove_from_cart':
    $result = $shop->remove_from_cart();
    break;

  default:
    # code...
    break;
}
echo json_encode($result);
die;
