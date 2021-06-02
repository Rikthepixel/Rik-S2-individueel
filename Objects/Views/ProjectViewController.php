<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

class ProjectViewController
{
    public static function GetApi()
    {
        $request = new Request();
        $request->GetRequestVariables();

        if (!isset($request->id)) {
            
            include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Projects/Get.php";
            
        }
        else {

            $Project = ProjectController::GetProject($request->id);
            include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Projects/Get.php";

        }
    }

    public static function GetAllApi()
    {
        
        $Projects = ProjectController::GetAllProjects();
        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Projects/GetAll.php";
        
    }
}