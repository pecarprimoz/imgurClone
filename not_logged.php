<!DOCTYPE html>
<html lang="en">
<head>
    <title>Imgur clone</title>
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
            margin: auto;
            width: 75%;
            text-align: left;
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
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="#">User pictures</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php
                session_start();
                if($_SESSION){
                    echo " <li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">";
                    echo "<span class=\"glyphicon glyphicon-user\"></span>"." Logged in as ".$_SESSION["uname"]." ";
                    echo "<b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                        <li><a href=\"user_control_panel.php\">User control panel</a></li>
                        <li><a href=\"destory_session.php\">Log out</a></li>
                    </ul>";
                }
                else{
                    echo "<li><a href=\"./register.php\"><span class=\"glyphicon glyphicon-cloud\"></span> Register</a></li>";
                    echo "<li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
                }

                ?>

                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">

    <div class="row content">
        <h1>Please log in.</h1>
        <hr>
        <div class="content-center">
            <div class="col-md-7 col-md-offset-3">

                <h3><p>If you want to access the user section log in.<br><br> If you do not have an account, create one by clicking <a href="register.php">register</a>     .</p></h3>

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
