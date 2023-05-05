<?php
require('../database/connection.php');
require_once('../class/base.php');
require_once('common.php');
$base = new Base($conn);
foreach ($base->get_list("select id,upper(name) as name from tbl_barangay where city_id = '" . $_GET['id'] . "' order by name asc") as $res) { ?>
  <option value="<?= $res['id'] ?>"> <?= $res['name'] ?></option>
<?php
}
?>