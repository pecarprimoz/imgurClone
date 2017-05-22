
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

                <li><a href="./register.php"><span class="glyphicon glyphicon-cloud"></span> Register</a></li>
                <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">

    <div class="row content">
        <h1>Please log in.</h1>
        <hr>
        <div class="content-center">
            <div class="container-fluid">
                <section class="container">
                    <div class="container-page">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h3 class="panel-title"><strong>Sign In </strong></h3></div>
                                    <div class="panel-body">
                                        <form action="./login.php" method="post">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Username or Email</label>
                                                <input type="text" class="form-control" id="uname_email" name="uname_email"  placeholder="Enter email or username">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password
                                                    <a href="" data-toggle="modal" data-target="#myModal">(forgot password)</a></label>

                                                <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                                            </div>

                                            <button type="submit" class="btn btn-sm btn-default">Sign in</button>

                                        </form>
                                        <?php

                                        require_once("UsersDB.php");
                                        $uname_email = (isset($_POST["uname_email"])) ? $_POST["uname_email"] : null;
                                        $pass = (isset($_POST["pass"])) ? $_POST["pass"] : null;

                                        if ($uname_email!=null and $pass!=null){

                                            if(strpos($uname_email,"@")!=false ){
                                                $user=UsersDB::get_email($uname_email);
                                            }
                                            else{

                                                $user=UsersDB::get_uname($uname_email);

                                            }
                                            if($user["pass"]==md5($pass)){
                                                //TODO, nared redirect na user page
                                                session_start();
                                                $_SESSION["uname"]=$uname_email;
                                                $_SESSION["md5pw"]=md5($pass);
                                                echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
                                                echo "Password is correct";
                                            }
                                            if ($user == false) {
                                                echo "<b style=\"text-decoration: underline; color:red;\"><p id=\"raiseError\">Username or email not found in database.</p></b>";
                                            }
                                            else if ($user["pass"] != md5($pass)) {
                                                echo "<b style=\"text-decoration: underline; color:red;\"><p id=\"raiseError\">The password is not correct.</p></b>";
                                            }
                                        }
                                        ?>
                                    </div>
                            </div>
                            <p>Dont have an account yet? Sign up <a href="register.php">here</a>.</p>

                </section>
            </div>

    </div>
</div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Password recovery process.</h4>
                </div>
                <div class="modal-body">
                    <p>Please first check your email, every registered user recives an email upon registration with all his login prompts.
                    If you do not have the email, please contact the administrator.</p>

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