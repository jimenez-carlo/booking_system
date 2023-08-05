<?php
class Account extends Base
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

    $required_fields = array('account_name', 'account_code', 'account_no');

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


    $check_name = $this->get_one("select count(`account_name`) as `exists` from tbl_account where `account_name` = '$account_name' and is_deleted = 0 group by account_name limit 1");

    if (isset($check_name->exists) && !empty($check_name->exists)) {
      $errors[] = 'account_name';
      $result->result = $this->response_error("Account Name Already Exists!");
      return $result;
    }

    $created_by = $_SESSION['user']->id;
    $result->status = true;

    if (isset($is_sub_account)) {
      $this->query("insert into tbl_account (parent_account_id,account_type_id,account_name,account_code,account_no,currency_id,description, is_sub_account,created_by,is_deletable) values ('$parent_account_type', '$account_type','$account_name', '$account_code','$account_no','$currency','$description',1,$created_by,1)");
      $result->result = success_msg("New Account Created!");
      return $result;
    }

    $this->query("insert into tbl_account (account_type_id,account_name,account_code,account_no,currency_id,description, is_sub_account,created_by,is_deletable) values ( '$account_type','$account_name', '$account_code','$account_no','$currency','$description',0,$created_by,1)");

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

    $required_fields = array('account_name', 'account_code', 'account_no');

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

    $check_name = $this->get_one("select count(`account_name`) as `exists` from tbl_account where `account_name` = '$account_name' and id <> '$id' and is_deleted = 0 group by account_name limit 1");

    if (isset($check_name->exists) && !empty($check_name->exists)) {
      $errors[] = 'account_name';
      $result->result = $this->response_error("Account Name Already Exists!");
      return $result;
    }

    $parent_account_id = !isset($parent_account_type) ? 0 : $parent_account_type;
    $sub_account = !isset($is_sub_account) ? 0 : 1;


    $this->query("update tbl_account set parent_account_id = '$parent_account_id',account_type_id = '$account_type',account_name = '$account_name',account_code = '$account_code',account_no = '$account_no',currency_id = '$',description = '$description', is_sub_account = $sub_account where id = $id");
    $result->status = true;
    $result->reset = false;
    $result->result = success_msg("Account Updated!");
    return $result;
  }
}
