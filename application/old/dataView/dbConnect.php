<!-- DB 로그인 -->
<?php

    echo('Hello');

    $hostname = "localhost";
    $username = "jho";
    $passwd = "@admin295";
    $dbname = "account";
    $connect = mysql_connect($hostname, $username, $passwd) or die("Failed");

    $result = mysql_select_db($dbname, $connect);

    ?>