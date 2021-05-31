<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Repositories/ProjectRepository.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/ApiResponse.php";

class ProjectController extends ObjectController
{
    function __construct()
    {
        $this->Repository = new ProjectRepository();
    }

    public function GetAllProjectsApi()
    {
        $Projects = $this->Repository->GetAll();

        $ApiResponse = new ApiResponse(true, "fetched projects successfully", $Projects);
        $ApiResponse->EchoResponse();
    }
}