<?php
include_once "ViewController.php";

include_once $GLOBALS["PATHS"]->Controllers."/ImageController.php";
include_once $GLOBALS["PATHS"]->Controllers."/ProjectController.php";
include_once $GLOBALS["PATHS"]->Controllers."/UpdateController.php";

class HomeViewController extends ViewController
{
    public function __construct()
    {
        $this->ProjectController = new ProjectController();
        $this->ImageController = new ImageController();
        $this->UpdateController = new UpdateController();
    }
    
    public function GetFrontPage()
    {
        $ProcessedProjects = array();

        $AllProjects = $this->ProjectController->GetAllVisibleProjects();
        for ($i=0; $i < count($AllProjects); $i++) { 
            $Project = $AllProjects[$i];

            $IconSource = $this->ImageController->GetImageSource($Project->image);

            array_push($ProcessedProjects, [
                "project_info" => $Project,
                "project_icon" => $IconSource
            ]);
        }

        $this->IncludeView("MainView/Frontpage.php", array(
            "Projects" => $ProcessedProjects
        ));
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

        $this->IncludeView("MainView/Projectpage.php", array(
            "Project" => $Project
        ));
    }

    public function GetProjectAdminPanel()
    {
        $ProcessedProjects = array();

        $Projects = $this->ProjectController->GetAllProjects();
        for ($i=0; $i < count($Projects); $i++) { 
            $Project = $Projects[$i];
            $IconSource = $this->ImageController->GetImageSource($Project->image);

            array_push($ProcessedProjects, [
                "project_info" => $Project,
                "project_icon" => $IconSource
            ]);
        }

        $this->IncludeView("AdminViews/Project/ProjectOverview.php", array(
            "Projects" => $ProcessedProjects
        ));
    }
}