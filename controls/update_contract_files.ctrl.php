<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/contract_file.obj.php';

$database = new Connection();
$db = $database->connect();

$update_contract_file = new ContractFile($db);

$update_contract_file->id = $_POST['id'];
$update_contract_file->contract_name = $_POST['contract_name'];
$update_contract_file->contract_file = file_get_contents($_FILES['contract_file']['tmp_name']);
$update_contract_file->contract_type_id = $_POST['contract_type_id'];

$update = $update_contract_file->update_contract_files();

if ($update) {
    echo 1;
} else {
    echo 0;
}
