<?php
use PHPUnit\Framework\TestCase;
$_SERVER["DOCUMENT_ROOT"] = realpath(".");
include_once $_SERVER["DOCUMENT_ROOT"]."\src\Controllers\ImageController.php";

class ImageUnitTests extends TestCase
{
    public function testGetImageSource(): void
    {
        $id = 0;
        $imageModel = new ImageModel($id, "", "");
        $imageController = new ImageController();
        $Source = $imageController->GetImageSource($imageModel);

        $this->assertFileExists(".".$Source);
    }

    public function testGetImage()
    {
        $id = 0;
        $imageController = new ImageController();

        $image = $imageController->GetImage($id);

        $this->assertIsObject($image);
        $this->assertNotNull($image);
    }
    
}