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

    }

    public function GetAllImages()
    {
        
    }
}