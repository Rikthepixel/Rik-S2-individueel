<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ApiViews/ApiResponse.php";

include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Repositories/ProjectRepository.php";


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

    public function GetProjectApi(Request $request)
    {
        if (!isset($request->id)){
            $ApiResponse = new ApiResponse(false, "no id provided", array());
            $ApiResponse->EchoResponse();
        }

        $Projects = $this->Repository->GetSingle($request->id);

        $ApiResponse = new ApiResponse(true, "fetched projects successfully", $Projects);
        $ApiResponse->EchoResponse();
    }
}