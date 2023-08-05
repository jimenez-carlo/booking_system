<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-user-plus"></i> Create Account</h1>
  </div>
</div>
<div class="row">
  <form action="" method="post" name="create_account" refresh="admin_account_create">
    <div class="col-lg-12">
      <div class="result"></div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <!-- Customer Creation Form -->
          <button type="submit" class="btn btn-sm btn-primary" name="admin_account_list"> Save <i class="fa fa-check"></i></button>
          <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_account_list"><i class="fa fa-backward" aria-hidden="true"></i> Back </button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Account Name</label>
                <input class="form-control" type="text" name="account_name" id="account_name" placeholder="Account Name">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Account Type</label>
                <select class="form-control select2" name="account_type" id="account_type">
                  <?php $group = null ?>
                  <?php foreach ($account_type as $res) { ?>
                    <?php if (empty($group)) {
                      $group = $res['parent_name'];
                      echo '<optgroup label="' . $res['parent_name'] . '">';
                    } ?>
                    <?= ($group != $res['parent_name']) ? '<optgroup label="' . $res['parent_name'] . '">' : "" ?>
                    <option value="<?= $res['id'] ?>" data-child="<?= $res['child'] ?>"><?= $res['name'] ?></option>
                    <?php $group = $res['parent_name']; ?>
                    <?= ($group != $res['parent_name']) ? "</optgroup>" : "" ?>
                  <?php } ?>
                </select>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Account Code</label>
                <input class="form-control" type="text" name="account_code" id="account_code" placeholder="Account Code">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>Account No</label>
                <input class="form-control" type="text" name="account_no" id="account_no" placeholder="Account No">
              </div>
            </div>
          </div>
          <div class="row" id="subaccount">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red"></span>Make this a sub-account</label>
                <input type="checkbox" aria-label="..." class="" name="is_sub_account" id="is_sub_account">
              </div>
            </div>
            <div class="col-lg-3" id="paccount">
              <div class="form-group">
                <label><span style="color:red">*</span>Parent Account</label>
                <select class="form-control select2" name="parent_account_type" id="parent_account_type">
                  <?php $group = null ?>
                  <?php foreach ($account_type as $res) { ?>
                    <?php if (empty($group)) {
                      $group = $res['parent_name'];
                      echo '<optgroup label="' . $res['parent_name'] . '">';
                    } ?>
                    <?= ($group != $res['parent_name']) ? '<optgroup label="' . $res['parent_name'] . '">' : "" ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                    <?php $group = $res['parent_name']; ?>
                    <?= ($group != $res['parent_name']) ? "</optgroup>" : "" ?>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label><span style="color:red">*</span>Currency</label>
                <select class="form-control select2" name="currency" id="currency">
                  <?php foreach ($currency as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['code'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" cols="30" rows="2" class="form-control"></textarea>
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
  $(document).ready(function() {
    $('select[name="account_type"]').off('change');

    $('select[name="account_type"]').on('change', function() {
      toggleSubAccountSection();
      parent_account();
    });

    $('#is_sub_account').on('change', function() {
      toggleSubAccountCheckbox();
    });



    // $('.select2').select2();
    parent_account();
    toggleSubAccountSection();
    toggleSubAccountCheckbox();
  });
</script>