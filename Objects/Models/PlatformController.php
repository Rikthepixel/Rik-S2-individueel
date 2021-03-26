<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Database/DatabaseHandler.php";
class PlatformController
{
    
    //Private
    private $DatabaseHandler;
    private $table = "platforms";

    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->TestConnect();
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

    public function GetSingle($PlatformID)
    {
        $PlatformID = $this->DatabaseHandler->EscapeString($PlatformID);

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
                pltfrm.ID = $PlatformID
            ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Create($CreateData)
    {

        for ($i = 0; $i <= count($CreateData); $i++) {
            $CreateData[$i] = $this->DatabaseHandler->EscapeString($CreateData[$i]);
        }

        $GameName = $CreateData['Name'];
        $IconID = $CreateData['IconID'];
        $Link = $CreateData['Link'];

        $Query = "INSERT 
                INTO $this->table 
                (
                    'Name',
                    'IconID',
                    'Link',
                )
                VALUES (
                    $GameName,
                    $IconID, 
                    $Link
                )
            ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Update($UpdateData)
    {

        for ($i = 0; $i <= count($UpdateData); $i++) {
            $UpdateData[$i] = $this->DatabaseHandler->EscapeString($UpdateData[$i]);
        }

        function IsValidvalue($Value){
            if (isset($Value) && $Value != null) {
                return true;
            } else {
                return false;
            }
        }

        function CheckandAddToString($Value, $CollumName, $StringtoAddTo){
            if (IsValidvalue($Value)) {
                return "$StringtoAddTo, $CollumName = $Value";
            }
        }


        $UpdateString = "";
        $UpdateString = CheckandAddToString($UpdateData['Name'], 'Name', $UpdateString);
        $UpdateString = CheckandAddToString($UpdateData['Link'], 'Link', $UpdateString);
        $UpdateString = CheckandAddToString($UpdateData['IconID'], 'IconID', $UpdateString);
        $ID = $UpdateData['ID'];

        $Query = "UPDATE $this->table 
                SET
                    $UpdateString
                )
                WHERE
                    ID = $ID
            ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Delete($PlatformID)
    {
        $PlatformID = $this->DatabaseHandler->EscapeString($PlatformID);
        $Query = "DELETE FROM $this->table WHERE ID = $PlatformID";
        return $this->DatabaseHandler->ExecuteQuery($Query);
    }
}
?>