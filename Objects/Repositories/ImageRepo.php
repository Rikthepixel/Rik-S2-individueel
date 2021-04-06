<?php
require_once "ObjectRepo.php";

class ImageModel extends ObjectRepo
{

    //Private
    private $table = "images";

    function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $Query = "SELECT 
                imgs.Name,
                imgs.Image,
                imgs.DateUploaded
            FROM
                $this->table imgs
            ORDER BY 
                imgs.DateUploaded DESC
        ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }

    public function GetSingle($ID)
    {
        $ID = $this->DatabaseHandler->EscapeInjection($ID);

        $Query = "SELECT 
                imgs.Name,
                imgs.Image,
                imgs.DateUploaded
            FROM
                $this->table imgs
            WHERE 
                imgs.ID = :IDnumber
        ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":IDnumber", $ID);

        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }

    public function Create($CreateData) {
        if (array_key_exists("Name", $CreateData)) {
            $ValuesString = "";
            $NamesString = "";

            $Parameters = array();
            $ParameterCount = 0;
            function AddToString($Key, $Value, $ValuesString, $NamesString, $ParameterCount) {
                $ParameterName = ":$Key";

                if ($ParameterCount > 1) {
                    $ValuesString += ", ";
                    $NamesString += ", ";
                }
                $ParameterCount += 1;

                $NamesString += $Key;
                $ValuesString += $ParameterName;

                $Parameters[$ParameterName] = $Value;
            }

            if (isset($UpdateData["Name"])) AddToString("Name", $this->DatabaseHandler->EscapeInjection($CreateData["Name"]), $ValuesString, $NamesString, $ParameterCount);
            if (isset($UpdateData["Image"])) AddToString("Image", $this->DatabaseHandler->EscapeInjection($CreateData["Image"]), $ValuesString, $NamesString, $ParameterCount);
        
            $Query = "INSERT 
                INTO $this->table 
                (
                    $NamesString
                )
                VALUES (
                    $ValuesString
                )
            ";
            $Statement = $this->DatabaseHandler->CreateStatement($Query);

            $this->DatabaseHandler->BindAllParams($Statement, $Parameters);

            return $this->DatabaseHandler->ExecuteStatement($Statement);
        } else {
            return false;
        }
    }

    public function Update($UpdateData) {
        if (array_key_exists("ID", $UpdateData)) {

            $ID = $UpdateData['ID'];
            $UpdateString = "";

            $Parameters = array();
            $ParameterCount = 0;
            function AddToString($Key, $Value, $UpdateString, $ParameterCount)
            {
                $ParameterName = ":$Key";

                if ($ParameterCount > 1) $UpdateString += ", ";
                $ParameterCount += 1;

                $UpdateString += "$Key = $ParameterName";
                $Parameters[$ParameterName] = $Value;
            }

            if (isset($UpdateData["Name"])) AddToString("Name", $this->DatabaseHandler->EscapeInjection($UpdateData["Name"]), $UpdateString, $ParameterCount);

            $Query = "UPDATE $this->table
                    SET
                    $UpdateString
                    WHERE
                        ID = :IDnumber
                ";

            $Statement = $this->DatabaseHandler->CreateStatement($Query);
            $Statement->bindParam(":IDnumber", $ID);

            $this->DatabaseHandler->BindAllParams($Statement, $Parameters);

            return $this->DatabaseHandler->ExecuteStatement($Statement);
        } else {
            return false;
        }
    }

    public function Delete($ID) {
        $ID = $this->DatabaseHandler->EscapeInjection($ID);
        
        $Query = "DELETE FROM $this->table WHERE ID = :IDnumber";
        
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":IDnumber", $ID);

        return $this->DatabaseHandler->ExecuteStatement($Query);
    }
}
?>