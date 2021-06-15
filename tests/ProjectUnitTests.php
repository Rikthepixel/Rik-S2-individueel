<?php
use PHPUnit\Framework\TestCase;
$_SERVER["DOCUMENT_ROOT"] = realpath(".");
include_once $_SERVER["DOCUMENT_ROOT"]."\src\Controllers\ProjectController.php";

class ProjectUnitTests extends TestCase
{
    public function testGetProjects()
    {
        $projectController = new ProjectController();

        $updates = $projectController->GetAllProjects();

        $this->assertIsArray($updates);
    }
    
}