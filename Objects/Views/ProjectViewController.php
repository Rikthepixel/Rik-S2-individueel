<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

class ProjectViewController
{
    public function __construct()
    {
        $this->ProjectController = new ProjectController();    
    }

    public function GetApi()
    {
        $request = new Request();
        $request->GetRequestVariables();

        if (!isset($request->id)) {
            
            include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Projects/Get.php";
            
        }
        else {

            $Project = $this->ProjectController->GetProject($request->id);
            include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Projects/Get.php";

        }
    }

    public function GetAllApi()
    {
        
        $Projects = $this->ProjectController->GetAllProjects();
        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Projects/GetAll.php";
        
    }
}