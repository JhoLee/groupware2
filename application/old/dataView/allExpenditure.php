<meta charset="UTF-8">
<?php

    include "dbConnect.php";

    mysql_query("set names utf8");

    $sql="
    SELECT date,
    
       usagePlace AS 사용처,
    
       SUM(CASE name WHEN '김기담' THEN ammount
            ELSE NULL 
            END) as 김기담,
    
       SUM(CASE name WHEN '김제린' THEN ammount
            ELSE NULL 
            END) as 김제린,
    
       SUM(CASE name WHEN '김헵시바' THEN ammount
            ELSE NULL 
            END) as 김헵시바,
    
       SUM(CASE name WHEN '박재현' THEN ammount
            ELSE NULL 
            END) as 박재현,
    
       SUM(CASE name WHEN '양지원' THEN ammount
            ELSE NULL 
            END) as 양지원,
    
       SUM(CASE name WHEN '이건' THEN ammount
            ELSE NULL 
            END) as 이건,
    
       SUM(CASE name WHEN '이주호' THEN ammount
            ELSE NULL 
            END) as 이주호,
    
       SUM(CASE name WHEN '전민석' THEN ammount
            ELSE NULL 
            END) as 전민석,
    
       SUM(CASE name WHEN '정원영' THEN ammount
            ELSE NULL 
            END) as 정원영,
    
       SUM(CASE name WHEN '정혜경' THEN ammount
            ELSE NULL 
            END) as 정혜경,
    
       SUM(CASE name WHEN '한종현' THEN ammount
            ELSE NULL 
            END) as 한종현,
            
       SUM(CASE name WHEN '허채원' THEN ammount
            ELSE NULL 
            END) as 허채원,
        
        SUM(ammount) AS 합계
    FROM expenditure
    GROUP BY date
    ORDER BY date ASC;";

    // 출력문
    $rs = mysql_query($sql);
    
    echo '
		
		<table width=1500 border=1>
    
        <tr class="title">    
        <td class="dateTitle" width=8% align=center>날짜</td>

        <td class="usageTitle"width=14% align=center>사용처</td>
    
        <td class="nameTitle" width=6% align=center>김기담</td>
    
        <td class="nameTitle" width=6% align=center>김제린</td>
    
        <td class="nameTitle" width=6% align=center>김헵시바</td>
    
        <td class="nameTitle" width=6% align=center>박재현</td>
    
        <td class="nameTitle" width=6% align=center>양지원</td>
    
        <td class="nameTitle" width=6% align=center>이건</td>

        <td class="nameTitle" width=6% align=center>이주호</td>

        <td class="nameTitle" width=6% align=center>전민석</td>

        <td class="nameTitle" width=6% align=center>정원영</td>

        <td class="nameTitle" width=6% align=center>정혜경</td>

        <td class="nameTitle" width=6% align=center>한종현</td>

        <td class="nameTitle" width=6% align=center>허채원</td>

        <td class="sumTitle" width=6% align=center>합계</td>
    
        </tr>
    
    ';
    
     
    
     // 쿼리의 결과값이 있는 동안 반복을 통한 출력
    
        while($row = mysql_fetch_array($rs))
    
        {
    
            echo("
    
            <tr>

            <td align='center'>$row[date]</td>    
            
            <td align='center'>$row[usagePlace]</td>

            ");

            // 김기담
            echo("<td align='center'>");
            if($row[김기담]) { 
                echo("\\$row[김기담]");
            }
            echo("</td>");

            // 김제린
            echo("<td align='center'>");
            if($row[김제린]) { 
                echo("\\$row[김제린]");
            }
            echo("</td>"); 
            
            // 김헵시바
            echo("<td align='center'>");
            if($row[김헵시바]) { 
                echo("\\$row[김헵시바]");
            }
            echo("</td>"); 
            
            // 박재현
            echo("<td align='center'>");
            if($row[박재현]) { 
                echo("\\$row[박재현]");
            }
            echo("</td>"); 

            // 양지원
            echo("<td align='center'>");
            if($row[양지원]) { 
                echo("\\$row[양지원]");
            }
            echo("</td>"); 

            // 이건
            echo("<td align='center'>");
            if($row[이건]) { 
                echo("\\$row[이건]");
            }
            echo("</td>"); 

            // 이주호
            echo("<td align='center'>");
            if($row[이주호]) { 
                echo("\\$row[이주호]");
            }
            echo("</td>"); 

            // 전민석
            echo("<td align='center'>");
            if($row[전민석]) { 
                echo("\\$row[전민석]");
            }
            echo("</td>"); 

            // 정원영
            echo("<td align='center'>");
            if($row[정원영]) { 
                echo("\\$row[정원영]");
            }
            echo("</td>"); 

            // 정혜경
            echo("<td align='center'>");
            if($row[정혜경]) { 
                echo("\\$row[정혜경]");
            }
            echo("</td>"); 

            // 한종현
            echo("<td align='center'>");
            if($row[한종현]) { 
                echo("\\$row[한종현]");
            }
            echo("</td>"); 

            // 허채원
            echo("<td align='center'>");
            if($row[허채원]) { 
                echo("\\$row[허채원]");
            }
            echo("</td>"); 

            echo("
            <td align='center'>\\$row[합계]</td>
    
            </tr>
    
            ");
    
        }
    
    
    
?>