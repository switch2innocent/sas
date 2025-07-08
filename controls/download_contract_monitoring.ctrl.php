<?php
require_once '../vendor/autoload.php';
require_once '../config/dbconn.php';
require_once '../objects/contract_titling_monitoring.obj.php';
require_once '../objects/signatories.obj.php';

require_once '../config/dbconn_main.php';
require_once '../objects/companies_main_db.obj.php';
require_once '../objects/projects_main_db.obj.php';

use PhpOffice\PhpWord\TemplateProcessor;

$database = new Connection();
$db = $database->connect();

$databaseMain = new ConnectionMain();
$dbMain = $databaseMain->connectMain();

$download_contract_monitoring = new ContractTitlingMonitoring($db);
$get_signatories_id = new Signatories($db);

$get_company_id = new CompaniesMainDB($dbMain);
$get_project_id = new ProjectsMainDB($dbMain);

$download_contract_monitoring->customer_id = $_GET['custom_id'];
$download_contract_monitoring->contract_id = $_GET['contract_id'];

$get_signatories_id->signatory1 = $_GET['signatory1'];
$get_signatories_id->signatory2 = $_GET['signatory2'];

$get_company_id->comp_id = $_GET['company_main'];
$get_project_id->proj_id = $_GET['projects_main'];

$download = $download_contract_monitoring->download_contract_monitorings();
$get = $get_signatories_id->get_signatories_ids();
$get_comp = $get_company_id->get_companies_ids();
$get_proj = $get_project_id->get_projects_ids();

if ($download->rowCount() > 0) {
    $row = $download->fetch(PDO::FETCH_ASSOC);
    $row2 = $get->fetch(PDO::FETCH_ASSOC);
    $row3 = $get_comp->fetch(PDO::FETCH_ASSOC);
    $row4 = $get_proj->fetch(PDO::FETCH_ASSOC);

    //Save the original DOCX temporarily
    $tempFile = tempnam(sys_get_temp_dir(), 'docx_') . '.docx';
    file_put_contents($tempFile, $row['contract_file']);

    //Load and modify DOCX
    $template = new TemplateProcessor($tempFile);
    $current_datetime = date('Y-m-d H:i:s');  //Date & Time

    //For customer details
    $template->setValue('customer_name', htmlspecialchars($row['customer_name']));
    $template->setValue('customer_address', htmlspecialchars($row['customer_address']));
    $template->setValue('civil_status', htmlspecialchars($row['civil_status']));
    $template->setValue('legality', htmlspecialchars($row['legality']));
    $template->setValue('citizenship', htmlspecialchars($row['citizenship']));
    $template->setValue('net_selling_price_word', htmlspecialchars($row['net_selling_price_word']));
    $template->setValue('net_selling_price', htmlspecialchars($row['net_selling_price']));
    $template->setValue('unit_no', htmlspecialchars($row['unit_no']));
    $template->setValue('condo_type', htmlspecialchars($row['condo_type']));
    $template->setValue('unit_floor', htmlspecialchars($row['unit_floor']));
    $template->setValue('unit_floor_sup', htmlspecialchars($row['unit_floor_sup']));
    $template->setValue('unit_floor_area', htmlspecialchars($row['unit_floor_area']));
    $template->setValue('witness_a', htmlspecialchars($row['witness_a']));
    $template->setValue('witness_b', htmlspecialchars($row['witness_b']));
    $template->setValue('contract_name', htmlspecialchars($row['contract_name']));
    $template->setValue('current_datetime', htmlspecialchars($current_datetime));
    $template->setValue('full_name', htmlspecialchars($row['full_name']));

    //For signatories details
    $template->setValue('company_person1', htmlspecialchars($row2['company_person1']));
    $template->setValue('company_person2', htmlspecialchars($row2['company_person2']));
    $template->setValue('company_person_tin1', htmlspecialchars($row2['company_person_tin1']));
    $template->setValue('company_person_tin2', htmlspecialchars($row2['company_person_tin2']));
    $template->setValue('person_ctc_date_place1', htmlspecialchars($row2['person_ctc_date_place1']));
    $template->setValue('person_ctc_date_place2', htmlspecialchars($row2['person_ctc_date_place2']));

    //For company details
    $template->setValue('comp_name', htmlspecialchars($row3['comp_name']));

    //For project details
    $template->setValue('proj_name', htmlspecialchars($row4['proj_name']));

    //Save the edited DOCX
    $outputFile = tempnam(sys_get_temp_dir(), 'output_') . '.docx';
    $template->saveAs($outputFile);

    //Output to browser
    header("Content-Description: File Transfer");
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=\"" . basename($row['contract_name']) . "\"");
    header("Content-Length: " . filesize($outputFile));
    readfile($outputFile);

    //Cleanup
    unlink($tempFile);
    unlink($outputFile);
    exit;
} else {
    echo "No contract file found with the provided ID.";
}
