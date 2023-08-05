<?php
class Tax extends Base
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

    $required_fields = array('tax_name', 'rate');

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


    $check_name = $this->get_one("select count(`name`) as `exists` from tbl_tax where `name` = '$tax_name' and is_deleted = 0 group by name limit 1");

    if (isset($check_name->exists) && !empty($check_name->exists)) {
      $errors[] = 'tax_name';
      $result->result = $this->response_error("Tax Already Exists!");
      return $result;
    }

    $created_by = $_SESSION['user']->id;
    $result->status = true;

    $this->query("insert into tbl_tax (name,rate,created_by) values ('$tax_name', '$rate',$created_by)");
    $result->result = success_msg("New Account Created!");

    return $result;
  }

  public function update()
  {
    extract($this->escape_data($_POST));

    $result = def_response();
    $blank = 0;
    $errors = array();
    $msg = '';

    $required_fields = array('tax_name', 'rate');

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

    $check_name = $this->get_one("select count(`name`) as `exists` from tbl_account where `name` = '$account_name' and id <> '$id' and is_deleted = 0 group by name limit 1");

    if (isset($check_name->exists) && !empty($check_name->exists)) {
      $errors[] = 'tax_name';
      $result->result = $this->response_error("Tax Already Exists!");
      return $result;
    }


    $this->query("update tbl_tax set name = '$tax_name',rate = '$rate'  where id = $id");
    $result->status = true;
    $result->reset = false;
    $result->result = success_msg("Tax Updated!");
    return $result;
  }

  public function delete()
  {
    extract($this->escape_data($_POST));
    $result = def_response();

    $this->query("update tbl_tax set is_deleted = 1  where id = $id");
    $result->status = true;
    $result->result = success_msg("Tax Deleted!");
    return $result;
  }
}
