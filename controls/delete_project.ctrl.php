<?php

require_once '../config/dbconn.php';
require_once '../objects/project.obj.php';

$database = new Connection();
$db = $database->connect();

$delete_project = new Project($db);

$delete_project->id = $_POST['id'];

if ($delete_project->delete_projects()) {
    echo 1;
} else {
    echo 0;
}
