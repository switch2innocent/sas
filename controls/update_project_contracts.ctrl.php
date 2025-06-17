<?php
require_once '../config/dbconn.php';
require_once '../objects/project_contract.obj.php';

$database = new Connection();
$db = $database->connect();

$delete_project_contract = new ProjectContract($db);

$delete_project_contract->project_id = $_POST['upd_project_id'];

$delete = $delete_project_contract->delete_project_contracts();
if ($delete) {
    echo 1;
} else {
    echo 0;
}
