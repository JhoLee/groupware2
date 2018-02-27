<!doctype html>
<html>

	<!-- data file -->
		<?php 
			include_once('../account02/data.php');
			include_once('../account02/sum.php');
			include_once('../account02/queriedData.php')
		?>
		<!--ViewPort-->
		<meta name="viewport" content="width=device-width" />
 
		
		<meta charset="utf-8">
		<title>account</title>
   		
  	    <!-- JQuery Mobile URL -->
   	    <link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
		
			
		</script>
	
		
	</head>


<body>


<!-- Start of view page -->
	<div data-role="page" id="view">
	  <div data-role="header">
	    <h1>혜경결 회비 조회 - 김기담</h1>
      </div>
	  <div data-role="content">
	    <div data-role="collapsible-set">
	      <div data-role="collapsible">
	        <h3>납입내역</h3>
	        <p>
	        	
	        	<!-- 내용 -->
	        </p>
          </div>
	    
	    	
	    <!-- View details of 'Expendtirue' -->
	      <div data-role="collapsible" data-collapsed="true">
	        <h3>소비내역</h3>
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
					while($queriedDatas[1][1][2][$i]) { 
						// date
						echo('<div class="ui-block-a"><div class="ui-bar-c">');
						echo($queriedDatas[1][1][0][$i]);
						echo('</div></div>');
						
						// usagePlace
						echo('<div class="ui-block-b"><div class="ui-bar-c">');
						echo($queriedDatas[1][1][1][$i]);
						echo('</div></div>');
						
						// amount
						echo('<div class="ui-block-c"><div class="ui-bar-c">');
						echo($queriedDatas[1][1][2][$i]);
						echo('</div></div>');
						
						// amount sum
						echo('<div class="ui-block-d"><div class="ui-bar-c">');
						echo($queriedDatas[1][1][3][$i]);
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
      <!-- End of The Body of page -->
      
	  <div data-role="footer">
	    <h4>
	    	 계좌 잔액(<?php echo($names[1]."): "); print($sum[1]."원"); ?>  </h4>
      </div>
    </div>
	<!-- End of view page -->


</body>
</html>
