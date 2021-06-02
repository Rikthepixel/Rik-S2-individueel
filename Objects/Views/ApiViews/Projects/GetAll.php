<?php
include_once "../ApiResponse.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

$projectController = new ProjectController();
$Projects = $projectController->GetAllProjects();

$ApiResponse = new ApiResponse(true, "fetched projects successfully", $Projects);
$ApiResponse->EchoResponse();