<?php
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Repositories/ProjectRepository.php";

class ProjectController extends ObjectController
{
    function __construct()
    {
        $this->Repository = new ProjectRepository();
    }
}