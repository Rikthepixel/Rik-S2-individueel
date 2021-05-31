<?php 
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Request.php";

$projectController = new ProjectController();
$request = new Request();
$request->GetRequestVariables();

$projectController->GetProjectApi($request);

echo $request;