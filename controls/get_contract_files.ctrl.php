<?php
session_start();

require_once '../config/dbconn.php';
require_once '../objects/contract_file.obj.php';
require_once '../objects/contract_type.obj.php';

$database = new Connection();
$db = $database->connect();

$get_contract_file = new ContractFile($db);
$get_contract_type = new ContractType($db);

$get_contract_file->id = $_POST['id'];

$get = $get_contract_file->get_contract_files();
$get_contract = $get_contract_type->get_contract_types();

while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <form enctype="multipart/form-data">
        <div class="form-group">
            <label for="contractName">Contract Name <span style="color:red">*</span></label>
            <input type="text" id="upd_id" value="' . $row['id'] . '" hidden>
            <input type="text" class="form-control" id="upd_contractName" placeholder="Enter contract name" value="' . $row['contract_name'] . '" required>
        </div>
        <div class="form-group">
            <label for="contractType">Type <span style="color:red">*</span></label>
    <select class="form-control" id="upd_contractType" name="contractType" required>
    <option value="' . (int)$row['contract_type_id'] . '">' . $row['description'] . '</option>
    ';
    while ($row2 = $get_contract->fetch(PDO::FETCH_ASSOC)) {
        if ((int)$row2['id'] !== (int)$row['contract_type_id']) {
            echo "<option value='" . $row2['id'] . "'>" . $row2['description'] . "</option>";
        }
    }
    echo '
    </select>
        </div>
        <div class="form-group">
            <label for="docfile">Upload File (.docx only) <span style="color:red">*</span></label>
            <input type="file" class="form-control" id="upd_docfile" accept=".docx" required>
        </div>
    </form>
    ';
}
?>

<script>
    //Append .docx on edit
    $('#upd_contractName').on('blur', function() {
        let val = $(this).val().trim();
        if (val && !val.toLowerCase().endsWith('.docx')) {
            $(this).val(val + '.docx');
        }
    });
</script>