<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-users"></i> Tax list</h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="result"></div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_tax_create"> Create Tax <i class="fa fa-plus"></i> </button>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>Tax Name</th>
                <th style="width: 0.1%;white-space:nowrap">Rate(%)</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($taxes as $res) { ?>
                <tr class="gradeX">
                  <td><?= $res['name'] ?></td>
                  <td><?= $res['rate'] ?></td>
                  <td>
                    <form method="post" name="delete_tax" refresh="admin_tax_list" confirm>
                      <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_tax_edit" value="<?= $res['id'] ?>"> Edit <i class="fa fa-edit"></i> </button>
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