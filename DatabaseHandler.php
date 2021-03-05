<?php
    include_once "DatabaseInfo.php";
    class DatabaseHandler{
        private static $DatabaseConnection;

        function __construct()
        {
            DatabaseHandler::$DatabaseConnection = mysqli_connect(DBInfo::$DBServer, DBInfo::$DBUser, DBInfo::$DBPassword, DBInfo::$DBName);
            if (!DatabaseHandler::$DatabaseConnection) {
                die("Connection to the database failed");
            }
        }

        public static function ExecuteQuery($Query){

            return DatabaseHandler::$DatabaseConnection -> query($Query) -> fetch_array();

        }

    }
?>