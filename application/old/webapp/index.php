<?php

session_start(); 

require 'authDB.php';

if( isset($_SESSION['user_id']) ) {
    echo("<script type='text/javascript'> alert($_SESSION'[user_id]');</script>");
    $conn->query("set names utf8;");
    $records = $conn->prepare('SELECT id, name, password, permission FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    $user = NULL;
    $message = "";
    
    
    if( count($results) > 0) {
        $user = $results;
        $loginName = $results['name'];
        $permission = $results['permission'];
    }
}

/* for personal page */
if( !empty($_POST['personal']) ) {
    $id = $_POST['personal'];
} else {
    $id = $_SESSION['user_id'];
}

?>

<!doctype html>
<html>

<head>
    <!-- data file -->
    <?php 
    include_once('data.php');
    include_once('sum.php');
    include_once('queriedData.php');
    ?>
    
    
    
    
    
    <!--ViewPort-->
    <meta name="viewport" content="width=device-width" />
    
    
    <meta charset="utf-8">
    <title>account</title>
    
    <!-- JQuery Mobile URL -->
    <link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
    
    
    <!-- my javascript -->
    <script type="text/javascript" src="functions.js"></script>
    
    
</head>

<body>
    
    <!-- If login == true -->   
    <?php if( !empty($user) ): ?>
        
        
        <!-- Start of main page -->
        <div data-role="page" id="main">
            <div data-role="header">
                <a href="#" data-role="button" data-icon="back" data-iconpos="left" data-rel="back">back</a>
				<h1>혜경결 회비 조회</h1>
				<div class="ui-body">로그인: <?=$loginName ?> 님 </div> 
               
                <a class="ui-btn-block" data-role="button" href="logout.php">로그아웃</a>
               
            </div>
            
            <div data-role="content">
              <div data-role="controlgroup">
                <?php if ( $permission == 'Admin' || $permission == 'Root') { ?>
                <a href="#summary" data-role="button">전체 요약</a>
                <?php } ?>
                <a href="#personal" data-role="button">개별 조회</a>
                <a href="passwordChange.php" data-role="button">비밀번호 수정</a>
            </div>
            
        </div>
        
        <div data-role="footer" data-theme="d">

            <h4> 계좌 잔액(<?php echo("$names[13]".") : "."$sum[13]"); ?>
            </h4>

        </div>                

        
    </div>
    <!--End of main page -->
    
    
    
    <!-- Start of summary page -->
    <div data-role="page" id="summary">
      
      
        
      <div data-role="header">
          <a href="#" class="ui-btn-block" data-rel="back">뒤로 가기</a>
          <h1>혜경결 회비 조회 </h1>
          <p class="ui-body">로그인: <?=$loginName ?> 님</p>
          <a class="ui-btn-block" href="logout.php">로그아웃</a>

      </div>
      
      
      <!-- If user is not admin -->
      <?php if( $permission != "Root" &&
        $permission != "Admin") { 
            ?>
            
            <?php $message = '접근 권한이 없습니다'; ?>
            <div data-role="page">
                
                <a href="#" class="ui-btn-block" data-rel="back">접근 권한이 없습니다></a>
                

                
            </div>
            
            
            <!-- If user is admin -->
            <?php } else { ?>
            <div data-role="content">
                
                <?php if( !empty($message) ) { ?>
                <p class="ui-body"><?=$message ?></p>
                <?php } ?>
                <ul style="list-style-type:none;" data-role="listview" data-inset="true">


                    <li>
                        <!-- 김기담 -->  
                        <a href="#building">
                            <h3> <?php echo($names[1]); ?></h3>
                            <p><?php echo("$sum[1]"); ?></p>
                        </a>
                    </li>

                    <li>
                        <!-- 김제린 -->  
                        <a href="#building">
                            <h3> <?php echo($names[2]); ?></h3>
                            <p> <?php echo("$sum[2]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 김헵시바 -->  
                        <a href="#building">
                            <h3> <?php echo($names[3]); ?></h3>
                            <p> <?php echo("$sum[3]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 박재현 -->  
                        <a href="#building">
                            <h3> <?php echo($names[4]); ?></h3>
                            <p> <?php echo("$sum[4]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 양지원 -->  
                        <a href="#building">
                            <h3> <?php echo($names[5]); ?></h3>
                            <p> <?php echo("$sum[5]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 이건 -->  
                        <a href="#building">
                            <h3> <?php echo($names[6]); ?></h3>
                            <p> <?php echo("$sum[6]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 이주호 -->  
                        <a href="#building">
                            <h3> <?php echo($names[7]); ?></h3>
                            <p> <?php echo("$sum[7]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 전민석 -->  
                        <a href="#building">
                            <h3> <?php echo($names[8]); ?></h3>
                            <p> <?php echo("$sum[8]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 정원영 -->  
                        <a href="#building">
                            <h3> <?php echo($names[9]); ?></h3>
                            <p> <?php echo("$sum[9]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 정혜경 -->  
                        <a href="../account02/user10.php">
                            <h3> <?php echo($names[10]); ?></h3>
                            <p> <?php echo("$sum[10]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 한종현 -->  
                        <a href="#building">
                            <h3> <?php echo($names[11]); ?></h3>
                            <p> <?php echo("$sum[11]"); ?></p>
                        </a>
                    </li>           

                    <li>
                        <!-- 허채원 -->  
                        <a href="#building">
                            <h3> <?php echo($names[12]); ?></h3>
                            <p> <?php echo("$sum[12]"); ?></p>
                        </a>
                    </li>           

                </ul>

                <!-- EOL -->
            </div>
            
            
            <?php } ?>
            
            <div data-role="footer" data-theme="d">

                <h4> 계좌 잔액(<?php echo("$names[13]".") : "."$sum[13]"); ?>


                </h4>

            </div>
            
            
            
            
        </div>
        <!-- End of Summary Page -->

        

        <!--Start of Personal Page -->
        <div data-role="page" id="personal">
            <div data-role="header">
                <a href="#" class="ui-btn-block" data-rel="back">뒤로 가기</a>
                <h1>혜경결 회비 조회 (<?=$names[$id] ?>)</h1>
                <p class="ui-body">로그인: <?=$loginName ?> 님 </p>
                <a class="ui-btn-block" data-role="button" href="logout.php">로그아웃</a>
            </div>
			
            <div data-role="content">
            
              <?php if( $permission == "Root" || $permission == "Admin") {   ?>
              <form action="./index.php#personal" data-ajax="false" method="POST">
                <select name="personal" id="personal">
                  <option value="1">김기담</option>
                  <option value="2">김제린</option>
                  <option value="3">김헵시바</option>
                  <option value="4">박재현</option>
                  <option value="5">양지원</option>
                  <option value="6">이건</option>
                  <option value="7">이주호</option>
                  <option value="8">전민석</option>
                  <option value="9">정원영</option>
                  <option value="10">정혜경</option>
                  <option value="11">한종현</option>
                  <option value="12">허채원</option>
                  <input type="submit" value="조회"></input>
              </select>
          </form>
		  <?php } ?>

          
          <div data-role="collapsible-set">
              <div data-role="collapsible">
              <!-- view details of 'deposit' -->
               
                <h3>납입내역</h3>
                <p>
                    
                    <div class="ui-grid-b">
                        <!-- title column of 'details of expenditure' -->
                        <div class="ui-block-a"><div class="ui-bar-d">날짜</div></div>
                        <div class="ui-block-b"><div class="ui-bar-d">방법</div></div>
                        <div class="ui-block-c"><div class="ui-bar-d">금액</div></div>
                        <!-- End of Title Column -->
                        
                        <!-- Start of Contents.. -->
                        <?php
                        $i = 0;
                        while($datas[0][$id][1][$i]) { 
                        // [0] date
                            echo('<div class="ui-block-a"><div class="ui-bar-c">');
                            echo($datas[0][$id][0][$i]); 
                            echo('</div></div>');
                            
						// [1] name - skip
							
                        // [2] means
                            echo('<div class="ui-block-b"><div class="ui-bar-c">');
                            echo($datas[0][$id][2][$i]);
                            echo('</div></div>');
                            
                        // [3] amount
                            echo('<div class="ui-block-c"><div class="ui-bar-c">');
                            echo($datas[0][$id][3][$i]);
                            echo('</div></div>');
                            
                            
                            $i = $i + 1;
                        }
                  /*
                  <div class="ui-block-a">블록 2,1</div>
                  <div class="ui-block-b">블록 2,2</div>
                  <div class="ui-block-c">블록 2,3</div>
                  <div class="ui-block-d">블록 2,4</div>
                  */
                  
                  ?>
                  <!-- End of Contents.. -->
              </div>
                </p>
            </div>
            
            
            <!-- View details of 'Expendtirue' -->
            <div data-role="collapsible" data-collapsed="true">
                <h3>사용내역</h3>
                <p>
                    
                    <div class="ui-grid-c">
                        <!-- title column of 'details of expenditure' -->
                        <div class="ui-block-a"><div class="ui-bar-d">날짜</div></div>
                        <div class="ui-block-b"><div class="ui-bar-d">사용처</div></div>
                        <div class="ui-block-c"><div class="ui-bar-d">본인</div></div>
                        <div class="ui-block-d"><div class="ui-bar-d">전체</div></div>
                        <!-- End of Title Column -->
                        
                        <!-- Start of Contents.. -->
                        <?php
                        $i = 0;
                        while($queriedDatas[1][$id][2][$i]) { 
                        // date
                            echo('<div class="ui-block-a"><div class="ui-bar-c">');
                            echo($queriedDatas[1][$id][0][$i]);
                            echo('</div></div>');
                            
                        // usagePlace
                            echo('<div class="ui-block-b"><div class="ui-bar-c">');
                            echo($queriedDatas[1][$id][1][$i]);
                            echo('</div></div>');
                            
                        // amount
                            echo('<div class="ui-block-c"><div class="ui-bar-c">');
                            echo($queriedDatas[1][$id][2][$i]);
                            echo('</div></div>');
                            
                        // amount sum
                            echo('<div class="ui-block-d"><div class="ui-bar-c">');
                            echo($queriedDatas[1][$id][3][$i]);
                            echo('</div></div>');
                            
                            $i = $i + 1;
                        }
                  /*
                  <div class="ui-block-a">블록 2,1</div>
                  <div class="ui-block-b">블록 2,2</div>
                  <div class="ui-block-c">블록 2,3</div>
                  <div class="ui-block-d">블록 2,4</div>
                  */
                  
                  ?>
                  <!-- End of Contents.. -->
              </div>

              
          </p>
      </div>
  </div>
  
  
</div>

<div data-role="footer" data-theme="d">
    <? print($id); ?>

       <h4>
        회비 잔액(<?php echo("$names[$id]".") : "."$sum[$id]"); ?>
        
        
    </h4>
    
     
</div>
</div>
<!-- End of Personal page -->



<!-- 공사중인디 -->
<div data-role="page" id="building">
    <div data-role="header">
      <a href="#" class="ui-btn-block" data-rel="back">뒤로 가기</a>
      <h1>혜경결 회비 조회 </h1>
      <p class="ui-body">로그인: <?=$loginName ?> 님</p>
      <a class="ui-btn-block" href="logout.php">로그아웃</a>

  </div>
  <div data-role="content">


    <?php if( !empty($message) ) { ?>
    <?=$message ?>
    <?php } ?>
</div>

공사중...


<div data-role="footer" data-theme="d">

    <h4> 계좌 잔액(<?php echo("$names[13]".") : "."$sum[13]"); ?>


    </h4>

</div>
<!-- 공사중이란 말여 -->






<!-- If login == false -->
<?php else: ?>
    <?php header("Location: login.php"); ?>
<?php endif; ?>

</body>

</html>
