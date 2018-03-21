<div id="login_box" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info">
        <div class="panel-heading">
            <img class="mb-4" src="https://cdn1.iconfinder.com/data/icons/flat-business-icons/128/user-512.png" alt=""
                 width="72" height="72">
            <div class="panel-title">Sign In</div>
            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="register"><s>Forgot
                        password?</s></a>
            </div>
        </div>

        <div style="padding-top:30px" class="panel-body">

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

            <form id="loginform" class="form-horizontal" role="form"
                  action="<?= site_url('/auth/authentication?return_url=' . rawurlencode($return_url)) ?>"
                  method="post">

                <div class="input-group input-group-data" style="margin-bottom:25px;">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="login-username" type="text" class="form-control" name="id" value=""
                           placeholder="ID" autofocus>
                </div>

                <div class="input-group input-group-data" style="margin-bottom:25px;">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password"
                           placeholder="password">
                </div>

                <!--
                <div class="input-group">
                    <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                        </label>
                    </div>
                </div>
                -->


                <div style="margin-top:10px" class="form-group">
                    <!-- Button -->

                    <div class="col-sm-12 controls">
                        <button id="btn-login" class="btn btn-success">Login</button>
                        <a id="btn-register" href="/index.php/auth/register" class="btn btn-primary"><s>Register</s></a>

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
