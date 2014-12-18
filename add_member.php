<?php
$conn = mysqli_connect('localhost','root','111111','member') or die("Error ".mysqli_error($conn));

mysqli_query($conn,'set session character_set_connection=utf8;');
mysqli_query($conn,'set session character_set_results=utf8;');
mysqli_query($conn,'set session character_set_client=utf8;');

$result = mysqli_query($conn,"SELECT * FROM memManage");
/* 회원중복 비교 */ 
while($human_Info = mysqli_fetch_array($result,MYSQLI_BOTH)){
$DB_ID = $human_Info['ID'];
$DB_PASSWORD = $human_Info['PASSWORD'];

if(password_verify($_POST['id'],$DB_ID) == TRUE){
   $doubled = TRUE;
   header("Location: login.php?d={$doubled}");
   exit;
}
}
/* 중복되는 회원이 없는 경우 */
$secure_ID = password_hash($_POST['id'],PASSWORD_DEFAULT);
$secure_PASSWORD = password_hash($_POST['pwd'],PASSWORD_DEFAULT);

$sql = "INSERT INTO memManage (ID, PASSWORD) VALUES ('".mysqli_real_escape_string($conn,$secure_ID)."','".
       mysqli_real_escape_string($conn,$secure_PASSWORD)."')";
$ret = mysqli_query($conn,$sql);

header("Location: login.php?insert={$ret}");

?>


