<?php
/* 세션 시작 */
session_start();

/* 서버접속 및 DB 선택 */
$conn = mysqli_connect('localhost', 'root', '111111','member') or die("Error ".mysqli_error($conn));


/* PHP와 DB 연동시 문자셋 통일 */
mysqli_query($conn,"set session character_set_connection=utf8;");
mysqli_query($conn,"set session character_set_results=utf8;");
mysqli_query($conn,"set session character_set_client=utf8;");

/* 네비게이션 영역에 DB 목록 출력 */
$list_result = mysqli_query($conn,'SELECT * FROM memInfo');

/* DB에서 모든 테이블 조회 */
if (!empty($_GET['id'])) {
	$topic_result = mysqli_query($conn,'SELECT * FROM memInfo WHERE id = ' . mysqli_real_escape_string($conn,$_GET['id']));
	$topic = mysqli_fetch_array($topic_result,MYSQLI_BOTH);

	$sql1 = "SELECT * FROM memImg WHERE id = " . mysqli_real_escape_string($conn,$_GET['id']);
	$imgSelected = mysqli_fetch_array(mysqli_query($conn,$sql1),MYSQLI_BOTH);

	$sql2 = "SELECT * FROM memMusic WHERE id = " . mysqli_real_escape_string($conn,$_GET['id']);
	$musicSelected = mysqli_fetch_array(mysqli_query($conn,$sql2),MYSQLI_BOTH);
}

?>

<!--------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html>
<!------------------------헤더영역 ------------------------>
      <head>
            <meta charset="utf-8"/>
            <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <style>
		body {
			font-size: 0.8em;
			font-family: sans-serif;
			line-height: 1.6em;
		}
		nav {
			float: left;
			margin-right: 10px;
			min-height: 2500px;
			min-width: 50px;
			border-right: 1px solid #ccc;
			padding-right: 0;
		}
		nav ul {
			list-style: none;
			padding-left: 0;
			padding-right: 25px;
		}
		nav ul a {
			color: white;
                        text-decoration: none;

		}
		nav ul a:hover {
			color: orange;
                        text-decoration: none;
		}
		article {
			float: middle;
		}
		.age {
			width: 500px;
		}
                form{
                        margin-top: 10px;
                }
	        .container-fluid div form {
			float: middle;
			margin-left: 0px;
			margin-top: 10px;
			margin-bottom: 10px;
			width: 370px;
			padding: 0.8em;
			padding-bottom: 7px;
			padding-top: 7px;
			border: 1px solid #ccc;
			border-radius: 0.7em;
		}

		hr {
			border-bottom: 5px solid #ccc;
		}
                /*.row div, .row-fluid div {
                        background-color: #f0ffff;
                }*/
                .Well {
                        border-bottom: 1px solid #ccc;
                        min-width: 1500px;
                        padding-left: 150px;
                        padding-top: 15px;
                        padding-bottom: 20px;
                }
                /*.label-warning {
                        color: black;
                }*/
      </style>
      <!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
      <!--link href="../Bootstrap/css/bootstrap-responsive.css" rel="stylesheet"-->     
      </head>
<!--------------------------- 바디 영역 --------------------------------->      
      <body>
      <?php if(isset($_SESSION['is_login'])){ ?>
            <header>
              <div class="row-fluid">
                <div class="span6">
                <h2 class="Well">Welcome to my homepage !! </h2> 
                </div>
                <div class="span2 offset4">
                  </br>
                  <div class="btn-group">
                    <a class="btn btn-primary" href="#"><i class="icon-user icon-white"></i> <?php echo " ".$_SESSION['nickname']; ?></a>
                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                       <li><a href="#"><i class="icon-pencil"></i> 계정변경</a></li>
                       <li><a href="#"><i class="icon-trash"></i> 계정삭제</a></li>
                       <li><a href="#"><i class="icon-wrench"></i> 친구관리</a></li>
                       <li><a href="logout.php"><i class="icon-off"></i> 로그아웃</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </header>
            <nav>
                 <ul>
                <?php
                    /* 네비게이션 목록 출력 */
					while ($row = mysqli_fetch_array($list_result,MYSQLI_BOTH)) {
						echo "<li><h4><span class=\"label label-inverse\"><a href=\"?id={$row['id']}\">".htmlspecialchars($row['name'])."</a></span></h4></li>";
					}
                ?>
                 </ul>
                 <br/>
                 <h4><a href="./input.php">  목록추가</a></h4>
               
            </nav>
            <article>
            <?php if(empty($_GET['id'])){ ?>
            <img src="ridebarstow.jpg" width="800" height="300"/>
            <?php } ?>
            	    <!-- 본문내용 출력 -->
                <?php
                if(!empty($topic)){
                ?>
                <div>
                <h3><?php echo "NAME :  ".htmlspecialchars($topic['name'])?></h3>
                <h3><?php echo "AGE :  ".htmlspecialchars($topic['age'])?></h3>
                </div>
             <form method="POST" action="process.php?mode=delete">                    
                <div class="form-group">
                    <div class="btn-group">
                       <button class="btn btn-danger" type="submit">삭제</button>
                       <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                       </button>
                       <ul class="dropdown-menu">
                	     <!-- 수정페이지 링크 -->
                             <li><a tabindex="-1" href="modify.php?id=<?php echo $topic['id']?>">revise</a></li>
                             <li><a tabindex="-1" href="#">Action</a></li>
                             <li class="divider"></li>
                             <li><a tabindex="-1" href="#">Separated link</a></li>
                             <li class="dropdown-submenu">
                                 <a tabindex="-1" href="#">More options</a>
                                 <ul class="dropdown-menu">
                                     <li><a tabindex="-1" href="#">option 1</a><li>
                                     <li><a tabindex="-1" href="#">option 2</a><li>
                                     <li><a tabindex="-1" href="#">option 3</a><li>
                                 </ul>
                             </li>
                       </ul>
                    </div>
                    <div>
                        <!-- 본문내용 삭제 -->
                        <input type="hidden" name="id" value="<?php echo $topic['id']?>"/>  
                    </div>
                </div>
             </form>


         <div class="container-fluid">
            <div class="row-fluid">
               <div class="span5">

                         <!-- 사진 업로드 폼 생성 -->
                    <form method="POST" action="imageProcess.php?imode=iinsert" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
                        <input type="hidden" name="id" value="<?php echo $topic['id']?>"/>
                        <label class="btn btn-small" for="my-file-selector1">
                            <input id="my-file-selector1" type="file" name="userfile" style="display:none;"/>
                            파일 선택 
                        </label>               
		        <button class="btn btn-small btn-warning">사진 업로드</button>
                    </form>
              
               
            
               <?php
                   /* 파일이 DB와 HDD에 모두 존재시 사진 표시*/
                 if($imgSelected == TRUE and file_exists($imgSelected['imgPath'])==TRUE){
                     // echo "<h2> 사진 [ {$imgSelected['imgName']} ] 이 성공적으로 업로드 되었습니다.</h2>";
               ?> 
              
                      <img src="<?php echo $imgSelected['imgName']?>" width="380" height="226"/>
                      <form method="POST" action="imageProcess.php?imode=idelete">
                           <input type="hidden" name="id" value="<?php echo $imgSelected['id']?>"/>
                           <button class="btn btn-small btn-danger">사진 삭제</button>
                      </form>
                      <form method="POST" action="imageProcess.php?imode=iupdate" enctype="multipart/form-data">
                           <input type="hidden" name="MAX_FILE_SIZE" value="8000000"/>
                           <input type="hidden" name="id" value="<?php echo $imgSelected['id']?>"/>
                           <label class="btn btn-small" for="my-file-selector2">
                               <input id="my-file-selector2" type="file" name="userfile" style="display:none;">
                               파일 선택
                           </label>
                           <button class="btn btn-small btn-success">사진 변경</button>    
                      </form>
                      <!--success message display -->
                      <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        사진을 성공적으로 업로드 하였습니다!
                      </div> 
                            <?php
				}else{
                            ?>
                                <!-- Thumbnails -->
                                <ul class="thumbnails">
                                  <li class="span5">
                                    <a href="#" class="thumbnail">
                                      <img src="http://placehold.it/300x200" alt="">
                                    </a>
                                  </li>
                                </ul>
               
                                <!--error message display -->
                                <div class="alert alert-error">
                                  <button class="close" data-dismiss="alert">&times;</button> 
				  <strong>주의: </strong>사진을 아직 업로드하지 않았거나 성공적으로 삭제하였습니다!                                
                                </div>
			    <?php
                         	}
                            ?>
			   
               </div>   
               

               <div class="span5">

                <form method="POST" action="musicProcess.php?mmode=minsert" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
                        <input type="hidden" name="id" value="<?php echo $topic['id']?>"/>
                        <input type="hidden" name="" value="upload" />
                        <label class="btn btn-small" for="my-file-selector3">
                            <input id="my-file-selector3" type="file" name="userfile" style="display:none;">
                            파일 선택 
                        </label>
                        <button class="btn btn-small btn-warning">음악 업로드</button>
                </form>
               
                
               
               <?php
                   /* 파일이 DB와 HDD에 모두 존재시 음악재생 */
                 if($musicSelected == TRUE and file_exists($musicSelected['musicPath'])==TRUE){
                     // echo "<h2> 음악 [ {$musicSelected['musicName']} ] 이 성공적으로 업로드 되었습니다.</h2>";
               ?> 
               
                      <audio id="player" controls="" preload="" loop="" >
                      	          <source src="<?php echo $musicSelected['musicName']?>" type="audio/mp3"/>
                      </audio> 
                                  <!--초기 볼륨설정-->
                           <script type="text/javascript">
							        player = document.getElementById("player");
							        player.volume = 0.5;
                           </script>
                      </br>     
                      <!-- 노래제목 출력 -->
                      <span class="label"><?php echo $musicSelected['musicName']; ?></span>
                      <form method="POST" action="musicProcess.php?mmode=mdelete">
                           <input type="hidden" name="id" value="<?php echo $musicSelected['id']?>"/>
                           <button class="btn btn-small btn-danger">음악 삭제</button>
                      </form>
                      <form method="POST" action="musicProcess.php?mmode=mupdate" enctype="multipart/form-data">
                           <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/>
                           <input type="hidden" name="id" value="<?php echo $musicSelected['id']?>"/>
                           <label class="btn btn-small" for="my-file-selector4">
                               <input id="my-file-selector4" type="file" name="userfile" style="display:none;">
                               파일 선택 
                           </label>
                           <button class="btn btn-small btn-success">음악 변경</button>
                      </form>
                      <div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        노래를 성공적으로 업로드 하였습니다. 
                      </div>

                      <!-- Progress bar -->
                      <?php echo var_dump($_SESSION['upload_progress_123']); ?>
  
                      <div class="progress progress-success">
                           <div class="bar" style="width: 40%"></div>
                      </div>
                      
              
                      <?php
				}else{
                      ?>
                      <div class="alert alert-error">
                        <button class="close" data-dismiss="alert">&times;</button>
		        <strong>주의: </strong>노래를 업로드하지 않았거나 성공적으로 삭제하였습니다!
                      </div>
                      <?php
				}
                      ?>
			   
               </div>
          
            </div>

           </div>
           <?php } ?>
            
            </article>
            <script src="http://code.jquery.com/jquery-latest.js"></script>
            <script src="../Bootstrap/js/bootstrap.min.js"></script>
      <?php } ?>
      </body>
</html>

