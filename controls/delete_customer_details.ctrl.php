<?php

require_once '../config/dbconn.php';
require_once '../objects/contract_titling_monitoring.obj.php';

$database = new Connection();
$db = $database->connect();

$delete_customer_detail = new ContractTitlingMonitoring($db);

$delete_customer_detail->id = $_POST['id'];

$delete = $delete_customer_detail->delete_customer_details();

if ($delete) {
    echo 1;
} else {
    echo 0;
}
