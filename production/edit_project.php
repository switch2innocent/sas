<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/project.obj.php';
require_once '../objects/company.obj.php';
require_once '../objects/contract_file.obj.php';
require_once '../objects/project_contract.obj.php';

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

    <title>SAS | Edit Project</title>

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
                            <h5>Masters / <a href="project.php">Project</a> / <b><a href="edit_project.php">Edit</a></b></h5>
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
                                    <h2>Project Form</h2>
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
                                    <p><strong>NOTE</strong>: Fields marked with a red asterisk (<span style="color: red">*</span>) are required. Please complete them before submitting.</p>
                                    <br>

                                    <?php
                                    $edit_project = new Project($db);

                                    $edit_project->id = $_GET['id'];

                                    $edit = $edit_project->get_projects();
                                    while ($row = $edit->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                        <form>
                                            <div class="panel panel-default">
                                                <div class="panel-heading"><strong>Project Details</strong></div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <!-- Column 1 -->
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="upd_project_code">Project Code</label>
                                                                <input type="text" id="upd_project_id" name="upd_project_id" value="' . $row['id'] . '" hidden>
                                                                <input type="text" class="form-control" id="upd_project_code" name="upd_project_code" value="' . $row['project_code'] . '" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="upd_company_code">Company Code <span style="color:red">*</span></label>
                                                                <select class="form-control" id="upd_company_code">
                                                                <option value="' . (int)$row['company_id'] . '" disabled selected>' . $row['company_code'] . '</option>
                                                                ';
                                        $view_company = new Company($db);
                                        $view = $view_company->view_companys();

                                        while ($row2 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            if ((int)$row2['id'] !== (int)$row['company_id']) {
                                                echo '<option value="' . htmlspecialchars($row2['id']) . '">' . htmlspecialchars($row2['company_code']) . '</option>';
                                            }
                                        }
                                        echo ' 
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="upd_project_name">Project Name <span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" id="upd_project_name" name="upd_project_name" value="' . $row['project_name'] . '">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="upd_condo">Condo</label>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="upd_condo" name="upd_condo" value="' . $row['condo'] . '" ' . ($row['condo'] == 1 ? ' checked' : '') . '>
                                                                    <label class="custom-control-label" for="condo">Yes</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Column 2 -->
                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="upd_location">Location <span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" id="upd_location" name="upd_location" value="' . $row['location'] . '">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="upd_city">City</label>
                                                                <input type="text" class="form-control" id="upd_city" name="upd_city" value="' . $row['city'] . '">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="upd_province">Province</label>
                                                                <input type="text" class="form-control" id="upd_province" name="upd_province" value="' . $row['province'] . '">
                                                            </div>
                                                        </div>
                                                        <!-- Column 3 -->
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="upd_association">Association</label>
                                                                <input type="text" class="form-control" id="upd_association" name="upd_association" value="' . $row['association'] . '">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="upd_registry">Registry</label>
                                                                <input type="text" class="form-control" id="upd_registry" name="upd_registry" value="' . $row['registry'] . '">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="upd_project_tct_no">Project TCT No</label>
                                                                <input type="text" class="form-control" id="upd_project_tct_no" name="upd_project_tct_no" value="' . $row['project_tct_no'] . '">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Contract Monitoring -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading"><strong>Contract Monitoring</strong></div>
                                                <div class="panel-body">
                                                    <div class="row">';

                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="upd_contract_remarks_' . $i . '">Remarks ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="upd_contract_remarks_' . $i . '" name="upd_contract_remarks_' . $i . '" value="' . $row['contract_remarks_' . $i . ''] . '">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="upd_contract_date_' . $i . '">Date ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="upd_contract_date_' . $i . '" name="upd_contract_date_' . $i . '" value="' . $row['contract_date_' . $i . ''] . '">
                                                                </div>
                                                            </div>
                                                        ';
                                        }

                                        echo '</div>
                                                </div>
                                            </div>

                                            <!-- Pagibig Monitoring -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading"><strong>Pagibig Monitoring</strong></div>
                                                <div class="panel-body">
                                                    <div class="row">';

                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '
                                                         <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="upd_pagibig_remarks_' . $i . '">Remarks ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="upd_pagibig_remarks_' . $i . '" name="upd_pagibig_remarks_' . $i . '" value="' . $row['pagibig_remarks_' . $i . ''] . '">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="upd_pagibig_date_' . $i . '">Date ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="upd_pagibig_date_' . $i . '" name="upd_pagibig_date_' . $i . '" value="' . $row['pagibig_date_' . $i . ''] . '">
                                                                </div>
                                                            </div>
                                                        ';
                                        }

                                        echo '</div>
                                                </div>
                                            </div>

                                            <!-- Titling Monitoring -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading"><strong>Titling Monitoring</strong></div>
                                                <div class="panel-body">
                                                    <div class="row">';

                                        for ($i = 1; $i <= 5; $i++) {
                                            echo '
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="upd_titling_remarks_' . $i . '">Remarks ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="upd_titling_remarks_' . $i . '" name="upd_titling_remarks_' . $i . '" value="' . $row['titling_remarks_' . $i . ''] . '">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="upd_titling_date_' . $i . '">Date ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="upd_titling_date_' . $i . '" name="upd_titling_date_' . $i . '" value="' . $row['titling_date_' . $i . ''] . '">
                                                                </div>
                                                            </div>
                                                        ';
                                        }

                                        echo '</div>
                                                </div>
                                            </div>

                                            <!-- Contracts -->
                                            <div class="panel panel-default">
                                              <div class="panel-heading"><strong><span class="fa fa-folder-open"></span> Contracts</strong> <span style="color:red">*</span>
                                                <p><strong>NOTE</strong>: Select the contracts that should be assigned to this project. Only checked contracts will be linked.</p>
                                            </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                         <table id="datatable" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center"><input type="checkbox" id="check_all"></th>
                                                                <th class="text-center">Contract Name</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';

                                        $view_contract_file = new ContractFile($db);
                                        $get_contract_id = new ProjectContract($db);

                                        $get_contract_id->project_id = $_GET['id'];

                                        $view = $view_contract_file->view_contract_files();
                                        $projectContracts = $get_contract_id->get_contract_ids();

                                        //Extract just the contract_id values for quick lookup
                                        $selectedContractIds = [];
                                        foreach ($projectContracts as $row) {
                                            $selectedContractIds[] = $row['contract_id'];
                                        }
                                        while ($row2 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $isChecked = in_array($row2['id'], $selectedContractIds) ? 'checked' : '';

                                            echo '<tr>
                                                    <td class="text-center">
                                                        <input type="checkbox" name="contract_id" class="checklist" value="' . htmlspecialchars($row2['id']) . '" ' . $isChecked . '>
                                                    </td>
                                                    <td>' . htmlspecialchars($row2['contract_name']) . '</td>
                                                </tr>';
                                        }

                                        echo '</tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="text-center" style="margin-top:20px;">
                                                <button type="submit" class="btn btn-primary btn-md update"><i class="fa fa-save"></i> Update</button>
                                                <button type="reset" class="btn btn-default btn-md"><i class="fa fa-undo"></i> Reset</button>
                                            </div>
                                        </form>
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
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script src="../assets/js/project.script.js"></script>
</body>

</html>