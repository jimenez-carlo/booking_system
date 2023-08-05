<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-percent"></i> Create Tax</h1>
  </div>
</div>
<div class="row">
  <form action="" method="post" name="create_tax" refresh="admin_tax_create">
    <div class="col-lg-12">
      <div class="result"></div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <!-- Customer Creation Form -->
          <button type="submit" class="btn btn-sm btn-primary" name="admin_tax_list"> Save <i class="fa fa-check"></i></button>
          <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_tax_list"><i class="fa fa-backward" aria-hidden="true"></i> Back </button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Tax Name</label>
                <input class="form-control" type="text" name="tax_name" id="tax_name" placeholder="Tax Name">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Rate(%)</label>
                <input class="form-control" type="number" name="rate" id="rate" placeholder="0">
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