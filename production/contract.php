<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/contract_type.obj.php';
require_once '../objects/contract_file.obj.php';

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

  <title>IDS | Contract</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
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
                <li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard </a>
                </li>
                <li class="active"><a><i class="fa fa-database"></i> Masters <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="company.php">Company</a></li>
                    <li><a href="project.php">Project</a></li>
                    <li><a href="contract.php">Contract</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i> Customer Data <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="#">Customer Details</a></li>
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
              <h5>Masters / <b><a href="contract.php">Contract</a></b></h5>
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

          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Contract Table</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <!-- <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul> -->
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <!-- button -->
                  <div class="btn-group" style="margin-bottom: 15px;">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
                  </div>
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">Contract Name</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $view_contract_file = new ContractFile($db);

                      $view = $view_contract_file->view_contract_files();

                      while ($row = $view->fetch(PDO::FETCH_ASSOC)) {
                        echo '
                        <tr>
                          <td class="text-center">' . htmlspecialchars($row['contract_name']) . '</td>
                          <td class="text-center">' . htmlspecialchars($row['description']) . '</td>
                          <td class="text-center">' . ($row['is_active'] ? 'Active' : 'Inactive') . '</td>
                          <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                More <span class="fa fa-caret-down"></span>
                                </button>
                              </button>
                              <ul class="dropdown-menu">
                                <li>
                                 <a class="download" href="../controls/download_contract_files.ctrl.php?id=' . htmlspecialchars($row['id']) . '"><i class="fa fa-eye"></i> Download</a>
                                </li>
                                <li>
                                  <a class="edit" href="#" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i> Edit</a>
                                </li>
                                <li>
                                  <a class="delete" href="#" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i> Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                       ';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- Add Contract Modal -->
      <div class="modal fade" id="addModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-plus"></i> Add Contract</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form enctype="multipart/form-data">
                <div class="form-group">
                  <label for="contractName">Contract Name <span style="color:red">*</span></label>
                  <input type="text" class="form-control" id="contractName" name="contractName" placeholder="Enter Contract Name" required>
                </div>
                <div class="form-group">
                  <label for="contractType">Type <span style="color:red">*</span></label>
                  <select class="form-control" id="contractType" name="contractType" required>
                    <option value="0" disabled selected>Choose ...</option>
                    <?php
                    $get_contract_type = new ContractType($db);

                    $get = $get_contract_type->get_contract_types();
                    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                      echo "<option value='" . $row['id'] . "'>" . $row['description'] . "</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="docfile">Upload File (.docx only) <span style="color:red">*</span></label>
                  <input type="file" class="form-control" id="docfile" name="docfile" accept=".docx" required>
                </div>
              </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button class="btn btn-success" id="submit">Submit</button>
            </div>

          </div>
        </div>
      </div>

      <!-- Edit Contract Modal -->
      <div class="modal fade" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Contract</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="edit_modalBody">
              <!-- content goes here -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button class="btn btn-success" id="update">Update</button>
            </div>

          </div>
        </div>
      </div>

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
  <!-- FastClick -->
  <script src="../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../vendors/nprogress/nprogress.js"></script>
  <!-- iCheck -->
  <script src="../vendors/iCheck/icheck.min.js"></script>
  <!-- Datatables -->
  <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="../vendors/jszip/dist/jszip.min.js"></script>
  <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
  <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
  <script src="../assets/js/contract.script.js"></script>

</body>

</html>