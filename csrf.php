<?php

function csrf_token()
{
    return $_SESSION['csrf_token'];
}

if (!empty($_POST['_token'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['_token'])) {
        // Log this as a warning and keep an eye on these attempts
        die("CSRF Validation failed.");
    }
}

// Generate a new token for the page
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
