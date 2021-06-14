<?php
use PHPUnit\Framework\TestCase;
use src\Controllers\ImageController;

class ImageUnitTests extends TestCase
{
    public function ImageLoads(): void
    {
        $id = 0;
        $imageController = new ImageController();

        $Source = $imageController->GetImageSource($id);

        $this->assertFileExists($_SERVER["DOCUMENT_ROOT"].$Source);
    }

    
}
