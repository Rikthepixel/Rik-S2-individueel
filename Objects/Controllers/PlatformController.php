<?php
require_once "ObjectController.php";

class PlatformController extends ObjectController
{

    //Private
    private $table = "platforms";

    function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
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

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function GetSingle($GameID)
    {
        $GameID = $this->DatabaseHandler->EscapeString($GameID);
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
                    pltfrm.ID = $GameID
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

    public function Delete($GameID)
    {
        $GameID = $this->DatabaseHandler->EscapeString($GameID);
        $Query = "DELETE FROM $this->table WHERE ID = $GameID";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }
}
?>