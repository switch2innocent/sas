<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/customer_house.obj.php';

$database = new Connection();
$db = $database->connect();

$update_customer_house = new CustomerHouse($db);

$update_customer_house->project_id = $_POST['project_id'];
$update_customer_house->house_no = $_POST['house_no'];
$update_customer_house->lot = $_POST['lot'];
$update_customer_house->block = $_POST['block'];
$update_customer_house->house_type = $_POST['house_type'];
$update_customer_house->lot_area = $_POST['lot_area'];
$update_customer_house->floor_area = $_POST['floor_area'];
$update_customer_house->condo_type = $_POST['condo_type'];
$update_customer_house->unit_no = $_POST['unit_no'];
$update_customer_house->unit_floor_area = $_POST['unit_floor_area'];
$update_customer_house->unit_floor = $_POST['unit_floor'];
$update_customer_house->unit_floor_sup = $_POST['unit_floor_sup'];
$update_customer_house->parking_unit = $_POST['parking_unit'];
$update_customer_house->parking_unit_area = $_POST['parking_unit_area'];
$update_customer_house->parking_title_no = $_POST['parking_title_no'];
$update_customer_house->parking_floor = $_POST['parking_floor'];
$update_customer_house->parking_floor_sup = $_POST['parking_floor_sup'];
$update_customer_house->net_selling_price = $_POST['net_selling_price'];
$update_customer_house->net_selling_price_word = $_POST['net_selling_price_word'];
$update_customer_house->equity = $_POST['equity'];
$update_customer_house->equity_word = $_POST['equity_word'];
$update_customer_house->payment_term = $_POST['payment_term'];
$update_customer_house->repricing = $_POST['repricing'];
$update_customer_house->loan_amount = $_POST['loan_amount'];
$update_customer_house->loan_amount_word = $_POST['loan_amount_word'];
$update_customer_house->loan_term = $_POST['loan_term'];
$update_customer_house->loan_term_word = $_POST['loan_term_word'];
$update_customer_house->pagibig_interest = $_POST['pagibig_interest'];
$update_customer_house->pagibig_interest_word = $_POST['pagibig_interest_word'];
$update_customer_house->parking_nsp = $_POST['parking_nsp'];
$update_customer_house->parking_nsp_word = $_POST['parking_nsp_word'];
$update_customer_house->processing_fee = $_POST['processing_fee'];
$update_customer_house->processing_fee_word = $_POST['processing_fee_word'];
$update_customer_house->regfees = $_POST['regfees'];
$update_customer_house->admin_fee = $_POST['admin_fee'];
$update_customer_house->additional_work = $_POST['additional_work'];
$update_customer_house->transfer_tax = $_POST['transfer_tax'];
$update_customer_house->docstamp_tax = $_POST['docstamp_tax'];
$update_customer_house->technical_description_1 = $_POST['technical_description_1'];
$update_customer_house->technical_description_2 = $_POST['technical_description_2'];
$update_customer_house->house_description = $_POST['house_description'];
$update_customer_house->purpose = $_POST['purpose'];
$update_customer_house->co_borrower_name_1 = $_POST['co_borrower_1'];
$update_customer_house->co_borrower_id_1 = $_POST['co_borrower_id_1'];
$update_customer_house->co_borrower_spouse_1 = $_POST['co_borrower_spouse_1'];
$update_customer_house->co_borrower_ctc_1 = $_POST['co_borrower_ctc_1'];
$update_customer_house->co_borrower_date_place_1 = $_POST['co_borrower_date_place_1'];
$update_customer_house->co_borrower_name_2 = $_POST['co_borrower_2'];
$update_customer_house->co_borrower_id_2 = $_POST['co_borrower_id_2'];
$update_customer_house->co_borrower_spouse_2 = $_POST['co_borrower_spouse_2'];
$update_customer_house->co_borrower_ctc_2 = $_POST['co_borrower_ctc_2'];
$update_customer_house->co_borrower_date_place_2 = $_POST['co_borrower_date_place_2'];
$update_customer_house->witness_a = $_POST['witness_a'];
$update_customer_house->witness_b = $_POST['witness_b'];
$update_customer_house->id = $_POST['upd_house_id'];

if ($update_customer_house->update_customer_houses()) {
    echo 1;
} else {
    echo 0;
}
