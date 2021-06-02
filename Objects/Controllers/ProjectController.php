<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Repositories/ProjectRepository.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Models/ProjectModel.php";

class ProjectController extends ObjectController
{
    function __construct()
    {
        parent::$Repository = new ProjectRepository();
    }

    public static function GetAllProjects()
    {
        return parent::$Repository->GetAll();;
    }

    public static function GetProject(int $id)
    {
        return parent::$Repository->GetSingle($id);
    }

    public static function SetProjectVisiblilty(ProjectModel $project, bool $visible)
    {
        parent::$Repository->SetVisibility($project->id, $visible);
    }
}