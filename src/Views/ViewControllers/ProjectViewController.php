<?php
namespace Views\ViewControllers;

use Router\Request;

use Controllers\ImageController;
use Controllers\ProjectController;
use Controllers\UpdateController;

class ProjectViewController extends ViewController
{
    public function __construct()
    {
        $this->ProjectController = new ProjectController();
        $this->ImageController = new ImageController();
        $this->UpdateController = new UpdateController();
    }

    public function GetApi(Request $request)
    {
        $Project = null;
        if (isset($request->id))
        {
            $Project = $this->ProjectController->GetProject($request->id);
        }

        $this->IncludeView("ApiViews/Projects/Get.php", array(
            "Project" => $Project
        ));
    }

    public function GetAllApi()
    {
        
        $Projects = $this->ProjectController->GetAllProjects();
        $this->IncludeView("ApiViews/Projects/GetAll.php", array(
            "Projects" => $Projects
        ));
        
    }

    public function GetAdminProjectCreatePage()
    {
        $this->IncludeView("AdminViews/Project/ProjectAddEdit.php");
    }

    public function AdminCreateProject(Request $request)
    {

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

    public function GetAdminProjectEditPage(Request $request)
    {

        if (!isset($request->id)) {
            header('Location: /admin/projects');  
        }

        $project = $this->ProjectController->GetProject($request->id);

        if (!$project) {
            header('Location: /admin/projects');  
        }
        
        $project_updates = $this->UpdateController->getUpdates($project->id);
        $project_icon = $this->ImageController->GetImageSource($project->image);


        $this->IncludeView("AdminViews/Project/ProjectAddEdit.php", array(
            "project" => $project,
            "project_updates" => $project_updates,
            "project_icon" => $project_icon
        ));
    }

    public function AdminEditProject(Request $request)
    {

        if (!isset($request->id)) { return null; } 

        $ExistingProject = $this->ProjectController->GetProject($request->id);

        if (!$ExistingProject) { return null; }
       
        if (isset($_FILES["Image"])) {
            $imageFile = $_FILES["Image"];
            $CreatedImage = $this->ImageController->CreateImage($imageFile);

            if ($CreatedImage != null) {
                $ExistingProject->image = $CreatedImage;
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

    public function AdminDeleteProject(Request $request)
    {

        if (!isset($request->id)) { return null; }
        $success = $this->ProjectController->removeProject($request->id);
        if (!$success) {
            header('Location: /admin/projects');
            return null;
        }

        $success = $this->UpdateController->removeProjectUpdates($request->id);
        if (!$success) {
            header('Location: /admin/projects');
            return null;
        }

        header('Location: /admin/projects');
    }
}