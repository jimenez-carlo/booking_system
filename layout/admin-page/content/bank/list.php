<?php
$type = [
  3 => 'fa-money',
  4 => 'fa-bank',
  9 => 'fa-credit-card'
];
?>
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-bank"></i> Banking</h1>
    <!-- <h5>
      <button class="btn btn-default" style="width: fit-content;display:inline-block">Cash in Hand <b>80.00</b></button>
      <button class="btn btn-default" style="width: fit-content;display:inline-block">Bank <b>80.00</b></button>
      <button class="btn btn-default" style="width: fit-content;display:inline-block">Credit Card <b>80.00</b></button>
    </h5> -->
  </div>

</div>
<div class="row">
  <div class="col-lg-12">
    <div class="result"></div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_bank_create"> Add Credit Card/Bank <i class="fa fa-plus"></i> </button>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>Account Name</th>
                <th style="width: 0.1%;white-space:nowrap">Account Code</th>
                <th>Account No.</th>
                <th>Account Type</th>
                <th>Balance</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($banks as $res) { ?>
                <tr class="gradeX">
                  <td><button class="btn btn-sm btn-default" disabled><i class="fa <?= $type[$res['account_type_id']] ?>"></i></button> <?= $res['account_name'] ?></td>
                  <td><?= $res['account_code'] ?></td>
                  <td><?= $res['account_no'] ?></td>
                  <td><?= ucwords(strtolower($res['account_type'])) ?></td>
                  <td class="text-right"><?= $res['symbol'] . ' ' . number_format(0, 2) ?></td>
                  <td>
                    <form method="post" name="delete_account" refresh="admin_bank_list" confirm>
                      <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_bank_edit" value="<?= $res['id'] ?>"> Edit <i class="fa fa-edit"></i> </button>
                      <?php if ($res['is_deletable']) { ?>
                        <button type="submit" class="btn btn-sm btn-primary" name="id" value="<?= $res['id'] ?>"> Delete <i class="fa fa-trash"></i> </button>
                      <?php } else { ?>
                        <button type="button" class="btn btn-sm btn-primary" disabled> Delete <i class="fa fa-lock"></i> </button>
                      <?php } ?>
                    </form>
                  </td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>

      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->
</div>
<script>
  $(document).ready(function() {
    if (!$.fn.DataTable.isDataTable('#dataTables-example')) {
      $('#dataTables-example').DataTable({
        dom: '<"custom_bar"<"flex"lB>f>rtip',
        "aaSorting": [],
        buttons: [{
          extend: 'copy',
          text: 'Copy <i class="fa fa-clipboard" aria-hidden="true"></i>',
          className: 'btn btn-sm btn-primary'

        }, {
          extend: 'csv',
          text: 'Csv <i class="fa fa-print" aria-hidden="true"></i>',
          className: 'btn btn-sm btn-primary',
        }, {
          extend: 'excelHtml5',
          text: 'Excel <i class="fa fa-print" aria-hidden="true"></i>',
          className: 'btn btn-sm btn-primary',
        }],
        responsive: true
      });
    }
  });
</script>