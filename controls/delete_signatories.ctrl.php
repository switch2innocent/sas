<?php

require_once '../config/dbconn.php';
require_once '../objects/signatories.obj.php';

$database = new Connection();
$db = $database->connect();

$delete_signatory = new Signatories($db);

$delete_signatory->id = $_POST['id'];

if ($delete_signatory->delete_signatories()) {
    echo 1;
} else {
    echo 0;
}
