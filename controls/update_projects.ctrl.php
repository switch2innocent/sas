<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/project.obj.php';

$database = new Connection();
$db = $database->connect();

$update_project = new Project($db);

$update_project->project_code = $_POST['upd_project_code'];
$update_project->company_code = $_POST['upd_company_code'];
$update_project->project_name = $_POST['upd_project_name'];
$update_project->location = $_POST['upd_locations'];
$update_project->city = $_POST['upd_city'];
$update_project->province = $_POST['upd_province'];
$update_project->association = $_POST['upd_association'];
$update_project->registry = $_POST['upd_registry'];
$update_project->project_tct_no = $_POST['upd_project_tct_no'];
$update_project->condo = $_POST['upd_condo'];
$update_project->contract_remarks_1 = $_POST['upd_contract_remarks_1'];
$update_project->contract_date_1 = $_POST['upd_contract_date_1'];
$update_project->contract_remarks_2 = $_POST['upd_contract_remarks_2'];
$update_project->contract_date_2 = $_POST['upd_contract_date_2'];
$update_project->contract_remarks_3 = $_POST['upd_contract_remarks_3'];
$update_project->contract_date_3 = $_POST['upd_contract_date_3'];
$update_project->contract_remarks_4 = $_POST['upd_contract_remarks_4'];
$update_project->contract_date_4 = $_POST['upd_contract_date_4'];
$update_project->contract_remarks_5 = $_POST['upd_contract_remarks_5'];
$update_project->contract_date_5 = $_POST['upd_contract_date_5'];
$update_project->pagibig_remarks_1 = $_POST['upd_pagibig_remarks_1'];
$update_project->pagibig_date_1 = $_POST['upd_pagibig_date_1'];
$update_project->pagibig_remarks_2 = $_POST['upd_pagibig_remarks_2'];
$update_project->pagibig_date_2 = $_POST['upd_pagibig_date_2'];
$update_project->pagibig_remarks_3 = $_POST['upd_pagibig_remarks_3'];
$update_project->pagibig_date_3 = $_POST['upd_pagibig_date_3'];
$update_project->pagibig_remarks_4 = $_POST['upd_pagibig_remarks_4'];
$update_project->pagibig_date_4 = $_POST['upd_pagibig_date_4'];
$update_project->pagibig_remarks_5 = $_POST['upd_pagibig_remarks_5'];
$update_project->pagibig_date_5 = $_POST['upd_pagibig_date_5'];
$update_project->titling_remarks_1 = $_POST['upd_titling_remarks_1'];
$update_project->titling_date_1 = $_POST['upd_titling_date_1'];
$update_project->titling_remarks_2 = $_POST['upd_titling_remarks_2'];
$update_project->titling_date_2 = $_POST['upd_titling_date_2'];
$update_project->titling_remarks_3 = $_POST['upd_titling_remarks_3'];
$update_project->titling_date_3 = $_POST['upd_titling_date_3'];
$update_project->titling_remarks_4 = $_POST['upd_titling_remarks_4'];
$update_project->titling_date_4 = $_POST['upd_titling_date_4'];
$update_project->titling_remarks_5 = $_POST['upd_titling_remarks_5'];
$update_project->titling_date_5 = $_POST['upd_titling_date_5'];
$update_project->project_id = $_POST['upd_project_id'];

if ($update_project->update_projects()) {
    echo 1;
} else {
    echo 0;
}
