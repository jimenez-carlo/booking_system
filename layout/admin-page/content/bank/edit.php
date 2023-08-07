<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-user-edit"></i> Editing Bank/Credit Card</h1>
  </div>
</div>
<div class="row">
  <form action="" method="post" name="edit_account" refresh="admin_bank_edit&id=<?= $info->id ?>">
    <input type="hidden" id="id" name="id" value="<?= $info->id ?>">
    <div class="col-lg-12">
      <div class="result"></div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <!-- Customer Creation Form -->
          <button type="submit" class="btn btn-sm btn-primary" name="admin_bank_list"> Save <i class="fa fa-check"></i></button>
          <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_bank_list"><i class="fa fa-backward" aria-hidden="true"></i> Back </button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Select Account Type</label>
                <br>
                <input type="radio" name="account_type" id="account_type" value="4" <?= $info->account_type_id == 4 ? "checked" : "" ?>> Bank
                <input type="radio" name="account_type" id="account_type" value="9" <?= $info->account_type_id == 9 ? "checked" : "" ?> style="margin-left:10rem"> Credit Card
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Account Name</label>
                <input class="form-control" type="text" name="account_name" id="account_name" placeholder="Account Name" value="<?= $info->account_name ?>">
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Account Code</label>
                <input class="form-control" type="text" name="account_code" id="account_code" placeholder="Account Code" value="<?= $info->account_code ?>">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>Account No</label>
                <input class="form-control" type="text" name="account_no" id="account_no" placeholder="Account No" value="<?= $info->account_no ?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Currency</label>
                <select class="form-control select2" name="currency" id="currency">
                  <?php foreach ($currency as $res) { ?>
                    <option value="<?= $res['id'] ?>" <?= $res['id'] == $info->currency_id ? 'selected' : '' ?>><?= $res['code'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" cols="30" rows="2" class="form-control"><?= $info->description ?></textarea>
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