<?php
require('../database/connection.php');
require_once('../class/base.php');
require_once('common.php');
$base = new Base($conn);
$selected = (isset($_GET['selected'])) ? $_GET['selected'] : 0;
$group = null;
foreach ($base->get_list("SELECT x.id,x.account_name,z.name as parent_name FROM tbl_account x inner join tbl_account_type y on y.id = x.account_type_id left join tbl_account_type_category z on z.id = y.account_type_category_id where x.account_type_id = '" . $_GET['id'] . "' order by y.account_type_category_id,y.order_index asc") as $res) { ?>
  <?php if (empty($group)) {
    $group = $res['parent_name'];
    echo '<optgroup label="' . $res['parent_name'] . '">';
  } ?>
  <?= ($group != $res['parent_name']) ? '<optgroup label="' . $res['parent_name'] . '">' : "" ?>
  <option value="<?= $res['id'] ?>" <?= $selected == $res['id'] ? 'selected' : '' ?>><?= $res['account_name'] ?></option>
  <?php $group = $res['parent_name']; ?>
  <?= ($group != $res['parent_name']) ? "</optgroup>" : "" ?>

<?php
}
?>