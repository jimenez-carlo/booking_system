<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>System</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="css/metisMenu.min.css" rel="stylesheet">

  <!-- Timeline CSS -->
  <link href="css/timeline.css" rel="stylesheet">

  <!-- DataTables CSS -->
  <link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">
  <!-- <link href="css/dataTables/buttons.css" rel="stylesheet"> -->

  <!-- Custom CSS -->
  <link href="css/startmin.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="css/morris.css" rel="stylesheet">
  <link href="css/select2.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<script>
  var base_url = "<?php echo "http://" . $_SERVER['SERVER_NAME'] . str_replace("index.php", "", strtok($_SERVER["REQUEST_URI"], '?')); ?>";
</script>

<body>
  <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php"><i class="fa fa-home fa-fw"></i> System</a>
      </div>

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <ul class="nav navbar-right navbar-top-links">

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <?= $_SESSION['user']->first_name . ', ' . $_SESSION['user']->last_name ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="module/logout.php" onclick="return confirm('Are you sure?')"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- /.navbar-top-links -->

      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
            <li class="sidebar-search">
              <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
              <!-- /input-group -->
            </li>
            <li>
              <a href="." class=" nav-link sidebar-btn active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
              <a href="#" name="admin_customer_list" class="nav-link sidebar-btn"><i class="fa fa-users fa-fw"></i> Manage Customers List</a>
            </li>
            <!-- <li>
              <a href="#" name="admin_customer_list2" class="nav-link sidebar-btn"><i class="fa fa-users fa-fw"></i> Manage Customers List</a>
            </li> -->
            <li>
              <a href="#" name="admin_account_list" class="nav-link sidebar-btn"><i class="fa fa-users fa-fw"></i> Manage Chart of Accounts</a>
            </li>
            <li>
              <a href="#" class="nav-link sidebar-btn"><i class="fa fa-files-o fa-fw"></i> Generate Reports<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">
                <li><a href="#" name="profit_loss" class="nav-link sidebar-btn"><i class="fa fa-file fa-fw"></i> Profit/Loss</a></li>
                <li><a href="#" name="customer_statement_of_account" class="nav-link sidebar-btn"><i class="fa fa-file fa-fw"></i> Customer Statement of Account</a></li>
                <li><a href="#" name="sales_tax_summary" class="nav-link sidebar-btn"><i class="fa fa-file fa-fw"></i> Sales Tax Summary</a></li>
                <li><a href="#" name="payment_summary" class="nav-link sidebar-btn"><i class="fa fa-file fa-fw"></i> Payment Summary</a></li>
                <li><a href="#" name="income_and_expenses_summary" class="nav-link sidebar-btn"><i class="fa fa-file fa-fw"></i> Income and Expenses Summary</a></li>
              </ul>
              <!-- /.nav-second-level -->
            </li>

          </ul>
        </div>
      </div>
    </nav>