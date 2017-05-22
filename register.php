<?php
require_once("UsersDB.php");
function send_conf_mail($uname,$email,$pass){
    $subject="ImgurClone registration notice.";
    $content=wordwrap("Hey there,\n
              thanks for singing up at ImgurClone, your credidentials are the following:
                -Username".$uname."\n
                -Password".$pass."\n
              Everything was sent unencrypted, since I haven't learnt how to encrypt stuff yet.",40);
    $headers="From ImgurClone@notarealemail.com". "\r\n".
             "CC: ceo@notarealemail.com";
    mail($email,$subject,$content);
}
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

                <?php
                session_start();
                if($_SESSION){
                    echo " <li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">";
                    echo "Logged in as ".$_SESSION["uname"];
                }
                else{
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
        <h1>Please create a new account.</h1>
        <hr>
        <div class="content-center">
            <div class="container-fluid">
                <section class="container">
                    <div class="container-page">
                        <div class="col-md-6">
                            <h3 class="dark-grey">Registration</h3>
                        <form action="./register.php" method="post">
                            <div class="form-group col-lg-12">
                                <label>Username</label>
                                <input type="text" name="uname" class="form-control" id="uname" value=""
                                       pattern="[a-zA-Z0-1]{1,15}" title="Invalid username. Upper/lower case charachters and numbers allowed. Max size 15.">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" id="pass" value=""
                                       pattern="[a-zA-Z0-1]{1,15}" title="Invalid password. Upper/lower case charachters and numbers allowed. Max size 15.">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Repeat Password</label>
                                <input type="password" name="repass" class="form-control" id="repass" value=""
                                       pattern="[a-zA-Z0-1]{1,15}" title="Invalid password. Upper/lower case charachters and numbers allowed. Max size 15.">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Email Address</label>
                                <input type="text" name="email" class="form-control" id="email" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Invalid email address.">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Repeat Email Address</label>
                                <input type="text" name="reemail" class="form-control" id="reemail" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Invalid email address.">
                            </div>
                            <div class="form-group col-lg-6">
                                <?php

                                $uname = (isset($_POST["uname"])) ? $_POST["uname"] : null;
                                $pass = (isset($_POST["pass"])) ? $_POST["pass"] : null;
                                $repass = (isset($_POST["repass"])) ? $_POST["repass"] : null;
                                $email = (isset($_POST["email"])) ? $_POST["email"] : null;
                                $reemail = (isset($_POST["reemail"])) ? $_POST["reemail"] : null;

                                $unameOK=true;
                                $passOK= false;
                                $emailOK=false;

                                if($pass!=null) {
                                    if ($pass != $repass) {
                                        echo "<b style=\"text-decoration: underline; color:red;\"><p id=\"raiseError\">Passwords do not match.</p></b>";
                                    }
                                    else{
                                        $passOK=true;
                                    }
                                }
                                if($email!=null){
                                    if ($email != $reemail) {
                                        echo "<b style=\"text-decoration: underline; color:red;\"><p id=\"raiseError\">Emails do not match.</p></b>";
                                    }
                                    else{
                                        $emailOK=true;
                                    }
                                }
                                foreach (UsersDB::getAll() as $users){
                                    if($users["uname"]==$uname){
                                        echo "<b style=\"text-decoration: underline; color:red;\"><p id=\"raiseError\">Username already in use.</p></b>";
                                        $unameOK=false;
                                        break;
                                    }
                                }
                                foreach (UsersDB::getAll() as $users){
                                    if($users["email"]==$email){
                                        echo "<b style=\"text-decoration: underline; color:red;\"><p id=\"raiseError\">Email already in use.</p></b>";
                                        $emailOK=false;
                                        break;
                                    }
                                }


                                if($passOK and $emailOK and $unameOK)
                                    $check_params=true;
                                else
                                    $check_params=false;
                                ?>
                            </div>
                            </div>

                        <div class="col-md-6">
                            <h3 class="dark-grey">Terms and Conditions</h3>
                            <p>
                                By clicking on "Register" you agree to The Company's' Terms and Conditions
                            </p>
                            <p>
                                While rare, prices are subject to change based on exchange rate fluctuations -
                                should such a fluctuation happen, we may request an additional payment. You have the option to request a full refund or to pay the new price. (Paragraph 13.5.8)
                            </p>
                            <p>
                                Should there be an error in the description or pricing of a product, we will provide you with a full refund (Paragraph 13.5.6)
                            </p>
                            <p>
                                Acceptance of an order by us is dependent on our suppliers ability to provide the product. (Paragraph 13.5.6)
                            </p>
                            <p>Where the fuck am I</p>
                            <button type="submit" class="btn btn-primary">Register</button>

                            </form>
                        </div>
                    </div>
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
<!--
array(5) { ["uname"]=> string(4) "test" ["password"]=> string(3) "tes" ["repassword"]=> string(4)
"test" ["email"]=> string(15) "nekaj@gmail.com" ["reemail"]=> string(15) "nekaj@gmail.com" } Array
-->
<?php

if($uname!=null and $pass!=null and $email!=null){
    var_dump($check_params);
    if($check_params){
        try {
            UsersDB::insert($uname,$email,md5($pass));
            send_conf_mail($uname,$email,$pass);
            header("Location: register_success.php");
            echo "<meta http-equiv=\"refresh\" content=\"0; url=register_success.php\">";

        } catch (Exception $e) {
            $errorMessage = "Database error occured: $e";
        }
    }
}
?>