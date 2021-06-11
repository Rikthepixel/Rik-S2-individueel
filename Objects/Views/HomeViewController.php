<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ImageController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/UpdateController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

class HomeViewController
{
    public static function GetFrontPage()
    {
        $Projects = array();

        $VisibleProjects = ProjectController::GetAllProjects();
        for ($i=0; $i < count($VisibleProjects); $i++) { 
            $Project = $VisibleProjects[$i];
            $IconSource = ImageController::GetImageSource($Project->image);

            array_push($Projects, [
                "project_info" => $Project,
                "project_icon" => $IconSource
            ]);
        }

        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/MainView/Frontpage.php";
    }

    public static function GetProjectPage()
    {
        $request = new Request();
        $request->GetRequestVariables();

        $Projectinfo = ProjectController::GetProject($request->id);
        $Updates = UpdateController::GetUpdates($Projectinfo->id);
        $IconSource = ImageController::GetImageSource($Projectinfo->image);

        $Project = array(
            "project_info" => $Projectinfo,
            "project_updates" => $Updates,
            "project_icon" => $IconSource
        );
        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/MainView/Projectpage.php";
    }
}