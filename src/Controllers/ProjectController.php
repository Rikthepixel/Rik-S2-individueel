<?php
namespace Controllers;

use Repositories\ProjectRepository;
use Models\ProjectModel;

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

    public function GetAllVisibleProjects()
    {
        return $this->Repository->GetAllVisible();
    }

    public function GetProject(int $id)
    {
        return $this->Repository->GetSingle($id);
    }

    public function CreateProject(ProjectModel $project)
    {
        return $this->Repository->Create($project);
    }

    public function UpdateProject(ProjectModel $project)
    {
        return $this->Repository->Update($project);
    }

    public function removeProject(int $id)
    {
        return $this->Repository->Delete($id);
    }

    public function SetProjectVisiblilty(ProjectModel $project, bool $visible)
    {
        $this->Repository->SetVisibility($project->id, $visible);
    }
}