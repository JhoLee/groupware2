<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--Bootstrap-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css" rel="stylesheet"
          type="text/css">
    <link href="/application/res/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
    <link href="/application/res/css/footable.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/application/res/css/multi-switch.min.css" rel="stylesheet" type="text/css">

    <style media="screen">
        @media ( min-width: 980px ) {
            body {
                padding-top: 70px;

            }

            .container {
                margin-left: auto;
                margin-right: auto;
            }
        }

        @media (max-width: 980px) {
            .container {
                margin-left: 30px;
                margin-right: 30px;
            }
        }


    </style>

    <!--js-->
    <script src="/application/res/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/application/res/js/multi-switch.js" type="text/javascript"></script>
    <script src="/application/res/js/footable.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function ($) {

            $('.transaction-table').footable({
                "paging": {
                    "enabled": true,
                    "countFormat": "{CP} / {TP}",
                    "size": 15
                },
                "sorting": {
                    "enabled": true
                }
            });
        });
    </script>

    <title>Jho</title>
</head>
<body>

<div role="navigation" class="navbar navbar-default navbar-fixed-top navbar-static">
    <?php
    if ($this->session->flashdata('message')) {
        ?>
        <script>
            alert('<?=$this->session->flashdata('message')?>');
        </script>
        <?php
    }
    ?>
    <div class="container" style="padding-left:10px">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index.php">~~~~</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/index.php/transaction">내역 <span class="sr-only">(current)</span></a></li>
                <li><a href="/index.php/calendar">
                        <s>달력</s>
                    </a></li>
                <li><a href="/index.php/auth/changePW">비밀번호 변경</a></li>

            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><s>Submit</s></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><?= $id . " 님" ?></a></li>
                <!--TODO: 개인정보 페이지로... -->
                <li><a href="/index.php/auth/logout">로그아웃</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</div><!--/div.navbar-->
<?php if ($this->config->item('is_dev') == true) { ?>
    <div class="well">
        개발환경 수정중...
    </div><!--/div.well-->
<?php } ?>
<div class="container-fluid contents">

