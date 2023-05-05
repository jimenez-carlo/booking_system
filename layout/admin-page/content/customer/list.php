<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-users"></i> Manage Customer List</h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_customer_create"> Add <i class="fa fa-plus"></i> </button>
      </div>
      <!-- /.panel-heading -->
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
              <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Contact No</th>
                <th>Email</th>
                <th>Province</th>
                <th>City</th>
                <th>Barangay</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($customers as $res) { ?>
                <tr class="gradeX">
                  <td><?= $res['id'] ?></td>
                  <td><?= $res['first_name'] . ' ' . (!empty($res['middle_name']) ? $res['middle_name'] . ',' : '') . ' ' . $res['last_name'] ?></td>
                  <td><?= $res['gender'] ?></td>
                  <td><?= $res['contact_no'] ?></td>
                  <td><?= $res['email'] ?></td>
                  <td><?= $res['province'] ?></td>
                  <td><?= $res['city'] ?></td>
                  <td><?= $res['barangay'] ?></td>
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
        responsive: true
      });
    }
  });
</script>