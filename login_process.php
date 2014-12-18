<?php
$conn = mysqli_connect('localhost','root','111111','member') or die("Error ".mysqli_error($conn));

mysqli_query($conn,'set session character_set_connection=utf8;');
mysqli_query($conn,'set session character_set_results=utf8;');
mysqli_query($conn,'set session character_set_client=utf8;');

session_start();

$result = mysqli_query($conn,"SELECT * FROM memManage");

while($human_Info = mysqli_fetch_array($result,MYSQLI_BOTH)){
$secure_ID = $human_Info['ID'];
$secure_PASSWORD = $human_Info['PASSWORD'];

if(!empty($_POST['id']) && !empty($_POST['pwd'])){
    if(password_verify($_POST['id'],$secure_ID) == TRUE && password_verify($_POST['pwd'],$secure_PASSWORD) == TRUE){
        $_SESSION['is_login'] = true;
        $_SESSION['nickname'] = $_POST['id'];
        header('Location: ./list.php');
        exit;
    }
}
}
header('Location: ./login_failed.php');
?>
