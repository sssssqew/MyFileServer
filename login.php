<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
          <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet" >
     </head>
     <body>
        </br>
        <div class="row">
        <div class="span4 offset2">
          <form action="login_process.php" method="POST" >
             <p><label>아이디    </label><input type="text" name="id" /></p>
             <p><label>비밀번호  </label><input type="password" name="pwd" /></p>
             <button class="btn btn-small btn-success" type="submit">로그인</button>
          </form>
        </div>
        <div class="span6">
          <!-- Button to trigger modal -->
          <a href="#myModal" role="button" class="btn" data-toggle="modal">회원가입</a>
          </br>   
          <?php
          if(!empty($_GET['d'])){
            if($_GET['d'] == TRUE){
          ?>
          <div class="alert">
             <button class="close" data-dismiss="alert">&times;</button>
             <strong>경고! </strong>기존에 계정이 존재하므로 다른 계정으로 가입해 주세요.
          </div>
          <?php
            $_GET['d'] = FALSE;
              }
          }else if(!empty($_GET['insert'])){
            if($_GET['insert'] == TRUE){
          ?>
          <div class="alert alert-success">
             <button class="close" data-dismiss="alert">&times;</button>
             <strong>축하합니다! </strong>회원가입에 성공하였습니다.
          </div>
          <?php
            $_GET['insert'] = FALSE;
              }
          }
          ?> 
          <!-- Modal -->
          <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>회원가입란</h3>
             </div>
             <div class="modal-body">
               <form action="add_member.php" method="POST">
                <p><label>아이디 (ID) </label><input type="text" name="id" /></p>
                <p><label>비밀번호 (PASSWORD) </label><input type="password" name="pwd" /></p> 
             </div>
             <div class="modal-footer">
                <button class="btn btn-primary" type="submit">가입하기</a></button>
               </form>
             </div>
          </div>
        </div>
        </div>
          <script src="http://code.jquery.com/jquery-latest.js"></script>
          <script src="../Bootstrap/js/bootstrap.min.js"></script>
     </body>
</html>



