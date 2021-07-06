<?php
namespace Repositories;

use Models\Model;
use Models\ImageModel;

class ImageRepository extends ObjectRepository
{

    function __construct()
    {
        parent::__construct();
        $this->table = "images";
        $this->storagePath = $_SERVER["DOCUMENT_ROOT"]."/storage/Images";
        $this->sourcePath = "/storage/Images";
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
    
    public function Create(Model $ImageModel)
    {
        $Query = "INSERT INTO $this->table (name) VALUES (:name)";
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

    public function GetMaxId()
    {
        $Query = "SELECT MAX(id) FROM `images`";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        
        $ImageId = $this->DatabaseHandler->ExecuteStatement($Statement);
        if ($ImageId)
        {
            for ($i=0; $i < count($ImageId); $i++) { 
                $index = "MAX(id)";
                return $ImageId[$i]->$index;
            }
        }
    }

    public function StoreImage($File)
    {
        if (!$File)
        {
            return null;
        }

        $Name = basename($File["name"]);
        $path_parts = pathinfo($File["name"]);

        if (!isset($path_parts["extension"])) {
            return null;
        }
    
        $quality = 50;
        $imageTmp = null;
        $newExtention = "jpg";

        $OriginalImageSize = filesize($File["tmp_name"]);

        switch (exif_imagetype($File["tmp_name"])) {
            case IMAGETYPE_PNG:
                $imageTmp = imagecreatefrompng($File["tmp_name"]);
                break;
            case IMAGETYPE_JPEG:
                $imageTmp = imagecreatefromjpeg($File["tmp_name"]);
                break;
            case IMAGETYPE_GIF:
                $imageTmp = imagecreatefromgif($File["tmp_name"]);
                $newExtention = "gif";
                break;
            case IMAGETYPE_BMP:
                $imageTmp = imagecreatefrombmp($File["tmp_name"]);
                break;
            default:
                $imageTmp = imagecreatefromjpeg($File["tmp_name"]);
                break;
        }

        $success = $this->Create(new ImageModel(0, $Name, 0));
        if (!$success) {
            return null;
        }

        $id = $this->GetMaxId();
        if (!$id) {
            return null;
        }

        $originalPath = $this->storagePath."/".$id.".".$path_parts["extension"];
        $newPath = $this->storagePath."/".$id.".".$newExtention;

        if (!imagejpeg($imageTmp, $newPath, $quality)){
            imagedestroy($imageTmp);

            $this->Delete($id);
            return null;
        }
        imagedestroy($imageTmp);
        
        $NewImageSize = filesize($newPath);
        if ($NewImageSize > $OriginalImageSize) {

            if (!move_uploaded_file($File["tmp_name"], $originalPath)) {
                $this->Delete($id);
                return null;
            }

        }
        
        return $id;
    }

    public function CanBeUploaded($File)
    {
        if (!isset($File['tmp_name'])) { return false; }

        if(!file_exists($File['tmp_name']) || !is_uploaded_file($File['tmp_name'])) {
            return false;
        }

        if (!exif_imagetype($File['tmp_name'])) {
            //Its an image
            return false;
        }

        return true;
    }

    public function GetSource(int $id)
    {
        $files = glob($this->storagePath."/".$id.".*");

        if (count($files) == 0) { return null; }

        $image = null;

        for ($i=0; $i < count($files); $i++) { 
            if (exif_imagetype($files[$i])) {
                //Its an image
                $image = $files[$i];

                break;
            }
        }

        if (file_exists($image))
        {
            return $this->sourcePath."/".basename($image);
        }
        
        return null;
    }
}