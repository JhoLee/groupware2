<div class="well">
    <form class="form-signin" action="<?= site_url('/auth/authentication?returnURL=' . rawurlencode($returnURL)) ?>"
          method="post">
        <img class="mb-4" src="https://cdn1.iconfinder.com/data/icons/flat-business-icons/128/user-512.png" alt=""
             width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Login</h1>
        <div class="input-group">
            <input type="text" id="id-input" class="form-control" placeholder="ID" name="id" required autofocus>
        </div>
        <div class="input-group">
            <input type="password" id="assword-input" class="form-control" placeholder="Password" name="password"
                   required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
        <a href="/index.php/Auth/register" class="btn btn-lg btn-block">Sign up</a>
        <!-- TODO 회원가입 및 로그인 처리. -->
    </form>

    <p class="mt-5 mb-3 text-muted">&copy; 2018. <a href="mailto:jooho_lee@outlook.kr">Jho</a></p>
    <!-- TODO: 내 profile 페이지를 만들자. -->
</div>