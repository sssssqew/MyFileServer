<?php
mysql_connect('localhost','root','111111');
mysql_select_db('member');

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");

$list_result = mysql_query('SELECT * FROM memInfo');

if(!empty($_GET['id'])){
    $topic_result = mysql_query('SELECT * FROM memInfo WHERE id = '.mysql_real_escape_string($_GET['id']));
    $topic = mysql_fetch_array($topic_result);

    $sql = "SELECT * FROM memImg WHERE id = ".mysql_real_escape_string($_GET['id']);
    $imgSelected = mysql_fetch_array(mysql_query($sql));
}
?>
<!DOCTYPE html>
<html>
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
            min-width: 150px;
            border-right: 1px solid #ccc;
            padding-right: 0;
         }
         nav ul {
            list-style: none;
            padding-left: 0;
            padding-right: 20px;
         }
         article {
            float: middle;
         }
         .age {
            width: 500px;
         }
      </style>
      </head>
      <body>
            <nav>
                 <ul>
                    <?php
                       while($row = mysql_fetch_array($list_result)){
		   echo "<h3><li><a href=\"?id={$row['id']}\">".htmlspecialchars($row['name'])."</a></li></h3>";
                       }
                    ?>
                 </ui>
            </nav>
            <article>
                <?php
                if(!empty($topic)){
                ?>
                <div>
                <h2><?php echo "NAME :  ".htmlspecialchars($topic['name'])?></h2>
                <h2><?php echo "AGE :  ".htmlspecialchars($topic['age'])?></h2>
                </div>
                <div>
                    <a href="modify.php?id=<?php echo $topic['id']?>">수정</a>
                    <form method="POST" action="process.php?mode=delete">
                        <input type="hidden" name="id" value="<?php echo $topic['id']?>"/>
                        <input type="submit" value="삭제"/>
                    </form>
                    <form method="POST" action="imageProcess.php?iinsert" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
                        <input type="hidden" name="id" value="<?php echo $topic['id']?>"/>
                        <input type="file" name="userfile" />
                        <input type="submit" value="업로드"/>
                    </form>
            
                    <?php
                   
                      if(!empty($_GET['fn'])){
                        if($_GET['up'] == TRUE){
                          echo "<h2>파일 [ {$_GET['fn']} ]이 성공적으로 업로드 되었습니다.</h2>";
                        }else{
                          echo "<h2>파일 [ {$_GET['fn']} ]을 로딩하는데 실패하였습니다.</h2>";
                        }
                      }
                    ?>
                    
                    
                    
               </div>
               <div>
               <?php 
               if(!empty($imgSelected)){
               ?>
               <img src="<?php echo $imgSelected['imgName']?>" width="490" height="300"/>
               <form method="POST" action="imageProcess.php?mode=idelete" >
                     <input type="hidden" name="id" value=<?php echo $imgSelected['id']?>/>
                     <input type="submit" value="사진 삭제"/>
               </form>
               <?php } ?>
               </div>
                <?php
                }else{
                  echo "<h2>데이터가 삭제되어서 로딩할 수 없습니다.</h2>";
                }
                ?>
            </article>
      </body>
</html>

