<?php
    include_once "DatabaseInfo.php";
    class DatabaseHandler{
        public static $DatabaseConnection;

        function __construct()
        {
            $DatabaseConnection = mysqli_connect(DBInfo::$DBServer, DBInfo::$DBUser, DBInfo::$DBPassword, DBInfo::$DBName);
            if (!$DatabaseConnection) {
                die("Connection to the database failed");
            }
        }

    }
?>