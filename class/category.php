<?php
class Category
{
  private $conn;
  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function add_category()
  {
    $category_name = mysqli_real_escape_string($this->conn, $_POST['category_name']);
    $created_by = $_SESSION['user']->id;

    $result = def_response();
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

    if (!empty($category_name)) {
      $exists = $this->get_one("select count(*) as count from tbl_category where name = '$category_name'");
      if (isset($exists->count) && !empty($exists->count)) {
        $errors[] = 'category_name';
        $msg .= "Category Already Exists!";
        $result->result = error_msg($msg);
        $result->items = implode(',', $errors);
        return $result;
      }
    }


    mysqli_query($this->conn, "INSERT INTO tbl_category (`name`,created_by) values ('$category_name', '$created_by')");

    $result->status = true;
    $result->result = success_msg("New Category Added!");

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
