<?php

require_once '../config/dbconn.php';
require_once '../objects/contract_file.obj.php';

$database = new Connection();
$db = $database->connect();

$delete_contract_file = new ContractFile($db);

$delete_contract_file->id = $_POST['id'];

$delete = $delete_contract_file->delete_contract_files();

if ($delete) {
    echo 1;
} else {
    echo 0;
}
