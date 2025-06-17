<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/project.obj.php';

$database = new Connection();
$db = $database->connect();

$add_project = new Project($db);

$add_project->project_code = $_POST['project_code'];
$add_project->company_code = $_POST['company_code'];
$add_project->project_name = $_POST['project_name'];
$add_project->location = $_POST['locations'];
$add_project->city = $_POST['city'];
$add_project->province = $_POST['province'];
$add_project->association = $_POST['association'];
$add_project->registry = $_POST['registry'];
$add_project->project_tct_no = $_POST['project_tct_no'];
$add_project->condo = $_POST['condo'];
$add_project->contract_remarks_1 = $_POST['contract_remarks_1'];
$add_project->contract_date_1 = $_POST['contract_date_1'];
$add_project->contract_remarks_2 = $_POST['contract_remarks_2'];
$add_project->contract_date_2 = $_POST['contract_date_2'];
$add_project->contract_remarks_3 = $_POST['contract_remarks_3'];
$add_project->contract_date_3 = $_POST['contract_date_3'];
$add_project->contract_remarks_4 = $_POST['contract_remarks_4'];
$add_project->contract_date_4 = $_POST['contract_date_4'];
$add_project->contract_remarks_5 = $_POST['contract_remarks_5'];
$add_project->contract_date_5 = $_POST['contract_date_5'];
$add_project->pagibig_remarks_1 = $_POST['pagibig_remarks_1'];
$add_project->pagibig_date_1 = $_POST['pagibig_date_1'];
$add_project->pagibig_remarks_2 = $_POST['pagibig_remarks_2'];
$add_project->pagibig_date_2 = $_POST['pagibig_date_2'];
$add_project->pagibig_remarks_3 = $_POST['pagibig_remarks_3'];
$add_project->pagibig_date_3 = $_POST['pagibig_date_3'];
$add_project->pagibig_remarks_4 = $_POST['pagibig_remarks_4'];
$add_project->pagibig_date_4 = $_POST['pagibig_date_4'];
$add_project->pagibig_remarks_5 = $_POST['pagibig_remarks_5'];
$add_project->pagibig_date_5 = $_POST['pagibig_date_5'];
$add_project->titling_remarks_1 = $_POST['titling_remarks_1'];
$add_project->titling_date_1 = $_POST['titling_date_1'];
$add_project->titling_remarks_2 = $_POST['titling_remarks_2'];
$add_project->titling_date_2 = $_POST['titling_date_2'];
$add_project->titling_remarks_3 = $_POST['titling_remarks_3'];
$add_project->titling_date_3 = $_POST['titling_date_3'];
$add_project->titling_remarks_4 = $_POST['titling_remarks_4'];
$add_project->titling_date_4 = $_POST['titling_date_4'];
$add_project->titling_remarks_5 = $_POST['titling_remarks_5'];
$add_project->titling_date_5 = $_POST['titling_date_5'];
$add_project->created_by = $_SESSION['user_id'];

if ($add_project->add_projects()) {
    //Return the last inserted project ID
    echo $db->lastInsertId();
} else {
    echo 0;
}
