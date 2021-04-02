<?php
$Models = $_SERVER['DOCUMENT_ROOT']."/Objects/Models";
$Controllers = $Models."/Controllers";
include_once $Controllers."/ImageController.php";
include_once $Models."/API/APIPages/APIPage.php";

class ImagesAPIPage extends APIPage
{
    function __construct()
    {
        parent::__construct();
        $this->Controller = new PlatformController();
    }

    public function GetSingle($ImageID) {
        $Image = $this->Controller->GetSingle($ImageID);
        $ValidationResult = $this->ApiResponse::GenerateResponse($Image);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Image);
    }
    public function GetAll() {
        $ListOfImages = $this->Controller->GetAll();
        $ValidationResult = $this->ApiResponse::GenerateResponse($ListOfImages);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfImages);
    }
    public function CreateNew($CreateData) {
        $Response = $this->Controller->Create($CreateData);
        $ValidationResult = $this->ApiResponse::GenerateResponse($Response);
        
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    }
    public function Update($ImageData) {
        $Response = $this->Controller->Update($ImageData);
        $ValidationResult = $this->ApiResponse::GenerateResponse($Response);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    }
    
    public function Delete($ImageID) {
        if (isset($ImageID)) {
            
            $Response = $this->Controller->Delete($ImageID);
            if ($Response != null){
                $ValidationResult = $this->ApiResponse::GenerateResponse($Response);
                $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
            }
            else {
                $ValidationResult = $this->ApiResponse::GenerateResponse(false);
                $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], false);
            }
        }
        else{
            $this->APIResponse->ChangeResponse(false, "Undefined Variable", "");
        }
    }
}
