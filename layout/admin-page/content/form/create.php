<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-file"></i> Create Form</h1>
  </div>
</div>
<div class="row">
  <form action="" method="post" name="create_customer">
    <div class="col-lg-12">
      <div class="result"></div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <!-- Customer Creation Form -->
          <button type="submit" class="btn btn-sm btn-primary" name="admin_customer_list"> Save <i class="fa fa-check"></i></button>
          <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_customer_list"> Back </button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label><span style="color:red">*</span>Customer</label>
                <select class="form-control select" name="customer" id="customer">
                  <?php foreach ($customers as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= strtoupper($res['first_name'] . ' ' . (!empty($res['middle_name']) ? $res['middle_name'] . ',' : '') . ' ' . $res['last_name'] . ' #' . $res['id']) ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label><span style="color:red">*</span>Form</label>
                <select class="form-control" name="form" id="form">
                  <?php foreach ($forms as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

          </div>


        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
  </form>
  <!-- /.col-lg-12 -->
</div>

<script>
  $('.select').select2();
</script>