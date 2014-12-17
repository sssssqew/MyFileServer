<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php
		$conn = mysqli_connect('localhost', 'root', '111111','member') or die("Error ".mysqli_error($conn));

		mysqli_query($conn,'set session character_set_connection=utf8;');
		mysqli_query($conn,'set session character_set_results=utf8;');
		mysqli_query($conn,'set session character_set_client=utf8;');

		switch($_GET['imode']) {
			case 'iinsert' :

				/*이미지 파일경로 생성*/
				$fileName = $_FILES['userfile']['name'];
				$uploaddir = "/var/www/memINFO/";
				$uploadfile = $uploaddir . $fileName;
				/*이미지 파일이동*/
				move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
				/*이미지 파일 DB 추가*/
				$sql = "INSERT INTO memImg (id,imgName,imgPath) VALUES ('" . mysqli_real_escape_string($conn,$_POST['id']) . "','" . mysqli_real_escape_string($conn,$fileName) . "','" . mysqli_real_escape_string($conn,$uploadfile) . "')";
				mysqli_query($conn,$sql);
				break;
			case 'idelete' :
				/*DB의 이미지 경로 조회*/
				$result = mysqli_query($conn,"SELECT * FROM memImg WHERE id = " . mysqli_real_escape_string($conn,$_POST['id']));
				$delfile = mysqli_fetch_array($result,MYSQLI_BOTH);
				/*이미지 파일 삭제*/
				unlink($delfile['imgPath']);
				/*이미지 파일 DB 삭제*/
				mysqli_query($conn,'DELETE FROM memImg WHERE id = ' . mysqli_real_escape_string($conn,$_POST['id']));
				break;
			case 'iupdate' :
				/*이미지 삭제*/
				$result = mysqli_query($conn,"SELECT * FROM memImg WHERE id = " . mysqli_real_escape_string($conn,$_POST['id']));
				$delfile = mysqli_fetch_array($result,MYSQLI_BOTH);
				unlink($delfile['imgPath']);
				mysqli_query($conn,'DELETE FROM memImg WHERE id = ' . mysqli_real_escape_string($conn,$_POST['id']));

				$fileName = $_FILES['userfile']['name'];
				$uploaddir = "/var/www/memINFO/";
				$uploadfile = $uploaddir . $fileName;
				move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
				$sql = "INSERT INTO memImg (id,imgName,imgPath) VALUES ('" . mysqli_real_escape_string($conn,$_POST['id']) . "','" . mysqli_real_escape_string($conn,$fileName) . "','" . mysqli_real_escape_string($conn,$uploadfile) . "')";
				mysqli_query($conn,$sql);
				break;
		}
      /* HTTP 송신시 아래 메세지 추가 및 list.php 페이지로 이동 */
		header("Location: list.php?id={$_POST['id']}");
	?>
</body>
</html>

