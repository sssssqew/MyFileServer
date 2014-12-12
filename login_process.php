<?php
session_start();
$id = 'sylee';
$pwd = '7618353ab';

if(!empty($_POST['id']) && !empty($_POST['pwd'])){
    if($_POST['id'] == $id && $_POST['pwd'] == $pwd){
        $_SESSION['is_login'] = true;
        $_SESSION['nickname'] = 'sylee';
        header('Location: ./list.php');
        exit;
    }
}
header('Location: ./login_failed.php');
?>
