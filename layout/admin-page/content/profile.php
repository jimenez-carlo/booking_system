<?php
$result = $data['profile'];
?>
<div class="container">
  <br>
  <div class="card">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-user"></i> My Profile
    </div>
    <div class="card-body">
      <form method="post" name="customer_update">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <label for="password" class="form-label">*Username</label>
              <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Username" requireds value="<?php echo $result->username; ?>">
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">*Email Address</label>
              <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="user@example.com" requireds value="<?php echo $result->email; ?>">
            </div>
            <div class="col-md-6">
              <label for="firstname" class="form-label">*First Name</label>
              <input type="text" class="form-control form-control-sm" id="firstname" name="firstname" placeholder="firstname" value="<?php echo $result->first_name; ?>">
            </div>
            <div class="col-md-6">
              <label for="lastname" class="form-label">*Last Name</label>
              <input type="text" class="form-control form-control-sm" id="lastname" name="lastname" placeholder="lastname" value="<?php echo $result->last_name; ?>">
            </div>
            <div class="col-md-6">
              <label for="address" class="form-label">*Address</label>
              <textarea class="form-control form-control-sm" id="address" name="address" rows="4"><?php echo $result->address; ?></textarea>
            </div>
            <div class="col-md-6">
              <label for="contact" class="form-label">*Contact No</label>
              <input type="text" class="form-control form-control-sm" id="contact" name="contact" placeholder="09xxxxxxxxx" requireds value="<?php echo $result->contact_no; ?>">
              <label for="contact" class="form-label">*Gender</label>
              <select class="form-select form-select-sm" aria-label=".form-select-lg example" id="gender" name="gender" requireds style="width: 100%;">
                <?php foreach ($data['gender_list'] as $res) {
                  if ($result->gender_id == $res['id']) {
                    echo '<option value="' . $res['id'] . '" selected>' . $res['gender'] . '</option>';
                  } else {
                    echo '<option value="' . $res['id'] . '">' . $res['gender'] . '</option>';
                  }
                } ?>
              </select>
            </div>
            <div class="col-md-12 mt-3">
              <div class="pull-right">

                <button type="submit" class="btn btn-sm btn-primary">Update <i class="fa fa-save"></i></button>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-lock"></i> Change Password
    </div>
    <div class="card-body">
      <form method="post" name="customer_change_password">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <label for="email" class="form-label">*Old Password</label>
              <input type="password" class="form-control form-control-sm" id="old_password" name="old_password" placeholder="Password" requireds>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">*New Password</label>
              <input type="password" class="form-control form-control-sm" id="new_password" name="new_password" placeholder="New Password" requireds>
            </div>
            <div class="col-md-6">
              <label for="firstname" class="form-label">*Re-type New Password</label>
              <input type="password" class="form-control form-control-sm" id="re_password" name="re_password" placeholder="Re-type New Password">
            </div>

            <div class="col-md-12 mt-3">
              <div class="pull-right">

                <button type="submit" class="btn btn-sm btn-primary">Update <i class="fa fa-save"></i></button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<br>