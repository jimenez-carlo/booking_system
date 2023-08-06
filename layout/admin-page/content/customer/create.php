<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-user-plus"></i> Create Customer</h1>
  </div>
</div>
<div class="row">
  <form action="" method="post" name="create_customer" refresh="admin_customer_create">
    <div class="col-lg-12">
      <div class="result"></div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <!-- Customer Creation Form -->
          <button type="submit" class="btn btn-sm btn-primary" name="admin_customer_list"> Save <i class="fa fa-check"></i></button>
          <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_customer_list"><i class="fa fa-backward" aria-hidden="true"></i> Back </button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>First name</label>
                <input class="form-control" type="text" name="first_name" id="first_name" placeholder="First name">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>Middle name</label>
                <input class="form-control" type="text" name="middle_name" id="middle_name" placeholder="Middle name">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Last name</label>
                <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Last name">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Company</label>
                <select class="form-control" name="company" id="company">
                  <?php foreach ($company as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['company'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Gender</label>
                <select class="form-control" name="gender" id="gender">
                  <?php foreach ($gender as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Province</label>
                <select class="form-control" name="province" id="province">
                  <?php foreach ($province as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>City</label>
                <select class="form-control" name="city" id="city">
                  <?php foreach ($city as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Barangay</label>
                <select class="form-control" name="barangay" id="barangay">\
                  <?php foreach ($barangay as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Birth Date</label>
                <input class="form-control" type="date" name="birth_date" id="birth_date" placeholder="Birth Date">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Contact No</label>
                <input class="form-control" type="number" name="contact_no" id="contact_no" placeholder="Contact No#">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Email">
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Customer Type</label>
                <br>
                <input type="radio" name="customer_type_id" id="customer_type_id" value="1" checked> Individual
                <input type="radio" name="customer_type_id" id="customer_type_id" value="2" style="margin-left:10rem"> Business
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
  $('select[name="province"]').off('change');
  $('select[name="city"]').off('change');

  $('select[name="province"]').on('change', function() {
    city();
    barangay();
  });

  $('select[name="city"]').on('change', function() {
    barangay();
  });
</script>