<?php
require_once "ObjectRepo.php";

class GameModel extends ObjectRepo
{

    //Private
    private $table = "games";

    function __construct()
    {
        parent::__construct();
    }

    public function GetAll() {
        $Query = "SELECT 
                pltfrm.Name as Platform_Name,
                pltfrm.Link as Platform_Link,
                imgs.Image as Icon_blob,
                imgs.Name as Icon_Name,
                gms.Name,
                gms.LaunchDate,
                gms.Link
            FROM
                $this->table gms
            LEFT JOIN
                images imgs ON gms.IconID = imgs.ID
            LEFT JOIN
                platforms pltfrm ON gms.PlatformID = pltfrm.ID
            ORDER BY 
                gms.LaunchDate DESC
            ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }

    public function GetSingle($ID) {
        $ID = $this->DatabaseHandler->EscapeInjection($ID);

        $Query = "SELECT 
                pltfrm.Name as Platform_Name,
                pltfrm.Link as Platform_Link,
                imgs.Image as Icon_blob,
                imgs.Name as Icon_Name,
                gms.Name,
                gms.LaunchDate,
                gms.Link
            FROM
                $this->table gms
            LEFT JOIN
                images imgs ON gms.IconID = imgs.ID
            LEFT JOIN
                platforms pltfrm ON gms.PlatformID = pltfrm.ID
            WHERE
                gms.ID = :IDnumber
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
            if (isset($UpdateData["Description"])) AddToString("Description", $this->DatabaseHandler->EscapeInjection($CreateData["Description"]), $ValuesString, $NamesString, $ParameterCount);
            if (isset($UpdateData["LaunchDate"])) AddToString("LaunchDate", $this->DatabaseHandler->EscapeInjection($CreateData["LaunchDate"]), $ValuesString, $NamesString, $ParameterCount);
            if (isset($UpdateData["IconID"])) AddToString("IconID", $this->DatabaseHandler->EscapeInjection($CreateData["IconID"]), $ValuesString, $NamesString, $ParameterCount);
            if (isset($UpdateData["PlatformID"])) AddToString("PlatformID", $this->DatabaseHandler->EscapeInjection($CreateData["PlatformID"]), $ValuesString, $NamesString, $ParameterCount);
            if (isset($UpdateData["Link"])) AddToString("Link", $this->DatabaseHandler->EscapeInjection($CreateData["Link"]), $ValuesString, $NamesString, $ParameterCount);
            if (isset($UpdateData["Visible"])) AddToString("Visible", $this->DatabaseHandler->EscapeInjection($CreateData["Visible"]), $ValuesString, $NamesString, $ParameterCount);

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
        
        $Query = "DELETE FROM $this->table WHERE ID = :IDnumber";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":IDnumber", $GameID);

        return $this->DatabaseHandler->ExecuteStatement($Query);
    }
}
?>