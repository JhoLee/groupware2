<meta charset="UTF-8">
<?php

    $hostname = "localhost";
    $username = "jholee";
    $passwd = "dbqlqjs295";
    $dbname = "jholee";
    $connect = mysql_connect($hostname, $username, $passwd) or die("Failed");

    $result = mysql_select_db($dbname, $connect);

    echo "결회비 지출내역 (전체) - 17/09/05 기준";
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
    FROM jholee.expenditure
    GROUP BY date
    ORDER BY date ASC;";

    // 출력문
    $rs = mysql_query($sql);
    
    echo "
    <table width='1500' border='1'>
    
        <tr>
    
        <td width='8%' align='center'>날짜</td>

        <td width='14%' align='center'>사용처</td>
    
        <td width='6%' align='center'>김기담</td>
    
        <td width='6%' align='center'>김제린</td>
    
        <td width='6%' align='center'>김헵시바</td>
    
        <td width='6%' align='center'>박재현</td>
    
        <td width='6%' align='center'>양지원</td>
    
        <td width='6%' align='center'>이건</td>

        <td width='6%' align='center'>이주호</td>

        <td width='6%' align='center'>전민석</td>

        <td width='6%' align='center'>정원영</td>

        <td width='6%' align='center'>정혜경</td>

        <td width='6%' align='center'>한종현</td>

        <td width='6%' align='center'>허채원</td>

        <td width='6%' align='center'>합계</td>
    
        </tr>
    
    ";
    
     
    
     // 쿼리의 결과값이 있는 동안 반복을 통한 출력
    
        while($row = mysql_fetch_array($rs))
    
        {
    
            echo("
    
            <tr>

            <td align='center'>$row[date]</td>    
            
            <td align='center'>$row[사용처]</td>

            ");
    
            if($row[김기담]) { 
                echo("
                <td align='center'>\\$row[김기담]</td>
                ");

            } else {
                echo("<td>");
            }

            if($row[김제린]) {
                echo("
                <td align='center'>\\$row[김제린]</td>
                ");
            } else {
                echo("<td>");
            }
    
            if($row[김헵시바]) {
                echo("
                <td align='center'>\\$row[김헵시바]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[박재현]) {
                echo("
                <td align='center'>\\$row[박재현]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[양지원]) {
                echo("
                <td align='center'>\\$row[양지원]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[이건]) {
                echo("
                <td align='center'>\\$row[이건]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[이주호]) {
                echo("
                <td align='center'>\\$row[이주호]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[전민석]) {
                echo("
                <td align='center'>\\$row[전민석]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[정원영]) {
                echo("
                <td align='center'>\\$row[정원영]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[정혜경]) {
                echo("
                <td align='center'>\\$row[정혜경]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[한종현]) {
                echo("
                <td align='center'>\\$row[한종현]</td>
                ");
            } else {
                echo("<td>");
            }

            if($row[허채원]) {
                echo("
                <td align='center'>\\$row[허채원]</td>
                ");
            } else {
                echo("<td>");
            }

            echo("
            <td align='center'>\\$row[합계]</td>
    
            </tr>
    
            ");
    
        }
    
    
    
?>