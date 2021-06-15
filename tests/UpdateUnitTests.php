<?php
use PHPUnit\Framework\TestCase;
$_SERVER["DOCUMENT_ROOT"] = realpath(".");
include_once $_SERVER["DOCUMENT_ROOT"]."\src\Controllers\UpdateController.php";

class UpdateUnitTests extends TestCase
{
    public function testGetUpdates()
    {
        $updateController = new UpdateController();
        $project_id = 0;

        $updates = $updateController->getUpdates($project_id);

        $this->assertIsArray($updates);
    }
    
}