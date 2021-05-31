<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Models/ImageModel.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Repositories/ObjectRepository.php";

class ImageRepository extends ObjectRepository
{

    function __construct()
    {
        parent::__construct();
        $this->table = "images";
    }

    public function GetAll()
    {
        $Query = "SELECT images.* FROM $this->table images ORDER BY images.id DESC";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement);

        $Images = array();
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                $Project = new ImageModel($Data[$i]->id, $Data[$i]->name, $Data[$i]->created_at);
                array_push($Images, $Project);
            }
        }

        return $Images;
    }

    public function GetSingle($id)
    {
        $Query = "SELECT images.* FROM $this->table images WHERE images.id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $id
        ]);

        $Image = null;
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                $Image = new ImageModel($Data[$i]->id, $Data[$i]->name, $Data[$i]->created_at);
            }
        }

        return $Image;
    }

    public function GetSingleByName($Name)
    {
        $Query = "SELECT images.* FROM $this->table images WHERE images.name = :name";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":name" => $Name
        ]);

        $Image = null;
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                $Image = new ImageModel($Data[$i]->id, $Data[$i]->name, $Data[$i]->created_at);
            }
        }

        return $Image;
    }
    
    public function Create(Model $ImageModel)
    {
        $Query = "INSERT INTO $this->table ('name') VALUES (':name')";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":name" => $ImageModel->name,
        ]);
    }

    public function Update(Model $ImageModel)
    {
        $Query = "UPDATE $this->table SET 'name' = ':name' WHERE id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $ImageModel->id,
            ":name" => $ImageModel->name,
        ]);
    }

    public function Delete($id)
    {
        $Query = "DELETE FROM $this->table WHERE id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $id
        ]);
    }
}