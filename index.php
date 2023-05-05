<?php
require('database/connection.php');
require('class/main.php');
require('class/modal.php');

if (!isset($_SESSION['base_url'])) {
  $_SESSION['base_url'] = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

if (isset($_SESSION['is_logged_in'])) {
  // Customer
  if ($_SESSION['user']->access_id == 1) {
    $request = new main($conn);
    $cart = $request->get_one("select count(*) as items from tbl_transactions where status_id = 1 and is_deleted = 0 and buyer_id = " . $_SESSION['user']->id);
    include('layout/admin-page/header.php');
    include('layout/admin-page/body.php');
    include('layout/admin-page/footer.php');
  } else {
    include('layout/user-page/header.php');
    include('layout/user-page/body.php');
    include('layout/user-page/footer.php');
  }
} else {
  include('layout/landing-page/header.php');
  include('layout/landing-page/body.php');
  include('layout/landing-page/footer.php');
}
