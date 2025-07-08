<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/contract_titling_monitoring.obj.php';

$database = new Connection();
$db = $database->connect();

$add_contract_titling_monitoring = new ContractTitlingMonitoring($db);

$add_contract_titling_monitoring->project_id = $_POST['project_id'];
$add_contract_titling_monitoring->customer_id = $_POST['customer_id'];
$add_contract_titling_monitoring->customer_house_id = $_POST['customer_house_id'];
$add_contract_titling_monitoring->submitted_to_bir = $_POST['submitted_to_bir'];
$add_contract_titling_monitoring->bir_actual_release = $_POST['bir_actual_release'];
$add_contract_titling_monitoring->car_process_remarks1 = $_POST['car_process_remarks1'];
$add_contract_titling_monitoring->actual_dockets_preparation_for_rd = $_POST['actual_dockets_preparation_for_RD'];
$add_contract_titling_monitoring->car_process_remarks2 = $_POST['car_process_remarks2'];
$add_contract_titling_monitoring->actual_preparation_of_docket_for_rd = $_POST['actual_preparation_of_docket_for_rd'];
$add_contract_titling_monitoring->rd_assessment_remarks1 = $_POST['rd_assessment_remarks1'];
$add_contract_titling_monitoring->actual_submitted_to_rd_for_assessment = $_POST['actual_submitted_to_rd_for_assessment'];
$add_contract_titling_monitoring->actual_release_of_rd_assessment = $_POST['actual_release_of_rd_assessment'];
$add_contract_titling_monitoring->rd_assessment_remarks2 = $_POST['rd_assessment_remarks2'];
$add_contract_titling_monitoring->rd_assessment_received = $_POST['rd_assessment_received'];
$add_contract_titling_monitoring->rcp_processed_signed = $_POST['rcp_processed_signed'];
$add_contract_titling_monitoring->accounting_received_rcp_for_m_check = $_POST['accounting_received_rcp_for_m_check'];
$add_contract_titling_monitoring->accounting_processed_m_check = $_POST['accounting_processed_m_check'];
$add_contract_titling_monitoring->accounting_m_check_for_released = $_POST['accounting_m_check_for_released'];
$add_contract_titling_monitoring->check_process_remarks1 = $_POST['check_process_remarks1'];
$add_contract_titling_monitoring->m_check_received = $_POST['m_check_received'];
$add_contract_titling_monitoring->check_process_remarks2 = $_POST['check_process_remarks2'];
$add_contract_titling_monitoring->date_submitted_to_rd = $_POST['date_submitted_to_rd'];
$add_contract_titling_monitoring->estimated_date_of_release = $_POST['estimated_date_of_release'];
$add_contract_titling_monitoring->actual_date_released = $_POST['actual_date_released'];
$add_contract_titling_monitoring->created_by = $_SESSION['user_id'];

if ($add_contract_titling_monitoring->add_contract_titling_monitorings()) {
    echo 1;
} else {
    echo 0;
}
