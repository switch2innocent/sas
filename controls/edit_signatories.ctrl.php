<?php

require_once '../config/dbconn.php';
require_once '../objects/signatories.obj.php';

$database = new Connection();
$db = $database->connect();

$edit_signatory = new Signatories($db);

$edit_signatory->id = $_POST['id'];

$edit = $edit_signatory->edit_signatories();

while ($row = $edit->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <form autocomplete="off">
    <input type="hidden" id="edit_id" name="id">
        <div class="form-group">
            <label for="upd_company_person">Company Person <span style="color: red">*</span></label>
            <input type="hidden" class="form-control" id="upd_id" value="' . $row['id'] . '">
            <input type="text" class="form-control" id="upd_company_person" value="' . $row['company_person'] . '">
        </div>
        <div class="form-group">
            <label for="upd_company_position">Company Position <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="upd_company_position" value="' . $row['company_position'] . '">
        </div>
        <div class="form-group">
            <label for="upd_company_person_tin">Company Person TIN <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="upd_company_person_tin" value="' . $row['company_person_tin'] . '">
        </div>
        <div class="form-group">
            <label for="upd_person_ctc">Person CTC <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="upd_person_ctc" value="' . $row['person_ctc'] . '">
        </div>
        <div class="form-group">
            <label for="upd_person_ctc_date_place">Company CTC Date Place <span style="color: red">*</span></label>
            <input type="text" class="form-control" id="upd_person_ctc_date_place" value="' . $row['person_ctc_date_place'] . '">
        </div>
    </form>
    ';
}
