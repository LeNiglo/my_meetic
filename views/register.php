<form action="/auth/post_register" method="post">
    <input type="hidden" name="_token" value="<?= csrf_token() ?>" />

    <fieldset>
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" id="firstname" placeholder="Firstname" class="form-control" required="required" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" class="form-control" required="required" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="birth_day">Birthday</label>
                    <div class="input-group input-group-birthday">
                        <span class="input-group-addon">
                            <input type="number" min="1" max="31" step="1" name="birth_day" id="birth_day" placeholder="<?= date('d') ?>" class="form-control" required="required" />
                        </span>

                        <span class="input-group-addon">
                            <input type="number" min="1" max="12" step="1" name="birth_month" id="birth_month" placeholder="<?= date('m') ?>" class="form-control" required="required" />
                        </span>

                        <span class="input-group-addon">
                            <input type="number" min="1900" max="<?= date('Y') ?>" step="1" name="birth_year" id="birth_year" placeholder="<?= date('Y') ?>" class="form-control" required="required" />
                        </span>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <label for="male">Gender</label>
            </div>
            <div class="col-xs-6 text-center">
                <label for="male">
                    <input type="radio" name="gender" id="male" value="1" />
                    Male
                </label>
            </div>
            <div class="col-xs-6 text-center">
                <label for="female">
                    <input type="radio" name="gender" id="female" value="0" />
                    Female
                </label>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <label for="city">City</label>
                <select class="form-control" name="city" id="city">
                    <?php foreach (config('CITIES') as $city) { ?>
                        <option value="<?= $city ?>"><?= ucfirst($city) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required" />
                </div>
            </div>

            <div class="col-xs-12">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required" />
                </div>
            </div>

            <div class="col-xs-12">
                <div class="form-group">
                    <label for="password_confirm">Password (Confirmation)</label>
                    <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Password" required="required" />
                </div>

            </div>
        </div>
    </fieldset>

    <p>
        <a href="/auth/login">Already an account ? Login !</a>
    </p>

    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3 text-center">
        <button type="submit" class="btn btn-block btn-primary">
            Register
        </button>
    </div>
</form>
