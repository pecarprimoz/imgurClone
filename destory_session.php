<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/20/17
 * Time: 2:00 PM
 */
session_start();
session_destroy();
echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
?>