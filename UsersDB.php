<?php

require "DBInit.php";

class UsersDB{

    /*
     * Funkcije za shemo img_replica, tabela files
     */
    public static function getAll_files() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, file_name, uploaded, user FROM files");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get_all_user_files($user) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id,file_name, uploaded FROM files 
            WHERE user = :user");
        $statement->bindParam(":user", $user, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();

    }
    public static function insert_files($file_name, $usern) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO files (file_name, uploaded, user)
            VALUES (:file_name, :date_time, :usern)");
        $statement->bindParam(":file_name", $file_name);
        $statement->bindParam(":date_time", date("Y-m-d H:i:s"));
        $statement->bindParam(":usern", $usern);
        $statement->execute();
    }


    /*
     * Funkcije za shemo img_replica, tabela users
     */
    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, uname, email, pass FROM users");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function get($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, uname, email, pass FROM users 
            WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
    public static function get_uname($uname) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, uname, email, pass FROM users 
            WHERE uname = :uname");
        $statement->bindParam(":uname", $uname, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
    public static function get_email($email) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, uname, email, pass FROM users 
            WHERE email = :email");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public static function insert($uname, $email, $pass) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO users (uname, email, pass)
            VALUES (:uname, :email, :pass)");
        $statement->bindParam(":uname", $uname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":pass", $pass);

        $statement->execute();
    }

    public static function update($id, $uname, $email, $pass) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE users SET uname = :uname,
            email = :email, pass = :pass WHERE id = :id");
        $statement->bindParam(":uname", $uname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":pass", $pass);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function change_password($login, $pass) {
        $db = DBInit::getInstance();
        if(strpos($login, "@")){
            $statement = $db->prepare("UPDATE users SET pass = :pass WHERE email = :email");
            $statement->bindParam(":email", $login);
            $statement->bindParam(":pass", $pass);
            $statement->execute();
            }
            else{
                $statement = $db->prepare("UPDATE users SET pass = :pass WHERE uname = :uname");
                $statement->bindParam(":uname", $login);
                $statement->bindParam(":pass", $pass);
                $statement->execute();
            }
    }

    public static function delete($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM users WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function search($query) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, uname,email,pass FROM users 
            WHERE uname LIKE :query OR email LIKE :query");

        # Alternatively, we could execute:
        # $statement = $db->prepare("SELECT id, author, title, price FROM book
        #    WHERE MATCH (author, title) against (:query)");
        # However, we would have to set the table ("book") storage engine to
        # MyISAM and set a joint full-text index to author and title columns

        $statement->bindValue(":query", '%' . $query . '%');
        $statement->execute();

        return $statement->fetchAll();
    }
}
?>