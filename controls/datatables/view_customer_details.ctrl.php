<?php

require_once '../../config/dbconn.php';
require_once '../../objects/contract_titling_monitoring.obj.php';

$database = new Connection();
$db = $database->connect();

$view_customer_detail = new ContractTitlingMonitoring($db);

header("Content-Type: application/json");

//For column to table
$columns = array(
    0 => 'id',
    1 => 'customer_code',
    2 => 'customer_name',
    3 => 'project_name',
    4 => 'house_no',
    5 => 'lot',
    6 => 'block',
    7 => 'action',
);

$sql = "SELECT c.id, c.customer_code, c.customer_name, p.project_name, ch.house_no, ch.lot, ch.block FROM customer_tbl c, project_tbl p, customer_house_tbl ch WHERE c.id = ch.customer_id AND p.id = ch.project_id AND c.is_active = 1";

$get_all_rows = $view_customer_detail->view_customer_details($sql);
$total_all_rows = $get_all_rows->rowCount();

//Search
if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];

    $sql .= " AND (
        c.id LIKE '%" . $search_value . "%' 
        OR c.customer_code LIKE '%" . $search_value . "%' 
        OR c.customer_name LIKE '%" . $search_value . "%' 
        OR p.project_name LIKE '%" . $search_value . "%' 
        OR ch.house_no LIKE '%" . $search_value . "%' 
        OR ch.lot LIKE '%" . $search_value . "%' 
        OR ch.block LIKE '%" . $search_value . "%'
    )";
}

//Order
if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
}

//Pagination
if (isset($_POST['length']) != '') {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length . " ";
}

//Fetch data
$view = $view_customer_detail->view_customer_details($sql);

$output = array();
$data = array();
while ($row = $view->fetch(PDO::FETCH_ASSOC)) {

    // $id = '<input type="checkbox" name="form_users" class="checklist" value="' . $row['id'] . '">';
    $id = $row['id'];
    $customer_code = $row['customer_code'];
    $customer_name = $row['customer_name'];
    $project_name = $row['project_name'];
    $house_no = $row['house_no'];
    $lot = $row['lot'];
    $block = $row['block'];
    $action = '<center>
        <div class="btn-group">
            <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                More <span class="fa fa-caret-down"></span>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="view_all" href="#" data-id="' . $row['id'] . '"><i class="fa fa-eye"></i> View</a>
                </li>
                <li>
                    <a class="edit" href="edit_customer_details.php?id=' . htmlspecialchars($row['id']) . '"><i class="fa fa-edit"></i> Edit</a>
                </li>
                <li>
                    <a class="delete" href="#" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i> Delete</a>
                </li>
            </ul>
        </div>
    </center>';

    $data[] = array($id, $customer_code, $customer_name, $project_name, $house_no, $lot, $block, $action);
}

$count_rows = $view->rowcount();

//Output data
$output = array(
    'draw' => isset($_POST['draw']) ? $_POST['draw'] : 0,
    'recordsTotal' => $count_rows,
    'recordsFiltered' => $total_all_rows,
    'data' => $data,
);

echo json_encode($output, JSON_PRETTY_PRINT);
