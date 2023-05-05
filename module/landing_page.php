<?php
require_once('../database/connection.php');
require_once('common.php');
if (!$_POST || !isset($_POST['form'])) {
  http_response_code(500);
}

if ($_POST['form'] == 'login') {
  $user = mysqli_real_escape_string($conn, clean_data($_POST['login_username']));
  $password = mysqli_real_escape_string($conn, clean_data($_POST['login_password']));
  $sql = "SELECT a.name as access_name,ui.*,u.*,count(*) as user_count FROM tbl_users u inner join tbl_users_info ui on ui.id = u.id  inner join tbl_access a on a.id = u.access_id WHERE (u.username = '$user' OR u.email = '$user')";
  if ($result = mysqli_query($conn, $sql)) {
    while ($obj = mysqli_fetch_object($result)) {
      if (!empty($obj->user_count)) {
        $password_validate = password_verify($password, $obj->password);
        if ($password_validate == true) {
          $_SESSION['user'] = $obj;
          $_SESSION['is_logged_in'] = true;
          echo true;
          die;
        } else {
          // Incorrect Username/password
          echo "Error Invalid Username/Password.";
          die;
        }
      } else {
        // No result 
        echo "Error Invalid Username/Password.";
        die;
      }
    }
    mysqli_free_result($result);
  }
} else if ($_POST['form'] == 'signup') {
  $obj = new stdClass();
  $obj->username = mysqli_real_escape_string($conn, clean_data($_POST['username']));
  $obj->password = mysqli_real_escape_string($conn, clean_data($_POST['password']));
  $obj->password_retype = mysqli_real_escape_string($conn, clean_data($_POST['password_retype']));
  $obj->first_name = mysqli_real_escape_string($conn, clean_data($_POST['firstname']));
  $obj->last_name = mysqli_real_escape_string($conn, clean_data($_POST['lastname']));
  $obj->address = mysqli_real_escape_string($conn, clean_data($_POST['address']));
  $obj->contact_no = mysqli_real_escape_string($conn, clean_data($_POST['contact']));
  $obj->gender = mysqli_real_escape_string($conn, clean_data($_POST['gender']));

  if ($obj->password != $obj->password_retype) {
    echo "Error Password Does Not Match.";
    die;
  }

  if (!filter_var($obj->email, FILTER_VALIDATE_EMAIL)) {
    echo "Error Invalid Email.";
    die;
  }
  $sql = "SELECT count(*) as user_count FROM tbl_users u WHERE u.email = '$obj->email'";
  if ($result = mysqli_query($conn, $sql)) {
    if (!empty(mysqli_fetch_assoc($result)['user_count'])) {
      echo "Error Email Already In-use.";
      die;
    }
    mysqli_free_result($result);
  }

  if (!filter_var(intval($obj->contact_no), FILTER_VALIDATE_INT)) {
    echo "Error Invalid Contact No.";
    die;
  }
  $password = password_hash($obj->password, PASSWORD_DEFAULT);
  $sql = "INSERT INTO tbl_users (username, password) VALUES ('$obj->username', '$password')";
  if (mysqli_query($conn, $sql)) {
    $user_id = intval(mysqli_insert_id($conn));
    $sql = "INSERT INTO tbl_users_info (id, first_name, last_name, address, contact_no, gender_id) VALUES ($user_id, '$obj->first_name', '$obj->last_name', '$obj->address', $obj->contact_no, $obj->gender)";
    if (mysqli_query($conn, $sql)) {
      // $_SESSION['user'] = $obj;
      // $_SESSION['is_logged_in'] = true;
      echo true;
      die;
    } else {
      http_response_code(404);
      echo "Server Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    http_response_code(404);
    echo "Server Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  mysqli_close($conn);
} else {
  http_response_code(500);
}
