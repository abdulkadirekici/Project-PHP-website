<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Flat Theme</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/prettyPhoto.css" rel="stylesheet" type="text/css">
    <link href="../css/animate.css" rel="stylesheet" type="text/css">
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="../images/ico/favicon.ico">
</head><!--/head-->
<body>
<header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../php/index.php"><img src="../images/logo.png" alt="logo"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="../php/index.php?nav=home">Home</a></li>
                <li><a href="../php/index.php?pageid=1">About Us</a></li>
                <li><a href="../php/index.php?pageid=2">Services</a></li>
                <li><a href="../php/index.php?nav=portfolio">Portfolio</a></li>
                <li><a href="../php/index.php?pageid=4">Blog Single</a></li>
                <li><a href="../php/index.php?pageid=3&action=registreren">Registration</a></li>
                <li class="divider"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin<i class="icon-angle-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="../php/index.php?pageid=1">Admin Users</a></li>
                        <li><a href="../php/index.php?pageid=7">Admin Blog</a></li>
                        <li><a href="../php/index.php?pageid=8">Admin Comments</a></li>
                        <li><a href="../php/index.php?pageid=9">Admin Projecten</a></li>
                    </ul>
                </li>
                <li><a href="../php/index.php?pageid=5">Log in</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

            <!-- START BLOCK : LOGINTOP -->
            <form class="navbar-form navbar-right" action="index.php?pageid=5" method="post">
                <div class="form-group">
                    <input type="text" placeholder="Username" class="form-control" name="gnaam">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
            <!-- END BLOCK : LOGINTOP -->
            <!-- START BLOCK : LOGGEDIN -->
            <p class="navbar-text navbar-right">Signed in as <a href="#" class="navbar-link">{USERNAME}</a> - <a href="index.php?pageid=6">Logout</a></p>
            <!-- END BLOCK : LOGGEDIN -->

        </div>
    </div>
</header><!--/header-->