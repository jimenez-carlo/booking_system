<div id="page-wrapper">
  <div class="container-fluid" id="content">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-users fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?= $request->get_one("SELECT IFNULL(count(*),0) as result from tbl_customers where is_deleted = 0")->result ?></div>
                <div>Customers</div>
              </div>
            </div>
          </div>
          <a href="#" name="admin_customer_list" class="btn-view">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-users fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?= $request->get_one("SELECT IFNULL(count(*),0) as result from tbl_vendor where is_deleted = 0")->result ?></div>
                <div>Vendors</div>
              </div>
            </div>
          </div>
          <a href="#" name="admin_vendor_list" class="btn-view">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-shopping-cart fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge"><?= $request->get_one("SELECT IFNULL(count(*),0) as result from tbl_invoice where is_deleted = 0")->result ?></div>
                <div>Invoice</div>
              </div>
            </div>
          </div>
          <a href="#" name="admin_invoice_list" class="btn-view">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-support fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge">13</div>
                <div>Support Tickets!</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
            <div class="pull-right">
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                  Actions
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                  <li><a href="#">Action</a>
                  </li>
                  <li><a href="#">Another action</a>
                  </li>
                  <li><a href="#">Something else here</a>
                  </li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div id="morris-area-chart"></div>
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example
            <div class="pull-right">
              <div class="btn-group">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                  Actions
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                  <li><a href="#">Action</a>
                  </li>
                  <li><a href="#">Another action</a>
                  </li>
                  <li><a href="#">Something else here</a>
                  </li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>3326</td>
                        <td>10/21/2013</td>
                        <td>3:29 PM</td>
                        <td>$321.33</td>
                      </tr>
                      <tr>
                        <td>3325</td>
                        <td>10/21/2013</td>
                        <td>3:20 PM</td>
                        <td>$234.34</td>
                      </tr>
                      <tr>
                        <td>3324</td>
                        <td>10/21/2013</td>
                        <td>3:03 PM</td>
                        <td>$724.17</td>
                      </tr>
                      <tr>
                        <td>3323</td>
                        <td>10/21/2013</td>
                        <td>3:00 PM</td>
                        <td>$23.71</td>
                      </tr>
                      <tr>
                        <td>3322</td>
                        <td>10/21/2013</td>
                        <td>2:49 PM</td>
                        <td>$8345.23</td>
                      </tr>
                      <tr>
                        <td>3321</td>
                        <td>10/21/2013</td>
                        <td>2:23 PM</td>
                        <td>$245.12</td>
                      </tr>
                      <tr>
                        <td>3320</td>
                        <td>10/21/2013</td>
                        <td>2:15 PM</td>
                        <td>$5663.54</td>
                      </tr>
                      <tr>
                        <td>3319</td>
                        <td>10/21/2013</td>
                        <td>2:13 PM</td>
                        <td>$943.45</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.col-lg-4 (nested) -->
              <div class="col-lg-8">
                <div id="morris-bar-chart"></div>
              </div>
              <!-- /.col-lg-8 (nested) -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

        <!-- /.panel -->
      </div>
      <!-- /.col-lg-8 -->
      <div class="col-lg-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-bank fa-fw"></i> Bank and Credit Cards
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="list-group">
              <?php

              $type = [
                3 => 'fa-money',
                4 => 'fa-bank',
                9 => 'fa-credit-card'
              ];

              $banks = $request->get_list("SELECT x.id,x.parent_account_id,x.account_name,x.account_code,x.account_no,x.account_type_id,c.symbol,y.name as account_type,z.account_name as parent_name, x.is_deletable,x.is_deleted FROM tbl_account x inner join tbl_account_type y on (x.account_type_id = y.id and y.is_deleted = 0) left join tbl_account z on (z.id = x.parent_account_id and z.is_deleted = 0) inner join tbl_currency c on (c.id = x.currency_id and c.is_deleted = 0) where x.is_deleted = 0 and x.account_type_id in (3,4,9) order by x.created_date desc limit 5");
              ?>
              <?php foreach ($banks as $res) { ?>
                <a href="#" class="list-group-item">
                  <i class="fa <?= $type[$res['account_type_id']] ?> fa-fw"></i> <?= $res['account_name'] ?>
                  <span class="pull-right text-muted small"><em><?= number_format(0, 2) ?></em>
                  </span>
                </a>
              <?php } ?>

            </div>
            <!-- /.list-group -->
            <a href="#" class="btn btn-default btn-block btn-view" name="admin_bank_list">View More</a>
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <i class="fa fa-bar-chart-o fa-fw"></i> Top Expenses
          </div>
          <div class="panel-body">
            <div id="morris-donut-chart"></div>
            <a href="#" class="btn btn-default btn-block">View Details</a>
          </div>
          <!-- /.panel-body -->
        </div>
        <!-- /.panel -->

        <!-- /.panel .chat-panel -->
      </div>
      <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>