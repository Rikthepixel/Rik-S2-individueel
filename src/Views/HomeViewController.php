<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ImageController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/UpdateController.php";

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

        $AllProjects = $this->ProjectController->GetAllProjects();
        for ($i=0; $i < count($AllProjects); $i++) { 
            $Project = $AllProjects[$i];

            if (!$Project->visible) { continue; }

            $IconSource = $this->ImageController->GetImageSource($Project->image);

            array_push($Projects, [
                "project_info" => $Project,
                "project_icon" => $IconSource
            ]);
        }

        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/MainView/Frontpage.php";
    }

    public function GetProjectPage(Request $request)
    {

        $Projectinfo = $this->ProjectController->GetProject($request->id);
        $Updates = $this->UpdateController->getVisibleUpdates($Projectinfo->id);
        $IconSource = $this->ImageController->GetImageSource($Projectinfo->image);

        if (!$Projectinfo->visible) {
            return null;
        }

        $Projectinfo->description = ltrim(rtrim($Projectinfo->description));

        $Project = array(
            "project_info" => $Projectinfo,
            "project_updates" => $Updates,
            "project_icon" => $IconSource
        );
        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/MainView/Projectpage.php";
    }

    public function GetProjectAdminPanel()
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

        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/AdminViews/Project/ProjectOverview.php";
    }
}