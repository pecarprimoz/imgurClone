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
                }

                ?>
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="user_control_panel.php">User control panel</a></li>
                    <li><a href="destory_session.php">Log out</a></li>
                </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">

    <div class="row content">
        <h1>Control panel</h1>
        <hr>
        <div class="content-center">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title"><strong>Settings</strong></h3></div>
                    <div class="panel-body">
                        <form action="./user_control_panel.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Change password</label>
                                <input type="password" class="form-control" id="curpw" name="curpw"  placeholder="Enter current password">
                            </div>


                            <button type="submit" class="btn btn-sm btn-default">Reset</button>
                            <?php
                            require_once("UsersDB.php");
                            session_start();
                            $pass = (isset($_POST["curpw"])) ? $_POST["curpw"] : null;
                            if ($pass != null){
                                if(md5($pass)==$_SESSION["md5pw"]){
                                    echo "<script type='text/javascript'>
                                $(document).ready(function(){
                                    $('#myModal').modal('show');
                                });
                                </script>";
                                }
                                else{
                                    echo "<b style=\"text-decoration: underline; color:red;\"><p id=\"raiseError\">The password is not correct.</p></b>";
                                }
                            }

                            $pass = (isset($_POST["pass"])) ? $_POST["pass"] : null;
                            $repass = (isset($_POST["repass"])) ? $_POST["repass"] : null;
                            $passOK= false;

                            if($pass!=null) {
                                if ($pass != $repass) {
                                    echo "<b style=\"text-decoration: underline; color:red;\"><p id=\"raiseError\">Passwords do not match.</p></b>";
                                }
                                else{
                                    $passOK=true;
                                    echo "<b style=\"text-decoration: underline; color:green;\"><p id=\"raiseError\">Password sucessfuly changed.</p></b>";
                                    UsersDB::change_password($_SESSION["uname"],md5($pass));
                                    $_SESSION["md5pw"]=md5($pass);

                                }

                            }
                            ?>

                    </div>

                    </form>

                </div>
                </section>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enter a new password.</h4>
            </div>
            <div class="modal-body">
                <form action="user_control_panel.php" method="post">
                    <div class="form-group col-lg-6">
                        <label>New Password</label>
                        <input type="password" name="pass" class="form-control" id="pass" value=""
                               pattern="[a-zA-Z[0-9]]{1,15}" title="Invalid password. Upper/lower case charachters and numbers allowed. Max size 15.">
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Repeat New Password</label>
                        <input type="password" name="repass" class="form-control" id="repass" value=""
                               pattern="[a-zA-Z[0-9]]{1,15}" title="Invalid password. Upper/lower case charachters and numbers allowed. Max size 15.">
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-left:15px;">Reset password</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<footer class="container-fluid text-center">
    <p>Created by: Primož Pečar</p>
</footer>

</body>
</html>
