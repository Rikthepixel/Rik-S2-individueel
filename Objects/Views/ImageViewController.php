<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ImageController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

class ImageViewController
{
    public static function GetApi()
    {
        $request = new Request();
        $request->GetRequestVariables();

        $Image = null;
        if (isset($request->id)) {
            $Image = ImageController::GetImage($request->id);
        }

        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Images/Get.php";
    }

    public static function GetAllApi()
    {
        
        $Images = ImageController::GetAllImages();
        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Images/GetAll.php";
        
    }
}