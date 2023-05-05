<?php
class Product
{
  private $conn;
  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function add_product()
  {
    $product_name = mysqli_real_escape_string($this->conn, $_POST['product_name']);
    $category = mysqli_real_escape_string($this->conn, $_POST['category']);
    $price = mysqli_real_escape_string($this->conn, $_POST['price']);
    $description = mysqli_real_escape_string($this->conn, $_POST['description']);
    $image_name = 'default.png';
    $created_by = $_SESSION['user']->id;

    $result = def_response();
    $blank = 0;
    $errors = array();
    $msg = '';

    if (empty($product_name)) {
      $errors[] = 'product_name';
      $blank++;
    }
    if (empty($price)) {
      $errors[] = 'price';
      $blank++;
    }
    if (empty($description)) {
      $errors[] = 'description';
      $blank++;
    }

    if (!empty($errors)) {
      $msg .= "Please Fill Blank Fields!";
      $result->result = error_msg($msg);
      $result->items = implode(',', $errors);
      return $result;
    }

    if ($_FILES['image']['error'] == 0) {
      $image_name = 'image_' . date('YmdHis') . '.jpeg';
      move_uploaded_file($_FILES["image"]["tmp_name"],   '../images/products/' . $image_name);
    }


    mysqli_query($this->conn, "INSERT INTO tbl_product (`name`,`category_id`,`description`,`image`, price,created_by) values ('$product_name', '$category','$description', '$image_name', '$price', '$created_by')");
    $last_id = mysqli_insert_id($this->conn);
    mysqli_query($this->conn, "INSERT INTO tbl_inventory (product_id,qty) VALUES ('$last_id', 0)");
    // mysqli_query($this->conn, "INSERT INTO tbl_inventory_history (product_id,original_qty,qty,created_by) VALUES ('$last_id', 0,0,$created_by)");

    $result->status = true;
    $result->result = success_msg("New Product Added!");

    return $result;
  }

  public function update_product()
  {
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    $result = def_response();

    switch ($type) {
      case 're_stock_list':
      case 're_stock':
        $product_id = mysqli_real_escape_string($this->conn, $_POST['product_id']);
        $qty = mysqli_real_escape_string($this->conn, $_POST['qty']);
        $created_by = $_SESSION['user']->id;

        $blank = 0;
        $errors = array();
        $msg = '';

        if (empty($qty)) {
          $errors[] = 'qty';
        }

        if (!empty($errors)) {
          $msg .= "Please Fill Blank Fields!";
          $result->result = error_msg($msg);
          $result->items = implode(',', $errors);
          return $result;
        }

        $original_qty = $this->get_one("select qty from tbl_inventory where product_id = '$product_id'")->qty;
        mysqli_query($this->conn, "UPDATE tbl_inventory set qty = (qty + '$qty') where id = '$product_id'");
        mysqli_query($this->conn, "INSERT into tbl_inventory_history (product_id,original_qty,qty,created_by) values ('$product_id', '$original_qty','$qty', '$created_by')");
        $result->status = true;
        $result->result = success_msg("Product Re-Stocked!");
        break;
      case 'delete':
        $product_id = mysqli_real_escape_string($this->conn, $_POST['product_id']);
        mysqli_query($this->conn, "UPDATE tbl_product set is_deleted = 1 where id = '$product_id'");
        $result->status = true;
        $result->result = success_msg("Product Deleted!");
        break;
      case 'update':
        $product_id = mysqli_real_escape_string($this->conn, $_POST['product_id']);
        $product_name = mysqli_real_escape_string($this->conn, $_POST['product_name']);
        $category = mysqli_real_escape_string($this->conn, $_POST['category']);
        $price = mysqli_real_escape_string($this->conn, $_POST['price']);
        $description = mysqli_real_escape_string($this->conn, $_POST['description']);
        $image_name = $this->get_one("select image from tbl_product where id = '$product_id' limit 1")->image;

        $blank = 0;
        $errors = array();
        $msg = '';

        if (empty($product_name)) {
          $errors[] = 'product_name';
          $blank++;
        }
        if (empty($price)) {
          $errors[] = 'price';
          $blank++;
        }
        if (empty($description)) {
          $errors[] = 'description';
          $blank++;
        }

        if (!empty($errors)) {
          $msg .= "Please Fill Blank Fields!";
          $result->result = error_msg($msg);
          $result->items = implode(',', $errors);
          return $result;
        }

        if ($_FILES['image']['error'] == 0) {
          $image_name = 'image_' . date('YmdHis') . '.jpeg';
          move_uploaded_file($_FILES["image"]["tmp_name"],   '../images/products/' . $image_name);
        }

        mysqli_query($this->conn, "UPDATE tbl_product set `name` = '$product_name', `category_id`='$category',`description` = '$description', `image` = '$image_name', price = '$price' where id = '$product_id'");

        $result->status = true;
        $result->result = success_msg("Product Updated!");
        break;
    }
    return $result;
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

  public function get_one($sql)
  {
    if ($result = mysqli_query($this->conn, $sql)) {
      $obj = mysqli_fetch_object($result);
      return $obj;
    }
    return false;
  }
}
