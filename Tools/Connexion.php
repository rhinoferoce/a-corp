<?php

class Connexion {
    
    public static function init() {
        /* connect to the application database */

        try {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $base = "id463720_acorp";

            $connection = new PDO("mysql:host=".$host.";dbname=".$base, $user, $pass, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
            
        } catch (PDOException $e) {
            print "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }
    }
}



/*
for remote:
            $host = "localhost";
            $user = "id463720_fchatterji";
            $pass = "topsecre1";
            $base = "id463720_acorp";

for local:
            $host = "localhost";
            $user = "root";
            $pass = "";
            $base = "id463720_acorp";
*/