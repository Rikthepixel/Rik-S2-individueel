<?php
class GameModel
{
    public $ID;
    public $Name;
    public $Description;
    public $ReleaseDate;
    public $Link;
    public $Icon;
    public $Platform;
    public $Visible;

    function __construct($ConstructionData)
    {
        require_once "ImageModel";
        require_once "PlatformModel";
        
        $this->ID = $ConstructionData["ID"];
        $this->Name = $ConstructionData["Name"];
        $this->Description = $ConstructionData["Description"];
        $this->LaunchDate = $ConstructionData["LaunchDate"];
        $this->Visible = $ConstructionData["Visible"];
        $this->Link = $ConstructionData["Link"];
        $this->Icon = new ImageModel($ConstructionData["Icon_ID"], $ConstructionData["Icon_Name"], $ConstructionData["Icon_blob"]);
        $this->Platform = new PlatformModel(array(
            "Icon_ID" => $ConstructionData["Platform_Icon_ID"],
            "Icon_Name" => $ConstructionData["Platform_Icon_Name"],
            "Icon_blob" => $ConstructionData["Platform_Icon_blob"],
            "Name" => $ConstructionData["Platform_Name"],
            "Link" => $ConstructionData["Platform_Link"],
            "ID" => $ConstructionData["Platform_ID"]
        ));
    }
}
?>