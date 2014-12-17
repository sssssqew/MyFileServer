<html>
<head><meta charset="utf-8"/></head>
<body>
<?php
$conn = mysqli_connect('localhost','root','111111','member') or die("Error ".mysqli_error($conn));

mysqli_query($conn,'set session character_set_connection=utf8;');
mysqli_query($conn,'set session character_set_results=utf8;');
mysqli_query($conn,'set session character_set_client=utf8;');

switch($_GET['mmode']){
	case 'minsert':
         $fileName = $_FILES['userfile']['name'];
         $uploaddir = "/var/www/memINFO/";
         $uploadfile = $uploaddir.$fileName; 
         move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);
           
         $sql = "INSERT INTO memMusic (id,musicName,musicPath) VALUES ('".mysqli_real_escape_string($conn,$_POST['id'])."','".mysqli_real_escape_string($conn,$fileName)."','".mysqli_real_escape_string($conn,$uploadfile)."')";
         mysqli_query($conn,$sql);
         break;
   case 'mdelete': 
         $result = mysqli_query($conn,"SELECT * FROM memMusic WHERE id = ".mysqli_real_escape_string($conn,$_POST['id']));
         $delfile = mysqli_fetch_array($result,MYSQLI_BOTH);
         unlink($delfile['musicPath']);
         mysqli_query($conn,'DELETE FROM memMusic WHERE id = '.mysqli_real_escape_string($conn,$_POST['id']));
         break;
   case 'mupdate':
         /* delete와 같은 내용 */
         $result = mysqli_query($conn,"SELECT * FROM memMusic WHERE id = ".mysqli_real_escape_string($conn,$_POST['id']));
         $delfile = mysqli_fetch_array($result,MYSQLI_BOTH);
         unlink($delfile['musicPath']);
         mysqli_query($conn,'DELETE FROM memMusic WHERE id = '.mysqli_real_escape_string($conn,$_POST['id']));
         /* insert와 같은 내용 */
         $fileName = $_FILES['userfile']['name'];
         $uploaddir = "/var/www/memINFO/";
         $uploadfile = $uploaddir.$fileName;
         move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile);
         $sql = "INSERT INTO memMusic (id,musicName,musicPath) VALUES ('".mysqli_real_escape_string($conn,$_POST['id'])."','".mysqli_real_escape_string($conn,$fileName)."','".mysqli_real_escape_string($conn,$uploadfile)."')";
         mysqli_query($conn,$sql);
         break;
}
 
header("Location: list.php?id={$_POST['id']}");

?>
</body>
</html>

