<?php
session_start();

require_once '../config/dbconn.php';
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

    <title>SAS | Edit Company</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <style>
        .right_col {
            height: 0px !important;
        }
    </style>

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
                            <h5>Masters / <a href="company.php">Company</a> / <b><a href="#">Edit</a></b></h5>
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

                                    <?php
                                    $edit_company = new Company($db);

                                    $edit_company->id = $_GET['id'];

                                    $edit = $edit_company->get_companys();

                                    while ($row = $edit->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                        <!-- Edit Company Form -->
                                        <p><strong>NOTE</strong>: Fields marked with a red asterisk (<span style="color: red">*</span>) are required. Please complete them before submitting.</p>
                                        <br>
                                        <form>
                                            <div class="panel panel-default">
                                            <div class="panel-heading"><strong><span class="fa fa-building"></span> Company Details</strong></div>
                                            <div class="panel-body">
                                                <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="company_code">Company Code <span style="color:red">*</span></label>
                                                    <input type="text" id="upd_id" name="upd_id" value="' . $row['id'] . '" hidden>
                                                    <input type="text" class="form-control" id="upd_company_code" name="company_code" value="' . $row['company_code'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="company_name">Company Name <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" id="upd_company_name" name="company_name" value="' . $row['company_name'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="company_address">Company Address <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" id="upd_company_address" name="company_address" value="' . $row['company_address'] . '">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="city_notary">City Notary</label>
                                                    <input type="text" class="form-control" id="upd_city_notary" name="city_notary" value="' . $row['city_notary'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="company_city">Company City</label>
                                                    <input type="text" class="form-control" id="upd_company_city" name="company_city" value="' . $row['company_city'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="company_tin">Company TIN</label>
                                                    <input type="text" class="form-control" id="upd_company_tin" name="company_tin" value="' . $row['company_tin'] . '">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="company_ctc">Company CTC</label>
                                                    <input type="text" class="form-control" id="upd_company_ctc" name="company_ctc" value="' . $row['company_ctc'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="company_ctc_date">Company CTC Date</label>
                                                    <input type="date" class="form-control" id="upd_company_ctc_date" name="company_ctc_date" value="' . $row['company_ctc_date'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="company_ctc_place">Company CTC Place</label>
                                                    <input type="text" class="form-control" id="upd_company_ctc_place" name="company_ctc_place" value="' . $row['company_ctc_place'] . '">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="panel panel-default">
                                            <div class="panel-heading"><strong><span class="fa fa-users"></span> Company Personnels</strong></div>
                                            <div class="panel-body">
                                                <div class="row">
                                                <!-- Personnel A -->
                                                <div class="col-md-6">
                                                    <fieldset style="border:1px solid #ddd; padding:15px; border-radius:10px;">
                                                    <legend style="font-size:16px; font-weight:bold;"><span class="fa fa-user"></span> Personnel A</legend>
                                                    <div class="form-group">
                                                        <label for="company_person_a">Company Person</label>
                                                        <input type="text" class="form-control" id="upd_company_person_a" name="company_person_a" value="' . $row['company_person_a'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company_position_a">Company Position</label>
                                                        <input type="text" class="form-control" id="upd_company_position_a" name="company_position_a" value="' . $row['company_position_a'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company_person_tin_a">Company Person TIN</label>
                                                        <input type="text" class="form-control" id="upd_company_person_tin_a" name="company_person_tin_a" value="' . $row['company_person_tin_a'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="person_ctc_a">Person CTC</label>
                                                        <input type="text" class="form-control" id="upd_person_ctc_a" name="person_ctc_a" value="' . $row['person_ctc_a'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="person_ctc_date_place_a">Person CTC Date Place</label>
                                                        <input type="text" class="form-control" id="upd_person_ctc_date_place_a" name="person_ctc_date_place_a" value="' . $row['person_ctc_date_place_a'] . '">
                                                    </div>
                                                    </fieldset>
                                                </div>
                                                <!-- Personnel B -->
                                                <div class="col-md-6">
                                                    <fieldset style="border:1px solid #ddd; padding:15px; border-radius:10px;">
                                                    <legend style="font-size:16px; font-weight:bold;"><span class="fa fa-user"></span> Personnel B</legend>
                                                    <div class="form-group">
                                                        <label for="company_person_b">Company Name</label>
                                                        <input type="text" class="form-control" id="upd_company_person_b" name="company_person_b" value="' . $row['company_person_b'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company_position_b">Company Position</label>
                                                        <input type="text" class="form-control" id="upd_company_position_b" name="company_position_b" value="' . $row['company_position_b'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company_person_tin_b">Company Person TIN</label>
                                                        <input type="text" class="form-control" id="upd_company_person_tin_b" name="company_person_tin_b" value="' . $row['company_person_tin_b'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="person_ctc_b">Person CTC</label>
                                                        <input type="text" class="form-control" id="upd_person_ctc_b" name="person_ctc_b" value="' . $row['person_ctc_b'] . '">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="person_ctc_date_place_b">Person CTC Date Place</label>
                                                        <input type="text" class="form-control" id="upd_person_ctc_date_place_b" name="person_ctc_date_place_b" value="' . $row['person_ctc_date_place_b'] . '">
                                                    </div>
                                                    </fieldset>
                                                </div>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="panel panel-default">
                                            <div class="panel-heading"><strong><span class="fa fa-user"></span> Pag-Ibig Personnel</strong></div>
                                            <div class="panel-body">
                                                <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="pagibig_person">Pag-Ibig Person</label>
                                                    <input type="text" class="form-control" id="upd_pagibig_person" name="pagibig_person" value="' . $row['pagibig_person'] . '">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="pagibig_address">Pag-Ibig Address</label>
                                                    <input type="text" class="form-control" id="upd_pagibig_address" name="pagibig_address" value="' . $row['pagibig_address'] . '">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="pagibig_position">Pag-Ibig Position</label>
                                                    <input type="text" class="form-control" id="upd_pagibig_position" name="pagibig_position" value="' . $row['pagibig_position'] . '">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="text-center">
                                            <button type="submit" class="btn btn-success btn-md update"><i class="fa fa-save"></i> Update</button>
                                            <button type="reset" class="btn btn-default btn-md"><i class="fa fa-undo"></i> Reset</button>
                                            </div>
                                        </form>
                                        <!-- End Edit Company Form -->
                                        ';
                                    }

                                    ?>
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
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script src="../assets/js/company.script.js"></script>
</body>

</html>