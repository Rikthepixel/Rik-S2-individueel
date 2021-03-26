<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Database/DatabaseHandler.php";
class GameController
{

    //Private
    private $DatabaseHandler;
    private $table = "games";

    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->TestConnect();
    }

    public function GetAll()
    {
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

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function GetSingle($GameID)
    {
        $GameID = $this->DatabaseHandler->EscapeString($GameID);

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
                gms.ID = $GameID
            ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Create($CreateData)
    {
        $ValuesString = "";
        $NamesString = "";
        $CreateDataKeys = array_keys($CreateData);
        echo count($CreateData);
        for ($i = 0; count($CreateData) > $i; $i++) {
            echo "Loopty";
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
        echo $Query;
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