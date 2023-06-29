<?php
class Invoice extends Base
{
  private $conn;
  public function __construct($db)
  {
    parent::__construct($db);
    $this->conn = $db;
  }

  public function insert_transaction($data)
  {
    $sql = "INSERT INTO tbl_invoice_transaction 
          ( company_id, customer_id, date_target, title, amount, reference_type, invoice,reference_no, created_by) VALUES 
          (:company_id, :customer_id, ':date_target', ':title', ':amount', ':reference_type', ':invoice',':reference_no' :created_by)";
    $sql = strtr($sql, $data);
    $this->query($sql);
  }

  public function insert_tax($data)
  {
    $sql = "INSERT INTO tbl_invoice_tax 
          ( invoice, title, amount, created_by) VALUES 
          (':invoice', ':title', ':amount', :created_by)";
    $sql = strtr($sql, $data);
    $this->query($sql);
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


    $created_by = $_SESSION['user']->id;

    // Insert Invoice
    $sql = "INSERT INTO tbl_invoice (invoice, remarks, due_date, created_by) VALUES (:invoice, ':remarks',':due_date',':created_by')";
    $params = [
      ':invoice' => $reference_no,
      ':remarks' => $invoice_remarks,
      ':due_date' => $invoice_due_date,
      ':created_by' => $created_by
    ];
    $sql = strtr($sql, $params);
    $this->query($sql);

    // Insert Profit
    if (!empty($profit_name)) {
      foreach ($profit_name as $key => $title) {
        $data = [
          ':company_id' => $company,
          ':customer_id' => $customer,
          ':date_target' => $profit_date[$key],
          ':title' => $title,
          ':amount' => floatval($profit_val[$key]),
          ':invoice' => $reference_no,
          ':reference_type' => 'profit',
          ':reference_no' => $profit_reference[$key],
          ':created_by' =>  $created_by
        ];
        $this->insert_transaction($data);
      }
    }
    // Insert Expense
    if (!empty($expense_name)) {
      foreach ($expense_name as $key => $title) {
        $data = [
          ':company_id' => $company,
          ':customer_id' => $customer,
          ':date_target' => $expense_date[$key],
          ':title' => $title,
          ':amount' => floatval($expense_val[$key]),
          ':invoice' => $reference_no,
          ':reference_type' => 'expense',
          ':reference_no' => $expense_reference[$key],
          ':created_by' =>  $created_by
        ];
        $this->insert_transaction($data);
      }
    }

    // Insert Tax
    if (!empty($tax_name)) {
      foreach ($tax_name as $key => $title) {
        $data = [
          ':company_id' => $company,
          ':customer_id' => $customer,
          ':title' => $title,
          ':amount' => floatval($tax_val[$key]),
          ':invoice' => $reference_no,
          ':created_by' =>  $created_by
        ];
        $this->insert_tax($data);
      }
    }


    $result->status = true;
    $result->result = success_msg("Invoice <b>#$reference_no</b> Successfully Created!");

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
}
