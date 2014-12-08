<?php
mysql_connect('localhost','root','111111');
mysql_select_db('member');

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

/* mysql_real_escape_string : 데이터 입력시 보안문제 해결 */
switch($_GET['mode']){
       case 'insert':
          mysql_query("INSERT INTO memInfo (name,age) VALUES ('".$_POST['memName']."','".mysql_real_escape_string($_POST['memAge'])."')");
          header("Location: list.php");
          break;
       case 'modify':
          mysql_query("UPDATE memInfo SET name = '".mysql_real_escape_string($_POST['memName'])."', age = '".mysql_real_escape_string($_POST['memAge'])."' WHERE id = ".mysql_real_escape_string($_POST['id']));
          header("Location: list.php?id={$_POST['id']}");
          break;
       case 'delete':
          mysql_query("DELETE FROM memInfo WHERE id = ".mysql_real_escape_string($_POST['id']));
          header("Location: list.php?id={$_POST['id']}");
          break;
}
         
?>
