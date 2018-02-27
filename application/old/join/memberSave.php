<?php
     $host = 'localhost';
     $user = 'leejho';
     $pw = 'dbqlqjs295';
     $dbName = 'leejho';
     $mysqli = new mysqli($host, $user, $pw, $dbName);
     
     $id=$_POST['id'];
     $password=md5($_POST['pwd']);
     $name=$_POST['name'];
     $mobile=$_POST['mobile'];
     
     $sql = "INSERT INTO account_info (id, pwd, name, mobile)
                VALUES('$id','$password','$name','$mobile')";
     mysql_query($mysqli, $sql);
     
    ?>