<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = $Objects."/Models";
include_once $Models."/PlatformModel.php";
include_once $Objects."/API/APIView/APIPage.php";

class PlatformsAPIView extends APIView
{
    function __construct()
    {
        parent::__construct();
        $this->Model = new PlatformModel();
    }
    public function GetSingle($PlatformID) {
        
        $Platform = $this->Model->GetSingle($PlatformID);
        $ValidationResult = $this->APIResponse::GenerateResponse($Platform);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Platform);
        
    }
    public function GetAll() {

        $ListOfPlatforms = $this->Model->GetAll();
        $ValidationResult = $this->APIResponse::GenerateResponse($ListOfPlatforms);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfPlatforms);
    }
    public function CreateNew($CreateData) {
        
        $Response = $this->Model->Create($CreateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);
        
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function Update($UpdateData) {
        
        $Response = $this->Model->Update($UpdateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function Delete($PlatformID) {
        if (isset($PlatformID)) {
            
    
            $Response = $this->Model->Delete($PlatformID);
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
