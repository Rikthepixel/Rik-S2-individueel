<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ImageController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/UpdateController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Request.php";

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

    public function GetProjectPage()
    {
        $request = new Request();
        $request->GetRequestVariables();

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

    public function GetProjectCreatePage()
    {
        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/AdminViews/Project/Add.php";
    }

    public function CreateProject()
    {
        $request = new Request();
        $request->GetRequestVariables();

        $image = new ImageModel(0, "", 0);
        if (isset($_FILES["Image"])) {
            $imageFile = $_FILES["Image"];
            if ($this->ImageController->IsValidUpload($imageFile)) {
                $CreatedImage = $this->ImageController->CreateImage($imageFile);

                if ($CreatedImage != null) {
                    $image = $CreatedImage;
                }
            }
        }

        if (!isset($request->Visible)) {
            $request->Visible = false;
        }

        $project = new ProjectModel(0, $request->Name, $request->Description, $request->Link, $request->Visible, $image);
        $Created = $this->ProjectController->CreateProject($project);
        header('Location: /admin/projects');
    }

    public function GetProjectEditPage()
    {
        $request = new Request();
        $request->GetRequestVariables();

        if (!isset($request->id)) {
            header('Location: /admin/projects');  
        }

        $project = $this->ProjectController->GetProject($request->id);

        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/AdminViews/Project/ProjectEdit.php";
    }

    public function EditProject()
    {
        $request = new Request();
        $request->GetRequestVariables();

        if (!isset($request->id)) { return null; } 

        $ExistingProject = $this->ProjectController->GetProject($request->id);

        if (!$ExistingProject) { return null; }
       
        if (isset($_FILES["Image"])) {
            $imageFile = $_FILES["Image"];
            if ($this->ImageController->IsValidUpload($imageFile)) {
                $CreatedImage = $this->ImageController->CreateImage($imageFile);

                if ($CreatedImage != null) {
                    $ExistingProject->image = $CreatedImage;
                }
            }
        }

        if (!isset($request->Visible)) {
            $request->Visible = false;
        }

        $ExistingProject->name = $request->Name;
        $ExistingProject->description = $request->Description;
        $ExistingProject->link = $request->Link;
        $ExistingProject->visible = $request->Visible;

        $Updated = $this->ProjectController->UpdateProject($ExistingProject);
        header('Location: /admin/projects');
    }
}