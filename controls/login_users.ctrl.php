<?php
session_start();

require_once '../config/dbconn_main.php';
require_once '../objects/users.obj.php';

$databaseMain = new ConnectionMain();
$dbMain = $databaseMain->connect();

$login_user = new Users($dbMain);

$login_user->username_email = $_POST['username_email'];
$login_user->password = md5($_POST['password']);

$login = $login_user->login_users();

if ($row = $login->fetch(PDO::FETCH_ASSOC)) {

    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['user_position'] = $row['position'];
    $_SESSION['user_role'] = $row['role'];
    $_SESSION['user_name'] = $row['username'];

    echo 1;
} else {
    echo 0;
}
