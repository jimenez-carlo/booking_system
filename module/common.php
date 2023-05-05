<?php
if (!function_exists('clean_data')) {
  function clean_data($value)
  {
    $value = trim($value);
    $value = stripslashes($value);
    // $value = htmlspecialchars($value);
    return $value;
  }
}

if (!function_exists('get_contents')) {
  function get_contents($url, $data = array())
  {
    extract($data);
    ob_start();
    include($url);
    return ob_get_clean();
  }
}

if (!function_exists('get_access')) {
  function get_access($access = null)
  {
    switch ($access) {
      case 1: //admin
        return array(
          'dashboard',
          'admin_customer_list',
          'admin_customer_create',
          'admin_customer_edit'
        );


      default:
        return array('');
    }
  }
}

if (!function_exists('page_url')) {
  function page_url($page)
  {
    switch ($page) {
      case 'dashboard':
        return '../layout/admin-page/content/dashboard.php';
      case 'admin_customer_list':
        return '../layout/admin-page/content/customer/list.php';
      case 'admin_customer_create':
        return '../layout/admin-page/content/customer/create.php';
      case 'admin_customer_edit':
        return '../layout/admin-page/content/customer/edit.php';


      case 'denied':
        return '../layout/admin-page/content/access_denied.php';
      default:
        return '../layout/admin-page/content/not_found.php';
    }
  }
}

if (!function_exists('error_msg')) {
  function error_msg($message = "Oops Something Went Wrong!", $title = "Error! ")
  {

    $result = '
<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<i class="fa fa-exclamation-triangle"></i>
                                                <strong>' . $title . '</strong>
        ' . $message . '
                                    </div>

';
    return $result;
  }
}

if (!function_exists('success_msg')) {
  function success_msg($message = "Action Successfull!", $title = "Successfull! ")
  {
    $result = '
<div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <i class="fa fa-check"> </i>
        <strong>' . $title . '</strong>
        ' . $message . '
                                    </div>
';

    return $result;
  }
}


if (!function_exists('def_response')) {
  function def_response()
  {
    $result = new stdClass();
    $result->status = false;
    $result->result = error_msg();
    $result->items = '';
    return $result;
  }
}
