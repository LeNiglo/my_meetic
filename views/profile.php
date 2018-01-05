<?php if (is_null($user)) { ?>
    <h1><?= $title ?></h1>

    <div class="row">
        <div class="col-xs-12 text-right">
            <a href="/home/search" class="btn btn-sm btn-primary">Retour à la recherche</a>
        </div>
    </div>
<?php } else { ?>
    <h1><?= "$user->firstname $user->lastname" ?></h1>

    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $user->firstname ?>" readonly="readonly" />
            </div>

            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $user->lastname ?>" readonly="readonly" />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $user->email ?>" readonly="readonly" />
            </div>

            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="text" name="birthday" id="birthday" class="form-control" value="<?= $user->birthday ?>" readonly="readonly" />
            </div>
        </div>
    </div>

    <?php if ($user->id == auth_id()) { ?>
        <hr />
        <div class="row">
            <div class="col-xs-12">
                <form action="/profile/update" method="post">
                    <input type="hidden" name="_token" value="<?= csrf_token() ?>" />
                    <input type="hidden" name="user_id" value="<?= $user->id ?>" />

                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" name="old_password" id="old_password" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirm">Confirmation</label>
                        <input type="password" name="password_confirm" id="password_confirm" class="form-control" />
                    </div>

                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                    </div>
                    <div class="spacer"></div>
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <a href="/profile/disable" class="btn btn-block btn-danger">DISABLE</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
<?php } ?>
