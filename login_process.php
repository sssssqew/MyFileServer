<?php
session_start();
$id = 'sylee';
$pwd = '$2y$10$YEF0gasnKd3F89CBkEiJ2OLp79RnlpjcGIAnVJKjrMrC6gdS9CM2e';

if(!empty($_POST['id']) && !empty($_POST['pwd'])){
    if($_POST['id'] == $id && password_verify($_POST['pwd'],$pwd) == TRUE){
        $_SESSION['is_login'] = true;
        $_SESSION['nickname'] = 'sylee';
        header('Location: ./list.php');
        exit;
    }
}
header('Location: ./login_failed.php');
?>
