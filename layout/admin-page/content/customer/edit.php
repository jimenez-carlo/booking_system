<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header"><i class="fa fa-user-edit"></i> Editing Customer #<?= $info->id ?> </h1>
  </div>
</div>
<div class="row">
  <form action="" method="post" name="edit_customer" refresh="admin_customer_edit&id=<?= $info->id ?>">
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



      <div class="panel-body">
        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#payment_tab" id="payment_tab-tab" role="tab" data-toggle="tab" aria-controls="payment_tab" aria-expanded="true">Payments History</a></li>
            <li role="presentation" class=""><a href="#disbursement_tab" role="tab" id="disbursement_tab-tab" data-toggle="tab" aria-controls="disbursement_tab" aria-expanded="false">Disbursement History</a></li>
            <li role="presentation" class=""><a href="#invoice_tab" role="tab" id="invoice_tab-tab" data-toggle="tab" aria-controls="invoice_tab" aria-expanded="false">Invoice History</a></li>
          </ul>
          <div id="myTabContent" class="tab-content" style="padding: 25px;border:1px solid #ddd">
            <div role="tabpanel" class="tab-pane fade active in" id="payment_tab" aria-labelledby="payment_tab-tab">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="customer_payments_history">
                  <thead>
                    <tr>
                      <th>Reference No#</th>
                      <th>Invoice#</th>
                      <th>Title</th>
                      <th>Company</th>
                      <th>Amount</th>
                      <th>Date Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($payment_history as $res) { ?>
                      <tr class="gradeX">
                        <td><?= $res['reference'] ?></td>
                        <td><?= $res['title'] ?></td>
                        <td><?= $res['invoice'] ?></td>
                        <td><?= $res['company'] ?></td>
                        <td class="text-right"><?= $res['amount'] ?></td>
                        <td><?= $res['date_created'] ?></td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="disbursement_tab" aria-labelledby="disbursement_tab-tab">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="customer_disbursement_history">
                  <thead>
                    <tr>
                      <th>Reference No#</th>
                      <th>Invoice#</th>
                      <th>Title</th>
                      <th>Company</th>
                      <th>ledger</th>
                      <th>Amount</th>
                      <th>Date Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($disbursement_history as $res) { ?>
                      <tr class="gradeX">
                        <td><?= $res['reference'] ?></td>
                        <td><?= $res['invoice'] ?></td>
                        <td><?= $res['title'] ?></td>
                        <td><?= $res['company'] ?></td>
                        <td><?= $res['ledger'] ?></td>
                        <td class="text-right"><?= $res['amount'] ?></td>
                        <td><?= $res['date_created'] ?></td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="invoice_tab" aria-labelledby="invoice_tab-tab">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="customer_invoice_history">
                  <thead>
                    <tr>
                      <th>Invoice#</th>
                      <th>Company</th>
                      <th>Total Amount</th>
                      <th>Total Paid</th>
                      <th>Total Balance</th>
                      <th>Due Date</th>
                      <th>Date Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($invoice_history as $res) { ?>
                      <tr class="gradeX">
                        <td><?= $res['invoice'] ?></td>
                        <td><?= $res['company'] ?></td>
                        <td class="text-right"><?= abs($res['invoice_total']) ?></td>
                        <td class="text-right"><?= $res['payment_total'] ?></td>
                        <td class="text-right"><?= abs($res['invoice_total'] - $res['payment_total'])  ?></td>
                        <td><?= $res['due_date'] ?></td>
                        <td><?= $res['date_created'] ?></td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>


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


  $(document).ready(function() {

    if (!$.fn.DataTable.isDataTable('#customer_payments_history')) {
      $('#customer_payments_history').DataTable({
        responsive: true
      });
    }
    if (!$.fn.DataTable.isDataTable('#customer_disbursement_history')) {
      $('#customer_disbursement_history').DataTable({
        responsive: true
      });
    }
    if (!$.fn.DataTable.isDataTable('#customer_invoice_history')) {
      $('#customer_invoice_history').DataTable({
        responsive: true
      });
    }
  });
</script>