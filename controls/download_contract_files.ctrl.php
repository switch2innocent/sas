<?php

require_once '../vendor/autoload.php';
require_once '../config/dbconn.php';
require_once '../objects/contract_file.obj.php';

$database = new Connection();
$db = $database->connect();

$download_contract_file = new ContractFile($db);
$download_contract_file->id = $_GET['id'];

$download = $download_contract_file->download_contract_files();

if ($download->rowCount() > 0) {
    $doc = $download->fetch(PDO::FETCH_ASSOC);

    //Send headers to trigger file download
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . $doc['contract_name'] . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($doc['contract_file']));

    echo $doc['contract_file'];
    exit;
} else {
    echo "No contract file found with the provided ID.";
}
