<?php
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("UsersDB.php");

if (isset($_SESSION["uname"])){
    if (strpos($_SESSION["uname"],"@")){
        $all_data=UsersDB::get_email($_SESSION["uname"]);
        $uname_correct=$all_data["uname"];
    }
    else{
        $uname_correct=$_SESSION["uname"];
    }
}
$old = umask(0);
if (!file_exists("uploads/".$uname_correct)) {
    mkdir("uploads/".$uname_correct, 0777);
    chmod("uploads/".$uname_correct, 0777);
}
umask($old);
$ds          = DIRECTORY_SEPARATOR;  //1

$storeFolder = "uploads/".$uname_correct;   //2
if (!empty($_FILES)) {
       // var_dump($_FILES["file"]["name"]);
        $counter=count($_FILES["file"]["name"]);
        for($i=0; $i<$counter; $i++){
            $tempFile = $_FILES["file"]['tmp_name'][$i];
            $ext = pathinfo($_FILES["file"]['name'][$i], PATHINFO_EXTENSION);
            //maybe ill need this
            $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
            $targetFile =  tempnam($targetPath,'');

            unlink($targetFile);
            $targetFile=$targetFile.".".$ext;
            if(move_uploaded_file($tempFile,$targetFile)){
                $is_in_db=false;
                foreach(UsersDB::getAll_files() as $user_file){
                    if($user_file["file_name"]==$targetFile && $user_file["user"]==$uname_correct){
                        $is_in_db=true;
                    }
                }
                if(!$is_in_db){
                    UsersDB::insert_files($targetFile,$uname_correct);
                }
                else{
                    echo "already in db";
                }
            }
            else{
                //var_dump($tempFile[0]);
                var_dump($targetFile);
            }
        }
}
/*
 * var_dump($test);
            $tempFile = $file[$i]['tmp_name'];          //3
            $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
            $targetFile =  $targetPath. $file[$i]['name'][0];  //5
            if(move_uploaded_file($tempFile[0],$targetFile)){
                echo "works";
            }
            else{
                //var_dump($tempFile[0]);
                //var_dump($targetFile);
            }
 */

?>