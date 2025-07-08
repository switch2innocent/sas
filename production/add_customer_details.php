<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/customer.obj.php';
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

    <title>SAS | Add Customer Details</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
                            <h5>Customer Data / <a href="customer_details.php">Customer Details</a> / <b><a href="add_customer_details.php">Add</a></b></h5>
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
                                                                            <?php
                                                                            $increment_customer_code = new Customer($db);

                                                                            $increment = $increment_customer_code->increment_customer_codes();

                                                                            if ($increment) {
                                                                                $row = $increment->fetch(PDO::FETCH_ASSOC);
                                                                                $numericBarcode = (int)substr($row['max_code'], 4);
                                                                                $customer_code = "A-" . str_pad($numericBarcode + 1, 4, "0", STR_PAD_LEFT);
                                                                            } else {
                                                                                $customer_code = "A-0001"; //Default value
                                                                            }
                                                                            ?>
                                                                            <input type="text" class="form-control" id="customer_code" name="customer_code" value="<?php echo htmlspecialchars($customer_code); ?>" required readonly>
                                                                        </td>
                                                                        <th style="width:20%;">Customer Name</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_name" name="customer_name">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Address</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_address" name="customer_address">
                                                                        </td>
                                                                        <th>Customer ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_id" name="customer_id">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer TCT No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_tct_no" name="customer_tct_no">
                                                                        </td>
                                                                        <th>Customer CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_ctc" name="customer_ctc">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer CTC Date</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_ctc_date" name="customer_ctc_date">
                                                                        </td>
                                                                        <th>Customer CTC Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_ctc_place" name="customer_ctc_place">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Civil Status</th>
                                                                        <td>
                                                                            <select class="form-control" id="civil_status" name="civil_status">
                                                                                <option value="0" selected disabled>Choose...</option>
                                                                                <option value="Single">Single</option>
                                                                                <option value="Married">Married</option>
                                                                                <option value="Widowed">Widowed</option>
                                                                                <option value="Separated">Separated</option>
                                                                                <option value="Divorced">Divorced</option>
                                                                            </select>
                                                                        </td>
                                                                        <th>Citizenship</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="citizenship" name="citizenship">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Employment</th>
                                                                        <td>
                                                                            <select class="form-control" id="employment" name="employment">
                                                                                <option value="0" selected disabled>Choose...</option>
                                                                                <option value="local">Local</option>
                                                                                <option value="self_employed">Self Employed</option>
                                                                                <option value="retired">Retired</option>
                                                                                <option value="ofw">OFW</option>
                                                                            </select>
                                                                        </td>
                                                                        <th>Designation</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="designation" name="designation">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Company</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="company" name="company">
                                                                        </td>
                                                                        <th>Contact No</th>
                                                                        <td>
                                                                            <input type="tel" class="form-control" id="contact_no" name="contact_no" maxlength="11" placeholder="e.g. 09171234567">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Gender</th>
                                                                        <td>
                                                                            <select class="form-control" id="gender" name="gender">
                                                                                <option value="0" selected disabled>Choose...</option>
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                            </select>
                                                                        </td>
                                                                        <th>Legality</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="legality" name="legality">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse" name="customer_spouse">
                                                                        </td>
                                                                        <th>Customer Spouse ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse_id" name="customer_spouse_id">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse_ctc" name="customer_spouse_ctc">
                                                                        </td>
                                                                        <th>Customer Spouse CTC Date</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse_ctc_date" name="customer_spouse_ctc_date">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Spouse CTC Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_spouse_ctc_place" name="customer_spouse_ctc_place">
                                                                        </td>
                                                                        <th>Customer Contact Company</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_contact_company" name="customer_contact_company">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Customer Contact Position</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_contact_position" name="customer_contact_position">
                                                                        </td>
                                                                        <th>Customer Contact Address</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="customer_contact_address" name="customer_contact_address">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Income</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="income" name="income">
                                                                        </td>
                                                                        <th>Birthdate</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Email</th>
                                                                        <td>
                                                                            <input type="email" class="form-control" id="email" name="email">
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
                                                                            <select class="form-control" id="project_id" name="project">
                                                                                <option value="0" selected disabled>Choose...</option>
                                                                                <?php
                                                                                $get_project_name = new Project($db);

                                                                                $get = $get_project_name->get_project_names();
                                                                                while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                                                                    echo '<option value="' . $row['id'] . '">' . $row['project_name'] . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </td>
                                                                        <th style="width:20%;">House No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="house_no" name="house_no">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Lot</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="lot" name="lot">
                                                                        </td>
                                                                        <th>Block</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="block" name="block">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>House Type</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="house_type" name="house_type">
                                                                        </td>
                                                                        <th>Lot Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="lot_area" name="lot_area">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Floor Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="floor_area" name="floor_area">
                                                                        </td>
                                                                        <th>Condo Type</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="condo_type" name="condo_type">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Unit No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="unit_no" name="unit_no">
                                                                        </td>
                                                                        <th>Unit Floor Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="unit_floor_area" name="unit_floor_area">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Unit Floor</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="unit_floor" name="unit_floor">
                                                                        </td>
                                                                        <th>Unit Floor SUP</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="unit_floor_sup" name="unit_floor_sup">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Unit</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_unit" name="parking_unit">
                                                                        </td>
                                                                        <th>Parking Unit Area</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_unit_area" name="parking_unit_area">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Title No.</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_title_no" name="parking_title_no">
                                                                        </td>
                                                                        <th>Parking Floor</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_floor" name="parking_floor">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking Floor SUP</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_floor_sup" name="parking_floor_sup">
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
                                                                            <input type="number" class="form-control" id="net_selling_price" name="net_selling_price" placeholder="0.00">
                                                                        </td>
                                                                        <th style="width:20%;">Net Selling Price (in Words)</th>
                                                                        <td style="width:30%;">
                                                                            <input type="text" class="form-control" id="net_selling_price_word" name="net_selling_price_word" style="width:100%; min-width:300px;" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th style="width:25%;">Equity</th>
                                                                        <td style="width:25%;">
                                                                            <input type="number" class="form-control" id="equity" name="equity" placeholder="0.00">
                                                                        </td>
                                                                        <th style="width:20%;">Equity (in Words)</th>
                                                                        <td style="width:30%;">
                                                                            <input type="text" class="form-control" id="equity_word" name="equity_word" style="width:100%; min-width:300px;" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Payment Term</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="payment_term" name="payment_term">
                                                                        </td>
                                                                        <th>Repricing</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="repricing" name="repricing">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Loan Amount</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="loan_amount" name="loan_amount" placeholder="0.00">
                                                                        </td>
                                                                        <th>Loan Amount (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="loan_amount_word" name="loan_amount_word" style="width:100%; min-width:300px;" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Loan Term</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="loan_term" name="loan_term" placeholder="0.00">
                                                                        </td>
                                                                        <th>Loan Term (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="loan_term_word" name="loan_term_word" style="width:100%; min-width:300px;" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Pagibig Interest</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="pagibig_interest" name="pagibig_interest" placeholder="0.00">
                                                                        </td>
                                                                        <th>Pagibig Interest (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="pagibig_interest_word" name="pagibig_interest_word" style="width:100%; min-width:300px;" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parking NSP</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="parking_nsp" name="parking_nsp" placeholder="0.00">
                                                                        </td>
                                                                        <th>Parking NSP (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="parking_nsp_word" name="parking_nsp_word" style="width:100%; min-width:300px;" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Processing Fee</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="processing_fee" name="processing_fee" placeholder="0.00">
                                                                        </td>
                                                                        <th>Processing Fee (in Words)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="processing_fee_word" name="processing_fee_word" style="width:100%; min-width:300px;" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Regfees</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="regfees" name="regfees" placeholder="0.00">
                                                                        </td>
                                                                        <th>Admin Fee</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="admin_fee" name="admin_fee" placeholder="0.00">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Additional Work</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="additional_work" name="additional_work" placeholder="0.00">
                                                                        </td>
                                                                        <th>Transfer Tax</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="transfer_tax" name="transfer_tax" placeholder="0.00">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Docstamp Tax</th>
                                                                        <td>
                                                                            <input type="number" class="form-control" id="docstamp_tax" name="docstamp_tax" placeholder="0.00">
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
                                                                            <textarea class="form-control" name="technical_description_1" id="technical_description_1" rows="4" style="min-height:100px;"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Technical Description 2</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="technical_description_2" id="technical_description_2" rows="4" style="min-height:100px;"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>House Description</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="house_description" id="house_description" rows="4" style="min-height:100px;"></textarea>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Purpose</th>
                                                                        <td colspan="3">
                                                                            <textarea class="form-control" name="purpose" id="purpose" rows="4" style="min-height:100px;"></textarea>
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
                                                                            <input type="text" class="form-control" id="co_borrower_1" name="co_borrower_1">
                                                                        </td>
                                                                        <th style="width:25%;">Co Borrower ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_id_1" name="co_borrower_id_1">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_spouse_1" name="co_borrower_spouse_1">
                                                                        </td>
                                                                        <th>Co Borrower CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_ctc_1" name="co_borrower_ctc_1">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Date Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_date_place_1" name="co_borrower_date_place_1">
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
                                                                            <input type="text" class="form-control" id="co_borrower_2" name="co_borrower_2">
                                                                        </td>
                                                                        <th>Co Borrower ID</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_id_2" name="co_borrower_id_2">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Spouse</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_spouse_2" name="co_borrower_spouse_2">
                                                                        </td>
                                                                        <th>Co Borrower CTC</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_ctc_2" name="co_borrower_ctc_2">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Co Borrower Date Place</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="co_borrower_date_place_2" name="co_borrower_date_place_2">
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
                                                                            <input type="text" class="form-control" id="witness_a" name="witness_a">
                                                                        </td>
                                                                        <th>Witness B</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="witness_b" name="witness_b">
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
                                                                    <small style="color:#888;">(Download contracts)</small>
                                                                </div>
                                                            </div>
                                                            <table class="table table-bordered" style="margin-bottom:0;">
                                                                <thead style="position: sticky; top: 0; background: #fff; z-index: 2; background-color: #f5f5f5;">
                                                                    <tr>
                                                                        <th class="text-center">Contract Name</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Content goes here... -->
                                                                </tbody>
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
                                                                            <input type="date" class="form-control" id="submitted_to_bir" name="submitted_to_bir">
                                                                        </td>
                                                                        <th style="width:30%;">BIR Actual Release</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="bir_actual_release" name="bir_actual_release">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (CAR Processing 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="car_process_remarks1" name="car_process_remarks1">
                                                                        </td>
                                                                        <th>Actual Dockets Preparation for RD</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="actual_dockets_preparation_for_RD" name="actual_dockets_preparation_for_RD">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (CAR Processing 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="car_process_remarks2" name="car_process_remarks2">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- RD Assessment -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">RD Assessment</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Preparation of Docket for RD</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="actual_preparation_of_docket_for_rd" name="actual_preparation_of_docket_for_rd">
                                                                        </td>
                                                                        <th>Remarks (RD Assessment 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="rd_assessment_remarks1" name="rd_assessment_remarks1">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Submitted to RD for Assessment</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="actual_submitted_to_rd_for_assessment" name="actual_submitted_to_rd_for_assessment">
                                                                        </td>
                                                                        <th>Actual Release of RD Assessment</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="actual_release_of_rd_assessment" name="actual_release_of_rd_assessment">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Remarks (RD Assessment 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="rd_assessment_remarks2" name="rd_assessment_remarks2">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Check Processing -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Check Processing</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>RD Assessment Received</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="rd_assessment_received" name="rd_assessment_received">
                                                                        </td>
                                                                        <th>RCP Processed/Signed</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="rcp_processed_signed" name="rcp_processed_signed">
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Accounting Received RCP for M Check</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="accounting_received_rcp_for_m_check" name="accounting_received_rcp_for_m_check">
                                                                        </td>
                                                                        <th>Accounting Processed M Check</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="accounting_processed_m_check" name="accounting_processed_m_check">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Accounting M. Check for Released</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="accounting_m_check_for_released" name="accounting_m_check_for_released">
                                                                        </td>
                                                                        <th>Remarks (Check Processing 1)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="check_process_remarks1" name="check_process_remarks1">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>M Check Received</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="m_check_received" name="m_check_received">
                                                                        </td>
                                                                        <th>Remarks (Check Processing 2)</th>
                                                                        <td>
                                                                            <input type="text" class="form-control" id="check_process_remarks2" name="check_process_remarks2">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Submission for title -->
                                                                    <tr>
                                                                        <th colspan="4" style="background:#e9ecef;">Submission for Title</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Date submitted to RD</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="date_submitted_to_rd" name="date_submitted_to_rd">
                                                                        </td>
                                                                        <th>Estimated Date of Release</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="estimated_date_of_release" name="estimated_date_of_release">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Actual Date Released</th>
                                                                        <td>
                                                                            <input type="date" class="form-control" id="actual_date_released" name="actual_date_released">
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
                                            <a class="btn btn-success btn-md submit"><i class="fa fa-save"></i> Save</a>
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
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script src="../assets/js/customer_details.script.js"></script>
</body>

</html>