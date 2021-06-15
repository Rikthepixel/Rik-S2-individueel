<?php
use PHPUnit\Framework\TestCase;
$_SERVER["DOCUMENT_ROOT"] = realpath("."); // "C:\Users\Rik\Documents\Github\Rik-S2-individueel";
include_once $_SERVER["DOCUMENT_ROOT"]."\src\Controllers\ImageController.php";

class ImageUnitTests extends TestCase
{
    public function testImageLoads(): void
    {
        $id = 0;
        $imageModel = new ImageModel($id, "", "");
        $imageController = new ImageController();
        $Source = $imageController->GetImageSource($imageModel);

        $this->assertFileExists(".".$Source);
    }

    
}