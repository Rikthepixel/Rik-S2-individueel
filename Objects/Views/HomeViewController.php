<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ImageController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/UpdateController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

class HomeViewController
{
    public function __construct()
    {
        $this->ProjectController = new ProjectController();
        $this->ImageController = new ImageController();
        $this->UpdateController = new UpdateController();
    }
    
    public function GetFrontPage()
    {
        $Projects = array();

        $VisibleProjects = $this->ProjectController->GetAllProjects();
        for ($i=0; $i < count($VisibleProjects); $i++) { 
            $Project = $VisibleProjects[$i];
            $IconSource = $this->ImageController->GetImageSource($Project->image);

            array_push($Projects, [
                "project_info" => $Project,
                "project_icon" => $IconSource
            ]);
        }

        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/MainView/Frontpage.php";
    }

    public function GetProjectPage()
    {
        $request = new Request();
        $request->GetRequestVariables();

        $Projectinfo = $this->ProjectController->GetProject($request->id);
        $Updates = $this->UpdateController->GetUpdates($Projectinfo->id);
        $IconSource = $this->ImageController->GetImageSource($Projectinfo->image);

        $Project = array(
            "project_info" => $Projectinfo,
            "project_updates" => $Updates,
            "project_icon" => $IconSource
        );
        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/MainView/Projectpage.php";
    }
}