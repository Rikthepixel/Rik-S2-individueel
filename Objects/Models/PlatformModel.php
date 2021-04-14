<?php
class PlatformModel
{
    public $ID;
    public $Name;
    public $Link;
    public $Icon;

    function __construct($ConstructionData)
    {
        require_once "ImageModel";

        $this->ID = $ConstructionData["ID"];
        $this->Name = $ConstructionData["Name"];
        $this->Link = $ConstructionData["Link"];
        $this->Icon = new ImageModel($ConstructionData["Icon_ID"], $ConstructionData["Icon_Name"], $ConstructionData["Icon_blob"]);
    }
}
?>