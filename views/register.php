<div class="row">
    <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $title ?></h3>
            </div>
            <div class="panel-body">
                <form action="/auth/post_register" method="post">
                    <input type="hidden" name="_token" value="<?= csrf_token() ?>" />

                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" placeholder="Firstname" class="form-control" value="<?= $form['firstname'] ?>" required="required" />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" class="form-control" value="<?= $form['lastname'] ?>" required="required" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="birth_day">Birthday</label>
                                    <div class="input-group input-group-birthday">
                                        <span class="input-group-addon">
                                            <input type="number" min="1" max="31" step="1" name="birth_day" id="birth_day" placeholder="<?= date('d') ?>" class="form-control" value="<?= $form['birth_day'] ?>" required="required" />
                                        </span>

                                        <span class="input-group-addon">
                                            <input type="number" min="1" max="12" step="1" name="birth_month" id="birth_month" placeholder="<?= date('m') ?>" class="form-control" value="<?= $form['birth_month'] ?>" required="required" />
                                        </span>

                                        <span class="input-group-addon">
                                            <input type="number" min="1900" max="<?= date('Y') ?>" step="1" name="birth_year" id="birth_year" placeholder="<?= date('Y') ?>" class="form-control" value="<?= $form['birth_year'] ?>" required="required" />
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="male">Gender</label>

                                        <div class="row">
                                            <div class="visible-md visible-lg" style="padding-top: 7px;"></div>
                                            <div class="col-xs-6 text-center">
                                                <label for="male">
                                                    <input type="radio" name="gender" id="male" value="1" <?= $form['gender'] === '1' ? 'checked="checked"' : '' ?> />
                                                    Male
                                                </label>
                                            </div>
                                            <div class="col-xs-6 text-center">
                                                <label for="female">
                                                    <input type="radio" name="gender" id="female" value="0" <?= $form['gender'] === '0' ? 'checked="checked"' : '' ?> />
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <label for="city">City</label>
                                <select class="form-control" name="city" id="city">
                                    <?php foreach (config('CITIES') as $city) { ?>
                                        <option value="<?= $city ?>" <?= $form['city'] == $city ? 'selected="selected"' : '' ?>><?= ucfirst($city) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <hr />
                    <fieldset>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"value=" <?= $form['email'] ?>" required="required" />
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="required" />
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
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
            </div>
        </div>
    </div>
</div>
