<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/contract_titling_monitoring.obj.php';

$database = new Connection();
$db = $database->connect();

$update_contract_titling_monitoring = new ContractTitlingMonitoring($db);

$update_contract_titling_monitoring->submitted_to_bir = $_POST['submitted_to_bir'];
$update_contract_titling_monitoring->bir_actual_release = $_POST['bir_actual_release'];
$update_contract_titling_monitoring->car_process_remarks1 = $_POST['car_process_remarks1'];
$update_contract_titling_monitoring->actual_dockets_preparation_for_rd = $_POST['actual_dockets_preparation_for_RD'];
$update_contract_titling_monitoring->car_process_remarks2 = $_POST['car_process_remarks2'];
$update_contract_titling_monitoring->actual_preparation_of_docket_for_rd = $_POST['actual_preparation_of_docket_for_rd'];
$update_contract_titling_monitoring->rd_assessment_remarks1 = $_POST['rd_assessment_remarks1'];
$update_contract_titling_monitoring->actual_submitted_to_rd_for_assessment = $_POST['actual_submitted_to_rd_for_assessment'];
$update_contract_titling_monitoring->actual_release_of_rd_assessment = $_POST['actual_release_of_rd_assessment'];
$update_contract_titling_monitoring->rd_assessment_remarks2 = $_POST['rd_assessment_remarks2'];
$update_contract_titling_monitoring->rd_assessment_received = $_POST['rd_assessment_received'];
$update_contract_titling_monitoring->rcp_processed_signed = $_POST['rcp_processed_signed'];
$update_contract_titling_monitoring->accounting_received_rcp_for_m_check = $_POST['accounting_received_rcp_for_m_check'];
$update_contract_titling_monitoring->accounting_processed_m_check = $_POST['accounting_processed_m_check'];
$update_contract_titling_monitoring->accounting_m_check_for_released = $_POST['accounting_m_check_for_released'];
$update_contract_titling_monitoring->check_process_remarks1 = $_POST['check_process_remarks1'];
$update_contract_titling_monitoring->m_check_received = $_POST['m_check_received'];
$update_contract_titling_monitoring->check_process_remarks2 = $_POST['check_process_remarks2'];
$update_contract_titling_monitoring->date_submitted_to_rd = $_POST['date_submitted_to_rd'];
$update_contract_titling_monitoring->estimated_date_of_release = $_POST['estimated_date_of_release'];
$update_contract_titling_monitoring->actual_date_released = $_POST['actual_date_released'];
$update_contract_titling_monitoring->id = $_POST['upd_cont_tit_id'];

if ($update_contract_titling_monitoring->update_contract_titling_monitorings()) {
    echo 1;
} else {
    echo 0;
}
