<?php
$conn = mysqli_connect('localhost','root','111111','member') or die("Error ".mysqli_error($conn));

mysqli_query($conn,'set session_character_set_connection=utf8;');
mysqli_query($conn,'set session_character_set_results=utf8;');
mysqli_query($conn,'set session_character_set_client=utf8;');

session_start();

$result = mysqli_query($conn,'SELECT * FROM memManage');

while($user = mysqli_fetch_array($result,MYSQLI_BOTH)){
	if($_SESSION['nickname'] == $user['ID']){
       $sql = "DELETE FROM memManage WHERE ID = '".$user['ID']."'";
       $ret = mysqli_query($conn,$sql);
       header("Location: login.php?delMem={$ret}");
	}
}
?>
