<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

$request = new Request();
$request->GetRequestVariables();

$projectController = new ProjectController();

if (!isset($request->id)) {
    
    $ApiResponse = new ApiResponse(false, "no id provided", null);
    $ApiResponse->EchoResponse();
    
}
else {

    $Project = $projectController->GetProject($request->id);
    $ApiResponse = new ApiResponse(true, "fetched project successfully", $Project);
    $ApiResponse->EchoResponse();

}

