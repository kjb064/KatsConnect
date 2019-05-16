<?php
class Dbh {

    protected function connect() {
        $hostname = "mysql.shsustudents.com"; // the hostname you created when creating the database
        $username = "hump";      // the username specified when setting up the database
        $password = "123456789";      // the password specified when setting up the database
        $database = "jabbe";      // the database name chosen when setting up the database

        $link = mysqli_connect($hostname, $username, $password, $database);
        if (mysqli_connect_errno()) {
            die("Connect failed: %s\n" . mysqli_connect_error());
            // exit();
        }

        return $link;
    }




}

?>