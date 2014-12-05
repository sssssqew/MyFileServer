<html>
<head><meta charset="utf-8"/></head>
<body>
<?php
mysql_connect('localhost','root','111111');
mysql_select_db('member');

mysql_query('set session character_set_connection=utf8;');
mysql_query('set session character_set_results=utf8;');
mysql_query('set session character_set_client=utf8;');


$upTF = FALSE;
$fileName = $_FILES['userfile']['name'];
$uploaddir = "/var/www/memINFO/";
$uploadfile = $uploaddir.$fileName;

$sql = "INSERT INTO memImg (id,imgName,imgPath) VALUES ('".mysql_real_escape_string($_POST['id'])."','".mysql_real_escape_string($fileName)."','".mysql_real_escape_string($uploadfile)."')";
mysql_query($sql);

switch($_GET['mode']){
     case 'idelete':
         mysql_query('DELETE FROM memImg WHERE id = '.mysql_real_escape_string($_GET['id']));
         break;
}
 
if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)){
    $upTF = TRUE;
    #header("Location: list.php?id={$_POST['id']}&up={$upTF}&fn={$fileName}");
}else{
    #header("Location: list.php?id={$_POST['id']}&up={$upTF}&fn={$fileName}");
}

?>
</body>
</html>

