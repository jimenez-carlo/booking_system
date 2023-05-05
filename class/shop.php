<?php
class Shop
{
  private $conn;
  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function add_to_cart()
  {
    $qty = mysqli_real_escape_string($this->conn, intval($_POST['qty']));
    $price = mysqli_real_escape_string($this->conn, intval($_POST['price']));
    $product_id = mysqli_real_escape_string($this->conn, $_POST['product_id']);

    $result = def_response();

    $customer_id = $_SESSION['user']->id;
    $stocks = $this->get_one("select qty from tbl_inventory where id='$product_id' limit 1");
    if (!empty($stocks) && isset($stocks->qty)) {
      if ($qty > $stocks->qty) {
        $result->result = error_msg("Not Enough Stocks.");
      } else {
        $draft = $this->get_one("select id,qty from tbl_transactions where product_id='$product_id' and buyer_id = '$customer_id' and status_id = 1 and is_deleted = 0 limit 1");

        if (isset($draft->qty) && isset($draft->id) && !empty($draft->qty) && !empty($draft->id)) {
          $total_qty = intval($draft->qty) + $qty;
          $total_price = $total_qty * $price;
          $id = $draft->id;
          $date = date('Y-m-d H:i:s');
          $sql = "update tbl_transactions set qty = '$total_qty', price = '$total_price', date_updated = '$date' where id = '$id'";
          mysqli_query($this->conn, $sql);
        } else {
          $total_price = $qty * intval($price);
          mysqli_query($this->conn, "insert into tbl_transactions (price,qty,product_id,buyer_id,status_id) VALUES ('$total_price', '$qty', '$product_id', '$customer_id', 1) ");
          $last_id = mysqli_insert_id($this->conn);
          mysqli_query($this->conn, "insert into tbl_status_history (transaction_id,status_id,created_by) VALUES ('$last_id', 1, '$customer_id') ");
        }
        $result->status = true;
        $result->result = success_msg("Product Added To Cart Successfully!");
      }
    } else {
      $result->result = error_msg("Product Out Of Stock.");
    }
    return $result;
  }

  public function get_cart_count()
  {
    $customer_id = $_SESSION['user']->id;
    $result = def_response();
    $sql = "select count(product_id) as count from tbl_transactions where status_id = 1 and is_deleted = 0 and buyer_id = '$customer_id' group by buyer_id";
    $count = $this->get_one($sql);

    $result->status = true;
    $result->result = (isset($count->count)) ? $count->count : 0;
    return $result;
  }

  public function update_cart()
  {
    $qty = mysqli_real_escape_string($this->conn, intval($_POST['qty']));
    $price = mysqli_real_escape_string($this->conn, intval($_POST['price']));
    $id = mysqli_real_escape_string($this->conn, $_POST['transaction_id']);

    $result = def_response();
    $new_price = intval($price) * intval($qty);
    if ($qty > 0) {
      $sql = "update tbl_transactions set price = '$new_price', qty = '$qty' where id = $id";
      mysqli_query($this->conn, $sql);
      $result->status = true;
      $result->result = success_msg("Product Quantity Updated From Cart!");
    } else {
      $result->result = error_msg("Invalid Product Quantity");
    }
    return $result;
  }

  public function remove_from_cart()
  {
    $id = mysqli_real_escape_string($this->conn, intval($_POST['transaction_id']));
    $result = def_response();
    $sql = "update tbl_transactions set is_deleted = 1  where id = $id";
    mysqli_query($this->conn, $sql);
    $result->status = true;
    $result->result = success_msg("Product Removed From Cart!");
    return $result;
  }

  public function get_transaction_count($where_id, $status_id)
  {
    $res = $this->get_one("select count(*) as result from tbl_transactions where invoice_id = $where_id and status_id = $status_id group by invoice_id limit 1");
    return isset($res->result) ? $res->result : 0;
  }


  public function has_stocks($id)
  {
    $transaction = $this->get_one("select product_id,qty from tbl_transactions where id = $id limit 1");
    $stock = $this->get_one("select qty from tbl_inventory where product_id = $transaction->product_id")->qty;
    return ($transaction->qty > $stock) ? false : $stock;
  }

  public function update_order($id, $status)
  {
    $id = mysqli_real_escape_string($this->conn, intval($id));
    $status = mysqli_real_escape_string($this->conn, intval($status));

    $invoice_id = $this->get_one("select id from tbl_invoice where invoice = $id")->id;
    $list = $this->get_list("select * from tbl_transactions where invoice_id = $invoice_id");

    foreach ($list as $res) {
      $this->update_transaction($res['id'], $status);
    }

    $result = def_response();

    $result->status = true;
    $result->result = success_msg("Order Updated!");
    return $result;
  }


  public function pay($id, $amount, $change, $total)
  {

    $result = def_response();
    if ($total > $amount) {

      $result->status = false;
      $result->result = error_msg($amount . "Paid Amount Not Enough!" . $total);
      return $result;
    }
    $sql = "update tbl_invoice set paid_status_id = 2,amount= '$amount',`change`='$change'  where invoice = '$id'";
    mysqli_query($this->conn, $sql);

    $result->status = true;
    $result->result = success_msg("Order Updated!");
    return $result;
  }

  public function update_transaction($id, $status)
  {
    $user_id = $_SESSION['user']->id;
    $id = mysqli_real_escape_string($this->conn, intval($id));
    $status = mysqli_real_escape_string($this->conn, intval($status));
    $result = def_response();
    $date = date("Y-m-d h:i:s");
    $seller = '';

    $stock = $this->has_stocks($id);
    if ($status == 3 && !$stock) {
      $result->status = false;
      $result->result = error_msg("Insuficient Stock!");
      return $result;
    }

    if (in_array($status, array(3, 6))) {
      $seller = ", seller_id = $user_id";
    }
    $invoice = $this->get_one("select invoice_id,status_id,product_id,qty,buyer_id from tbl_transactions where id = $id limit 1");
    mysqli_query($this->conn, "update tbl_transactions set status_id = '$status',date_updated = '$date' $seller  where id = $id");
    mysqli_query($this->conn, "insert into tbl_status_history (transaction_id,status_id,created_by) values('$id', '$status', '$user_id')");

    if (in_array($status, array(3, 5, 6))) {
      $tmp = $this->get_one("select count(*) as result from tbl_transactions where invoice_id = $invoice->invoice_id group by invoice_id limit 1");
      $items = isset($tmp->result) ? $tmp->result : 0;
      $pending = $this->get_transaction_count($invoice->invoice_id, 2);
      $rejected = $this->get_transaction_count($invoice->invoice_id, 6);
      $cancelled = $this->get_transaction_count($invoice->invoice_id, 5);
      if ($status == 3) {
        mysqli_query($this->conn, "insert into tbl_inventory_history (product_id,original_qty,qty,created_by) values('$invoice->product_id', $stock, -$invoice->qty, '$invoice->buyer_id')");
        mysqli_query($this->conn, "update tbl_inventory set qty = (qty - $invoice->qty) where product_id = $invoice->product_id");
        // approved
        if ($pending == 0) {
          mysqli_query($this->conn, "insert into tbl_invoice_status_history (invoice_id,status_id,created_by) values('$invoice->product_id', 3, '$user_id')");
          mysqli_query($this->conn, "update tbl_invoice set status_id = 3 where id = $invoice->invoice_id");
        } else {
          mysqli_query($this->conn, "insert into tbl_invoice_status_history (invoice_id,status_id,created_by) values('$invoice->invoice_id', 3, '$user_id')");
          mysqli_query($this->conn, "update tbl_invoice set status_id = 3 where id = $invoice->invoice_id");
        }
      } else if ($status == 5) {
        // cancelled
        if ($cancelled == $items) {
          mysqli_query($this->conn, "insert into tbl_invoice_status_history (invoice_id,status_id,created_by) values('$invoice->invoice_id', 6, '$user_id')");
          mysqli_query($this->conn, "update tbl_invoice set status_id = 6 where id = $invoice->invoice_id");
        } else {
          if ($pending == 0) {
            mysqli_query($this->conn, "insert into tbl_invoice_status_history (invoice_id,status_id,created_by) values('$invoice->invoice_id', 3, '$user_id')");
            mysqli_query($this->conn, "update tbl_invoice set status_id = 3 where id = $invoice->invoice_id");
          } else if ($pending == 0) {
            if ($cancelled > $rejected) {
              mysqli_query($this->conn, "insert into tbl_invoice_status_history (invoice_id,status_id,created_by) values('$invoice->invoice_id', 6, '$user_id')");
              mysqli_query($this->conn, "update tbl_invoice set status_id = 6 where id = $invoice->invoice_id");
            } else {
              mysqli_query($this->conn, "insert into tbl_invoice_status_history (invoice_id,status_id,created_by) values('$invoice->invoice_id', 7, '$user_id')");
              mysqli_query($this->conn, "update tbl_invoice set status_id = 7 where id = $invoice->invoice_id");
            }
          }
        }
      } else if ($status == 6) {
        // rejected
        if ($rejected == $items) {
          mysqli_query($this->conn, "insert into tbl_invoice_status_history (transaction_id,status_id,created_by) values('$invoice->invoice_id', 7, '$user_id')");
          mysqli_query($this->conn, "update tbl_invoice set status_id = 7 where id = $invoice->invoice_id");
        } else {
          if ($pending == 0) {
            mysqli_query($this->conn, "insert into tbl_invoice_status_history (transaction_id,status_id,created_by) values('$invoice->invoice_id', 3, '$user_id')");
            mysqli_query($this->conn, "update tbl_invoice set status_id = 3 where id = $invoice->invoice_id");
          } else if ($pending == 0) {
            if ($cancelled > $rejected) {
              mysqli_query($this->conn, "insert into tbl_invoice_status_history (transaction_id,status_id,created_by) values('$invoice->invoice_id', 6, '$user_id')");
              mysqli_query($this->conn, "update tbl_invoice set status_id = 6 where id = $invoice->invoice_id");
            } else {
              mysqli_query($this->conn, "insert into tbl_invoice_status_history (transaction_id,status_id,created_by) values('$invoice->invoice_id', 7, '$user_id')");
              mysqli_query($this->conn, "update tbl_invoice set status_id = 7 where id = $invoice->invoice_id");
            }
          }
        }
      }
    }
    $result->status = true;
    $result->result = success_msg("Transaction Updated!");
    return $result;
  }

  public function check_out_cart()
  {
    $result = def_response();
    $customer_id = $_SESSION['user']->id;
    $cart_count = $this->get_one("select count(product_id) as count from tbl_transactions where status_id = 1 and is_deleted = 0 and buyer_id = '$customer_id' group by buyer_id");
    if (!isset($cart_count->count) || empty($cart_count->count)) {
      $result->result = error_msg("No Products To Checkout!.");
      return $result;
    } else {
      $items = $this->get_list("select t.id,t.product_id, t.qty, i.qty as stocks,p.name from tbl_transactions t inner join tbl_inventory i on i.product_id = t.product_id inner join tbl_product p on p.id = t.product_id where t.status_id = 1 and t.is_deleted = 0 and t.buyer_id = '$customer_id'");
      $err = "";
      foreach ($items as $res) {
        if ($res['qty'] > $res['stocks']) {
          $err .= " Product <b>`" . $res['name'] . "`</b> has only " . $res['stocks'] . " stocks.";
        }
      }

      if (!empty($err)) {
        $result->result = error_msg($err);
        return $result;
      }

      $invoice = time();
      mysqli_query($this->conn, "insert into tbl_invoice (invoice,customer_id,status_id) VALUES('$invoice','$customer_id',1)");
      $invoice_id = mysqli_insert_id($this->conn);

      foreach ($items as $res) {
        $id = $res['id'];
        mysqli_query($this->conn, "insert into tbl_status_history (transaction_id,status_id,created_by) VALUES('$id',2,'$customer_id')");
      }
      mysqli_query($this->conn, "update tbl_transactions set status_id = 2, invoice_id= '$invoice_id' where status_id = 1 and is_deleted = 0 and buyer_id = '$customer_id'");

      $result->status = true;
      $result->result = success_msg("Successfully Checked Out!");
      return $result;
    }
  }

  public function get_one($sql)
  {
    if ($result = mysqli_query($this->conn, $sql)) {
      $obj = mysqli_fetch_object($result);
      return $obj;
    }
    return false;
  }

  public function get_list($sql)
  {
    $data = array();
    $result = mysqli_query($this->conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    return $data;
  }
}
