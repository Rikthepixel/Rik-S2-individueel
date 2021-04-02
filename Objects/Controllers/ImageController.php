<?php
include_once "ObjectController.php";

class ImageController extends ObjectController
{

    //Private
    private $table = "images";

    function __construct()
    {
        parent::__construct();
    }

    public function GetAll()
    {
        $Query = "SELECT 
                imgs.Name,
                imgs.Image,
                imgs.DateUploaded
            FROM
                $this->table imgs
            ORDER BY 
                imgs.DateUploaded DESC
        ";

        return $this->DatabaseHandler->ExecuteQuery($Query);
    }

    public function GetSingle($ID)
    {
        $ID = $this->DatabaseHandler->EscapeString($ID);

        $Query = "SELECT 
                imgs.Name,
                imgs.Image,
                imgs.DateUploaded
            FROM
                $this->table imgs
            WHERE 
                imgs.ID = $ID
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
            $ImageData[$Key] = $this->DatabaseHandler->EscapeString($CreateData[$Key]);

            if ($i != 0) {
                $ValuesString = $ValuesString.",";
                $NamesString = $NamesString.",";
            }
            $ValuesString = $ValuesString."$ImageData[$Key]";
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

    public function Update($ImageData)
    {
        $ImageString = "";
        $ID = $ImageData['ID'];
        unset($ImageData['ID']);
        $ImageDataKeys = array_keys($ImageData);
        for ($i = 0; count($ImageData) > $i; $i++) {
            $Key = $ImageDataKeys[$i];
            $ImageData[$Key] = $this->DatabaseHandler->EscapeString($ImageData[$Key]);

            if ($i != 0) {
                $ImageString = $ImageString.",";
            }
            $ImageString = $ImageString."$Key = $ImageData[$Key]";
        }
        

        $Query = "Image $this->table 
                SET
                $ImageString
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