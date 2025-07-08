<?php

require_once '../config/dbconn.php';
require_once '../objects/signatories.obj.php';

$database = new Connection();
$db = $database->connect();

$update_signatory = new Signatories($db);

$update_signatory->company_person = $_POST['company_person'];
$update_signatory->company_position = $_POST['company_position'];
$update_signatory->company_person_tin = $_POST['company_person_tin'];
$update_signatory->person_ctc = $_POST['person_ctc'];
$update_signatory->person_ctc_date_place = $_POST['person_ctc_date_place'];
$update_signatory->id = $_POST['id'];

if ($update_signatory->update_signatories()) {
    echo 1;
} else {
    echo 0;
}
