<?php
require_once "ObjectRepo.php";
require_once $_SERVER['DOCUMENT_ROOT']."Objects/Models/PlatformModel";

class PlatformModel extends ObjectRepo
{

    //Private
    private $table = "platforms";

    function __construct()
    {
        parent::__construct();
    }

    public function GetAll() {
        $Query = "SELECT 
                pltfrm.ID,
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
        $PlatformsReturned = $this->DatabaseHandler->ExecuteStatement($Statement);

        if ($PlatformsReturned){
            $Platforms = array();
            for ($i=0; $i < count($PlatformsReturned); $i++) { 
                $Platforms[$i] = new PlatformModel($PlatformsReturned[$i]);
            }
    
            return $Platforms;
        }else{
            return null;
        }

    }

    public function GetSingle($PlaftormID) {
        $PlaftormID = $this->DatabaseHandler->EscapeInjection($PlaftormID);
        $Query = "SELECT 
                    pltfrm.ID
                    pltfrm.Name,
                    pltfrm.Link,
                    imgs.ID as Icon_ID
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
        $ReturnedPlatform = $this->DatabaseHandler->ExecuteStatement($Statement);
        if ($ReturnedPlatform) {
            return new PlatformModel($ReturnedPlatform);
        }else{
            return null;
        }
       
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
            if (isset($UpdateData["Description"])) AddToString("Description", $this->DatabaseHandler->EscapeInjection($UpdateData["Description"]), $UpdateString, $ParameterCount);
            if (isset($UpdateData["LaunchDate"])) AddToString("LaunchDate", $this->DatabaseHandler->EscapeInjection($UpdateData["LaunchDate"]), $UpdateString, $ParameterCount);
            if (isset($UpdateData["Visible"])) AddToString("Visible", $this->DatabaseHandler->EscapeInjection($UpdateData["Visible"]), $UpdateString, $ParameterCount);
            if (isset($UpdateData["PlatformID"])) AddToString("PlatformID", $this->DatabaseHandler->EscapeInjection($UpdateData["PlatformID"]), $UpdateString, $ParameterCount);
            if (isset($UpdateData["Link"])) AddToString("Link", $this->DatabaseHandler->EscapeInjection($UpdateData["Link"]), $UpdateString, $ParameterCount);
            if (isset($UpdateData["IconID"])) AddToString("IconID", $this->DatabaseHandler->EscapeInjection($UpdateData["IconID"]), $UpdateString, $ParameterCount);

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

    public function Delete($GameID)
    {
        $GameID = $this->DatabaseHandler->EscapeInjection($GameID);
        $Query = "DELETE FROM $this->table WHERE ID = $GameID";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }
}
?>