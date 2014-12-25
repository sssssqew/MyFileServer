<html>
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
    <?php

		$conn = mysqli_connect('localhost', 'root', '111111', 'member') or die("Error " . mysqli_error($conn));
		session_start();
		mysqli_query($conn, 'set session character_set_connection=utf8;');
		mysqli_query($conn, 'set session character_set_results=utf8;');
		mysqli_query($conn, 'set session character_set_client=utf8');

        
		echo "친구관리 페이지에 오신 여러분을 환영합니다." . "</br></br>";
     if(!empty($_POST['selected_users'])){
		if (isset($_POST['selected_users'])) {
			//echo var_dump($_POST['selected_users']);
			$serial_selected_users = serialize($_POST['selected_users']);
			//echo var_dump($serial_selected_users);
			
			/* 행이 하나라도 존재해야 이 코드가 실행된다 */
			$result = mysqli_query($conn,"SELECT * FROM friendManage");
			while($friend_List = mysqli_fetch_array($result,MYSQLI_BOTH)){
				if($friend_List['myID'] == $_SESSION['nickname']){
					//echo "당신은 {$friend_List['myID']}입니다.";
					//echo $friend_List['friendID'];
					//echo $serial_selected_users.$friend_List['friendID'];
					
					$friends = unserialize($friend_List['friendID']);

					$newFriends = $_POST['selected_users'];
					
					$total_DB_friends = $friends;
					
					for($cnt=0;$cnt<count($newFriends);$cnt++){
						if(in_array($newFriends[$cnt],$friends)){
						   echo "{$newFriends[$cnt]}가 DB에 이미 존재합니다."."</br>";
						}else{
							echo "{$newFriends[$cnt]}가 DB에 추가되었습니다."."</br>";
							array_push($total_DB_friends,$newFriends[$cnt]);
							//echo $total_DB_friends;
							
						}
					}
					$total_DB_friends_serial = serialize($total_DB_friends);
					/* 기존 친구리스트 행 삭제 */
					$sql = "DELETE FROM friendManage WHERE myID = '".mysqli_real_escape_string($conn,$friend_List['myID'])."'";
					mysqli_query($conn,$sql);
					
					/* 새로 추가할 친구를 포함한 전체 친구리스트 행 재추가 */
					$sql2 = "INSERT INTO friendManage (myID, friendID) VALUES ('".mysqli_real_escape_string($conn,$_SESSION['nickname'])."','".mysqli_real_escape_string($conn,$total_DB_friends_serial)."')";
			      $ret = mysqli_query($conn,$sql2);
				  //if($ret)
				  //echo "새로운 친구를 추가하였습니다."."</br>";
				  echo "</br></br>";
				  /* 새로 추가할 친구를 포함한 전체 친구리스트 표시 */
				  $sql3 = "SELECT * FROM friendManage WHERE myID = '".mysqli_real_escape_string($conn,$_SESSION['nickname'])."'";
				  $list = mysqli_query($conn,$sql3);
				  $list_friends = mysqli_fetch_array($list,MYSQLI_BOTH);
				  $list_friends_unserial = unserialize($list_friends['friendID']);
				  
				  echo "-------------< 친구 리스트 >-------------"."<br>";
				  for($cnt=0;$cnt<count($list_friends_unserial);$cnt++){
				  	 echo $list_friends_unserial[$cnt]."</br>";
				  }
				  echo "--------------------------------------";
				  exit;
					
				}
			}
			
			
			
			/* 선택한 친구목록을 DB에 시리얼로 저장함 */
			$sql = "INSERT INTO friendManage (myID, friendID) VALUES ('".mysqli_real_escape_string($conn,$_SESSION['nickname'])."','".mysqli_real_escape_string($conn,$serial_selected_users)."')";
			$ret = mysqli_query($conn,$sql);
			if($ret) echo "친구추가가 성공적으로 되었습니다."."</br>";
			
			$result = mysqli_query($conn,"SELECT * FROM friendManage");
			$ret_array = mysqli_fetch_array($result,MYSQLI_BOTH);
			$unserial_friends = unserialize($ret_array['friendID']);
			
			echo "-------------< 친구 리스트 >-------------"."<br>";
			for($cnt=0;$cnt < count($unserial_friends);$cnt++){	  	
				echo $unserial_friends[$cnt]."</br>";
			}
			echo "--------------------------------------";
		} else {

			//$unserial_search = unserialize($_GET['search']);
			//echo "아무도 선택하지 않았습니다."."</br>";
			//echo var_dump($_POST['all_search_users']);
			$serial_search_users = serialize($_POST['all_search_users']);
			//$_POST['all_search_users'] = "";
			$not_select = TRUE;
			if (!empty($_GET['id'])) {
				header("Location: list.php?id={$_GET['id']}&search={$serial_search_users}&not_s={$not_select}");
			} else {
				header("Location: list.php?search={$serial_search_users}&not_s={$not_select}");
			}
		}
	}else{
		          /* 새로 추가할 친구를 포함한 전체 친구리스트 표시 */
				  $sql4 = "SELECT * FROM friendManage WHERE myID = '".mysqli_real_escape_string($conn,$_SESSION['nickname'])."'";
				  $list = mysqli_query($conn,$sql4);
				  $list_friends = mysqli_fetch_array($list,MYSQLI_BOTH);
				  $list_friends_unserial = unserialize($list_friends['friendID']);
				  
				  echo "-------------< 친구 리스트 >-------------"."<br>";
				  for($cnt=0;$cnt<count($list_friends_unserial);$cnt++){
				  	 echo $list_friends_unserial[$cnt]."</br>";
				  }
				  echo "--------------------------------------";
		
	}
	?>
</body>
</html>