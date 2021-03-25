<?php

class Game
{

    //Private
    private $DatabaseHandler;
    private $table = "games";

    function __construct($DB)
    {
        $this->DatabaseHandler = $DB;
    }

    public function GetAll()
    {
        $Query = "SELECT 
                pltfrm.Name as Platform_Name,
                pltfrm.Link as Platform_Link,
                imgs.Image as Icon_blob,
                imgs.Name as Icon_Name,
                gms.ID,
                gms.Name,
                gms.IconID,
                gms.PlatformID,
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
                gms.ID,
                gms.Name,
                gms.IconID,
                gms.PlatformID,
                gms.LaunchDate,
                gms.Link
            FROM
                $this->table gms
            LEFT JOIN
                platforms pltfrm ON gms.PlatformID = pltfrm.ID
            LEFT JOIN
                images imgs ON gms.IconID = imgs.ID
            WHERE
                gms.ID = $GameID
            ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Create($CreateData)
    {

        for ($i = 0; $i <= count($CreateData); $i++) {
            $CreateData[$i] = $this->DatabaseHandler->EscapeString($CreateData[$i]);
        }

        $GameName = $CreateData['Name'];
        $Description = $CreateData['Description'];
        $IconID = $CreateData['IconID'];
        $PlatformID = $CreateData['PlatformID'];
        $LaunchDate = $CreateData['LaunchDate'];
        $GameLink = $CreateData['Link'];
        $Visible = $CreateData['Visible'];

        $Query = "INSERT 
                INTO $this->table 
                (
                    'Name',
                    'Description'
                    'IconID',
                    'PlatformID',
                    'Link',
                    'LaunchDate'
                    'Visible'
                )
                VALUES (
                    $GameName,
                    $Description,
                    $IconID, 
                    $PlatformID,
                    $LaunchDate,
                    $GameLink,
                    $Visible
                )
            ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function Update($UpdateData)
    {

        for ($i = 0; $i <= count($UpdateData); $i++) {
            $UpdateData[$i] = $this->DatabaseHandler->EscapeString($UpdateData[$i]);
        }

        function IsValidvalue($Value)
        {
            if (isset($Value) && $Value != null) {
                return true;
            } else {
                return false;
            }
        }

        function CheckandAddToString($Value, $CollumName, $StringtoAddTo)
        {
            if (IsValidvalue($Value)) {
                return "$StringtoAddTo, $CollumName = $Value";
            }
        }


        $UpdateString = "";
        $UpdateString = CheckandAddToString($UpdateData['Name'], 'Name', $UpdateString);
        $UpdateString = CheckandAddToString($UpdateData['LaunchDate'], 'LaunchDate', $UpdateString);
        $UpdateString = CheckandAddToString($UpdateData['Link'], 'Link', $UpdateString);
        $UpdateString = CheckandAddToString($UpdateData['PlatformID'], 'PlatformID', $UpdateString);
        $UpdateString = CheckandAddToString($UpdateData['IconID'], 'IconID', $UpdateString);
        $UpdateString = CheckandAddToString($UpdateData['Description'], 'Description', $UpdateString);
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

    public function Delete($GameID)
    {
        $Query = "DELETE FROM $this->table WHERE ID = $GameID";
        echo "Before execture";
        $ReturnValue =  $this->DatabaseHandler->ExecuteQuery($Query);
        echo "After";
        return $ReturnValue;
    }
}
