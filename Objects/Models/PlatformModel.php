<?php
require_once "ObjectController.php";

class PlatformModel extends ObjectModel
{

    //Private
    private $table = "platforms";

    function __construct()
    {
        parent::__construct();
    }

    public function GetAll() {
        $Query = "SELECT 
                pltfrm.Name,
                pltfrm.Link,
                imgs.Image as Icon_blob,
                imgs.Name as Icon_Name
            FROM
                $this->table pltfrm
            LEFT JOIN
                images imgs ON pltfrm.IconID = imgs.ID
            ORDER BY 
                pltfrm.ID DESC
        ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }

    public function GetSingle($PlaftormID) {
        $PlaftormID = $this->DatabaseHandler->EscapeInjection($PlaftormID);
        $Query = "SELECT 
                    pltfrm.Name,
                    pltfrm.Link,
                    imgs.Image as Icon_blob,
                    imgs.Name as Icon_Name
                FROM
                    $this->table pltfrm
                LEFT JOIN
                    images imgs ON pltfrm.IconID = imgs.ID
                WHERE
                    pltfrm.ID = :IDnumber
                ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":IDnumber", $PlaftormID);
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
            if (isset($UpdateData["IconID"])) AddToString("IconID", $this->DatabaseHandler->EscapeInjection($CreateData["IconID"]), $ValuesString, $NamesString, $ParameterCount);
            if (isset($UpdateData["Link"])) AddToString("Link", $this->DatabaseHandler->EscapeInjection($CreateData["Link"]), $ValuesString, $NamesString, $ParameterCount);
            
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

    public function Update($UpdateData)
    {
        $UpdateString = "";
        $ID = $UpdateData['ID'];
        unset($UpdateData['ID']);
        $UpdateDataKeys = array_keys($UpdateData);
        for ($i = 0; count($UpdateData) > $i; $i++) {
            $Key = $UpdateDataKeys[$i];
            $UpdateData[$Key] = $this->DatabaseHandler->EscapeInjection($UpdateData[$Key]);

            if ($i != 0) {
                $UpdateString = $UpdateString.",";
            }
            $UpdateString = $UpdateString."$Key = $UpdateData[$Key]";
        }
        

        $Query = "UPDATE $this->table 
                SET
                $UpdateString
                WHERE
                    ID = $ID
            ";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Delete($GameID)
    {
        $GameID = $this->DatabaseHandler->EscapeInjection($GameID);
        $Query = "DELETE FROM $this->table WHERE ID = $GameID";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }
}
?>