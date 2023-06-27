<?php
require('../database/connection.php');
require_once('../class/base.php');
require_once('../class/user.php');
require_once('../class/customer.php');
require_once('../class/form.php');
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
$form_instance = new Form($conn);

// Forms
foreach ($base_instance->get_form() as $res) {
  switch ($form) {
    case 'create_' . $res['alias']:
      $result = $form_instance->create();
      break;
    case 'update_' . $res['alias']:
      $result = $form_instance->update();
      break;
  }
}

switch ($form) {
    // Customer
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
