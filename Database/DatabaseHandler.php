<?php
include_once "DatabaseInfo.php";
class DatabaseHandler
{
    private $DatabaseConnection;

    public function Connect() {
        $this->DatabaseConnection = null;
        try {
            $Host = DBInfo::$DBServer;
            $DBname = DBInfo::$DBName;
            $this->DatabaseConnection = new PDO("mysql:host=$Host;dbname=$DBname", DBInfo::$DBUser, DBInfo::$DBPassword);
        } catch (PDOException $e) {
            $Message = $e->getMessage();
            echo "Connection error $Message";
        }
        if ($this->DatabaseConnection != null) {
            $this->DatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
    
    public function TestConnect() {
        $this->DatabaseConnection = null;
        try {
            $DBHost = DBInfo::$TestDBServer;
            $DBname = DBInfo::$TestDBName;
            $this->DatabaseConnection = new PDO("mysql:dbname=$DBname;host=$DBHost", DBInfo::$TestDBUser, DBInfo::$TestDBPassword);
        } catch (PDOException $e) {
            $Message = $e->getMessage();
            echo "Connection error $Message";
        }
        if ($this->DatabaseConnection != null) {
            $this->DatabaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->DatabaseConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        //$this->DatabaseConnection = mysqli_connect(DBInfo::$TestDBServer, DBInfo::$TestDBUser, DBInfo::$TestDBPassword, DBInfo::$TestDBName);
        //if (!$this->DatabaseConnection) {
        //    die("Connection to the database failed");
        //}
    }

    public function ExecuteQuery($Query) {
        $Response = $this->DatabaseConnection->query($Query);
        if ($Response != null) {
            if (gettype($Response) == "boolean") {
                return $Response;
            }
            else {
                try {
                    $ReturnArray = array();

                    while ($Row = $Response->fetch()) {   //$Response->FETCH_ASSOC()
                        array_push($ReturnArray, $Row);
                    }
                    
                    if (count($ReturnArray) == 1) {
                        //Dont return an array in an array if it is only one item
                        return $ReturnArray[0];
                    }
                    return $ReturnArray;
                }  catch(PDOException $e) {
                    try {
                        if ( $Response->queryString) {
                            return true;
                        }
                        return;
                    } catch(Error $e) {
                        return $Response;
                    }

                }
            }

        } else {
            return false;
        }

    }

    public function ExecuteStatement($Statement, $Parameters = null) {
        if ($Parameters != null) {
            $ExecutedSuccesfully = $Statement->execute($Parameters);
        } else {
            $ExecutedSuccesfully = $Statement->execute();
        }
        if ($ExecutedSuccesfully) {
            $FetchedArray = $Statement->fetchAll();
            if (count($FetchedArray) == 0) {
                return $ExecutedSuccesfully;
            }
            return $FetchedArray;

        } else {
            return $ExecutedSuccesfully;
        }

    }

    public function CreateStatement($Query) {
        return $this->DatabaseConnection->prepare($Query);
    }

    public function BindAllParams($Statement, $ArrayOfParams){

        //binds Given parameters
        $ParametersKeys = array_keys($ArrayOfParams);
        for ($i = 0; $i < count($ArrayOfParams); $i++) {
            $Statement->bindParam($ParametersKeys[$i], $ArrayOfParams[$i]);
        }
    }

    public function EscapeInjection($UnsafeVariable) {
        return trim(htmlspecialchars_decode(strip_tags($UnsafeVariable)));
    }
}
