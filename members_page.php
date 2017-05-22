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
    <script src="scripts/dropzone.js"></script>
    <script>

        Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element
            url:"upload.php",
            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            acceptedFiles: "image/*",
            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;


                // First change the button to actually tell Dropzone to process the queue.
                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                /* an attempt was made fml
                this.on("addedfile", function () {
                    var classname=document.getElementsByClassName("dz-preview");
                    console.log("it works i made this")

                    var myFunction = function() {

                        console.log("wizard")
                    };
                    for (var i = 0; i < classname.length; i++) {
                        $(classname[i]).unbind
                    }

                    for (var i = 0; i < classname.length; i++) {

                        classname[i].addEventListener('click', myFunction, false);
                    }

                });*/


                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    for(var i=0; i<this.files.length; i++){
                        if(this.files[i].type.split("/")[0]!="image"){
                            console.log("err")
                        }
                    }

                    console.log("multiple")
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {
                    console.log("succ")
                    console.log(response)
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });
                this.on("errormultiple", function(files, response) {
                    console.log("no succ")
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            }

        };

        $('#my-awesome-dropzone').on("submit", function() {

            location.reload();

        });


    </script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }
        .pad-special{
            padding: 1.25rem 0;
        }


        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .content {height: 650px}

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
        .image-set img{
            padding: 10px;
            width:150px;
            height:150px;
        }

        .modal-header-success {
            color:#fff;
            padding:9px 15px;
            border-bottom:1px solid #eee;
            background-color: #5cb85c;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .modal-header-warning {
            color:#fff;
            padding:9px 15px;
            border-bottom:1px solid #eee;
            background-color: orange;
            -webkit-border-top-left-radius: 5px;
            -webkit-border-top-right-radius: 5px;
            -moz-border-radius-topleft: 5px;
            -moz-border-radius-topright: 5px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        body{
            background: #f7f7f4;
            width:100%;
        }
        .text-center{
            text-align: center;
            margin: 1.25rem 0;
            border-bottom: 1px solid #dadada;
        }
        .modal .modal-body {
            max-height: 420px;
            overflow-y: auto;
        }

        /* media queries specific to alignment of forms
           not using form-group Bootstrap to save space
           so we compensate - some phones looked odd so
           check before deployment
         */
        @media screen and (max-width: 540px) {
            .radio {
                margin-left: 1rem;
                font-size: 1.25rem;
            }
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
                <li class="active"><a href="members_page.php">User pictures</a></li>
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
        <h1>This is your user page<?php
            session_start();
            if($_SESSION["uname"]!=null){
                echo ", ".$_SESSION["uname"].".";
            }
            ?></h1>
        <p>Upload or browse already uploaded pictures.</p>
        <hr>
        <div class="container">
            <div class="row">

                <!--========== First Modal ==========-->
                    <article class="col-md-6 well">
                    <h3 class="page-header text-center pad-special">Upload pictures<br />
                        <small>Here you can upload new pictures.</small>
                    </h3>
                    <br><hr>
                    <div class="text-center pad-special">
                        <a class="btn btn-success" href="#successModal" data-toggle="modal"><i class="glyphicon glyphicon-eye-open"></i> Upload pictures</a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header modal-header-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h2><i class="glyphicon glyphicon-cloud"></i> Upload a picture.</h2>
                                </div>
                                <div class="modal-body">
                                    <form id="my-awesome-dropzone" class="dropzone">
                                        <div class="dropzone-previews"></div> <!-- this is were the previews should be shown. -->

                                        <!-- Now setup your input fields -->

                                        <button type="submit" class="btn btn-danger pull-right" data-dismiss="modal">Submit</button>
                                    </form>
                                </div><div class="clearfix"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onClick="window.location.reload();">Close</button>

                                    <!--
                                     Jeben dropzone ne pošilja datotek naprej, php se kliče sam druge stvari pa ne delajo, idk why
                                     Za nadalnje generacije oz. zame, fajli rabjo write acess za podmape
                                     sudo chmod 777 -R /var/www/html/dn03/
                                     -->
                                </div>
                            </div><!-- /.modal-content -->

                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </article>


                <!--========== Second Modal ==========-->
                <article class="col-md-6 well">
                    <h3 class="page-header text-center pad-special">Edit/Browse pictures<br />
                        <small>Here you can browse pictures, that you already uploadeasdd.</small>

                    </h3>
                    <br><hr>
                    <div class="text-center pad-special">
                        <a class="btn btn-warning" href="#warningModal" data-toggle="modal"><i class="glyphicon glyphicon-briefcase"></i> Edit pictures</a>
                    </div>
                    <!-- Modal -->

                    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header modal-header-warning">
                                    <! <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h2><i class="glyphicon glyphicon-user"></i>  Browse your pictures</h2>



                                </div>
                                <div class="modal-body">
                                    <?php
                                    require_once("UsersDB.php");
                                    session_start();
                                    if (isset($_SESSION["uname"])){
                                        if (strpos($_SESSION["uname"],"@")){
                                            $all_data=UsersDB::get_email($_SESSION["uname"]);
                                            $uname_correct=$all_data["uname"];
                                        }
                                        else{
                                            $uname_correct=$_SESSION["uname"];
                                        }
                                    }
                                    //file_name, uploaded
                                    echo "<div class=\"image-set\">";
                                    echo "<form action='index.php' method='POST'>";
                                    foreach (UsersDB::get_all_user_files($uname_correct) as $uslike) {
                                        //var_dump($uslike);
                                        $correct_fname = substr($uslike["file_name"], 13, strlen($uslike["file_name"]));

                                        echo "<a href=\"$correct_fname\" data-lightbox=\"usr-img\" data-title=" . $uslike["uploaded"] . "><img src=\"$correct_fname\"></a>";
                                        echo "<input type=\"button\" name=\"del-" . $uslike["id"] . "\">";
                                        echo "name=\"del-" . $uslike["id"] . "\"";
                                        ///dn03/uploads/primoz/jRXbd1.png
                                        //    echo "<img src=\"file://var/www/html/dn03/uploads/primoz/jRXbd1.png\"";
                                        //    echo "<a href=".$uslike["file_name"]." data-lightbox=\"usr-img\" data-title=".$uslike["uploaded"]."><img src=".$uslike["file_name"]."></a>
                                        //";
                                    }
                                    echo "</form>";
                                    echo "</div>";
                                    ?>
                                    <!-- static way to implement lightbox
                                    <div class="image-set">
                                    <a href="uploads/primoz/DYkdQY.png" data-lightbox="image-1" data-title="My caption"><img src="uploads/primoz/DYkdQY.png"></a>
                                    <a href="uploads/primoz/DYkdQY.png" data-lightbox="image-1" data-title="My caption"><img src="uploads/primoz/DYkdQY.png"></a>
                                    </div>
                                    -->
                                </div><div class="clearfix"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </article>


            </div>
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Created by: Primož Pečar</p>
</footer>

</body>
</html>