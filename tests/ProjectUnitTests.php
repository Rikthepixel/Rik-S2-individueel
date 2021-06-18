<?php
use PHPUnit\Framework\TestCase;
$_SERVER["DOCUMENT_ROOT"] = realpath(".");
include_once $_SERVER["DOCUMENT_ROOT"]."\src\Controllers\ProjectController.php";

class ProjectUnitTests extends TestCase
{
    public function testGetProjects()
    {
        $projectController = new ProjectController();
        $Projects = $projectController->GetAllProjects();

        $this->assertIsArray($Projects);
    }

    public function testGetProject()
    {
        $projectController = new ProjectController();
        $Project = $projectController->GetProject(15);

        $this->assertIsObject($Project);
        $this->assertNotNull($Project);
    }
}