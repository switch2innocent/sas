<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/signatories.obj.php';

$database = new Connection();
$db = $database->connect();

$add_signatory = new Signatories($db);

$add_signatory->company_person = $_POST['company_person'];
$add_signatory->company_position = $_POST['company_position'];
$add_signatory->company_person_tin = $_POST['company_person_tin'];
$add_signatory->person_ctc = $_POST['person_ctc'];
$add_signatory->person_ctc_date_place = $_POST['person_ctc_date_place'];
$add_signatory->created_by = $_SESSION['user_id'];

if ($add_signatory->add_signatories()) {
    echo 1;
} else {
    echo 0;
}
