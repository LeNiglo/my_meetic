<form action="/auth/post_login" method="post">
    <input type="hidden" name="_token" value="<?= csrf_token() ?>" />

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= $form['email'] ?>" required="required" />
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required" />
    </div>

    <p>
        <a href="/auth/register">No account ? Register !</a>
    </p>

    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 text-center">
        <button type="submit" class="btn btn-block btn-primary">
            Login
        </button>
    </div>
</form>
