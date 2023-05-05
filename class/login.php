<?php
class Login
{
  private $conn;
  public function __construct($db)
  {
    $this->conn = $db;
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

  public function signup()
  {
  }
}
