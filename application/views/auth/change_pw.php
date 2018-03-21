<div id="login_box" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <img class="mb-4" src="https://cdn1.iconfinder.com/data/icons/flat-business-icons/128/user-512.png" alt=""
                 width="72" height="72">
            <div class="panel-title">비밀번호 변경</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px">ID: <?= $id ?>
            </div>
        </div>

        <div style="padding-top:30px" class="panel-body">

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
            <form id="loginform" class="form-horizontal" role="form"
                  action="<?= site_url('/auth/changePW?return_url=' . rawurlencode($return_url)) ?>"
                  method="post">

                <div class="input-group input-group-data" style="margin-bottom:25px;">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="id" type="hidden" class="form-control col-xs-10" name="id" value="<?= $id ?>"
                           placeholder="ID" readonly>
                </div>

                <div class="input-group input-grpup-data" style="margin-bottom:25px;">
                    <div>
                        <input id="origin_password" type="password"
                               class="form-control" name="origin_password"
                               value="<?= set_value('origin_password') ?>"
                               placeholder="기존 비밀번호" aria-describedby="origin_help-block">
                    </div>

                    <?php if (!empty(form_error('origin_password'))) { ?>
                        <span id="origin_help-block" class="help-block alert alert-danger"
                        ><?= form_error('origin_password') ?></span>
                    <?php } ?>
                </div>

                <div class="input-group input-group-data" style="margin-bottom:25px;">
                    <input id="password1" type="password" class="form-control" name="password1"
                           value="<?= set_value('password1') ?>"
                           placeholder="변경할 비밀번호" aria-describedby="password1_help-block">
                    <?php if (!empty(form_error('origin_password'))) { ?>
                        <span id="password1_help-block" class="help-block alert alert-danger"
                        ><?= form_error('password1') ?></span>
                    <?php } ?>
                </div>


                <div class="input-group input-group-data" style="margin-bottom:25px;">
                    <input id="password2" type="password" class="form-control" name="password2"
                           value="<?= set_value('password2') ?>"
                           placeholder="비밀번호 재입력" aria-describedby="password2_help-block">
                    <?php if (!empty(form_error('origin_password'))) { ?>
                        <span id="password2_help-block" class="help-block alert alert-danger"
                        ><?= form_error('password2') ?></span>
                    <?php } ?>
                </div>

                <div style="margin-top:10px" class="form-group">
                    <!-- Button -->

                    <div class="col-sm-12 controls">
                        <input type="submit" id="btn-register" href="/index.php/auth/register"
                               class="btn btn-primary btn-block" value="변경">

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 control">
                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                            Contact to
                            <?= $email ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
