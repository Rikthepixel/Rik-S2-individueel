<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Repositories/ImageRepository.php";

class ImageController extends ObjectController
{
    function __construct()
    {
        $this->Repository = new ImageRepository();
    }

    public function GetImageSource(ImageModel $Image)
    {
        return $this->Repository->GetSource($Image->id);
    }

    public function GetImage(int $id)
    {
        return $this->Repository->GetSingle($id);
    }

    public function IsValidUpload($File)
    {
        if(!file_exists($File['tmp_name']) || !is_uploaded_file($File['tmp_name'])) {
            return false;
        }

        return true;
    }

    public function CreateImage($ImageFile)
    {
        $id = $this->Repository->StoreImage($ImageFile);

        if (!$id) { return null; }
        
        $Image = $this->Repository->GetSingle($id);
        return $Image;
    }
}