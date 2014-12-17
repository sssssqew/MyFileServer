<?php
$conn = mysqli_connect('localhost','root','111111','member') or die("Error ".mysqli_error($conn));

mysqli_query($conn,"set session character_set_connection=utf8;");
mysqli_query($conn,"set session character_set_results=utf8;");
mysqli_query($conn,"set session character_set_client=utf8;");

/* mysql_real_escape_string : 데이터 입력시 보안문제 해결 */
switch($_GET['mode']){
       case 'insert':
          mysqli_query($conn,"INSERT INTO memInfo (name,age) VALUES ('".$_POST['memName']."','".mysqli_real_escape_string($conn,$_POST['memAge'])."')");
          header("Location: list.php");
          break;
       case 'modify':
          mysqli_query($conn,"UPDATE memInfo SET name = '".mysqli_real_escape_string($conn,$_POST['memName'])."', age = '".mysqli_real_escape_string($conn,$_POST['memAge'])."' WHERE id = ".mysqli_real_escape_string($conn,$_POST['id']));
          header("Location: list.php?id={$_POST['id']}");
          break;
       case 'delete':
          mysqli_query($conn,"DELETE FROM memInfo WHERE id = ".mysqli_real_escape_string($conn,$_POST['id']));
          header("Location: list.php?id={$_POST['id']}");
          break;
}
         
?>
