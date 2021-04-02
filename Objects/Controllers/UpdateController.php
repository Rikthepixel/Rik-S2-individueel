<?php
class UpdateController extends ObjectController
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

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function GetAllByGame($ID)
    {
        $ID = $this->DatabaseHandler->EscapeString($ID);
        $Query = "SELECT 
                updt.Name,
                updt.Description,
                updt.GameID,
                updt.ReleaseDate,
                updt.WebsiteAdminID
            FROM
                $this->table updt
            WHERE
                updt.GameID = $ID
            ORDER BY 
                updt.ReleaseDate DESC
        ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function GetSingle($ID)
    {
        $ID = $this->DatabaseHandler->EscapeString($ID);

        $Query = "SELECT 
                    updt.Name,
                    updt.Description,
                    updt.GameID,
                    updt.ReleaseDate,
                    updt.WebsiteAdminID
                FROM
                    $this->table updt
                WHERE
                    updt.ID = $ID
                ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function GetSingleGameUpdate($GameID, $UpdateID)
    {
        $GameID = $this->DatabaseHandler->EscapeString($GameID);
        $UpdateID = $this->DatabaseHandler->EscapeString($UpdateID);

        $Query = "SELECT 
                    updt.Name,
                    updt.Description,
                    updt.GameID,
                    updt.ReleaseDate,
                    updt.WebsiteAdminID
                FROM
                    $this->table updt
                WHERE
                    updt.GameID = $GameID AND
                    updt.UpdateID = $UpdateID
                ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Create($CreateData)
    {
        if (array_key_exists("GameID", $CreateData) && array_key_exists("Name", $CreateData)) {
            $ValuesString = "";
            $NamesString = "";
            $CreateDataKeys = array_keys($CreateData);
            for ($i = 0; count($CreateData) > $i; $i++) {
                $Key = $CreateDataKeys[$i];
                $UpdateData[$Key] = $this->DatabaseHandler->EscapeString($CreateData[$Key]);

                if ($i != 0) {
                    $ValuesString = $ValuesString . ",";
                    $NamesString = $NamesString . ",";
                }
                $ValuesString = $ValuesString . "$UpdateData[$Key]";
                $NamesString = $NamesString . "$Key";
            }

            $Query = "INSERT 
                INTO $this->table 
                (
                    $NamesString
                )
                VALUES (
                    $ValuesString
                )
            ";
            return $this->DatabaseHandler->ExecuteQuery($Query);
        }
        else {
            return false;
        }
    }

    public function Update($UpdateData)
    {
        if (array_key_exists("GameID", $UpdateData) && array_key_exists("UpdateID", $UpdateData)) {
            $UpdateString = "";
            $ID = $UpdateData['GameID'];
            $UpdateID = $UpdateData['UpdateID'];
            unset($UpdateData['GameID']);
            unset($UpdateData['UpdateID']);
            $UpdateDataKeys = array_keys($UpdateData);
            for ($i = 0; count($UpdateData) > $i; $i++) {
                $Key = $UpdateDataKeys[$i];
                $UpdateData[$Key] = $this->DatabaseHandler->EscapeString($UpdateData[$Key]);

                if ($i != 0) {
                    $UpdateString = $UpdateString . ",";
                }
                $UpdateString = $UpdateString . "$Key = $UpdateData[$Key]";
            }


            $Query = "UPDATE $this->table
                    SET
                    $UpdateString
                    WHERE
                        GameID = $ID AND
                        UpdateID = $UpdateID
                ";
            return $this->DatabaseHandler->ExecuteQuery($Query);
        } else {
            return false;
        }
    }

    public function Delete($ID)
    {
        $ID = $this->DatabaseHandler->EscapeString($ID);
        $Query = "DELETE FROM $this->table WHERE ID = $ID";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }
    public function DeleteGame($GameID)
    {
        $GameID = $this->DatabaseHandler->EscapeString($GameID);
        $Query = "DELETE FROM $this->table WHERE GameID = $GameID";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }
    public function DeleteGameUpdate($GameID, $UpdateID)
    {
        $GameID = $this->DatabaseHandler->EscapeString($GameID);
        $UpdateID = $this->DatabaseHandler->EscapeString($UpdateID);
        $Query = "DELETE FROM $this->table WHERE GameID = $GameID AND UpdateID = $UpdateID";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }
}
