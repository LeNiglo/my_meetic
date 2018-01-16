<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Guillaume Lefrant" />
    <title><?= isset($title) ? $title : 'My Meetic' ?></title>

    <link type="text/css" rel="stylesheet" href="/css/app.css" />
    <link type="text/css" rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css" />
    <style type="text/css" media="screen">
    body, html {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        display: table;
    }
    body {
        display: table-cell;
        vertical-align: middle;
        padding-bottom: 42px !important;
    }

    header, footer {
        position: fixed;
        z-index: 999;
    }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <?php include(__DIR__ . '/partials/navbar.php'); ?>
        </div>
    </header>

    <div class="container">
        <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo ucfirst($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo ucfirst($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php } ?>

        <?php include ($__view_name); ?>
    </div>

    <footer>

    </footer>

    <script type="text/javascript" src="/bower/jquery/dist/jquery.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/bower/bootstrap/dist/js/bootstrap.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/app.js" charset="utf-8"></script>
</body>
</html>
