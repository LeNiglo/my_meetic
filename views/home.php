<?php if (is_null($user)) { ?>
    <a href="/auth/login">Login first.</a>
<?php } else { ?>
    <?= $user->email ?>
<?php } ?>
