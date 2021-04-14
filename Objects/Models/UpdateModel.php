<?php
class UpdateModel
{
    public $ID;
    public $GameID;
    public $UpdateID;
    public $Name;
    public $Description;
    public $ReleaseDate;
    public $Visibile;
    public $WebsiteAdmin;

    function __construct($ConstructionData)
    {
        $this->ID = $ConstructionData["ID"];
        $this->GameID = $ConstructionData["GameID"];
        $this->UpdateID = $ConstructionData["UpdateID"];
        $this->Name = $ConstructionData["Name"];
        $this->Description = $ConstructionData["Description"];
        $this->ReleaseDate = $ConstructionData["ReleaseDate"];
        $this->Visibile = $ConstructionData["Visibile"];
        $this->WebsiteAdmin = $ConstructionData["WebsiteAdmin"];
    }
}
