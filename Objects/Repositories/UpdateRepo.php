<?php
require_once "ObjectRepo.php";

class UpdateModel extends ObjectRepo
{

    //Private
    private $table = "updates";

    function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $Query = "SELECT 
                updt.Name,
                updt.Description,
                updt.GameID,
                updt.ReleaseDate,
                updt.WebsiteAdminID
            FROM
                $this->table updt
            ORDER BY 
                updt.ReleaseDate DESC
        ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);

        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }

    public function GetAllByGame($ID)
    {
        $ID = $this->DatabaseHandler->EscapeInjection($ID);

        $Query = "SELECT 
                updt.Name,
                updt.Description,
                updt.GameID,
                updt.ReleaseDate,
                updt.WebsiteAdminID
            FROM
                $this->table updt
            WHERE
                updt.GameID = :GameID
            ORDER BY 
                updt.ReleaseDate DESC
        ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":GameID", $ID);

        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }

    public function GetSingle($ID)
    {
        $ID = $this->DatabaseHandler->EscapeInjection($ID);

        $Query = "SELECT 
                    updt.Name,
                    updt.Description,
                    updt.GameID,
                    updt.ReleaseDate,
                    updt.WebsiteAdminID
                FROM
                    $this->table updt
                WHERE
                    updt.ID = :IDnumber
                ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":IDnumber", $ID);

        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }

    public function GetSingleGameUpdate($GameID, $UpdateID)
    {
        $GameID = $this->DatabaseHandler->EscapeInjection($GameID);
        $UpdateID = $this->DatabaseHandler->EscapeInjection($UpdateID);

        $Query = "SELECT 
                    updt.Name,
                    updt.Description,
                    updt.GameID,
                    updt.ReleaseDate,
                    updt.WebsiteAdminID
                FROM
                    $this->table updt
                WHERE
                    updt.GameID = :GameID AND
                    updt.UpdateID = :UpdateID $UpdateID
                ";

        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":GameID", $GameID);
        $Statement->bindParam(":UpdateID", $UpdateID);

        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }

    public function Create($CreateData)
    {
        if (array_key_exists("GameID", $CreateData) && array_key_exists("Name", $CreateData)) {
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
            if (isset($UpdateData["ReleaseDate"])) AddToString("ReleaseDate", $this->DatabaseHandler->EscapeInjection($CreateData["ReleaseDate"]), $ValuesString, $NamesString, $ParameterCount);
            if (isset($UpdateData["WebsiteAdminID"])) AddToString("WebsiteAdminID", $this->DatabaseHandler->EscapeInjection($CreateData["WebsiteAdminID"]), $ValuesString, $NamesString, $ParameterCount);
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

    public function Update($UpdateData)
    {
        if (array_key_exists("GameID", $UpdateData) && array_key_exists("UpdateID", $UpdateData)) {

            $ID = $UpdateData['GameID'];
            $UpdateID = $UpdateData['UpdateID'];
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
            if (isset($UpdateData["Link"])) AddToString("Link", $this->DatabaseHandler->EscapeInjection($UpdateData["Link"]), $UpdateString, $ParameterCount);
            if (isset($UpdateData["IconID"])) AddToString("IconID", $this->DatabaseHandler->EscapeInjection($UpdateData["IconID"]), $UpdateString, $ParameterCount);
            
            $Query = "UPDATE $this->table
                    SET
                    $UpdateString
                    WHERE
                        GameID = :IDnumber AND
                        UpdateID = :UpdateIDnumber
                ";

            $Statement = $this->DatabaseHandler->CreateStatement($Query);
            $Statement->bindParam(":IDnumber", $ID);
            $Statement->bindParam(":UpdateIDnumber", $UpdateID);

            $this->DatabaseHandler->BindAllParams($Statement, $Parameters);

            return $this->DatabaseHandler->ExecuteStatement($Statement);
        } else {
            return false;
        }
    }

    public function Delete($ID)
    {
        $ID = $this->DatabaseHandler->EscapeInjection($ID);
        $Query = "DELETE FROM $this->table WHERE ID = :IDnumber";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":IDnumber", $ID);
        return $this->DatabaseHandler->ExecuteStatement($Query);
    }
    public function DeleteAllGameUpdates($GameID)
    {
        $GameID = $this->DatabaseHandler->EscapeInjection($GameID);

        $Query = "DELETE FROM $this->table WHERE GameID = :GameID";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":GameID", $GameID);

        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }
    public function DeleteGameUpdate($GameID, $UpdateID)
    {
        $GameID = $this->DatabaseHandler->EscapeInjection($GameID);
        $UpdateID = $this->DatabaseHandler->EscapeInjection($UpdateID);

        $Query = "DELETE FROM $this->table WHERE GameID = :GameID AND UpdateID = :UpdateID";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Statement->bindParam(":GameID", $GameID);
        $Statement->bindParam(":UpdateID", $UpdateID);

        return $this->DatabaseHandler->ExecuteStatement($Statement);
    }
}
