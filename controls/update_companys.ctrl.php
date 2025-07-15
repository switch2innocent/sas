<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/company.obj.php';

$database = new Connection();
$db = $database->connect();

$update_company = new Company($db);

$update_company->id = $_POST['id'];
$update_company->company_code = $_POST['company_code'];
$update_company->company_name = $_POST['company_name'];
$update_company->company_address = $_POST['company_address'];
$update_company->city_notary = $_POST['city_notary'];
$update_company->company_city = $_POST['company_city'];
$update_company->company_tin = $_POST['company_tin'];
$update_company->company_ctc = $_POST['company_ctc'];
$update_company->company_ctc_date = $_POST['company_ctc_date'];
$update_company->company_ctc_place = $_POST['company_ctc_place'];
$update_company->company_person_a = $_POST['company_person_a'];
$update_company->company_position_a = $_POST['company_position_a'];
$update_company->company_person_tin_a = $_POST['company_person_tin_a'];
$update_company->person_ctc_a = $_POST['person_ctc_a'];
$update_company->person_ctc_date_place_a = $_POST['person_ctc_date_place_a'];
$update_company->company_person_b = $_POST['company_person_b'];
$update_company->company_position_b = $_POST['company_position_b'];
$update_company->company_person_tin_b = $_POST['company_person_tin_b'];
$update_company->person_ctc_b = $_POST['person_ctc_b'];
$update_company->person_ctc_date_place_b = $_POST['person_ctc_date_place_b'];
$update_company->pagibig_person = $_POST['pagibig_person'];
$update_company->pagibig_address = $_POST['pagibig_address'];
$update_company->pagibig_position = $_POST['pagibig_position'];
$update_company->updated_by = $_SESSION['user_id'];

$update = $update_company->update_companys();

if ($update) {
    echo 1;
} else {
    echo 0;
}
