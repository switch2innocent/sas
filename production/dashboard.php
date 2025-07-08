<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/customer.obj.php';
require_once '../objects/project.obj.php';
require_once '../objects/contract_file.obj.php';
require_once '../objects/company.obj.php';

$database = new Connection();
$db = $database->connect();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('location: ../index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SAS | Dashboard</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">

</head>

<body class="nav-md footer_fixed">
  <div class="container body">
    <div class="main_container">

      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="clearfix"></div>
          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu menu_fixed">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li class="active"><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard </a>
                </li>
                <li><a><i class="fa fa-database"></i> Masters <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="company.php">Company</a></li>
                    <li><a href="project.php">Project</a></li>
                    <li><a href="contract.php">Contract</a></li>
                    <li><a href="signatories.php">Signatories</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Customer Data <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="customer_details.php">Customer Details</a></li>
                    <li><a href="#">Subdivision Customer Upload</a></li>
                    <li><a href="#">Condo Customer Upload</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i> Reports <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="#">Customers</a></li>
                    <li><a href="#">CAR Summary</a></li>
                    <li><a href="#">CAR Detail</a></li>
                    <li><a href="#">Aging</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-info-circle"></i>About Us</a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu menu_fixed">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/img.jpg" alt=""><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="javascript:;"> Profile</a></li>
                  <li><a href="../controls/logout_users.ctrl.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h5><a href="dashboard.php"><b>Dashboard</b></a></h5>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <!-- Tabs -->
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-bars"></i> Customers</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="tile_stats_count text-center" style="padding: 20px 0;">
                    <span class="count_top" style="font-size:16px;"><i class="fa fa-user"></i> Total Customers</span>
                    <div class="count" style="font-size:32px; font-weight:bold; margin:10px 0;">
                      <?php
                      $count_customer = new Customer($db);

                      $count = $count_customer->count_customers();
                      while ($row = $count->fetch(PDO::FETCH_ASSOC)) {
                        echo $row['total_customer'];
                      }
                      ?>
                    </div>
                    <span class="count_bottom" style="font-size:13px;">
                      <i class="green" style="font-weight:bold;">Current status </i>
                    </span>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-bars"></i> Projects </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="tile_stats_count text-center" style="padding: 20px 0;">
                    <span class="count_top" style="font-size:16px;"><i class="fa fa-building"></i> Number of Projects</span>
                    <div class="count" style="font-size:32px; font-weight:bold; margin:10px 0;">
                      <?php
                      $count_project = new Project($db);

                      $count = $count_project->count_projects();
                      while ($row2 = $count->fetch(PDO::FETCH_ASSOC)) {
                        echo $row2['total_project'];
                      }
                      ?>
                    </div>
                    <span class="count_bottom" style="font-size:13px;">
                      <i class="green" style="font-weight:bold;">Current status </i>
                    </span>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-bars"></i> Contract Files</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="tile_stats_count text-center" style="padding: 20px 0;">
                    <span class="count_top" style="font-size:16px;"><i class="fa fa-file-text"></i> Contract Files</span>
                    <div class="count" style="font-size:32px; font-weight:bold; margin:10px 0;">
                      <?php
                      $count_contract = new ContractFile($db);

                      $count = $count_contract->count_contracts();
                      while ($row3 = $count->fetch(PDO::FETCH_ASSOC)) {
                        echo $row3['total_contract'];
                      }
                      ?>
                    </div>
                    <span class="count_bottom" style="font-size:13px;">
                      <i class="green" style="font-weight:bold;">Current status </i>
                    </span>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-bars"></i> Company </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <div class="tile_stats_count text-center" style="padding: 20px 0;">
                    <span class="count_top" style="font-size:16px;"><i class="fa fa-building"></i> Company</span>
                    <div class="count" style="font-size:32px; font-weight:bold; margin:10px 0;">
                      <?php
                      $count_company = new Company($db);

                      $count = $count_company->count_companys();
                      while ($row4 = $count->fetch(PDO::FETCH_ASSOC)) {
                        echo $row4['total_company'];
                      }
                      ?>
                    </div>
                    <span class="count_bottom" style="font-size:13px;">
                      <i class="green" style="font-weight:bold;">Current status </i>
                    </span>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Copyright 2025 @ <a href="https://innogroup.com.ph/">https://innogroup.com.ph/</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
</body>

</html>