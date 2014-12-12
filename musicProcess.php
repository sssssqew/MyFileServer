<html>
<head><meta charset="utf-8"/></head>
<body>
<?php
mysql_connect('localhost','root','111111');
mysql_select_db('member');

mysql_query('set session character_set_connection=utf8;');
mysql_query('set session character_set_results=utf8;');
mysql_query('set session character_set_client=utf8;');

switch($_GET['mmode']){
	case 'minsert':
         $fileName = $_FILES['userfile']['name'];
         $uploaddir = "/var/www/memINFO/";
         $uploadfile = $uploaddir.$fileName; 
         move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);
    
         $sql = "INSERT INTO memMusic (id,musicName,musicPath) VALUES ('".mysql_real_escape_string($_POST['id'])."','".mysql_real_escape_string($fileName)."','".mysql_real_escape_string($uploadfile)."')";
         mysql_query($sql);
         break;
   case 'mdelete': 
         $result = mysql_query("SELECT * FROM memMusic WHERE id = ".mysql_real_escape_string($_POST['id']));
         $delfile = mysql_fetch_array($result);
         unlink($delfile['musicPath']);
         mysql_query('DELETE FROM memMusic WHERE id = '.mysql_real_escape_string($_POST['id']));
         break;
   case 'mupdate':
         /* delete와 같은 내용 */
         $result = mysql_query("SELECT * FROM memMusic WHERE id = ".mysql_real_escape_string($_POST['id']));
         $delfile = mysql_fetch_array($result);
         unlink($delfile['musicPath']);
         mysql_query('DELETE FROM memMusic WHERE id = '.mysql_real_escape_string($_POST['id']));
         /* insert와 같은 내용 */
         $fileName = $_FILES['userfile']['name'];
         $uploaddir = "/var/www/memINFO/";
         $uploadfile = $uploaddir.$fileName;
         move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);
         $sql = "INSERT INTO memMusic (id,musicName,musicPath) VALUES ('".mysql_real_escape_string($_POST['id'])."','".mysql_real_escape_string($fileName)."','".mysql_real_escape_string($uploadfile)."')";
         mysql_query($sql);
         break;
}
 
header("Location: list.php?id={$_POST['id']}");

?>
</body>
</html>

