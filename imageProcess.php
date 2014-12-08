<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php
		mysql_connect('localhost', 'root', '111111');
		mysql_select_db('member');

		mysql_query('set session character_set_connection=utf8;');
		mysql_query('set session character_set_results=utf8;');
		mysql_query('set session character_set_client=utf8;');

		switch($_GET['imode']) {
			case 'iinsert' :

				/*이미지 파일경로 생성*/
				$fileName = $_FILES['userfile']['name'];
				$uploaddir = "/var/www/memINFO/";
				$uploadfile = $uploaddir . $fileName;
				/*이미지 파일이동*/
				move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
				/*이미지 파일 DB 추가*/
				$sql = "INSERT INTO memImg (id,imgName,imgPath) VALUES ('" . mysql_real_escape_string($_POST['id']) . "','" . mysql_real_escape_string($fileName) . "','" . mysql_real_escape_string($uploadfile) . "')";
				mysql_query($sql);
				break;
			case 'idelete' :
				/*DB의 이미지 경로 조회*/
				$result = mysql_query("SELECT * FROM memImg WHERE id = " . mysql_real_escape_string($_POST['id']));
				$delfile = mysql_fetch_array($result);
				/*이미지 파일 삭제*/
				unlink($delfile['imgPath']);
				/*이미지 파일 DB 삭제*/
				mysql_query('DELETE FROM memImg WHERE id = ' . mysql_real_escape_string($_POST['id']));
				break;
			case 'iupdate' :
				/*이미지 삭제*/
				$result = mysql_query("SELECT * FROM memImg WHERE id = " . mysql_real_escape_string($_POST['id']));
				$delfile = mysql_fetch_array($result);
				unlink($delfile['imgPath']);
				mysql_query('DELETE FROM memImg WHERE id = ' . mysql_real_escape_string($_POST['id']));

				$fileName = $_FILES['userfile']['name'];
				$uploaddir = "/var/www/memINFO/";
				$uploadfile = $uploaddir . $fileName;
				move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
				$sql = "INSERT INTO memImg (id,imgName,imgPath) VALUES ('" . mysql_real_escape_string($_POST['id']) . "','" . mysql_real_escape_string($fileName) . "','" . mysql_real_escape_string($uploadfile) . "')";
				mysql_query($sql);
				break;
		}
      /* HTTP 송신시 아래 메세지 추가 및 list.php 페이지로 이동 */
		header("Location: list.php?id={$_POST['id']}");
	?>
</body>
</html>

