<?php
class ImageModel
{
    public $ID;
    public $Blob;
    public $Name;
    public $Date_Created;

    function __construct($Image_ID = null, $Image_Name = null, $Image_blob = null, $Image_Date_Created = null)
    {
        $this->ID = $Image_ID;
        $this->Name = $Image_Name;
        $this->Blob = $Image_blob;
        $this->Date_Created = $Image_Date_Created;
    }
}
?>