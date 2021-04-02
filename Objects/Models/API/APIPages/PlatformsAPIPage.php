<?php
$Models = $_SERVER['DOCUMENT_ROOT']."/Objects/Models";
$Controllers = $Models."/Controllers";
include_once $Controllers."/PlatformController.php";
include_once $Models."/API/APIPages/APIPage.php";

class PlatformsAPIPage extends APIPage
{
    function __construct()
    {
        parent::__construct();
        $this->Controller = new PlatformController();
    }
    public function GetSingle($PlatformID) {
        
        $Platform = $this->Controller->GetSingle($PlatformID);
        $ValidationResult = $this->APIResponse::GenerateResponse($Platform);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Platform);
        
    }
    public function GetAll() {

        $ListOfPlatforms = $this->Controller->GetAll();
        $ValidationResult = $this->APIResponse::GenerateResponse($ListOfPlatforms);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfPlatforms);
    }
    public function CreateNew($CreateData) {
        
        $Response = $this->Controller->Create($CreateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);
        
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function Update($UpdateData) {
        
        $Response = $this->Controller->Update($UpdateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function Delete($PlatformID) {
        if (isset($PlatformID)) {
            
    
            $Response = $this->Controller->Delete($PlatformID);
            if ($Response != null){
                $ValidationResult = $this->APIResponse::GenerateResponse($Response);
                $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
                
            }
            else {
                $ValidationResult = $this->APIResponse::GenerateResponse(false);
                $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], false);
                
            }
        }
        else{
            $this->APIResponse->ChangeResponse(false, "Undefined Variable", "");
            
        }
    }
}
