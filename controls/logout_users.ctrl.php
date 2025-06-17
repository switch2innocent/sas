<?php

require_once '../config/dbconn_main.php';
require_once '../objects/users.obj.php';

$databaseMain = new ConnectionMain();
$dbMain = $databaseMain->connect();

$logoutuser = new Users($dbMain);

$logoutuser->logout_user();

if ($logoutuser) {
    header('Location: ../index.php');
}
