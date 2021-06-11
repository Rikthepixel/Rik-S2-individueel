<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ImageController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Request.php";

class ImageViewController
{
    public function __construct()
    {
        $this->ImageController = new ImageController();
    }

    public function GetApi()
    {
        $request = new Request();
        $request->GetRequestVariables();

        $Image = null;
        if (isset($request->id)) {
            $Image = $this->ImageController->GetImage($request->id);
        }

        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/ApiViews/Images/Get.php";
    }

    public function GetAllApi()
    {
        
        $Images = $this->ImageController->GetAllImages();
        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/ApiViews/Images/GetAll.php";
        
    }
}