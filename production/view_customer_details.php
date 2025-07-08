<?php
session_start();

//IDS Connection
require_once '../config/dbconn.php';
require_once '../objects/contract_titling_monitoring.obj.php';
require_once '../objects/signatories.obj.php';

//MainDB Connection
require_once '../config/dbconn_main.php';
require_once '../objects/companies_main_db.obj.php';
require_once '../objects/projects_main_db.obj.php';

$database = new Connection();
$db = $database->connect();

$databaseMain = new ConnectionMain();
$dbMain = $databaseMain->connectMain();

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

    <title>SAS | View Customer Details</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../build/css/custom_switch.style.css">

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
                                <li><a><i class="fa fa-database"></i> Masters <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="company.php">Company</a></li>
                                        <li><a href="project.php">Project</a></li>
                                        <li><a href="contract.php">Contract</a></li>
                                        <li><a href="signatories.php">Signatories</a></li>
                                    </ul>
                                </li>
                                <li class="active"><a><i class="fa fa-edit"></i> Customer Data <span class="fa fa-chevron-down"></span></a>
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
                            <h5>Customer Data / <a href="customer_details.php">Customer Details</a> / <b><a href="view_customer_details.php">View</a></b></h5>
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
                                    <h2>Customer Details Form</h2>
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

                                    <!-- Add Project Form -->
                                    <!-- <p>Please fill in all required fields below. Enter "NA" if a field does not apply.</p>
                                    <br> -->

                                    <?php
                                    $get_customer_detail = new ContractTitlingMonitoring($db);

                                    $get_customer_detail->id = $_GET['id'];

                                    $get = $get_customer_detail->get_customer_details();
                                    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                         <form>
                                        <!-- Tabs Pane Start -->
                                        <ul class="nav nav-tabs" id="customerTabs" role="tablist">
                                            <li class="nav-item active">
                                                <a class="nav-link active" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="project-details" aria-selected="true">
                                                    Customer
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="house-info-tab" data-toggle="tab" href="#house-info" role="tab" aria-controls="house-info" aria-selected="false">
                                                    House
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab" aria-controls="pricing" aria-selected="false">
                                                    Pricing
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="technical-description-tab" data-toggle="tab" href="#technical-description" role="tab" aria-controls="technical-description" aria-selected="true">
                                                    Technical Description
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="co-borrower-tab" data-toggle="tab" href="#co-borrower" role="tab" aria-controls="co-borrower" aria-selected="false">
                                                    Co Borrower
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contract-monitoring-tab" data-toggle="tab" href="#contract-monitoring" role="tab" aria-controls="contract-monitoring" aria-selected="false">
                                                    Contract Monitoring
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="titling-monitoring-tab" data-toggle="tab" href="#titling-monitoring" role="tab" aria-controls="titling-monitoring" aria-selected="false">
                                                    Titling Monitoring
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="customerTabsContent" style="margin-bottom:20px;">
                                            <div class="tab-pane fade in active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">
                                                <!-- Add your Customer Info fields here -->
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="invoice-box" style="background:#fff;border:1px solid #eee;padding:30px;box-shadow:0 0 10px #eee;">
                                                            <div class="row">
                                                                <div class="col-xs-12 text-center" style="margin-bottom:20px;">
                                                                    <h3 style="margin:0;font-weight:bold;">Customer Details</h3>
                                                                    <small style="color:#888;">(Please fill in all required fields)</small>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered" style="margin-bottom:0;">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width:20%;">Customer Code <span style="color:red">*</span></th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_code" name="customer_code" value="' . $row['customer_code'] . '" readonly>
                                                                        </td>
                                                                        <th style="width:20%;">Customer Name</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="' . $row['customer_name'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Address</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_address" name="customer_address" value="' . $row['customer_address'] . '" readonly>
                                                                        </td>
                                                                        <th>Customer ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_id" name="customer_id" value="' . $row['customer_valid_id'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer TCT No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_tct_no" name="customer_tct_no" value="' . $row['customer_tct_no'] . '" readonly>
                                                                        </td>
                                                                        <th>Customer CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_ctc" name="customer_ctc" value="' . $row['customer_ctc'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer CTC Date</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_ctc_date" name="customer_ctc_date" value="' . $row['customer_ctc_date'] . '" readonly>
                                                                        </td>
                                                                        <th>Customer CTC Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_ctc_place" name="customer_ctc_place" value="' . $row['customer_ctc_place'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Civil Status</th>
                                                                        <td>
                                                                            <select class="form-control" id="civil_status" name="civil_status" disabled>
                                                                                <option value="0">' . $row['civil_status'] . '</option>
                                                                            </select>
                                                                        </td>
                                                                        <th>Citizenship</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="citizenship" name="citizenship" value="' . $row['citizenship'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Employment</th>
                                                                        <td>
                                                                            <select class="form-control" id="employment" name="employment" disabled>
                                                                                <option value="0" selected disabled>' . $row['employment'] . '</option>
                                                                            </select>
                                                                        </td>
                                                                        <th>Designation</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="designation" name="designation" value="' . $row['designation'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Company</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="company" name="company" value="' . $row['company'] . '" readonly>
                                                                        </td>
                                                                        <th>Contact No</th>
                                                                        <td>
                                                                            <input type="tel" class="form-control" id="contact_no" name="contact_no" pattern="^(09|\+639)\d{9}$" maxlength="13" placeholder="e.g. 09171234567" title="Please enter a mobile number (e.g. 09171234567 or +639171234567)" value="' . $row['contact_no'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Gender</th>
                                                                        <td>
                                                                            <select class="form-control" id="gender" name="gender" disabled>
                                                                                <option value="0" selected disabled>' . $row['gender'] . '</option>
                                                                            </select>
                                                                        </td>
                                                                        <th>Legality</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="legality" name="legality" value="' . $row['legality'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse" name="customer_spouse" value="' . $row['customer_spouse'] . '" readonly>
                                                                        </td>
                                                                        <th>Customer Spouse ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse_id" name="customer_spouse_id" value="' . $row['customer_spouse_id'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse_ctc" name="customer_spouse_ctc" value="' . $row['customer_spouse_ctc'] . '" readonly>
                                                                        </td>
                                                                        <th>Customer Spouse CTC Date</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse_ctc_date" name="customer_spouse_ctc_date" value="' . $row['customer_spouse_ctc_date'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse CTC Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse_ctc_place" name="customer_spouse_ctc_place" value="' . $row['customer_spouse_ctc_place'] . '" readonly>
                                                                        </td>
                                                                        <th>Customer Contact Company</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_contact_company" name="customer_contact_company" value="' . $row['customer_contact_company'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Contact Position</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_contact_position" name="customer_contact_position" value="' . $row['customer_contact_position'] . '" readonly>
                                                                        </td>
                                                                        <th>Customer Contact Address</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_contact_address" name="customer_contact_address" value="' . $row['customer_contact_address'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Income</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="income" name="income" value="' . $row['income'] . '" readonly>
                                                                        </td>
                                                                        <th>Birthdate</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="' . $row['birthdate'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Email</th>
                                                                        <td>
                                                                            <input type="email" class="form-control" id="email" name="email" value="' . $row['email'] . '" readonly>
                                                                        </td>
                                                                        <th></th>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="house-info" role="tabpanel" aria-labelledby="house-info-tab">
                                                <!-- Add your House Info fields here -->
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="invoice-box" style="background:#fff;border:1px solid #eee;padding:30px;box-shadow:0 0 10px #eee;">
                                                            <div class="row">
                                                                <div class="col-xs-12 text-center" style="margin-bottom:20px;">
                                                                    <h3 style="margin:0;font-weight:bold;">House Info</h3>
                                                                    <small style="color:#888;">(Please fill in all required fields)</small>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered" style="margin-bottom:0;">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width:20%;">Project <span style="color:red">*</span></th>
                                                                        <td>
                                                                            <select class="form-control" id="project_id" name="project" disabled>
                                                                                <option value="0">' . $row['project_name'] . '</option>
                                                                            </select>
                                                                        </td>
                                                                        <th style="width:20%;">House No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="house_no" name="house_no" value="' . $row['house_no'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Lot</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="lot" name="lot" value="' . $row['lot'] . '" readonly>
                                                                        </td>
                                                                        <th>Block</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="block" name="block" value="' . $row['block'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>House Type</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="house_type" name="house_type" value="' . $row['house_type'] . '" readonly>
                                                                        </td>
                                                                        <th>Lot Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="lot_area" name="lot_area" value="' . $row['lot_area'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Floor Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="floor_area" name="floor_area" value="' . $row['floor_area'] . '" readonly>
                                                                        </td>
                                                                        <th>Condo Type</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="condo_type" name="condo_type" value="' . $row['condo_type'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Unit No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="unit_no" name="unit_no" value="' . $row['unit_no'] . '" readonly>
                                                                        </td>
                                                                        <th>Unit Floor Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="unit_floor_area" name="unit_floor_area" value="' . $row['unit_floor_area'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Unit Floor</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="unit_floor" name="unit_floor" value="' . $row['unit_floor'] . '" readonly>
                                                                        </td>
                                                                        <th>Unit Floor SUP</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="unit_floor_sup" name="unit_floor_sup" value="' . $row['unit_floor_sup'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Unit</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_unit" name="parking_unit" value="' . $row['parking_unit'] . '" readonly>
                                                                        </td>
                                                                        <th>Parking Unit Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_unit_area" name="parking_unit_area" value="' . $row['parking_unit_area'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Title No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_title_no" name="parking_title_no" value="' . $row['parking_title_no'] . '" readonly>
                                                                        </td>
                                                                        <th>Parking Floor</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_floor" name="parking_floor" value="' . $row['parking_floor'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Floor SUP</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_floor_sup" name="parking_floor_sup" value="' . $row['parking_floor_sup'] . '" readonly>
                                                                        </td>
                                                                        <th></th>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="invoice-box" style="background:#fff;border:1px solid #eee;padding:30px;box-shadow:0 0 10px #eee;">
                                                            <div class="row">
                                                                <div class="col-xs-12 text-center" style="margin-bottom:20px;">
                                                                    <h3 style="margin:0;font-weight:bold;">Pricing</h3>
                                                                    <small style="color:#888;">(Please fill in all required fields)</small>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered" style="margin-bottom:0;">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width:25%;">Net Selling Price</th>
                                                                        <td style="width:25%;">
                                                                            <input type="text" class="form-control" id="net_selling_price" name="net_selling_price" placeholder="0.00" value="' . $row['net_selling_price'] . '" readonly>
                                                                        </td>
                                                                        <th style="width:20%;">Net Selling Price (in Words)</th>
                                                                        <td style="width:30%;">
                                                                            <input type="text" class="form-control" id="net_selling_price_word" name="net_selling_price_word" style="width:100%; min-width:300px;" value="' . $row['net_selling_price_word'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width:25%;">Equity</th>
                                                                        <td style="width:25%;">
                                                                            <input type="text" class="form-control" id="equity" name="equity" placeholder="0.00" value="' . $row['equity'] . '" readonly>
                                                                        </td>
                                                                        <th style="width:20%;">Equity (in Words)</th>
                                                                        <td style="width:30%;">
                                                                            <input type="text" class="form-control" id="equity_word" name="equity_word" style="width:100%; min-width:300px;" value="' . $row['equity_word'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Payment Term</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="payment_term" name="payment_term" value="' . $row['payment_term'] . '" readonly>
                                                                        </td>
                                                                        <th>Repricing</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="repricing" name="repricing" value="' . $row['repricing'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Loan Amount</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="loan_amount" name="loan_amount" value="' . $row['loan_amount'] . '" readonly>
                                                                        </td>
                                                                        <th>Loan Amount (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="loan_amount_word" name="loan_amount_word" style="width:100%; min-width:300px;" value="' . $row['loan_amount_word'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Loan Term</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="loan_term" name="loan_term" value="' . $row['loan_term'] . '" readonly>
                                                                        </td>
                                                                        <th>Loan Term (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="loan_term_word" name="loan_term_word" style="width:100%; min-width:300px;" value="' . $row['loan_term_word'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Pagibig Interest</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="pagibig_interest" name="pagibig_interest" value="' . $row['pagibig_interest'] . '" readonly>
                                                                        </td>
                                                                        <th>Pagibig Interest (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="pagibig_interest_word" name="pagibig_interest_word" style="width:100%; min-width:300px;" value="' . $row['pagibig_interest_word'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking NSP</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_nsp" name="parking_nsp" value="' . $row['parking_nsp'] . '" readonly>
                                                                        </td>
                                                                        <th>Parking NSP (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_nsp_word" name="parking_nsp_word" style="width:100%; min-width:300px;" value="' . $row['parking_nsp_word'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Processing Fee</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="processing_fee" name="processing_fee" value="' . $row['processing_fee'] . '" readonly>
                                                                        </td>
                                                                        <th>Processing Fee (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="processing_fee_word" name="processing_fee_word" style="width:100%; min-width:300px;" value="' . $row['processing_fee_word'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Regfees</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="regfees" name="regfees" value="' . $row['regfees'] . '" readonly>
                                                                        </td>
                                                                        <th>Admin Fee</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="admin_fee" name="admin_fee" value="' . $row['admin_fee'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Additional Work</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="additional_work" name="additional_work" value="' . $row['additional_work'] . '" readonly>
                                                                        </td>
                                                                        <th>Transfer Tax</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="transfer_tax" name="transfer_tax" value="' . $row['transfer_tax'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Docstamp Tax</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="docstamp_tax" name="docstamp_tax" value="' . $row['docstamp_tax'] . '" readonly>
                                                                        </td>
                                                                        <th></th>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- </div>
                                                </div> -->
                                            </div>

                                            <div class="tab-pane fade" id="technical-description" role="tabpanel" aria-labelledby="technical-description-tab">
                                                <!-- Add your Other Details fields here -->
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="invoice-box" style="background:#fff;border:1px solid #eee;padding:30px;box-shadow:0 0 10px #eee;">
                                                            <div class="row">
                                                                <div class="col-xs-12 text-center" style="margin-bottom:20px;">
                                                                    <h3 style="margin:0;font-weight:bold;">Technical Description</h3>
                                                                    <small style="color:#888;">(Please fill in all required fields)</small>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered" style="margin-bottom:0;">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width:25%;">Technical Description 1</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="technical_description_1" id="technical_description_1" rows="4" style="min-height:100px;" readonly>' . $row['technical_description_1'] . '</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Technical Description 2</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="technical_description_2" id="technical_description_2" rows="4" style="min-height:100px;" readonly>' . $row['technical_description_2'] . '</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>House Description</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="house_description" id="house_description" rows="4" style="min-height:100px;" readonly>' . $row['house_description'] . '</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Purpose</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="purpose" id="purpose" rows="4" style="min-height:100px;" readonly>' . $row['purpose'] . '</textarea>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="co-borrower" role="tabpanel" aria-labelledby="co-borrower-tab">
                                                <!-- Add your Other Details fields here -->
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="invoice-box" style="background:#fff;border:1px solid #eee;padding:30px;box-shadow:0 0 10px #eee;">
                                                            <div class="row">
                                                                <div class="col-xs-12 text-center" style="margin-bottom:20px;">
                                                                    <h3 style="margin:0;font-weight:bold;">Co Borrower</h3>
                                                                    <small style="color:#888;">(Please fill in all required fields)</small>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered" style="margin-bottom:0;">
                                                                <tbody>
                                                                    <!-- Co Borrower 1 -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Co Borrower 1</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width:25%;">Co Borrower Name</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_1" name="co_borrower_1" value="' . $row['co_borrower_name_1'] . '"  readonly>
                                                                        </td>
                                                                        <th style="width:25%;">Co Borrower ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_id_1" name="co_borrower_id_1" value="' . $row['co_borrower_id_1'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_spouse_1" name="co_borrower_spouse_1" value="' . $row['co_borrower_spouse_1'] . '" readonly>
                                                                        </td>
                                                                        <th>Co Borrower CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_ctc_1" name="co_borrower_ctc_1" value="' . $row['co_borrower_ctc_1'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Date Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_date_place_1" name="co_borrower_date_place_1" value="' . $row['co_borrower_date_place_1'] . '" readonly>
                                                                        </td>
                                                                        <th></th>
                                                                        <td></td>
                                                                    </tr>
                                                                    <!-- Co Borrower 2 -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Co Borrower 2</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Name</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_2" name="co_borrower_2" value="' . $row['co_borrower_name_2'] . '" readonly>
                                                                        </td>
                                                                        <th>Co Borrower ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_id_2" name="co_borrower_id_2" value="' . $row['co_borrower_id_2'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_spouse_2" name="co_borrower_spouse_2" value="' . $row['co_borrower_spouse_2'] . '" readonly>
                                                                        </td>
                                                                        <th>Co Borrower CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_ctc_2" name="co_borrower_ctc_2" value="' . $row['co_borrower_ctc_2'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Date Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_date_place_2" name="co_borrower_date_place_2" value="' . $row['co_borrower_date_place_2'] . '" readonly>
                                                                        </td>
                                                                        <th></th>
                                                                        <td></td>
                                                                    </tr>
                                                                    <!-- Witnesses -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Witnesses</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Witness A</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="witness_a" name="witness_a" value="' . $row['witness_a'] . '" readonly>
                                                                        </td>
                                                                        <th>Witness B</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="witness_b" name="witness_b" value="' . $row['witness_b'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="contract-monitoring" role="tabpanel" aria-labelledby="contract-monitoring-tab">
                                                <!-- Add your Other Details fields here -->
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="invoice-box" style="background:#fff;border:1px solid #eee;padding:30px;box-shadow:0 0 10px #eee;">
                                                            <div class="row">
                                                                <div class="col-xs-12 text-center" style="margin-bottom:20px;">
                                                                    <h3 style="margin:0;font-weight:bold;">Contracts</h3>
                                                                    <small style="color:#888;">(Please fill in all required fields)</small>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered" style="margin-bottom:0;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Contract Name</th>
                                                                        <th class="text-center">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>';
                                        $get_contract_monitoring = new ContractTitlingMonitoring($db);

                                        $get_contract_monitoring->id = $row['project_id'];

                                        $get = $get_contract_monitoring->get_contract_monitorings();
                                        while ($row2 = $get->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                            <tr>
                                            <td class="text-center">' . htmlspecialchars($row2['contract_name']) . '</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-success open-signatories-modal btn-xs" data-custom-id="' . htmlspecialchars($row['custom_id']) . '" data-contract-id="' . htmlspecialchars($row2['id']) . '"> Create Contract</a>
                                            </td>
                                            </tr>
                                            ';
                                        }
                                        echo '</tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="titling-monitoring" role="tabpanel" aria-labelledby="titling-monitoring-tab">
                                                <!-- Add your Other Details fields here -->
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <div class="invoice-box" style="background:#fff;border:1px solid #eee;padding:30px;box-shadow:0 0 10px #eee;">
                                                            <div class="row">
                                                                <div class="col-xs-12 text-center" style="margin-bottom:20px;">
                                                                    <h3 style="margin:0;font-weight:bold;">Titling Monitoring</h3>
                                                                    <small style="color:#888;">(Please fill in all required fields)</small>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered" style="margin-bottom:0;">
                                                                <tbody>
                                                                    <!-- BIR Processing -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Car Processing</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width:30%;">Submitted to BIR</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="submitted_to_bir" name="submitted_to_bir" value="' . $row['submitted_to_bir'] . '" readonly>
                                                                        </td>
                                                                        <th style="width:30%;">BIR Actual Release</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="bir_actual_release" name="bir_actual_release" value="' . $row['bir_actual_release'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (CAR Processing 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="car_process_remarks1" name="car_process_remarks1" value="' . $row['remarks_car_processing_1'] . '" readonly>
                                                                        </td>
                                                                        <th>Actual Dockets Preparation for RD</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="actual_dockets_preparation_for_RD" name="actual_dockets_preparation_for_RD" value="' . $row['actual_dockets_preparation_for_rd'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (CAR Processing 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="car_process_remarks2" name="car_process_remarks2" value="' . $row['remarks_car_processing_2'] . '" readonly>
                                                                        </td>
                                                                    </tr>

                                                                    <!-- RD Assessment -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">RD Assessment</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Preparation of Docket for RD</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="actual_preparation_of_docket_for_rd" name="actual_preparation_of_docket_for_rd" value="' . $row['actual_preparation_of_docket_for_rd'] . '" readonly>
                                                                        </td>
                                                                        <th>Remarks (RD Assessment 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="rd_assessment_remarks1" name="rd_assessment_remarks1" value="' . $row['remarks_rd_assessment_1'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Submitted to RD for Assessment</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="actual_submitted_to_rd_for_assessment" name="actual_submitted_to_rd_for_assessment" value="' . $row['actual_submitted_to_rd_for_assessment'] . '" readonly>
                                                                        </td>
                                                                        <th>Actual Release of RD Assessment</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="actual_release_of_rd_assessment" name="actual_release_of_rd_assessment" value="' . $row['actual_release_of_rd_assessment'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (RD Assessment 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="rd_assessment_remarks2" name="rd_assessment_remarks2" value="' . $row['remarks_rd_assessment_2'] . '" readonly>
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Check Processing -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Check Processing</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>RD Assessment Received</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="rd_assessment_received" name="rd_assessment_received" value="' . $row['rd_assessment_received'] . '" readonly>
                                                                        </td>
                                                                        <th>RCP Processed/Signed</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="rcp_processed_signed" name="rcp_processed_signed" value="' . $row['rcp_processed_signed'] . '" readonly>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Accounting Received RCP for M Check</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="accounting_received_rcp_for_m_check" name="accounting_received_rcp_for_m_check" value="' . $row['accounting_received_rcp_for_m_check'] . '" readonly>
                                                                        </td>
                                                                        <th>Accounting Processed M Check</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="accounting_processed_m_check" name="accounting_processed_m_check" value="' . $row['accounting_processed_m_check'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Accounting M. Check for Released</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="accounting_m_check_for_released" name="accounting_m_check_for_released" value="' . $row['accounting_m_check_for_released'] . '" readonly>
                                                                        </td>
                                                                        <th>Remarks (Check Processing 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="check_process_remarks1" name="check_process_remarks1" value="' . $row['remarks_check_processing_1'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>M Check Received</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="m_check_received" name="m_check_received" value="' . $row['m_check_received'] . '" readonly>
                                                                        </td>
                                                                        <th>Remarks (Check Processing 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="check_process_remarks2" name="check_process_remarks2" value="' . $row['remarks_check_processing_2'] . '" readonly>
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Submission for title -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Submission for Title</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Date submitted to RD</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="date_submitted_to_rd" name="date_submitted_to_rd" value="' . $row['date_submitted_to_rd'] . '" readonly>
                                                                        </td>
                                                                        <th>Estimated Date of Release</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="estimated_date_of_release" name="estimated_date_of_release" value="' . $row['estimated_date_of_release'] . '" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Date Released</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="actual_date_released" name="actual_date_released" value="' . $row['actual_date_released'] . '" readonly>
                                                                        </td>
                                                                        <th></th>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Tabs Pane End -->

                                        <div class="text-center" style="margin-top:20px;">
                                            <a href="customer_details.php" class="btn btn-primary btn-md"><i class="fa fa-arrow-left"></i> Go Back</a>
                                        </div>
                                    </form>
                                    <!-- End Add Company Form -->
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

            <!-- Modal for Create Signatories -->
            <div class="modal fade" id="selectSignatoriesModal" tabindex="-1" role="dialog" aria-labelledby="selectSignatoriesModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <form id="signatoriesForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> <i class="fa fa-pencil" aria-hidden="true" style="margin-right:5px;"></i>Create Contract</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="company_main">
                                            <i class="fa fa-building" aria-hidden="true" style="margin-right:5px;"></i>Company <span style="color:red">*</span>
                                        </label>
                                        <select id="company_main" name="company_main" class="form-control" style="width:100%;">
                                            <option value="0" selected disabled>Choose company...</option>
                                            <?php
                                            $get_company = new CompaniesMainDB($dbMain);
                                            $get_com = $get_company->get_companies();

                                            while ($row4 = $get_com->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row4['id'] . '">' . $row4['comp_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="projects_main">
                                            <i class="fa fa-building" aria-hidden="true" style="margin-right:5px;"></i>Project <span style="color:red">*</span>
                                        </label>
                                        <select id="projects_main" name="projects_main" class="form-control" style="width:100%;">
                                            <option value="0" selected disabled>Choose project...</option>
                                            <?php
                                            $get_project = new ProjectsMainDB($dbMain);
                                            $get_proj = $get_project->get_projects();

                                            while ($row5 = $get_proj->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row5['id'] . '">' . $row5['proj_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="signatories">
                                            <i class="fa fa-users" aria-hidden="true" style="margin-right:5px;"></i>Signatories <small>(<b>NOTE:</b> Please Select 2 Signatories)</small> <span style="color:red">*</span>
                                        </label>
                                        <select id="signatories" name="signatories" class="form-control" multiple="multiple" style="width:100%;">
                                            <?php
                                            $get_signatory = new Signatories($db);
                                            $get = $get_signatory->get_signatories();

                                            while ($row3 = $get->fetch(PDO::FETCH_ASSOC)) {
                                                echo '<option value="' . $row3['id'] . '">' . $row3['company_person'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center" style="width:100%;">
                                    <a class="btn btn-success btn-sm" id="downloadSignatoriesBtn">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- jQuery Smart Wizard -->
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
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
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script src="../assets/js/customer_details.script.js"></script>
</body>

</html>