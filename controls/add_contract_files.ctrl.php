<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/contract_file.obj.php';

$database = new Connection();
$db = $database->connect();

$add_contract_file = new ContractFile($db);

$add_contract_file->contract_name = $_POST['contract_name'];
$add_contract_file->doc_file = file_get_contents($_FILES['doc_file']['tmp_name']);
$add_contract_file->type = $_POST['contract_type'];
$add_contract_file->created_by = $_SESSION['user_id'];

$add = $add_contract_file->add_contract_files();

if ($add) {
    echo 1;
} else {
    echo 0;
}
