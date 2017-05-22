<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/18/17
 * Time: 4:59 PM
 */
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script src="./scripts/jquery-3.2.1.min.js"></script>
        <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <style>
            /* Remove the navbar's default margin-bottom and rounded borders */
            .navbar {
                margin-bottom: 0;
                border-radius: 0;
            }


            /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
            .content {height: 650px}
            .content-center{
                text-align: left;
                margin: auto;
                width: 100%;
                padding: 10px;
            }
            /* Set black background color, white text and some padding */
            footer {
                background-color: #555;
                color: white;
                padding: 15px;
            }

            /* On small screens, set height to 'auto' for sidenav and grid */
            @media screen and (max-width: 767px) {
                .row.content {height:auto;}
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">ImgurClone</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">User pictures</a></li>
                    <li><a href="#">Placeholder</a></li>
                    <li><a href="#">Placeholder</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li  class="active"><a href="./register.php"><span class="glyphicon glyphicon-cloud"></span> Register</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid text-center">

        <div class="row content">
            <h1>Thank you for creating a new account.</h1>
            <hr>
            <div class="content-center">
                <div class="container-fluid">
                    <section class="container">
                        <div class="container-page">
                            <div class="col-md-6">
                                <h1> Thank you for registering !</h1>
                                <p>The page will automaticly redirect you to your user page.</p>
                                <meta http-equiv="refresh" content="5;URL=index.php" />
                    </section>
                </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">
        <p>Created by: Primož Pečar</p>
    </footer>

    </body>
    </html>