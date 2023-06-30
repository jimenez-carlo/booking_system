<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-plus"></i> Create Transaction</h1>
  </div>
</div>
<div class="row">
  <form method="post" name="create_<?= reset($forms)['alias'] ?>" refresh="admin_form_create&selected_form=create_invoice">
    <div class="col-lg-12">
      <div class="result"></div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <!-- Customer Creation Form -->
          <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-sm btn-primary btn-edit" name="admin_customer_list"><i class="fa fa-backward" aria-hidden="true"></i> Back </button>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">

          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label><span style="color:red">*</span>Type</label>
                  <select class="form-control select" name="form" id="form">
                    <?php foreach ($forms as $res) { ?>
                      <option value="create_<?= $res['alias'] ?>" <?= isset($_GET['selected_form']) && $_GET['selected_form'] == 'create_' . $res['alias'] ? 'selected' : ''; ?>><?= $res['name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label><span style="color:red">*</span>Reference No#</label>
                  <input class="form-control" type="number" value="<?= date('Ymdhis') ?>" disabled>
                  <input class="form-control" type="hidden" name="reference_no" value="<?= date('Ymdhis') ?>">
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-12">
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
          </div>

          <div id="create_invoice">

            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label><span style="color:red">*</span>Due Date</label>
                    <input class="form-control" type="date" name="invoice_due_date" id="invoice_due_date" value="<?= date('Y-m-d') ?>">
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" name="invoice_remarks" id="invoice_remarks" placeholder="(Optional)"></textarea>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-lg-12">
              <h4><i class="fa fa-arrow-circle-o-up"></i> Revenue</h4>
              <table class="table table-striped table-bordered table-hover" id="profit_table">
                <thead>
                  <tr>
                    <th class="w25">Title</th>
                    <th class="w25">Reference(optional)</th>
                    <th class="w25">Amount</th>
                    <th class="w25">Target Date</th>
                    <th class="w0">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="gradeX">
                    <td><input class="form-control" type="text" name="profit_name[]" placeholder="Profit"></td>
                    <td><input class="form-control" type="text" name="profit_reference[]" placeholder="12345"></td>
                    <td><input class="form-control text-right profit-expense" type="number" name="profit_val[]" placeholder="0.00"></td>
                    <td><input class="form-control" type="date" name="profit_date[]" value="<?= date("Y-m-d") ?>"></td>
                    <td class="w0"><button type="button" class="btn btn-sm btn-primary btn-del-row"> <i class="fa fa-trash"></i> </button></td>
                  </tr>
                </tbody>
                <tbody>
                  <thead>
                    <tr>
                      <th>Total:</th>
                      <th></th>
                      <th class="text-right"><input class="form-control text-right total-profit" type="text" placeholder="0.00" disabled></th>
                      <th colspan="2"></th>
                    </tr>
                  </thead>
                  <tr>
                    <td colspan="5">
                      <button type="button" class="btn btn-sm btn-primary btn-add-profit"> Add <i class="fa fa-plus"></i> </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="col-lg-12">
              <h4><i class="fa fa-arrow-circle-o-down"></i> Expense</h4>
              <table class="table table-striped table-bordered table-hover" id="expense_table">
                <thead>
                  <tr>
                    <th class="w25">Title</th>
                    <th class="w25">Reference(optional)</th>
                    <th class="w25">Amount</th>
                    <th class="w25">Target Date</th>
                    <th class="w0">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <tr class="gradeX">
                    <td><input class="form-control" type="text" name="expense_name[]" placeholder="Expense"></td>
                    <td><input class="form-control" type="text" name="expense_reference[]" placeholder="12345"></td>
                    <td><input class="form-control text-right profit-expense" type="number" name="expense_val[]" placeholder="0.00"></td>
                    <td><input class="form-control" type="date" name="expense_date[]" value="<?= date("Y-m-d") ?>"></td>
                    <td class="w0"><button type="button" class="btn btn-sm btn-primary btn-del-row"> <i class="fa fa-trash"></i> </button></td>
                  </tr>
                </tbody>
                <tbody>
                  <thead>
                    <tr>
                      <th>Total:</th>
                      <th></th>
                      <th class="text-right"><input class="form-control text-right total-expense" type="text" placeholder="0.00" disabled></th>
                      <th colspan="2"></th>
                    </tr>
                  </thead>
                  <tr>
                    <td colspan="5">
                      <button type="button" class="btn btn-sm btn-primary btn-add-expense"> Add <i class="fa fa-plus"></i> </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="col-lg-12">
              <h4><i class="fa fa-exchange"></i> Tax</h4>
              <table class="table table-striped table-bordered table-hover" id="tax_table">
                <thead>
                  <tr>
                    <th class="w25">Title</th>
                    <th class="w25">Amount</th>
                    <th class="w0">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <tr class="gradeX">
                    <td><input class="form-control" type="text" name="tax_name[]" placeholder="Tax title"></td>
                    <td><input class="form-control text-right profit-expense" type="number" name="tax_val[]" placeholder="0.00"></td>
                    <td class="w0"><button type="button" class="btn btn-sm btn-primary btn-del-row"> <i class="fa fa-trash"></i> </button></td>
                  </tr>
                </tbody>
                <tbody>
                  <thead>
                    <tr>
                      <th>Total:</th>
                      <th class="text-right"><input class="form-control text-right total-tax" type="text" placeholder="0.00" disabled></th>
                    </tr>
                  </thead>
                  <tr>
                    <td colspan="3">
                      <button type="button" class="btn btn-sm btn-primary btn-add-tax"> Add <i class="fa fa-plus"></i> </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div id="create_payment" style="display:none">

            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label><span style="color:red">*</span>Invoice</label>
                    <input class="form-control" type="text" name="payment_invoice" id="payment_invoice" placeholder="123456">

                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label><span style="color:red">*</span>Title</label>
                    <input class="form-control" type="text" name="payment_title" id="payment_title" placeholder="Balance Payment">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label><span style="color:red">*</span>Amount</label>
                    <input class="form-control text-right" type="number" name="payment_amount" id="payment_amount" placeholder="0.00">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" name="invoice_remarks" placeholder="(Optional)"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="create_disbursement" style="display:none">

            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label>Invoice</label>
                    <input class="form-control" type="text" name="disbursement_invoice" id="disbursement_invoice" placeholder="123456">

                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label><span style="color:red">*</span>Title</label>
                    <input class="form-control" type="text" name="disbursement_title" id="disbursement_title" placeholder="Transporation, Supplies, etc.">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label><span style="color:red">*</span>Amount</label>
                    <input class="form-control text-right" type="number" name="disbursement_amount" id="disbursement_amount" placeholder="0.00">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label><span style="color:red">*</span>Ledger folio</label>
                    <input class="form-control" type="text" name="disbursement_ledger" id="disbursement_ledger" placeholder="Ledger Folio">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="row">

                <div class="col-lg-12">
                  <div class="form-group">
                    <label>Remarks</label>
                    <textarea class="form-control" name="disbursement_remarks" placeholder="(Optional)"></textarea>
                  </div>
                </div>
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
  $(function() {

    $('.select').select2();

    var add_remove_profit = false;

    if (typeof jQuery.fn.add_remove_profit !== 'function') {
      add_remove_profit = (condition = true) => {
        let type = (condition) ? "profit" : "expense";
        $("#" + type + "_table tbody:first")
          .append('<tr class="gradeX">' +
            '<td><input class="form-control" type="text" name="' + type + '_name[]" placeholder="' + type[0].toUpperCase() + type.slice(1) + '"></td>' +
            '<td><input class="form-control" type="text" name="' + type + '_reference[]" placeholder="12345"></td>' +
            '<td><input class="form-control text-right profit-expense" type="number" name="' + type + '_val[]" placeholder="0.00"></td>' +
            '<td><input class="form-control" type="date" name="' + type + '_date[]" value="<?= date("Y-m-d") ?>"></td>' +
            '<td class="w0"><button type="button" class="btn btn-sm btn-primary btn-del-row"> <i class="fa fa-trash"></i> </button></td>' +
            '</tr>'
          );
      };
    }

    var add_tax = false;

    if (typeof jQuery.fn.add_tax !== 'function') {
      add_tax = () => {
        $("#tax_table tbody:first")
          .append('<tr class="gradeX">' +
            '<td><input class="form-control" type="text" name="tax_name[]" placeholder="Tax title"></td>' +
            '<td><input class="form-control text-right profit-expense" type="number" name="tax_val[]" placeholder="0.00"></td>' +
            '<td class="w0"><button type="button" class="btn btn-sm btn-primary btn-del-row"> <i class="fa fa-trash"></i> </button></td>' +
            '</tr>'
          );
      };
    }

    var create_selected_form = false;

    if (typeof jQuery.fn.add_tax !== 'function') {
      create_selected_form = (selected_form = 'create_invoice') => {
        if (selected_form == 'create_invoice') {
          $('#create_invoice').show();
          $('#create_payment').hide();
          $('#create_disbursement').hide();
        } else if (selected_form == 'create_payment') {
          $('#create_invoice').hide();
          $('#create_payment').show();
          $('#create_disbursement').hide();
        } else if (selected_form == 'create_disbursement') {
          $('#create_invoice').hide();
          $('#create_payment').hide();
          $('#create_disbursement').show();
        }
      };
    }

    $(document).off('click', '.btn-add-profit');
    $(document).off('click', '.btn-add-expense');
    $(document).off('click', '.btn-add-tax');
    $(document).off('change', 'input[name="profit_val[]');
    $(document).off('change', 'input[name="expense_val[]');
    $(document).off('change', 'input[name="tax_val[]');
    $(document).off('change', '#form');

    $(document).on('click', '.btn-add-profit', function() {
      add_remove_profit(true);
    });

    $(document).on('click', '.btn-add-expense', function() {
      add_remove_profit(false);
    });
    $(document).on('click', '.btn-add-tax', function() {
      add_tax();
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

    $(document).on('change', 'input[name="tax_val[]"]', function() {
      let sum = 0;
      $('input[name="tax_val[]').each(function() {
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
      $('.total-tax').val(clean_sum);
    });


    $(document).on('click', '.btn-del-row', function() {
      $(this).parent().parent().remove();
      $('input[name="expense_val[]"]').trigger("change");
      $('input[name="profit_val[]"]').trigger("change");
      $('input[name="tax_val[]"]').trigger("change");
    });

    $(document).on('change', '#form', function() {
      let selected_form = $(this).val();
      $('form').attr('name', selected_form);
      $('form').attr('refresh', 'admin_form_create&selected_form=' + selected_form);
      create_selected_form(selected_form);
    });
    $('#form').trigger("change");
  });
</script>