<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap-->
    <link href="/application/res/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style>
        body {
            padding-top: 60px;
        }

        .form-control {
            padding-top: 20px;
        }
    </style>
    <link href="/application/res/css/bootstrap-responsive.min.css" rel="stylesheet">
    <title>Jho</title>
</head>
<body>
<?php
if ($this->session->flashdata('message')) {
    ?>
    <script>
        alert('<?=$this->session->flashdata('message')?>');
    </script>
    <?php
}
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">

            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="#">JavaScript</a>

            <!-- Everything you want hidden at 940px or less, place within here -->
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <?php
                    if ($this->session->userdata('is_login')) {
                        ?>
                        <li><a href="/index.php/auth/logout">로그아웃</a></li>
                        <?php
                    } else {
                        ?>
                        <li><a href="/index.php/auth/login">로그인</a></li>
                        <li><a href="/index.php/auth/register">회원가입</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div><!--/div.navbar-inner-->
</div><!--/div.navbar-->
<?php if ($this->config->item('is_dev') == true) { ?>
    <div class="well">
        개발환경 수정중...
    </div><!--/div.well-->
<?php } ?>
<div class="container">
