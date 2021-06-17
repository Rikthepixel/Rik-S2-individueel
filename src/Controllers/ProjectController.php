<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Repositories/ProjectRepository.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Models/ProjectModel.php";

class ProjectController extends ObjectController
{
    function __construct()
    {
        $this->Repository = new ProjectRepository();
    }

    public function GetAllProjects()
    {
        return $this->Repository->GetAll();
    }

    public function GetProject(int $id)
    {
        return $this->Repository->GetSingle($id);
    }

    public function CreateProject(ProjectModel $project)
    {
        return $this->Repository->Create($project);
    }
    public function SetProjectVisiblilty(ProjectModel $project, bool $visible)
    {
        $this->Repository->SetVisibility($project->id, $visible);
    }
}