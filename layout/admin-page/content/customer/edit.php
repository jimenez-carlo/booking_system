<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-user-edit"></i> Editing Customer #<?= $info->id ?> </h1>
  </div>
</div>
<div class="row">
  <form action="" method="post" name="edit_customer">
    <input type="hidden" id="id" name="id" value="<?= $info->id ?>">
    <div class="col-lg-12">
      <div class="result"></div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <!-- Customer Creation Form -->
          <button type="submit" class="btn btn-sm btn-primary" name="admin_customer_list"> Update <i class="fa fa-check"></i></button>
          <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_customer_list"> Back </button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>First name</label>
                <input class="form-control" type="text" name="first_name" id="first_name" placeholder="First name" value="<?= $info->first_name ?>">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>Middle name</label>
                <input class="form-control" type="text" name="middle_name" id="middle_name" placeholder="Middle name" value="<?= $info->middle_name ?>">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Last name</label>
                <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Last name" value="<?= $info->last_name ?>">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Company</label>
                <select class="form-control" name="company" id="company">
                  <?php foreach ($company as $res) { ?>
                    <option value="<?= $res['id'] ?>" <?= $res['id'] == $info->company_id ? 'selected' : '' ?>><?= $res['company'] ?></option>
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
                    <option value="<?= $res['id'] ?>" <?= $res['id'] == $info->gender_id ? 'selected' : '' ?>><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Province</label>
                <select class="form-control" name="province" id="province">
                  <?php foreach ($province as $res) { ?>
                    <option value="<?= $res['id'] ?>" <?= $res['id'] == $info->province ? 'selected' : '' ?>><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>City</label>
                <select class="form-control" name="city" id="city">
                  <?php foreach ($city as $res) { ?>
                    <option value="<?= $res['id'] ?>" <?= $res['id'] == $info->city ? 'selected' : '' ?>><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Barangay</label>
                <select class="form-control" name="barangay" id="barangay">\
                  <?php foreach ($barangay as $res) { ?>
                    <option value="<?= $res['id'] ?>" <?= $res['id'] == $info->barangay ? 'selected' : '' ?>><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Birth Date</label>
                <input class="form-control" type="date" name="birth_date" id="birth_date" placeholder="Birth Date" value="<?= $info->birth_date ?>">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Contact No</label>
                <input class="form-control" type="number" name="contact_no" id="contact_no" placeholder="Contact No#" value="<?= $info->contact_no ?>">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Email" value="<?= $info->email ?>">
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
  $('select[name="province"]').on('change', function() {
    city();
    barangay();
  });

  $('select[name="city"]').on('change', function() {
    barangay();
  });
</script>