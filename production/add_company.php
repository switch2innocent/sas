<?php
session_start();

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

  <title>IDS | Add Company</title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

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
              <h5>Masters / <a href="company.php">Company</a> / <b><a href="add_company.php">Add</a></b></h5>
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
                  <h2>Company Form</h2>
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

                  <!-- Add Company Form -->
                  <p>Please fill in all required fields below. Enter "NA" if a field does not apply.</p>
                  <br>
                  <form>
                    <div class="panel panel-default">
                      <div class="panel-heading"><strong>Company Details</strong></div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="company_code">Company Code <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="company_code" name="company_code" required>
                            </div>
                            <div class="form-group">
                              <label for="company_name">Company Name <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="company_name" name="company_name" required>
                            </div>
                            <div class="form-group">
                              <label for="company_address">Company Address <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="company_address" name="company_address" required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="city_notary">City Notary <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="city_notary" name="city_notary" required>
                            </div>
                            <div class="form-group">
                              <label for="company_city">Company City <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="company_city" name="company_city" required>
                            </div>
                            <div class="form-group">
                              <label for="company_tin">Company TIN <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="company_tin" name="company_tin" required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="company_ctc">Company CTC <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="company_ctc" name="company_ctc" required>
                            </div>
                            <div class="form-group">
                              <label for="company_ctc_date">Company CTC Date <span style="color:red">*</span></label>
                              <input type="date" class="form-control" id="company_ctc_date" name="company_ctc_date" required>
                            </div>
                            <div class="form-group">
                              <label for="company_ctc_place">Company CTC Place <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="company_ctc_place" name="company_ctc_place" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading"><strong>Company Personnels</strong></div>
                      <div class="panel-body">
                        <div class="row">
                          <!-- Personnel A -->
                          <div class="col-md-6">
                            <fieldset style="border:1px solid #ddd; padding:15px; border-radius:10px;">
                              <legend style="font-size:16px; font-weight:bold;">Personnel A</legend>
                              <div class="form-group">
                                <label for="company_person_a">Company Person <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="company_person_a" name="company_person_a" required>
                              </div>
                              <div class="form-group">
                                <label for="company_position_a">Company Position <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="company_position_a" name="company_position_a" required>
                              </div>
                              <div class="form-group">
                                <label for="company_person_tin_a">Company Person TIN <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="company_person_tin_a" name="company_person_tin_a" required>
                              </div>
                              <div class="form-group">
                                <label for="person_ctc_a">Person CTC <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="person_ctc_a" name="person_ctc_a" required>
                              </div>
                              <div class="form-group">
                                <label for="person_ctc_date_place_a">Person CTC Date Place <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="person_ctc_date_place_a" name="person_ctc_date_place_a" required>
                              </div>
                            </fieldset>
                          </div>
                          <!-- Personnel B -->
                          <div class="col-md-6">
                            <fieldset style="border:1px solid #ddd; padding:15px; border-radius:10px;">
                              <legend style="font-size:16px; font-weight:bold;">Personnel B</legend>
                              <div class="form-group">
                                <label for="company_person_b">Company Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="company_person_b" name="company_person_b" required>
                              </div>
                              <div class="form-group">
                                <label for="company_position_b">Company Position <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="company_position_b" name="company_position_b" required>
                              </div>
                              <div class="form-group">
                                <label for="company_person_tin_b">Company Person TIN <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="company_person_tin_b" name="company_person_tin_b" required>
                              </div>
                              <div class="form-group">
                                <label for="person_ctc_b">Person CTC <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="person_ctc_b" name="person_ctc_b" required>
                              </div>
                              <div class="form-group">
                                <label for="person_ctc_date_place_b">Person CTC Date Place <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="person_ctc_date_place_b" name="person_ctc_date_place_b" required>
                              </div>
                            </fieldset>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading"><strong>Pag-Ibig Personnel</strong></div>
                      <div class="panel-body">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="pagibig_person">Pag-Ibig Person <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="pagibig_person" name="pagibig_person" required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="pagibig_address">Pag-Ibig Address <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="pagibig_address" name="pagibig_address" required>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="pagibig_position">Pag-Ibig Position <span style="color:red">*</span></label>
                              <input type="text" class="form-control" id="pagibig_position" name="pagibig_position" required>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-success btn-md buttonFinish"><i class="fa fa-save"></i> Save</button>
                      <button type="reset" class="btn btn-default btn-md"><i class="fa fa-undo"></i> Reset</button>
                    </div>
                  </form>
                  <!-- End Add Company Form -->
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
  <!-- FastClick -->
  <script src="../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../vendors/nprogress/nprogress.js"></script>
  <!-- jQuery Smart Wizard -->
  <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>

  <script src="../assets/js/company.script.js"></script>
</body>

</html>