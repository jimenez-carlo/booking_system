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
                <label><span style="color:red">*</span>Form</label>
                <select class="form-control select" name="form" id="form">
                  <?php foreach ($forms as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label><span style="color:red">*</span>Reference No#</label>
                <input class="form-control" type="number" name="reference_no" value="<?= date('Ymdhis') ?>" disabled>
                <input class="form-control" type="hidden" value="<?= date('Ymdhis') ?>" disabled>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-lg-6">
              <div class="form-group">
                <label><span style="color:red">*</span>Company</label>
                <select class="form-control select" name="company" id="company">
                  <?php foreach ($company as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['company'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label><span style="color:red">*</span>Customer</label>
                <select class="form-control select" name="customer" id="customer">
                  <?php foreach ($customers as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= ($res['id'] == 1) ? "NONE" : strtoupper($res['first_name'] . ' ' . (!empty($res['middle_name']) ? $res['middle_name'] . ',' : '') . ' ' . $res['last_name'] . ' #' . $res['id']) ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>


          </div>

          <div class="row" id="profit_loss">
            <div class="col-lg-12">
              <h4><i class="fa fa-arrow-circle-o-up"></i> Revenue</h4>
              <table class="table table-striped table-bordered table-hover" id="profit_table">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="gradeX">
                    <td><input class="form-control" type="text" name="profit_name[]" placeholder="Profit"></td>
                    <td><input class="form-control text-right profit-expense" type="number" name="profit_val[]" placeholder="0.00"></td>
                    <td><input class="form-control" type="date" name="profit_date[]" value="<?= date("Y-m-d") ?>"></td>
                    <td><button type="button" class="btn btn-sm btn-primary btn-del-row"> <i class="fa fa-trash"></i> </button></td>
                  </tr>
                </tbody>
                <tbody>
                  <thead>
                    <tr>
                      <th>Total:</th>
                      <th class="text-right"><input class="form-control text-right total-profit" type="text" placeholder="0.00" disabled></th>
                      <th colspan="2"></th>
                    </tr>
                  </thead>
                  <tr>
                    <td colspan="4">
                      <button type="button" class="btn btn-sm btn-primary btn-add-profit"> Add <i class="fa fa-plus"></i> </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row" id="sales_tax_summary">
            <div class="col-lg-12">
              <h4><i class="fa fa-arrow-circle-o-down"></i> Expense</h4>
              <table class="table table-striped table-bordered table-hover" id="expense_table">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <tr class="gradeX">
                    <td><input class="form-control" type="text" name="expense_name[]" placeholder="Expense"></td>
                    <td><input class="form-control text-right profit-expense" type="number" name="expense_val[]" placeholder="0.00"></td>
                    <td><input class="form-control" type="date" name="expense_date[]" value="<?= date("Y-m-d") ?>"></td>
                    <td><button type="button" class="btn btn-sm btn-primary btn-del-row"> <i class="fa fa-trash"></i> </button></td>
                  </tr>
                </tbody>
                <tbody>
                  <thead>
                    <tr>
                      <th>Total:</th>
                      <th class="text-right"><input class="form-control text-right total-expense" type="text" placeholder="0.00" disabled></th>
                      <th colspan="2"></th>
                    </tr>
                  </thead>
                  <tr>
                    <td colspan="4">
                      <button type="button" class="btn btn-sm btn-primary btn-add-expense"> Add <i class="fa fa-plus"></i> </button>
                    </td>
                  </tr>
                </tbody>
              </table>
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

  var add_remove_profit = false;

  if (typeof jQuery.fn.add_remove_profit !== 'function') {
    add_remove_profit = (condition = true) => {
      let type = (condition) ? "profit" : "expense";
      $("#" + type + "_table tbody:first")
        .append('<tr class="gradeX">' +
          '<td><input class="form-control" type="text" name="' + type + '_name[]" placeholder="' + type[0].toUpperCase() + type.slice(1) + '"></td>' +
          '<td><input class="form-control text-right profit-expense" type="number" name="' + type + '_val[]" placeholder="0.00"></td>' +
          '<td><input class="form-control" type="date" name="' + type + '_date[]" value="<?= date("Y-m-d") ?>"></td>' +
          '<td><button type="button" class="btn btn-sm btn-primary btn-del-row"> <i class="fa fa-trash"></i> </button></td>' +
          '</tr>'
        );
    };
  }

  $(document).off('click', '.btn-add-profit');
  $(document).off('click', '.btn-add-expense');

  $(document).on('click', '.btn-add-profit', function() {
    add_remove_profit(true);
  });

  $(document).on('click', '.btn-add-expense', function() {
    add_remove_profit(false);
  });

  $(document).on('change', 'input[name="profit_val[]"]', function() {
    let sum = 0;
    $('input[name="profit_val[]').each(function() {
      var value = $(this).val();

      if (value !== '') {
        var parsedValue = parseFloat(value);
        if (!isNaN(parsedValue)) {
          sum += parsedValue;
        }
      }
    });


    var clean_sum = sum.toLocaleString(undefined, {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
    $('.total-profit').val(clean_sum);
  });

  $(document).on('change', 'input[name="expense_val[]"]', function() {
    let sum = 0;
    $('input[name="expense_val[]').each(function() {
      var value = $(this).val();

      if (value !== '') {
        var parsedValue = parseFloat(value);
        if (!isNaN(parsedValue)) {
          sum += parsedValue;
        }
      }
    });


    var clean_sum = sum.toLocaleString(undefined, {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    });
    $('.total-expense').val(clean_sum);
  });


  $(document).on('click', '.btn-del-row', function() {
    $(this).parent().parent().remove();
  });
</script>