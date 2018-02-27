<?php
/**
 * Created by PhpStorm.
 * User: Jho
 * Date: 2018-01-30
 * Time: 오전 8:38
 */

session_start();
if (!isset($_SESSION['member_name'])) {
    if (!isset($_POST['member_name']) || !isset($_POST['member_pw']) || !isset($_POST['member_team'])) {

        header('Location: /groupware2/login/login.php');
        exit();


    } else {

        require_once 'jho.php';

        $name = $_POST['member_name'];
        $team = $_POST['member_team'];
        $pw = $_POST['member_pw'];


        $result = $db_conn->query("SELECT * FROM member WHERE m_name='$name' AND t_team='$team'");
        if ($result->num_rows > 0) { // 일치하는 ID 존재
            $row = $result->fetch_assoc();
            if (password_verify($pw, $row['m_pw'])) { // ID & PW 일치

                $_SESSION['member_id'] = $row['m_id'];
                $_SESSION['member_name'] = $row['m_name'];
                $_SESSION['member_team'] = $row['t_team'];
                $_SESSION['member_mobile'] = $row['m_mobile'];
                $_SESSION['member_birthday'] = $row['m_birthday'];
                $_SESSION['member_permission'] = $row['m_permission'];
                header("Location: /groupware2/index.php");

            }
        } // ID 미존재 혹은 PW 불일치
        $_SESSION['alert'] = "LOGIN_FAILED";
        header('Location: /groupware2/login/login.php');
        exit();

    }

} else {

    echo $_SESSION['member_name'];
}