<?php 
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ProjectController.php";

$projectController = new ProjectController();
$projectController->GetAllProjectsApi();