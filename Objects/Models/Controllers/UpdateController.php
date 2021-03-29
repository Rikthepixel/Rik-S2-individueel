<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Database/DatabaseHandler.php";
include_once "ObjectController.php";

class UpdateController extends ObjectController
{

    //Private
    private $DatabaseHandler;
    private $table = "updates";

    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->Connect();
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

    public function Create($CreateData)
    {
        $ValuesString = "";
        $NamesString = "";
        $CreateDataKeys = array_keys($CreateData);
        for ($i = 0; count($CreateData) > $i; $i++) {
            $Key = $CreateDataKeys[$i];
            $UpdateData[$Key] = $this->DatabaseHandler->EscapeString($CreateData[$Key]);

            if ($i != 0) {
                $ValuesString = $ValuesString.",";
                $NamesString = $NamesString.",";
            }
            $ValuesString = $ValuesString."$UpdateData[$Key]";
            $NamesString = $NamesString."$Key";
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
        echo $Query;
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Update($UpdateData)
    {
        $UpdateString = "";
        $ID = $UpdateData['ID'];
        unset($UpdateData['ID']);
        $UpdateDataKeys = array_keys($UpdateData);
        for ($i = 0; count($UpdateData) > $i; $i++) {
            $Key = $UpdateDataKeys[$i];
            $UpdateData[$Key] = $this->DatabaseHandler->EscapeString($UpdateData[$Key]);

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

    public function Delete($ID)
    {
        $ID = $this->DatabaseHandler->EscapeString($ID);
        $Query = "DELETE FROM $this->table WHERE ID = $ID";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }
}
?>