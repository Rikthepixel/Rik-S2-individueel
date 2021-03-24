<?php
include_once "DatabaseInfo.php";
class DatabaseHandler
{
    public $DatabaseConnection;

    public function Connect()
    {
        $this->DatabaseConnection = null;
        try {
            $this->DatabaseConnection = new PDO('mysql:host='.DBInfo::$DBServer.';dbname='.DBInfo::$DBName, DBInfo::$DBUser, DBInfo::$DBPassword);
        } catch(PDOException $e) {
            echo "Connection error $e->getMessage()";
        }
        $this->DatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //$this->DatabaseConnection = mysqli_connect(DBInfo::$DBServer, DBInfo::$DBUser, DBInfo::$DBPassword, DBInfo::$DBName);
        //if (!$this->DatabaseConnection) {
        //    die("Connection to the database failed");
        //}
    }

    public function ExecuteQuery($Query)
    {

        if ($Response = $this->DatabaseConnection->query($Query)) {
            if ($Response != null) {
                if ($FetchedArray = $Response->fetch(PDO::FETCH_ASSOC)) {
                    $ReturnArray = array();
                    array_push($ReturnArray, $FetchedArray);

                    while ($Row = $Response->fetch_assoc()) {
                        array_push($ReturnArray, $Row);
                    }
                    if (count($ReturnArray) == 1) {
                        //Dont return an array in an array if it is only one item
                        return $ReturnArray[0];
                    }
                    return $ReturnArray;
                } else {
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public function ValidateSQLResponse($ResultValue)
    {  
        $ReturnValue = array(
            "Result" => false,
            "Message" => "Unknown Error"
        );

        if (isset($ResultValue)) {
            if (!$ResultValue) {
                $ReturnValue["Result"] = false;
                $ReturnValue["Message"] = "Database query failed";
            } else {
                $ReturnValue["Result"] = true;
                $ReturnValue["Message"] = "No Errors";
            }
        } else {
            $ReturnValue["Result"] = false;
            $ReturnValue["Message"] = "Error while retrieving data";
        }
        return $ReturnValue;
    }

    public function EscapeString($UnsafeVariable)
    {
        return htmlspecialchars(strip_tags(mysqli_escape_string($this->DatabaseConnection, $UnsafeVariable)));
    }
}
