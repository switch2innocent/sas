<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/project_contract.obj.php';

$database = new Connection();
$db = $database->connect();

$add_project_contract = new ProjectContract($db);

$add_project_contract->project_id = $_POST['project_id'];
$add_project_contract->created_by_id = $_SESSION['user_id'];

$allAdded = true;

foreach ($_POST['id'] as $contract_id) {
    $add_project_contract->contract_id = $contract_id;

    if (!$add_project_contract->add_project_contracts()) {
        $allAdded = false;
        break;
    }
}

echo $allAdded ? 1 : 0;
