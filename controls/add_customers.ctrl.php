<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/customer.obj.php';

$database = new Connection();
$db = $database->connect();

$add_customer = new Customer($db);

$add_customer->customer_code = $_POST['customer_code'];
$add_customer->customer_name = $_POST['customer_name'];
$add_customer->customer_address = $_POST['customer_address'];
$add_customer->customer_id = $_POST['customer_id'];
$add_customer->customer_tct_no = $_POST['customer_tct_no'];
$add_customer->customer_ctc = $_POST['customer_ctc'];
$add_customer->customer_ctc_date = $_POST['customer_ctc_date'];
$add_customer->customer_ctc_place = $_POST['customer_ctc_place'];
$add_customer->civil_status = $_POST['civil_status'];
$add_customer->citizenship = $_POST['citizenship'];
$add_customer->employment = $_POST['employment'];
$add_customer->designation = $_POST['designation'];
$add_customer->company = $_POST['company'];
$add_customer->contact_no = $_POST['contact_no'];
$add_customer->gender = $_POST['gender'];
$add_customer->legality = $_POST['legality'];
$add_customer->customer_spouse = $_POST['customer_spouse'];
$add_customer->customer_spouse_id = $_POST['customer_spouse_id'];
$add_customer->customer_spouse_ctc = $_POST['customer_spouse_ctc'];
$add_customer->customer_spouse_ctc_date = $_POST['customer_spouse_ctc_date'];
$add_customer->customer_spouse_ctc_place = $_POST['customer_spouse_ctc_place'];
$add_customer->customer_contact_company = $_POST['customer_contact_company'];
$add_customer->customer_contact_position = $_POST['customer_contact_position'];
$add_customer->customer_contact_address = $_POST['customer_contact_address'];
$add_customer->income = $_POST['income'];
$add_customer->birthdate = $_POST['birthdate'];
$add_customer->email = $_POST['email'];
$add_customer->created_by = $_SESSION['user_id'];

if ($add_customer->add_customers()) {
    // Return the last inserted customer ID
    echo $db->lastInsertId();
} else {
    echo 0;
}
