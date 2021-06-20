<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ImageController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/UpdateController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Request.php";

class ProjectViewController
{
    public function __construct()
    {
        $this->ProjectController = new ProjectController();
        $this->ImageController = new ImageController();
        $this->UpdateController = new UpdateController();
    }

    public function GetApi()
    {
        $request = new Request();
        $request->GetRequestVariables();

        if (!isset($request->id)) {
            
            include $_SERVER["DOCUMENT_ROOT"]."/src/Views/ApiViews/Projects/Get.php";
            
        }
        else {

            $Project = $this->ProjectController->GetProject($request->id);
            include $_SERVER["DOCUMENT_ROOT"]."/src/Views/ApiViews/Projects/Get.php";

        }
    }

    public function GetAllApi()
    {
        
        $Projects = $this->ProjectController->GetAllProjects();
        include $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/Projects/GetAll.php";
        
    }

    public function GetAdminProjectCreatePage()
    {
        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/AdminViews/Project/Add.php";
    }

    public function AdminCreateProject()
    {
        $request = new Request();
        $request->GetRequestVariables();

        $image = new ImageModel(0, "", 0);
        if (isset($_FILES["Image"])) {
            $imageFile = $_FILES["Image"];
            $CreatedImage = $this->ImageController->CreateImage($imageFile);

            if ($CreatedImage != null) {
                $image = $CreatedImage;
            }
        }

        if (!isset($request->Visible)) {
            $request->Visible = false;
        }

        $project = new ProjectModel(0, $request->Name, $request->Description, $request->Link, $request->Visible, $image);
        $Created = $this->ProjectController->CreateProject($project);
        header('Location: /admin/projects');
    }

    public function GetAdminProjectEditPage()
    {
        $request = new Request();
        $request->GetRequestVariables();

        if (!isset($request->id)) {
            header('Location: /admin/projects');  
        }

        $project = $this->ProjectController->GetProject($request->id);

        if (!$project) {
            header('Location: /admin/projects');  
        }
        
        $project_updates = $this->UpdateController->getUpdates($project->id);
        $project_icon = $this->ImageController->GetImageSource($project->image);

        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/AdminViews/Project/ProjectEdit.php";
    }

    public function AdminEditProject()
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

    public function AdminDeleteProject()
    {
        $request = new Request();
        $request->GetRequestVariables();

        if (!isset($request->id)) { return null; }
        $success = $this->ProjectController->removeProject($request->id);

        header('Location: /admin/projects');
    }
}