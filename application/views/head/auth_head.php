<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <!--Bootstrap-->
    <link href="/application/res/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/application/res/css/login.css" rel="text/css">
    <style>
        body {
            background-color: #aaa;
            padding-top: 60px;
        }

        .container {
            padding-top: 100px;
            max-width: 260px;
        . center-block();
        }
    </style>
    <link href="/application/res/css/bootstrap-responsive.min.css" rel="stylesheet">
    <title>Jho</title>
</head>
<body class="text-center">
<div class="container">
    <?php
    if ($this->session->flashdata('message')) {
        ?>
        <script>
            alert('<?=$this->session->flashdata('message')?>');
        </script>
        <?php
    }
    ?>

    <?php if ($this->config->item('is_dev') == true) { ?>
        <div class="well">
            개발환경 수정중...
        </div><!--/div.well-->
    <?php } ?>
    <div class="row-fluid">