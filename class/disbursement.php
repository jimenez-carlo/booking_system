<?php
class Disbursement extends Base
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

    $required_fields = ['disbursement_title', 'disbursement_invoice', 'disbursement_amount', 'disbursement_ledger'];

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
    $sql = "INSERT INTO tbl_invoice (invoice, remarks, created_by) VALUES (:invoice, ':remarks',':created_by')";
    $params = [
      ':invoice' => $reference_no,
      ':remarks' => $disbursement_remarks,
      ':created_by' => $created_by
    ];
    $sql = strtr($sql, $params);
    $this->query($sql);

    // Insert Transaction
    $sql = "INSERT INTO tbl_invoice_transaction 
          ( company_id, customer_id, title, amount, reference_type, invoice, reference, created_by) VALUES 
          (:company_id, :customer_id,  ':title', ':amount', ':reference_type', ':invoice',':reference_no', :created_by)";

    $params = [
      ':company_id' => $company,
      ':customer_id' => $customer,
      ':title' => $disbursement_title,
      ':amount' => floatval($disbursement_amount),
      ':invoice' => $reference_no,
      ':reference_type' => 'disbursement',
      ':reference_no' => $disbursement_invoice,
      ':created_by' =>  $created_by
    ];
    $sql = strtr($sql, $params);
    $this->query($sql);

    $result->status = true;
    $result->result = success_msg("Disbursement <b>#$reference_no</b> Successfully Created!");

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
