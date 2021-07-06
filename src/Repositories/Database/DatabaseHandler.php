<?php

namespace Repositories\Database;

class DatabaseHandler
{
    private $DatabaseConnection;

    public function Connect($Server, $DatabaseName, $Username, $Password) {
        $this->DatabaseConnection = null;
        try {
            $this->DatabaseConnection = new \PDO("mysql:host=".$Server.";dbname=".$DatabaseName, $Username, $Password);
        } catch (\PDOException $e) {
            $Message = $e->getMessage();
            echo "Connection error $Message";
        }
        if ($this->DatabaseConnection != null) {
            $this->DatabaseConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
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
                }  catch(\PDOException $e) {
                    try {
                        if ( $Response->queryString) {
                            return true;
                        }
                        return;
                    } catch(\Error $e) {
                        return $Response;
                    }

                }
            }

        } else {
            return false;
        }

    }

    public function ExecuteStatement($Statement, $Parameters = null, $EscapeInjection = true) {
        if ($Parameters != null) {

            if ($EscapeInjection) {

                foreach ($Parameters as $key => $param) {
                    $Parameters[$key] = $this->escapeInjection($param);
                }

            }

            $ExecutedSuccesfully = $Statement->execute($Parameters);
        } else {
            $ExecutedSuccesfully = $Statement->execute();
        }
        if ($ExecutedSuccesfully) {
            try {
                $FetchedArray = $Statement->fetchAll();
            } catch (\Throwable $th) {
                //no data given
                return $ExecutedSuccesfully;
            } 


            if (gettype($FetchedArray) != "array") {
                return $ExecutedSuccesfully;
            }

            for ($i=0; $i < count($FetchedArray); $i++) { 
                $FetchedArray[$i] = (object)$FetchedArray[$i];
            }

            return $FetchedArray;

        } else {
            return $ExecutedSuccesfully;
        }

    }

    public function CreateStatement($Query) {
        return $this->DatabaseConnection->prepare($Query);
    }

    public function escapeInjection($UnsafeVariable, $allowedTags = null) {
        return strip_tags("$UnsafeVariable", $allowedTags);
    }

}
