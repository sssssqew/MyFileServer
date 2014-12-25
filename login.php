<html>
     <head>
          <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
          <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet" >
		  <style>
		     .row-fluid {
                  border:2px solid #ccc;
				  padding-top: 20px;
				  padding-left: 20px;
				  border-radius: 1em;
			 }
		  </style>
     </head>
     <body>
	  <div class="container-fluid">
	  <!--img src="박신혜.jpg" --/>
      
	  <!-- Carousel -->
      <div id="myCarousel" class="carousel slide">
	    <ol class="carousel-indicators">
		  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		  <li data-target="#myCarousel" data-slide-to="1"></li>
		  <li data-target="#myCarousel" data-slide-to="2"></li>
		  <li data-target="#myCarousel" data-slide-to="3"></li>
		  <li data-target="#myCarousel" data-slide-to="4"></li>
		  <li data-target="#myCarousel" data-slide-to="5"></li>
		</ol>
		<div class="carousel-inner">
		  <div class="active item">
		    <img src="mit.jpg" alt="" width="1700">
			<div class="carousel-caption">
			  <h4>A. 브래드 스트리트</h4>
			  <p> 만일 우리에게 겨울이 없다면, 봄은 그토록 즐겁지 않을 것이다.</p>
			  <p> 우리들이 이따금 역경을 맛보지 않는다면, 성공은 그토록 환영받지 못할 것이다.</p>
			</div>
		  </div>
		  <div class="item">
		    <img src="ReadingRoom.jpg" alt="" width="1700">
			<div class="carousel-caption">
			  <h4>스피노자</h4>
			  <p> 두려움, 공포, 분노는 인간 스스로가 만들어낸 마음의 지옥이다.</p>
			</div>
		  </div>
		  <div class="item">
		    <img src="library.jpg" alt="" width="1700">
		  </div>
		  <div class="item">
		    <img src="아인슈타인.jpg" alt="" width="1700">
			<div class="carousel-caption">
			  <h4>Albert Einstein</h4>
			  <p> Imagination is more important than knowledge. </p>
            </div>
		  </div>
		  <div class="item">
		    <img src="스티브잡스2.jpg" alt="" width="1700">
			<div class="carousel-caption">
			  <h4>Steve Jobs</h4>
			  <p> I'm convinced that the only thing that kept me going was that I loved what I did.</p>
			  <p> You've got to find what you love. </p>
			</div>
		  </div>
		  <div class="item">
		    <img src="엘런머스크.jpg" alt="" width="1700">
			<div class="carousel-caption">
		      <h4>Alon Musk</h4>
			  <p> Failure is an option here. If things are not failing, you are not innovating enough.</p>
			</div>
		  </div>
		</div>
		<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	  </div>
       
        <div class="row-fluid">
        <div class="span4">
          <form action="login_process.php" method="POST" >
             <input type="text" class="input-large" placeholder="ID" name="id"/>
             <input type="password" class="input-large" placeholder="PASSWORD" name="pwd"/>
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
		  <?php
		    if(!empty($_GET['delMem'])){
				if($_GET['delMem'] == TRUE){
		  ?>
		  <div class="alert alert-success">
		     <button class="close" data-dismiss="alert">&times;</button>
			 <strong>알림! </strong>회원님의 계정이 성공적으로 삭제되었습니다.
		  </div>
		  <?php
		     $_GET['delMem'] = FALSE;
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
	  </div>
          <script src="http://code.jquery.com/jquery-latest.js"></script>
          <script src="../Bootstrap/js/bootstrap.min.js"></script>
     </body>
</html>



