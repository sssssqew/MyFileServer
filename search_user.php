<?php
$conn = mysqli_connect('localhost','root','111111','member') or die("Error ".mysqli_error($conn));
session_start();
mysqli_query($conn,'set session character_set_connection=utf8;');
mysqli_query($conn,'set session character_set_results=utf8;');
mysqli_query($conn,'set session character_set_client=utf8');

$result = mysqli_query($conn,'SELECT * FROM memManage');

$cnt = 0;
$friend_user = array();

while($user = mysqli_fetch_array($result,MYSQLI_BOTH)){
	if(stristr($user['ID'],$_POST['searchString']) == TRUE && $_SESSION['nickname']!=$user['ID']){
	    $friend_user[$cnt] = $user['ID'];
		echo $friend_user[$cnt]."</br>";
		$cnt = $cnt + 1;
	}
} 
$serial_friend_user = serialize($friend_user);
header("Location: list.php?search={$serial_friend_user}");
?>



