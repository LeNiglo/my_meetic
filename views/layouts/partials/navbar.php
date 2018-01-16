<div class="row">
    <div class="col-xs-6">
        <a href="/" class="site-title">
            My Meetic
        </a>
    </div>
    <div class="col-xs-6">
        <ul class="nav-links">
            <?php if (auth_check()) { ?>
                <li>
                    <a href="/profile">My Profile</a>
                </li>
                <li>
                    <a href="/auth/logout">Logout</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="/auth/login">Login</a>
                </li>
                <li>
                    <a href="/auth/register">Register</a>
                </li>
            <?php }?>
        </ul>
    </div>
</div>
