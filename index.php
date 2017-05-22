<!DOCTYPE html>
<html lang="en">
<head>
    <title>Imgur clone</title>
    <meta charset="utf-8">
    <link href="style/dropzone.css" type="text/css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="./scripts/jquery-3.2.1.min.js"></script>
    <script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link href="./style/lightbox.css" rel="stylesheet">
    <script src="./scripts/lightbox.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }
        .content-center img{
            padding: 5px;
            width:250px;
            height:175px;
            border: 1px solid lightgray;
            -webkit-background-clip: padding-box; /* for Safari */
            background-clip: padding-box;
        }


        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .content {height: 850px}
        .content-center{
            margin: auto;
            width: 75%;
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
                <?php
                session_start();
                if ($_SESSION["uname"]!=null){
                    echo "<li><a href=\"members_page.php   \">User pictures</a></li>";
                }
                else{
                    echo "<li><a href=\"not_logged.php   \">User pictures</a></li>";
                }
                ?>
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
            <h1>Welcome to an ImgurClone<?php
                session_start();
                if($_SESSION["uname"]!=null){
                    echo ", ".$_SESSION["uname"].".";
                }
            ?></h1>
            <p>These are our top posts.</p>
            <hr>
            <div class="content-center">


                <?php
                require_once("UsersDB.php");
                $row_count=0;
                $num_of_pics=0;
                foreach (UsersDB::getAll_files() as $uslike){
                    if($num_of_pics==16){
                        break;
                    }
                    //var_dump($uslike);
                    if($row_count==0){
                        echo "<div class=\"row\">";
                    }
                    $correct_fname=substr($uslike["file_name"],13, strlen($uslike["file_name"]));
                    echo "<div class=\"col-xs-3\">";
                    echo "<a href=\"$correct_fname\" data-lightbox=\"usr-img\" data-title=".$uslike["uploaded"]."><img src=\"$correct_fname\"></a>";
                    $num_of_pics++;
                    echo "</div>";
                    $row_count++;
                    if($row_count==4){
                        echo "</div>";
                        $row_count=0;
                    }
                    ///dn03/uploads/primoz/jRXbd1.png
                    //    echo "<img src=\"file://var/www/html/dn03/uploads/primoz/jRXbd1.png\"";
                    //    echo "<a href=".$uslike["file_name"]." data-lightbox=\"usr-img\" data-title=".$uslike["uploaded"]."><img src=".$uslike["file_name"]."></a>
                    //";
                }
                ?>




                <!--
                <div class="row">
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                    <div class="col-xs-3">
                        <a href="#" class="thumbnail">
                            <img src="http://placehold.it/300x150" class="img-responsive">
                        </a>
                    </div>
                </div>-->
            </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Created by: Primož Pečar</p>
</footer>

</body>
</html>
