<?php
/* 서버접속 및 DB 선택 */
mysql_connect('localhost', 'root', '111111');
mysql_select_db('member');

/* PHP와 DB 연동시 문자셋 통일 */
mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

/* 네비게이션 영역에 DB 목록 출력 */
$list_result = mysql_query('SELECT * FROM memInfo');

/* DB에서 모든 테이블 조회 */
if (!empty($_GET['id'])) {
	$topic_result = mysql_query('SELECT * FROM memInfo WHERE id = ' . mysql_real_escape_string($_GET['id']));
	$topic = mysql_fetch_array($topic_result);

	$sql1 = "SELECT * FROM memImg WHERE id = " . mysql_real_escape_string($_GET['id']);
	$imgSelected = mysql_fetch_array(mysql_query($sql1));

	$sql2 = "SELECT * FROM memMusic WHERE id = " . mysql_real_escape_string($_GET['id']);
	$musicSelected = mysql_fetch_array(mysql_query($sql2));
}

?>

<!--------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<!------------------------헤더영역 ------------------------>
      <head>
            <meta charset="utf-8"/>
      <style>
		body {
			font-size: 0.8em;
			font-family: dotum;
			line-height: 1.6em;
		}
		nav {
			float: left;
			margin-right: 10px;
			min-height: 1500px;
			min-width: 50px;
			border-right: 1px solid #ccc;
			padding-right: 0;
		}
		nav ul {
			list-style: none;
			padding-left: 0;
			padding-right: 50px;
		}
		nav ul a {
			color: perple;
		}
		nav ul a:hover {
			color: orange;
		}
		article {
			float: middle;
		}
		.age {
			width: 500px;
		}
		form {
			float: middle;
			margin-left: 140px;
			margin-top: 10px;
			margin-bottom: 10px;
			width: 350px;
			padding: 0.8em;
			padding-bottom: 7px;
			padding-top: 7px;
			border: 1px solid #ccc;
			border-radius: 0.7em;
		}

		hr {
			border-bottom: 5px solid #ccc;
		}

      </style>
      </head>
<!--------------------------- 바디 영역 --------------------------------->      
      <body>
            <nav>
                 <ul>
                <?php
                    /* 네비게이션 목록 출력 */
					while ($row = mysql_fetch_array($list_result)) {
						echo "<h3><li><a href=\"?id={$row['id']}\">" . htmlspecialchars($row['name']) . "</a></li></h3>";
					}
                    ?>
                 </ui>
            </nav>
            <article>
            	    <!-- 본문내용 출력 -->
                <?php
                if(!empty($topic)){
                    ?>
                <div>
                <h2><?php echo "NAME :  ".htmlspecialchars($topic['name'])?></h2>
                <h2><?php echo "AGE :  ".htmlspecialchars($topic['age'])?></h2>
                </div>
                                 
                <div>
                	     <!-- 수정페이지 링크 -->
                    <h2><a href="modify.php?id=<?php echo $topic['id']?>">수정</a></h2>
                         <!-- 본문내용 삭제 -->
                    <form method="POST" action="process.php?mode=delete">
                        <input type="hidden" name="id" value="<?php echo $topic['id']?>"/>
                        <input type="submit" value="삭제"/>
                    </form>
                         <!-- 구분선 표시 -->
                    <hr size="1" align="left" width="80%" />
                         <?php //echo '</br>'; ?>
                         <!-- 사진 업로드 폼 생성 -->
                    <form method="POST" action="imageProcess.php?imode=iinsert" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
                        <input type="hidden" name="id" value="<?php echo $topic['id']?>"/>
                        <input type="file" name="userfile" />
                        <input type="submit" value="사진 업로드"/>
                    </form>
                </div>
               
               <div>
               <?php
                   /* 파일이 DB와 HDD에 모두 존재시 사진 표시*/
                 if($imgSelected == TRUE and file_exists($imgSelected['imgPath'])==TRUE){
                      echo "<h2> 사진 [ {$imgSelected['imgName']} ] 이 성공적으로 업로드 되었습니다.</h2>";
                   ?> 
               <div>
                      <img src="<?php echo $imgSelected['imgName']?>" width="324" height="200"/>
                      <form method="POST" action="imageProcess.php?imode=idelete">
                           <input type="hidden" name="id" value="<?php echo $imgSelected['id']?>"/>
                           <input type="submit" value="사진 삭제"/>
                      </form>
                      <form method="POST" action="imageProcess.php?imode=iupdate" enctype="multipart/form-data">
                           <input type="hidden" name="MAX_FILE_SIZE" value="8000000"/>
                           <input type="hidden" name="id" value="<?php echo $imgSelected['id']?>"/>
                           <input type="file" name="userfile" />
                           <input type="submit" value="사진 변경"/>
                      </form>
               </div>
               
               <?php
				}else{
				echo "<h2> 사진을 업로드하지 않았거나 성공적으로 삭제되어서 존재하지 않습니다. </h2>";
				}
                   ?>
			   
               </div>
               
                <?php
				}
				/*}else{
				echo "<h2>데이터가 삭제되어서 로딩할 수 없습니다.</h2>";
				}*/
                    ?>
                <hr size="1" align="left" width="80%" />
                    <?php //echo '</br>'; ?>    
                <div>
                <form method="POST" action="musicProcess.php?mmode=minsert" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                        <input type="hidden" name="id" value="<?php echo $topic['id']?>"/>
                        <input type="file" name="userfile" />
                        <input type="submit" value="음악 업로드"/>
                </form>
                </div>
                
               <div>
               <?php
                   /* 파일이 DB와 HDD에 모두 존재시 음악재생 */
                 if($musicSelected == TRUE and file_exists($musicSelected['musicPath'])==TRUE){
                      echo "<h2> 음악 [ {$musicSelected['musicName']} ] 이 성공적으로 업로드 되었습니다.</h2>";
                   ?> 
               <div>
                      <audio id="player" controls="" preload="" loop="" >
                      	          <source src="<?php echo $musicSelected['musicName']?>" type="audio/mp3"/>
                      </audio> 
                                  <!--초기 볼륨설정-->
                           <script type="text/javascript">
							        player = document.getElementById("player");
							        player.volume = 0.6;
                           </script>
                            
                           <!--div>
                           	      <button onclick="document.getElementById('player').play()">Play</button>
                           	      <button onclick="document.getElementById('player').pause()">Pause</button>
                           	      <button onclick="document.getElementById('player').volume += 0.1">Vol+</button>
                           	      <button onclick="document.getElementById('player').volume -= 0.1">Vol-</button>
                           </div-->
                      <form method="POST" action="musicProcess.php?mmode=mdelete">
                           <input type="hidden" name="id" value="<?php echo $musicSelected['id']?>"/>
                           <input type="submit" value="음악 삭제"/>
                      </form>
                      <form method="POST" action="musicProcess.php?mmode=mupdate" enctype="multipart/form-data">
                           <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>
                           <input type="hidden" name="id" value="<?php echo $musicSelected['id']?>"/>
                           <input type="file" name="userfile" />
                           <input type="submit" value="음악 변경"/>
                      </form>
               </div>
               <?php
				}else{
				echo "<h2> 음악을 업로드하지 않았거나 성공적으로 삭제되어서 존재하지 않습니다. </h2>";
				}
                   ?>
			   
               </div>
                    
            </article>
      </body>
</html>

