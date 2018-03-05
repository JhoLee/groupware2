<div class="well">
    <form class="form-renewPW" action="<?= site_url('/auth/authentication?returnURL=' . rawurlencode($returnURL)) ?>"
          method="post">
        <img class="mb-4" src="https://cdn1.iconfinder.com/data/icons/flat-business-icons/128/user-512.png" alt=""
             width="72" height="72">
        <h3 class="h5 mb-5 font-weight-normal">비밀번호 갱신</h3>
        <p>ID: <?= $user->id ?></p>
        <?= $this->calendar->generate() ?>
        <div class="input-group">
            <input type="password" id="password-input" class="form-control" placeholder="Password" name="password"
                   required autofocus>
        </div>
        <div class="input-group">
            <input type="password" id="password2-input" class="form-control" placeholder="Password2" name="password2"
                   required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">갱신</button>

    </form>
</div>