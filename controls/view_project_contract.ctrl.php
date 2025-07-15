<?php

require_once '../config/dbconn.php';
// require_once '../objects/project.obj.php';
require_once '../objects/project_contract.obj.php';

$database = new Connection();
$db = $database->connect();

$view_project_contract = new ProjectContract($db);

$view_project_contract->project_id = $_POST['id'];

$view = $view_project_contract->get_project_contracts();
$get = $view_project_contract->get_contracts();

while ($row = $view->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <!-- View Projects -->
    <form>
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Project Details</strong></div>
            <div class="panel-body">
                <div class="row">
                    <!-- Column 1 -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="project_code">Project Code</label>
                            <input type="text" id="upd_id" value="' . $row['id'] . '" hidden>
                            <input type="text" class="form-control" id="project_code" name="project_code" value="' . $row['project_code'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="company_code">Company Code</label>
                            <select class="form-control" name="" id="company_code" disabled>
                                <option value="0" disabled selected>' . $row['company_code'] . '</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="project_name">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" value="' . $row['project_name'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="condo">Condo</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="condo" name="condo" value="' . $row['condo'] . '" disabled' . ($row['condo'] == 1 ? ' checked' : '') . '>
                                <label class="custom-control-label" for="condo">Yes</label>
                            </div>
                        </div>
                    </div>
                    <!-- Column 2 -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="' . $row['location'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="' . $row['city'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="' . $row['province'] . '" readonly>
                        </div>
                    </div>
                    <!-- Column 3 -->
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="association">Association</label>
                            <input type="text" class="form-control" id="association" name="association" value="' . $row['association'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="registry">Registry</label>
                            <input type="text" class="form-control" id="registry" name="registry" value="' . $row['registry'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="project_tct_no">Project TCT No</label>
                            <input type="text" class="form-control" id="project_tct_no" name="project_tct_no" value="' . $row['project_tct_no'] . '" readonly>
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
                                                                    <label for="contract_remarks_' . $i . '">Remarks ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="contract_remarks_' . $i . '" name="contract_remarks_' . $i . '" value="' . $row['contract_remarks_' . $i . ''] . '" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="contract_date_' . $i . '">Date ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="contract_date_' . $i . '" name="contract_date_' . $i . '" value="' . $row['contract_date_' . $i . ''] . '" readonly>
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
                                                                    <label for="pagibig_remarks_' . $i . '">Remarks ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="pagibig_remarks_' . $i . '" name="pagibig_remarks_' . $i . '" value="' . $row['pagibig_remarks_' . $i . ''] . '" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="pagibig_date_' . $i . '">Date ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="pagibig_date_' . $i . '" name="pagibig_date_' . $i . '" value="' . $row['pagibig_date_' . $i . ''] . '" readonly>
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
                                                                    <label for="titling_remarks_' . $i . '">Remarks ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="titling_remarks_' . $i . '" name="titling_remarks_' . $i . '" value="' . $row['titling_remarks_' . $i . ''] . '" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="titling_date_' . $i . '">Date ' . $i . '</label>
                                                                    <input type="text" class="form-control" id="titling_date_' . $i . '" name="titling_date_' . $i . '" value="' . $row['titling_date_' . $i . ''] . '" readonly>
                                                                </div>
                                                            </div>
                                                        ';
    }

    echo '</div>
            </div>
        </div>
        <!-- Contracts -->
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Contracts</strong></div>
            <div class="panel-body">
                <div class="row">
                  <div style="max-height: 250px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead style="position: sticky; top: 0; background: #fff; z-index: 2; background-color: #f5f5f5;">
                            <tr>
                                <th class="text-center">Contract Name</th>
                            </tr>
                        </thead>
                        <tbody>';

    $hasContracts = false;
    while ($row2 = $get->fetch(PDO::FETCH_ASSOC)) {
        $hasContracts = true;
        echo '
                            <tr>
                                <td class="text-center">' . $row2['contract_name'] . '</td>
                            </tr>
                            ';
    }
    if (!$hasContracts) {
        echo '<tr><td class="text-center">No contract available on this project</td></tr>';
    }

    echo '</tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
    ';
}
