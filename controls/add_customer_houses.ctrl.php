<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/customer_house.obj.php';

$database = new Connection();
$db = $database->connect();

$add_customer_house = new CustomerHouse($db);

$add_customer_house->customer_id = $_POST['customer_id'];
$add_customer_house->project_id = $_POST['project_id'];
$add_customer_house->house_no = $_POST['house_no'];
$add_customer_house->lot = $_POST['lot'];
$add_customer_house->block = $_POST['block'];
$add_customer_house->house_type = $_POST['house_type'];
$add_customer_house->lot_area = $_POST['lot_area'];
$add_customer_house->floor_area = $_POST['floor_area'];
$add_customer_house->condo_type = $_POST['condo_type'];
$add_customer_house->unit_no = $_POST['unit_no'];
$add_customer_house->unit_floor_area = $_POST['unit_floor_area'];
$add_customer_house->unit_floor = $_POST['unit_floor'];
$add_customer_house->unit_floor_sup = $_POST['unit_floor_sup'];
$add_customer_house->parking_unit = $_POST['parking_unit'];
$add_customer_house->parking_unit_area = $_POST['parking_unit_area'];
$add_customer_house->parking_title_no = $_POST['parking_title_no'];
$add_customer_house->parking_floor = $_POST['parking_floor'];
$add_customer_house->parking_floor_sup = $_POST['parking_floor_sup'];
$add_customer_house->net_selling_price = $_POST['net_selling_price'];
$add_customer_house->net_selling_price_word = $_POST['net_selling_price_word'];
$add_customer_house->equity = $_POST['equity'];
$add_customer_house->equity_word = $_POST['equity_word'];
$add_customer_house->payment_term = $_POST['payment_term'];
$add_customer_house->repricing = $_POST['repricing'];
$add_customer_house->loan_amount = $_POST['loan_amount'];
$add_customer_house->loan_amount_word = $_POST['loan_amount_word'];
$add_customer_house->loan_term = $_POST['loan_term'];
$add_customer_house->loan_term_word = $_POST['loan_term_word'];
$add_customer_house->pagibig_interest = $_POST['pagibig_interest'];
$add_customer_house->pagibig_interest_word = $_POST['pagibig_interest_word'];
$add_customer_house->parking_nsp = $_POST['parking_nsp'];
$add_customer_house->parking_nsp_word = $_POST['parking_nsp_word'];
$add_customer_house->processing_fee = $_POST['processing_fee'];
$add_customer_house->processing_fee_word = $_POST['processing_fee_word'];
$add_customer_house->regfees = $_POST['regfees'];
$add_customer_house->admin_fee = $_POST['admin_fee'];
$add_customer_house->additional_work = $_POST['additional_work'];
$add_customer_house->transfer_tax = $_POST['transfer_tax'];
$add_customer_house->docstamp_tax = $_POST['docstamp_tax'];
$add_customer_house->technical_description_1 = $_POST['technical_description_1'];
$add_customer_house->technical_description_2 = $_POST['technical_description_2'];
$add_customer_house->house_description = $_POST['house_description'];
$add_customer_house->purpose = $_POST['purpose'];
$add_customer_house->co_borrower_name_1 = $_POST['co_borrower_1'];
$add_customer_house->co_borrower_id_1 = $_POST['co_borrower_id_1'];
$add_customer_house->co_borrower_spouse_1 = $_POST['co_borrower_spouse_1'];
$add_customer_house->co_borrower_ctc_1 = $_POST['co_borrower_ctc_1'];
$add_customer_house->co_borrower_date_place_1 = $_POST['co_borrower_date_place_1'];
$add_customer_house->co_borrower_name_2 = $_POST['co_borrower_2'];
$add_customer_house->co_borrower_id_2 = $_POST['co_borrower_id_2'];
$add_customer_house->co_borrower_spouse_2 = $_POST['co_borrower_spouse_2'];
$add_customer_house->co_borrower_ctc_2 = $_POST['co_borrower_ctc_2'];
$add_customer_house->co_borrower_date_place_2 = $_POST['co_borrower_date_place_2'];
$add_customer_house->witness_a = $_POST['witness_a'];
$add_customer_house->witness_b = $_POST['witness_b'];
$add_customer_house->created_by = $_SESSION['user_id'];

if ($add_customer_house->add_customer_houses()) {
    // Return the last inserted customer house ID
    echo $db->lastInsertId();
} else {
    echo 0;
}
