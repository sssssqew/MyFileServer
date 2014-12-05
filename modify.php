<?php
 mysql_connect('localhost','root','111111');
 mysql_select_db('member');

 mysql_query("set session character_set_connection=utf8;");
 mysql_query("set session character_set_results=utf8;");
 mysql_query("set session character_set_client=utf8;");

 $result = mysql_query('SELECT * FROM memInfo WHERE id = '.mysql_real_escape_string($_GET['id']));
 $topic = mysql_fetch_array($result);
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
