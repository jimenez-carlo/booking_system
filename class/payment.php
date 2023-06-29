<?php
class Payment extends Base
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

    $required_fields = ['payment_title', 'payment_invoice', 'payment_amount'];

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

    // Insert Payment
    $sql = "INSERT INTO tbl_invoice_payment (invoice, title, amount, customer_id, company_id, remarks, created_by, reference) VALUES (':invoice', ':title', ':amount', :customer_id, :company_id,':remarks', :created_by)";
    $params = [
      ':invoice' => $payment_invoice,
      ':title' => $payment_title,
      ':amount' => $payment_amount,
      ':customer_id' => $customer,
      ':company_id' => $company,
      ':remarks' => $invoice_remarks,
      ':created_by' => $created_by,
      ':reference' => $reference_no,
    ];
    $sql = strtr($sql, $params);
    $this->query($sql);

    $result->status = true;
    $result->result = success_msg("Payment <b>#$reference_no</b> Successfully Created!");

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
