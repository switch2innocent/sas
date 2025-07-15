<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/customer.obj.php';

$database = new Connection();
$db = $database->connect();

$update_customer = new Customer($db);

$update_customer->customer_code = $_POST['customer_code'];
$update_customer->customer_name = $_POST['customer_name'];
$update_customer->customer_address = $_POST['customer_address'];
$update_customer->customer_id = $_POST['customer_id'];
$update_customer->customer_tct_no = $_POST['customer_tct_no'];
$update_customer->customer_ctc = $_POST['customer_ctc'];
$update_customer->customer_ctc_date = $_POST['customer_ctc_date'];
$update_customer->customer_ctc_place = $_POST['customer_ctc_place'];
$update_customer->civil_status = $_POST['civil_status'];
$update_customer->citizenship = $_POST['citizenship'];
$update_customer->employment = $_POST['employment'];
$update_customer->designation = $_POST['designation'];
$update_customer->company = $_POST['company'];
$update_customer->contact_no = $_POST['contact_no'];
$update_customer->gender = $_POST['gender'];
$update_customer->legality = $_POST['legality'];
$update_customer->customer_spouse = $_POST['customer_spouse'];
$update_customer->customer_spouse_id = $_POST['customer_spouse_id'];
$update_customer->customer_spouse_ctc = $_POST['customer_spouse_ctc'];
$update_customer->customer_spouse_ctc_date = $_POST['customer_spouse_ctc_date'];
$update_customer->customer_spouse_ctc_place = $_POST['customer_spouse_ctc_place'];
$update_customer->customer_contact_company = $_POST['customer_contact_company'];
$update_customer->customer_contact_position = $_POST['customer_contact_position'];
$update_customer->customer_contact_address = $_POST['customer_contact_address'];
$update_customer->income = $_POST['income'];
$update_customer->birthdate = $_POST['birthdate'];
$update_customer->email = $_POST['email'];
$update_customer->updated_by = $_SESSION['user_id'];
$update_customer->id = $_POST['upd_custom_id'];

if ($update_customer->update_customers()) {
    echo 1;
} else {
    echo 0;
}
