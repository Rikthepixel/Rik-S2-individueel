<?php
include_once "ViewController.php";

include_once $GLOBALS["PATHS"]->Controllers."/ImageController.php";


class ImageViewController extends ViewController
{
    public function __construct()
    {
        $this->ImageController = new ImageController();
    }

    public function GetApi(Request $request)
    {

        $Image = null;
        if (isset($request->id)) {
            $Image = $this->ImageController->GetImage($request->id);
        }

        $this->IncludeView("ApiViews/Images/Get.php", array(
            "Image" => $Image
        ));
    }

    public function GetAllApi()
    {
        
        $Images = $this->ImageController->GetAllImages();

        $this->IncludeView("ApiViews/Images/GetAll.php", array(
            "Images" => $Images
        ));
        
    }
}