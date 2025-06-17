<?php

require_once '../config/dbconn.php';
require_once '../objects/company.obj.php';

$database = new Connection();
$db = $database->connect();

$view_company = new Company($db);

$view_company->id = $_POST['id'];

$view = $view_company->get_companys();

while ($row = $view->fetch(PDO::FETCH_ASSOC)) {
    echo '
    <form>
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Company Details</strong></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company_code">Company Code</label>
                            <input type="text" id="upd_id" value="' . $row['id'] . '" hidden>
                            <input type="text" class="form-control" id="company_code" name="company_code" value="' . $row['company_code'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" value="' . $row['company_name'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="company_address">Company Address</label>
                            <input type="text" class="form-control" id="company_address" name="company_address" value="' . $row['company_address'] . '" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city_notary">City Notary</label>
                            <input type="text" class="form-control" id="city_notary" name="city_notary" value="' . $row['city_notary'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="company_city">Company City</label>
                            <input type="text" class="form-control" id="company_city" name="company_city" value="' . $row['company_city'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="company_tin">Company TIN</label>
                            <input type="text" class="form-control" id="company_tin" name="company_tin" value="' . $row['company_tin'] . '" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company_ctc">Company CTC</label>
                            <input type="text" class="form-control" id="company_ctc" name="company_ctc" value="' . $row['company_ctc'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="company_ctc_date">Company CTC Date</label>
                            <input type="date" class="form-control" id="company_ctc_date" name="company_ctc_date" value="' . $row['company_ctc_date'] . '" readonly>
                        </div>
                        <div class="form-group">
                            <label for="company_ctc_place">Company CTC Place</label>
                            <input type="text" class="form-control" id="company_ctc_place" name="company_ctc_place" value="' . $row['company_ctc_place'] . '" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Company Personnels</strong></div>
            <div class="panel-body">
                <div class="row">
                    <!-- Personnel A -->
                    <div class="col-md-6">
                        <fieldset style="border:1px solid #ddd; padding:15px; border-radius:10px;">
                            <legend style="font-size:16px; font-weight:bold;">Personnel A</legend>
                            <div class="form-group">
                                <label for="company_person_a">Company Person</label>
                                <input type="text" class="form-control" id="company_person_a" name="company_person_a" value="' . $row['company_person_a'] . '" readonly>
                            </div>
                            <div class="form-group">
                                <label for="company_position_a">Company Position</label>
                                <input type="text" class="form-control" id="company_position_a" name="company_position_a" value="' . $row['company_position_a'] . '" readonly>
                            </div>
                            <div class="form-group">
                                <label for="company_person_tin_a">Company Person TIN</label>
                                <input type="text" class="form-control" id="company_person_tin_a" name="company_person_tin_a" value="' . $row['company_person_tin_a'] . '" readonly>
                            </div>
                            <div class="form-group">
                                <label for="person_ctc_a">Person CTC</label>
                                <input type="text" class="form-control" id="person_ctc_a" name="person_ctc_a" value="' . $row['person_ctc_a'] . '" readonly>
                            </div>
                            <div class="form-group">
                                <label for="person_ctc_date_place_a">Person CTC Date Place</label>
                                <input type="text" class="form-control" id="person_ctc_date_place_a" name="person_ctc_date_place_a" value="' . $row['person_ctc_date_place_a'] . '" readonly>
                            </div>
                        </fieldset>
                    </div>
                    <!-- Personnel B -->
                    <div class="col-md-6">
                        <fieldset style="border:1px solid #ddd; padding:15px; border-radius:10px;">
                            <legend style="font-size:16px; font-weight:bold;">Personnel B</legend>
                            <div class="form-group">
                                <label for="company_person_b">Company Name</label>
                                <input type="text" class="form-control" id="company_person_b" name="company_person_b" value="' . $row['company_person_b'] . '" readonly>
                            </div>
                            <div class="form-group">
                                <label for="company_position_b">Company Position</label>
                                <input type="text" class="form-control" id="company_position_b" name="company_position_b" value="' . $row['company_position_b'] . '" readonly>
                            </div>
                            <div class="form-group">
                                <label for="company_person_tin_b">Company Person TIN</label>
                                <input type="text" class="form-control" id="company_person_tin_b" name="company_person_tin_b" value="' . $row['company_person_tin_b'] . '" readonly>
                            </div>
                            <div class="form-group">
                                <label for="person_ctc_b">Person CTC</label>
                                <input type="text" class="form-control" id="person_ctc_b" name="person_ctc_b" value="' . $row['person_ctc_b'] . '" readonly>
                            </div>
                            <div class="form-group">
                                <label for="person_ctc_date_place_b">Person CTC Date Place</label>
                                <input type="text" class="form-control" id="person_ctc_date_place_b" name="person_ctc_date_place_b" value="' . $row['person_ctc_date_place_b'] . '" readonly>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Pag-Ibig Personnel</strong></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pagibig_person">Pag-Ibig Person</label>
                            <input type="text" class="form-control" id="pagibig_person" name="pagibig_person" value="' . $row['pagibig_person'] . '" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pagibig_address">Pag-Ibig Address</label>
                            <input type="text" class="form-control" id="pagibig_address" name="pagibig_address" value="' . $row['pagibig_address'] . '" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pagibig_position">Pag-Ibig Position</label>
                            <input type="text" class="form-control" id="pagibig_position" name="pagibig_position" value="' . $row['pagibig_position'] . '" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    ';
}
