<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/company.obj.php';

$database = new Connection();
$db = $database->Connect();

$add_company = new Company($db);

$add_company->company_code = $_POST['company_code'];
$add_company->company_name = $_POST['company_name'];
$add_company->company_address = $_POST['company_address'];
$add_company->city_notary = $_POST['city_notary'];
$add_company->company_city = $_POST['company_city'];
$add_company->company_tin = $_POST['company_tin'];
$add_company->company_ctc = $_POST['company_ctc'];
$add_company->company_ctc_date = $_POST['company_ctc_date'];
$add_company->company_ctc_place = $_POST['company_ctc_place'];
$add_company->company_person_a = $_POST['company_person_a'];
$add_company->company_position_a = $_POST['company_position_a'];
$add_company->company_person_tin_a = $_POST['company_person_tin_a'];
$add_company->person_ctc_a = $_POST['person_ctc_a'];
$add_company->person_ctc_date_place_a = $_POST['person_ctc_date_place_a'];
$add_company->company_person_b = $_POST['company_person_b'];
$add_company->company_position_b = $_POST['company_position_b'];
$add_company->company_person_tin_b = $_POST['company_person_tin_b'];
$add_company->person_ctc_b = $_POST['person_ctc_b'];
$add_company->person_ctc_date_place_b = $_POST['person_ctc_date_place_b'];
$add_company->pagibig_person = $_POST['pagibig_person'];
$add_company->pagibig_address = $_POST['pagibig_address'];
$add_company->pagibig_position = $_POST['pagibig_position'];
$add_company->created_by = $_SESSION['user_id'];

$add = $add_company->add_companys();

if ($add) {
    echo 1;
} else {
    echo 0;
}
