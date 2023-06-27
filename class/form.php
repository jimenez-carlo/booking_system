<?php
class Form extends Base
{
  private $conn;
  public function __construct($db)
  {
    parent::__construct($db);
    $this->conn = $db;
  }


  public function insert_profit_lost()
  {
    extract($this->escape_data($_POST));
    // Insert Profit
    if (!empty($profit_name)) {
      foreach ($profit_name as $key => $title) {
        $params = [
          ':company_id' => $company,
          ':customer_id' => $customer,
          ':date_target' => $profit_date[$key],
          ':title' => $title,
          ':amount' => floatval($profit_val[$key]),
          ':reference_batch' => $reference_no,
          ':reference_type' => 'profit',
          ':reference' => $profit_reference[$key],
          ':created_by' =>  $_SESSION['user']->id
        ];
        $sql = "INSERT into tbl_profit_expenses (company_id, customer_id, date_target, title, amount, reference_batch, reference_type, reference, created_by) VALUES (:company_id, :customer_id, ':date_target', ':title', :amount, ':reference_batch', ':reference_type', ':reference', :created_by)";
        $sql = strtr($sql, $params);
        $this->query($sql);
      }
    }
    // Insert Expense
    if (!empty($expense_name)) {
      foreach ($expense_name as $key => $title) {
        $params = [
          ':company_id' => $company,
          ':customer_id' => $customer,
          ':date_target' => $expense_date[$key],
          ':title' => $title,
          ':amount' => floatval($expense_val[$key]),
          ':reference_batch' => $reference_no,
          ':reference_type' => 'expense',
          ':reference' => $profit_reference[$key],
          ':created_by' =>  $_SESSION['user']->id
        ];
        $sql = "INSERT into tbl_profit_expenses (company_id, customer_id, date_target, title, amount, reference_batch, reference_type, reference, created_by) VALUES (:company_id, :customer_id, ':date_target', ':title', :amount, ':reference_batch', ':reference_type', ':reference', :created_by)";
        $sql = strtr($sql, $params);
        $this->query($sql);
      }
    }
  }

  public function create()
  {
    extract($this->escape_data($_POST));

    $result = def_response();
    $blank = 0;
    $errors = array();
    $msg = '';

    $required_fields = [];

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

    if ($company == 1 && $customer == 1) {
      $msg .= "Atleast 1 Company Or Customer Must Be Selected!";
      $result->result = $this->response_error($msg);
      $result->items = 'company,customer';
      return $result;
    }

    foreach ($this->get_form() as $res) {
      switch ($form) {
        case 'insert_' . $res['alias']:
          $this->{'insert_' . $res['alias']}();
          break;
      }
    }

    $this->insert_profit_lost();
    $result->status = true;
    $result->result = success_msg("Successfully Created ");

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

    $this->query("update tbl_customers set email = '$email', company = '$company'  where id = $id");
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
}
