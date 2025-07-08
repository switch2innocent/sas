<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/contract_titling_monitoring.obj.php';
require_once '../objects/project.obj.php';

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

    <title>SAS | Edit Customer Details</title>

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
                            <h5>Customer Data / <a href="customer_details.php">Customer Details</a> / <b><a href="edit_customer_details.php">Edit</a></b></h5>
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
                                                                            <input type="test" id="upd_custom_id" value="' . $row['custom_id'] . '" hidden>
                                                                            <input type="test" id="upd_house_id" value="' . $row['house_id'] . '" hidden>
                                                                            <input type="test" id="upd_cont_tit_id" value="' . $row['cont_tit_id'] . '" hidden>
                                                                            <input type="text" class="form-control" id="upd_customer_code" name="upd_customer_code" value="' . $row['customer_code'] . '" readonly>
                                                                        </td>
                                                                        <th style="width:20%;">Customer Name</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_name" name="upd_customer_name" value="' . $row['customer_name'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Address</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_address" name="upd_customer_address" value="' . $row['customer_address'] . '">
                                                                        </td>
                                                                        <th>Customer ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_id" name="upd_customer_id" value="' . $row['customer_valid_id'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer TCT No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_tct_no" name="upd_customer_tct_no" value="' . $row['customer_tct_no'] . '">
                                                                        </td>
                                                                        <th>Customer CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_ctc" name="upd_customer_ctc" value="' . $row['customer_ctc'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer CTC Date</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_ctc_date" name="upd_customer_ctc_date" value="' . $row['customer_ctc_date'] . '">
                                                                        </td>
                                                                        <th>Customer CTC Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_ctc_place" name="upd_customer_ctc_place" value="' . $row['customer_ctc_place'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Civil Status</th>
                                                                        <td>
                                                                            <select class="form-control" id="upd_civil_status" name="upd_civil_status">
                                                                            <option value="' . $row['civil_status'] . '" selected hidden>' . $row['civil_status'] . '</option>';
                                        $statuses = ['Single', 'Married', 'Widowed', 'Separated', 'Divorced'];
                                        foreach ($statuses as $status) {
                                            if ($status !== $row['civil_status']) {
                                                echo '<option value="' . $status . '">' . $status . '</option>';
                                            }
                                        }
                                        echo '</select>
                                                                           </td>
                                                                        <th>Citizenship</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_citizenship" name="upd_citizenship" value="' . $row['citizenship'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Employment</th>
                                                                        <td>
                                                                            <select class="form-control" id="upd_employment" name="upd_employment">
                                                                                <option value="' . $row['employment'] . '" selected hidden>' . $row['employment'] . '</option>';
                                        $employments = ['Local', 'Employed', 'Retired', 'OFW'];
                                        foreach ($employments as $employement) {
                                            if ($employement !== $row['employment']) {
                                                echo '<option value="' . $employement . '">' . $employement . '</option>';
                                            }
                                        }
                                        echo '</select>
                                                                        </td>
                                                                        <th>Designation</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_designation" name="upd_designation" value="' . $row['designation'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Company</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_company" name="upd_company" value="' . $row['company'] . '">
                                                                        </td>
                                                                        <th>Contact No</th>
                                                                        <td>
                                                                            <input type="tel" class="form-control" id="upd_contact_no" name="upd_contact_no" pattern="^(09|\+639)\d{9}$" maxlength="13" placeholder="e.g. 09171234567" title="Please enter a mobile number (e.g. 09171234567 or +639171234567)" value="' . $row['contact_no'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Gender</th>
                                                                        <td>
                                                                            <select class="form-control" id="upd_gender" name="upd_gender">
                                                                                <option value="' . $row['gender'] . '" selected hidden>' . $row['gender'] . '</option>';
                                        $genders = ['Male', 'Female'];
                                        foreach ($genders as $gender) {
                                            if ($gender !== $row['gender']) {
                                                echo '<option value="' . $gender . '">' . $gender . '</option>';
                                            }
                                        }
                                        echo '</select>
                                                                        </td>
                                                                        <th>Legality</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_legality" name="upd_legality" value="' . $row['legality'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_spouse" name="upd_customer_spouse" value="' . $row['customer_spouse'] . '">
                                                                        </td>
                                                                        <th>Customer Spouse ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_spouse_id" name="upd_customer_spouse_id" value="' . $row['customer_spouse_id'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_spouse_ctc" name="upd_customer_spouse_ctc" value="' . $row['customer_spouse_ctc'] . '">
                                                                        </td>
                                                                        <th>Customer Spouse CTC Date</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_spouse_ctc_date" name="upd_customer_spouse_ctc_date" value="' . $row['customer_spouse_ctc_date'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse CTC Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_spouse_ctc_place" name="upd_customer_spouse_ctc_place" value="' . $row['customer_spouse_ctc_place'] . '">
                                                                        </td>
                                                                        <th>Customer Contact Company</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_contact_company" name="upd_customer_contact_company" value="' . $row['customer_contact_company'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Contact Position</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_contact_position" name="upd_customer_contact_position" value="' . $row['customer_contact_position'] . '">
                                                                        </td>
                                                                        <th>Customer Contact Address</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_customer_contact_address" name="upd_customer_contact_address" value="' . $row['customer_contact_address'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Income</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_income" name="upd_income" value="' . $row['income'] . '">
                                                                        </td>
                                                                        <th>Birthdate</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="upd_birthdate" name="upd_birthdate" value="' . $row['birthdate'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Email</th>
                                                                        <td>
                                                                            <input type="email" class="form-control" id="upd_email" name="upd_email" value="' . $row['email'] . '">
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
                                                                            <select class="form-control" id="upd_project_id" name="project">
                                                                                <option value="' . $row['project_id'] . '" selected hidden>' . $row['project_name'] . '</option>';
                                        $get_project_name = new Project($db);

                                        $get = $get_project_name->get_project_names();
                                        while ($row2 = $get->fetch(PDO::FETCH_ASSOC)) {
                                            if ($row['project_name'] !== $row2['project_name']) {
                                                echo '<option value="' . $row2['id'] . '">' . $row2['project_name'] . '</option>';
                                            }
                                        }
                                        echo '</select>
                                                                        </td>
                                                                        <th style="width:20%;">House No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_house_no" name="upd_house_no" value="' . $row['house_no'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Lot</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_lot" name="upd_lot" value="' . $row['lot'] . '">
                                                                        </td>
                                                                        <th>Block</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_block" name="upd_block" value="' . $row['block'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>House Type</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_house_type" name="upd_house_type" value="' . $row['house_type'] . '">
                                                                        </td>
                                                                        <th>Lot Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_lot_area" name="upd_lot_area" value="' . $row['lot_area'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Floor Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_floor_area" name="upd_floor_area" value="' . $row['floor_area'] . '">
                                                                        </td>
                                                                        <th>Condo Type</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_condo_type" name="upd_condo_type" value="' . $row['condo_type'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Unit No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_unit_no" name="upd_unit_no" value="' . $row['unit_no'] . '">
                                                                        </td>
                                                                        <th>Unit Floor Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_unit_floor_area" name="upd_unit_floor_area" value="' . $row['unit_floor_area'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Unit Floor</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_unit_floor" name="upd_unit_floor" value="' . $row['unit_floor'] . '">
                                                                        </td>
                                                                        <th>Unit Floor SUP</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_unit_floor_sup" name="upd_unit_floor_sup" value="' . $row['unit_floor_sup'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Unit</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_parking_unit" name="upd_parking_unit" value="' . $row['parking_unit'] . '">
                                                                        </td>
                                                                        <th>Parking Unit Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_parking_unit_area" name="upd_parking_unit_area" value="' . $row['parking_unit_area'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Title No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_parking_title_no" name="upd_parking_title_no" value="' . $row['parking_title_no'] . '">
                                                                        </td>
                                                                        <th>Parking Floor</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_parking_floor" name="upd_parking_floor" value="' . $row['parking_floor'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Floor SUP</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_parking_floor_sup" name="upd_parking_floor_sup" value="' . $row['parking_floor_sup'] . '">
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
                                                                            <input type="text" class="form-control" id="upd_net_selling_price" name="upd_net_selling_price" placeholder="0.00" value="' . $row['net_selling_price'] . '">
                                                                        </td>
                                                                        <th style="width:20%;">Net Selling Price (in Words)</th>
                                                                        <td style="width:30%;">
                                                                            <input type="text" class="form-control" id="upd_net_selling_price_word" name="upd_net_selling_price_word" style="width:100%; min-width:300px;" value="' . $row['net_selling_price_word'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width:25%;">Equity</th>
                                                                        <td style="width:25%;">
                                                                            <input type="text" class="form-control" id="upd_equity" name="upd_equity" placeholder="0.00" value="' . $row['equity'] . '">
                                                                        </td>
                                                                        <th style="width:20%;">Equity (in Words)</th>
                                                                        <td style="width:30%;">
                                                                            <input type="text" class="form-control" id="upd_equity_word" name="upd_equity_word" style="width:100%; min-width:300px;" value="' . $row['equity_word'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Payment Term</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_payment_term" name="upd_payment_term" value="' . $row['payment_term'] . '">
                                                                        </td>
                                                                        <th>Repricing</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_repricing" name="upd_repricing" value="' . $row['repricing'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Loan Amount</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_loan_amount" name="upd_loan_amount" value="' . $row['loan_amount'] . '">
                                                                        </td>
                                                                        <th>Loan Amount (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_loan_amount_word" name="upd_loan_amount_word" style="width:100%; min-width:300px;" value="' . $row['loan_amount_word'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Loan Term</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_loan_term" name="upd_loan_term" value="' . $row['loan_term'] . '">
                                                                        </td>
                                                                        <th>Loan Term (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_loan_term_word" name="upd_loan_term_word" style="width:100%; min-width:300px;" value="' . $row['loan_term_word'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Pagibig Interest</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_pagibig_interest" name="upd_pagibig_interest" value="' . $row['pagibig_interest'] . '">
                                                                        </td>
                                                                        <th>Pagibig Interest (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_pagibig_interest_word" name="upd_pagibig_interest_word" style="width:100%; min-width:300px;" value="' . $row['pagibig_interest_word'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking NSP</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_parking_nsp" name="upd_parking_nsp" value="' . $row['parking_nsp'] . '">
                                                                        </td>
                                                                        <th>Parking NSP (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_parking_nsp_word" name="upd_parking_nsp_word" style="width:100%; min-width:300px;" value="' . $row['parking_nsp_word'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Processing Fee</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_processing_fee" name="upd_processing_fee" value="' . $row['processing_fee'] . '">
                                                                        </td>
                                                                        <th>Processing Fee (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_processing_fee_word" name="upd_processing_fee_word" style="width:100%; min-width:300px;" value="' . $row['processing_fee_word'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Regfees</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_regfees" name="upd_regfees" value="' . $row['regfees'] . '">
                                                                        </td>
                                                                        <th>Admin Fee</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_admin_fee" name="upd_admin_fee" value="' . $row['admin_fee'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Additional Work</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_additional_work" name="upd_additional_work" value="' . $row['additional_work'] . '">
                                                                        </td>
                                                                        <th>Transfer Tax</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_transfer_tax" name="upd_transfer_tax" value="' . $row['transfer_tax'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Docstamp Tax</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_docstamp_tax" name="upd_docstamp_tax" value="' . $row['docstamp_tax'] . '">
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
                                                                            <textarea class="form-control" name="upd_technical_description_1" id="upd_technical_description_1" rows="4" style="min-height:100px;">' . $row['technical_description_1'] . '</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Technical Description 2</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="upd_technical_description_2" id="upd_technical_description_2" rows="4" style="min-height:100px;">' . $row['technical_description_2'] . '</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>House Description</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="upd_house_description" id="upd_house_description" rows="4" style="min-height:100px;">' . $row['house_description'] . '</textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Purpose</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="upd_purpose" id="upd_purpose" rows="4" style="min-height:100px;">' . $row['purpose'] . '</textarea>
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
                                                                            <input type="text" class="form-control" id="upd_co_borrower_1" name="upd_co_borrower_1" value="' . $row['co_borrower_name_1'] . '" >
                                                                        </td>
                                                                        <th style="width:25%;">Co Borrower ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_co_borrower_id_1" name="upd_co_borrower_id_1" value="' . $row['co_borrower_id_1'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_co_borrower_spouse_1" name="upd_co_borrower_spouse_1" value="' . $row['co_borrower_spouse_1'] . '">
                                                                        </td>
                                                                        <th>Co Borrower CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_co_borrower_ctc_1" name="upd_co_borrower_ctc_1" value="' . $row['co_borrower_ctc_1'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Date Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_co_borrower_date_place_1" name="upd_co_borrower_date_place_1" value="' . $row['co_borrower_date_place_1'] . '">
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
                                                                            <input type="text" class="form-control" id="upd_co_borrower_2" name="upd_co_borrower_2" value="' . $row['co_borrower_name_2'] . '">
                                                                        </td>
                                                                        <th>Co Borrower ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_co_borrower_id_2" name="upd_co_borrower_id_2" value="' . $row['co_borrower_id_2'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_co_borrower_spouse_2" name="upd_co_borrower_spouse_2" value="' . $row['co_borrower_spouse_2'] . '">
                                                                        </td>
                                                                        <th>Co Borrower CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_co_borrower_ctc_2" name="upd_co_borrower_ctc_2" value="' . $row['co_borrower_ctc_2'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Date Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_co_borrower_date_place_2" name="upd_co_borrower_date_place_2" value="' . $row['co_borrower_date_place_2'] . '">
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
                                                                            <input type="text" class="form-control" id="upd_witness_a" name="upd_witness_a" value="' . $row['witness_a'] . '">
                                                                        </td>
                                                                        <th>Witness B</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_witness_b" name="upd_witness_b" value="' . $row['witness_b'] . '">
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

                                        $get_contract_monitoring->id = 0;

                                        // $row['project_id'];

                                        $get = $get_contract_monitoring->get_contract_monitorings();
                                        while ($row2 = $get->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                            <tr>
                                            <td class="text-center">' . htmlspecialchars($row2['contract_name']) . '</td>
                                            <td class="text-center">
                                                <a class="download" href="../controls/download_contract_monitoring.ctrl.php?customer_id=' . htmlspecialchars($row['customer_id']) . '&contract_id=' . htmlspecialchars($row2['id']) . '">
                                                <i class="fa fa-download"></i> Download</a>
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
                                                                            <input type="date" class="form-control" id="upd_submitted_to_bir" name="upd_submitted_to_bir" value="' . $row['submitted_to_bir'] . '">
                                                                        </td>
                                                                        <th style="width:30%;">BIR Actual Release</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="upd_bir_actual_release" name="upd_bir_actual_release" value="' . $row['bir_actual_release'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (CAR Processing 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_car_process_remarks1" name="upd_car_process_remarks1" value="' . $row['remarks_car_processing_1'] . '">
                                                                        </td>
                                                                        <th>Actual Dockets Preparation for RD</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="upd_actual_dockets_preparation_for_RD" name="upd_actual_dockets_preparation_for_RD" value="' . $row['actual_dockets_preparation_for_rd'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (CAR Processing 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_car_process_remarks2" name="upd_car_process_remarks2" value="' . $row['remarks_car_processing_2'] . '">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- RD Assessment -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">RD Assessment</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Preparation of Docket for RD</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_actual_preparation_of_docket_for_rd" name="upd_actual_preparation_of_docket_for_rd" value="' . $row['actual_preparation_of_docket_for_rd'] . '">
                                                                        </td>
                                                                        <th>Remarks (RD Assessment 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_rd_assessment_remarks1" name="upd_rd_assessment_remarks1" value="' . $row['remarks_rd_assessment_1'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Submitted to RD for Assessment</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_actual_submitted_to_rd_for_assessment" name="upd_actual_submitted_to_rd_for_assessment" value="' . $row['actual_submitted_to_rd_for_assessment'] . '">
                                                                        </td>
                                                                        <th>Actual Release of RD Assessment</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_actual_release_of_rd_assessment" name="upd_actual_release_of_rd_assessment" value="' . $row['actual_release_of_rd_assessment'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (RD Assessment 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_rd_assessment_remarks2" name="upd_rd_assessment_remarks2" value="' . $row['remarks_rd_assessment_2'] . '">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Check Processing -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Check Processing</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>RD Assessment Received</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_rd_assessment_received" name="upd_rd_assessment_received" value="' . $row['rd_assessment_received'] . '">
                                                                        </td>
                                                                        <th>RCP Processed/Signed</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_rcp_processed_signed" name="upd_rcp_processed_signed" value="' . $row['rcp_processed_signed'] . '">
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Accounting Received RCP for M Check</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_accounting_received_rcp_for_m_check" name="upd_accounting_received_rcp_for_m_check" value="' . $row['accounting_received_rcp_for_m_check'] . '">
                                                                        </td>
                                                                        <th>Accounting Processed M Check</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_accounting_processed_m_check" name="upd_accounting_processed_m_check" value="' . $row['accounting_processed_m_check'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Accounting M. Check for Released</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_accounting_m_check_for_released" name="upd_accounting_m_check_for_released" value="' . $row['accounting_m_check_for_released'] . '">
                                                                        </td>
                                                                        <th>Remarks (Check Processing 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_check_process_remarks1" name="upd_check_process_remarks1" value="' . $row['remarks_check_processing_1'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>M Check Received</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_m_check_received" name="upd_m_check_received" value="' . $row['m_check_received'] . '">
                                                                        </td>
                                                                        <th>Remarks (Check Processing 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_check_process_remarks2" name="upd_check_process_remarks2" value="' . $row['remarks_check_processing_2'] . '">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Submission for title -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Submission for Title</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Date submitted to RD</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_date_submitted_to_rd" name="upd_date_submitted_to_rd" value="' . $row['date_submitted_to_rd'] . '">
                                                                        </td>
                                                                        <th>Estimated Date of Release</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_estimated_date_of_release" name="upd_estimated_date_of_release" value="' . $row['estimated_date_of_release'] . '">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Date Released</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="upd_actual_date_released" name="upd_actual_date_released" value="' . $row['actual_date_released'] . '">
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
                                            <a class="btn btn-success btn-md update"><i class="fa fa-save"></i> Update</a>
                                            <button type="reset" class="btn btn-default btn-md"><i class="fa fa-undo"></i> Reset</button>
                                        </div>
                                    </form>
                                    <!-- End Add Company Form -->
                                        ';
                                    }
                                    ?>

                                    <!-- <a href="#" class="btn btn-success btn-md update">
                                        <i class="fa fa-save"></i> Update
                                    </a>
                                    <button type="submit" class="btn btn-success btn-md update"><i class="fa fa-save"></i> Update</button> -->
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