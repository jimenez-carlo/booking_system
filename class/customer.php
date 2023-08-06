<?php
class Customer extends Base
{
  private $conn;
  public function __construct($db)
  {
    parent::__construct($db);
    $this->conn = $db;
  }

  public function create()
  {
    extract($this->escape_data($_POST));

    $result = def_response();
    $blank = 0;
    $errors = array();
    $msg = '';

    $required_fields = array('first_name', 'last_name', 'birth_date', 'gender', 'province', 'city', 'barangay', 'contact_no', 'email', 'company');

    foreach ($required_fields as $res) {
      if (empty(${$res})) {
        $errors[] = $res;
        $blank++;
      }
    }

    if (!empty($errors)) {
      $msg .= "Please Fill Blank Fields!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }

    $created_by = $_SESSION['user']->id;
    $id = $this->insert_get_id("insert into tbl_customers (email,created_by,company_id,customer_type_id) values ('$email', '$created_by','$company','$customer_type_id')");
    $this->query("insert into tbl_customers_info (id,first_name,middle_name,last_name,contact_no,gender_id, province,city,barangay, birth_date) 
          values('$id','$first_name','$middle_name','$last_name','$contact_no','$gender', '$province','$city','$barangay','$birth_date')");
    $result->status = true;
    $result->result = success_msg("New Customer Created!");

    return $result;
  }

  public function update()
  {
    extract($this->escape_data($_POST));

    $result = def_response();
    $blank = 0;
    $errors = array();
    $msg = '';

    $required_fields = array('first_name', 'last_name', 'birth_date', 'gender', 'province', 'city', 'barangay', 'contact_no', 'email', 'company');

    foreach ($required_fields as $res) {
      if (empty(${$res})) {
        $errors[] = $res;
        $blank++;
      }
    }

    if (!empty($errors)) {
      $msg .= "Please Fill Blank Fields!";
      $result->result = $this->response_error($msg);
      $result->items = implode(',', $errors);
      return $result;
    }

    $this->query("update tbl_customers set email = '$email', company_id = '$company',customer_type_id = '$customer_type_id'  where id = $id");
    $this->query("update tbl_customers_info set first_name = '$first_name', middle_name =  '$middle_name', last_name = '$last_name', birth_date = '$birth_date', gender_id = '$gender', province = '$province',city='$city',barangay = '$barangay', contact_no = '$contact_no'  where id = $id");
    $result->status = true;
    $result->reset = false;
    $result->result = success_msg("Updated Customer ID#$id!");

    return $result;
  }

  public function update_category()
  {
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    $result = def_response();

    switch ($type) {
      case 'delete':
        $category_id = mysqli_real_escape_string($this->conn, $_POST['category_id']);
        mysqli_query($this->conn, "UPDATE tbl_category set is_deleted = 1 where id = '$category_id'");
        $result->status = true;
        $result->result = success_msg("Category Deleted!");
        break;
      case 'update':
        $category_id = mysqli_real_escape_string($this->conn, $_POST['category_id']);
        $category_name = mysqli_real_escape_string($this->conn, $_POST['category_name']);

        $blank = 0;
        $errors = array();
        $msg = '';

        if (empty($category_name)) {
          $errors[] = 'category_name';
          $blank++;
        }

        if (!empty($errors)) {
          $msg .= "Please Fill Blank Fields!";
          $result->result = error_msg($msg);
          $result->items = implode(',', $errors);
          return $result;
        }

        mysqli_query($this->conn, "UPDATE tbl_category set `name` = '$category_name' where id = '$category_id'");

        $result->status = true;
        $result->result = success_msg("Category Updated!");
        break;
    }
    return $result;
  }

  public function delete()
  {
    extract($this->escape_data($_POST));
    $result = def_response();

    $this->query("update tbl_customers set is_deleted = 1  where id = $id");
    $result->status = true;
    $result->result = success_msg("Customer Deleted!");
    return $result;
  }
}
