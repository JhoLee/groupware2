<?php

    /*
     * This file recives datas of both 'deposit', 'expenditure', 
     * and save it to a php variable.
     * 수정되지 않은 주석 존재.
     */
    
    /* MySQL Connect... */
    $mysql_host = "localhost";

    $mysql_user = "jho";

    $mysql_pw = "@admin295";

    $mysql_database = "account";



    $connect = mysqli_connect($mysql_host, $mysql_user, $mysql_pw, $mysql_database);

    if(!$connect) die('Not Connected : ' . mysqli_error());
        mysqli_query($connect, "set names utf8");
        /* */

        /* deposit */
        /* Query Datas from DB... */
        $sql = "SELECT 
        date As '날짜',
        name As '이름',
        means As '방법',
        amount As '금액'
        from deposit";
        /* */

    /* php printing test.... -> success
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    print_r($row);
    print($row[이름]);
    echo ($row[이름]);
    */
    
    /* Saving datas into php variables */
    $result = mysqli_query($connect, $sql);

    // Array for names
    $names = array("기타", "김기담", "김제린", "김헵시바", "박재현", "양지원", "이건", "이주호", "전민석", "정원영", "정혜경", "한종현", "허채원", "전체");

    // 3-Demensional array for 'deposit datas of each person'
    // '기타','김기담', '김제린', ..., '허채원'
    // [0] => '날짜' [1] => '이름' [2] => '방법' [3] => '금액'

    // [person]['name' or 'array'][column][order]
    $datas = array(
        array( /* deposit */
                array(array(), array(), array(), array()),      // 0
                array(array(), array(), array(), array()),      // 1
                array(array(), array(), array(), array()),      // 2
                array(array(), array(), array(), array()),      // 3
                array(array(), array(), array(), array()),      // 4
                array(array(), array(), array(), array()),      // 5
                array(array(), array(), array(), array()),      // 6
                array(array(), array(), array(), array()),      // 7
                array(array(), array(), array(), array()),      // 8
                array(array(), array(), array(), array()),      // 9
                array(array(), array(), array(), array()),      // 10
                array(array(), array(), array(), array()),      // 11
                array(array(), array(), array(), array())       // 12
            ),
        array( /* expenditure */
                array(array(), array(), array(), array(), array()),     // 0
                array(array(), array(), array(), array(), array()),     // 1
                array(array(), array(), array(), array(), array()),     // 2
                array(array(), array(), array(), array(), array()),     // 3
                array(array(), array(), array(), array(), array()),     // 4
                array(array(), array(), array(), array(), array()),     // 5
                array(array(), array(), array(), array(), array()),     // 6
                array(array(), array(), array(), array(), array()),     // 7
                array(array(), array(), array(), array(), array()),     // 8
                array(array(), array(), array(), array(), array()),     // 9
                array(array(), array(), array(), array(), array()),     // 10
                array(array(), array(), array(), array(), array()),     // 11
                array(array(), array(), array(), array(), array())      // 12
            )
        
    );
    
    while ($row = mysqli_fetch_row($result)) {
        for ($i = 0; $i < 13; $i++) {
            if($row[1] == $names[$i]) {
                array_push($datas[0][$i][0], $row[0]); // date
                array_push($datas[0][$i][1], $row[1]); // name
                array_push($datas[0][$i][2], $row[2]); // means
                array_push($datas[0][$i][3], $row[3]); // amount
            }

        }
    }

    /* End of 'Saving datas in php variables' */
    /* End of 'deposit'... */               
    
    /* Start of 'expenditure' ... */
    /* Query Datas from DB... */
    $sql = "SELECT 
    date As '날짜',
    usagePlace As '사용처',
    name As '이름',
    means As '방법',
    amount As '금액'
    from expenditure";
    /* */

    /* php printing test.... -> success
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    print_r($row);
    print($row[이름]);
    echo ($row[이름]);
    */
    
    /* Saving datas into php variables */
    $result = mysqli_query($connect, $sql);

/*
    // Array for names
    $names = array("기타", "김기담", "김제린", "김헵시바", "박재현", "양지원", "이건", "이주호", "전민석", "정원영", "정혜경", "한종현", "허채원");
/*
    // 3-Demensional array for 'deposit datas of each person'
    // '기타','김기담', '김제린', ..., '허채원'
    // [0] => '날짜' [1] => '사용처' [2] => 이름' [3] => '방법' [4] => '금액'

    /* 
    // [person]['name' or 'array'][column][order]
    $expenditureData = array(
            array("기타", array(array(), array(), array(), array())),     // 0
            array("김기담", array(array(), array(), array(), array())),        // 1
            array("김제린", array(array(), array(), array(), array())),        // 2
            array("김헵시바", array(array(), array(), array(), array())),       // 3
            array("박재현", array(array(), array(), array(), array())),        // 4
            array("양지원", array(array(), array(), array(), array())),        // 5
            array("이건", array(array(), array(), array(), array())),     // 6
            array("이주호", array(array(), array(), array(), array())),        // 7
            array("전민석", array(array(), array(), array(), array())),        // 8
            array("정원영", array(array(), array(), array(), array())),        // 9
            array("정혜경", array(array(), array(), array(), array())),        // 10
            array("한종현", array(array(), array(), array(), array())),        // 11
            array("허채원", array(array(), array(), array(), array()))     // 12
    );
    */
    
    
    while ($row2 = mysqli_fetch_row($result)) {
        for ($i = 0; $i < 13; $i++) {
            if($row2[2] == $names[$i]) {
                
                
                array_push($datas[1][$i][0], $row2[0]);
                array_push($datas[1][$i][1], $row2[1]);
                array_push($datas[1][$i][2], $row2[2]);
                array_push($datas[1][$i][3], $row2[3]);
                array_push($datas[1][$i][4], $row2[4]);
            }

        }
    }

    /* End of 'Saving datas in php variables' */
    


    /* 
    print($datas[0][1][0][0]." ");
    print($depositData[1][1][1][0]." ");
    print($depositData[1][1][2][0]." ");
    print($depositData[1][1][3][0]." ");
    
    print($expenditureData[1][1][0][0]." ");
    print($expenditureData[1][1][1][0]." ");
    print($expenditureData[1][1][2][0]." ");
    print($expenditureData[1][1][3][0]." ");
    print($expenditureData[1][1][4][0]." ");
    


    print("</br>");
    
    

    print($names[0]);
    
    */

    $loginInfo = array(0,
        '기타' => "...",
        '김기담' => "rlarleka123",
        '김제린' => "rlawpfls01",
        '김헵시바' => "rlagpqtlqk0005",
        '박재현' => "qkrwogus0034",
        '양지원' => "didwldnjs9595",
        '이건' =>"dlrjs0342",
        '이주호' => "dlwngh295",
        '전민석' => "wjsalstjr23423",
        '정원영' => "wjddnjsdud234",
        '정혜경' => "wjdgPrud12345",
        '한종현' => "gkswhdgus0909",
        '허채원' => "gjcodnjs1107"
    );
    ?>
