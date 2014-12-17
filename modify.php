<?php
$conn = mysqli_connect('localhost','root','111111','member') or die("Error ".mysqli_error($conn));

 mysqli_query($conn,"set session character_set_connection=utf8;");
 mysqli_query($conn,"set session character_set_results=utf8;");
 mysqli_query($conn,"set session character_set_client=utf8;");

 $result = mysqli_query($conn,'SELECT * FROM memInfo WHERE id = '.mysqli_real_escape_string($conn,$_GET['id']));
 $topic = mysqli_fetch_array($result,MYSQLI_BOTH);
?>
<!DOCTYPE html>
<html>
     <head>
         <meta charset="utf-8"/>
     </head>
     <body>
         <form method="POST" action="./process.php?mode=modify" >
            <input type="hidden" name="id" value="<?php echo $topic['id']?>" />
            <p>이름 : <input type="text" name="memName" value="<?php echo htmlspecialchars($topic['name'])?>"></p>
            <p>나이 : <input type="text" name="memAge" value="<?php echo htmlspecialchars($topic['age'])?>"></p>
            <p><input type="submit"/></p>
         </form>
     <body>
</html>
