<?php
namespace Controllers;

use Repositories\ImageRepository;
use Models\ImageModel;

include_once __DIR__."/ObjectController.php";
include_once $GLOBALS["PATHS"]->Repositories."/ImageRepository.php";

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

    public function CreateImage($ImageFile)
    {
        if (!$this->Repository->CanBeUploaded($ImageFile)){
            return null;
        }

        $id = $this->Repository->StoreImage($ImageFile);

        if (!$id) { return null; }
        
        $Image = $this->Repository->GetSingle($id);
        return $Image;
    }
}