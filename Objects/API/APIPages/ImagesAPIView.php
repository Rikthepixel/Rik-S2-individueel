<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = $Objects."/Models";
include_once $Models."/ImageModel.php";
include_once $Models."/API/APIPages/APIPage.php";

class ImagesAPIPage extends APIPage
{
    function __construct()
    {
        parent::__construct();
        $this->Model = new ImageModel();
    }

    public function GetSingle($ImageID) {
        $Image = $this->Model->GetSingle($ImageID);
        $ValidationResult = $this->ApiResponse::GenerateResponse($Image);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Image);
    }
    public function GetAll() {
        $ListOfImages = $this->Model->GetAll();
        $ValidationResult = $this->ApiResponse::GenerateResponse($ListOfImages);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfImages);
    }
    public function CreateNew($CreateData) {
        $Response = $this->Model->Create($CreateData);
        $ValidationResult = $this->ApiResponse::GenerateResponse($Response);
        
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    }
    public function Update($ImageData) {
        $Response = $this->Model->Update($ImageData);
        $ValidationResult = $this->ApiResponse::GenerateResponse($Response);
    
        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    }
    
    public function Delete($ImageID) {
        if (isset($ImageID)) {
            
            $Response = $this->Model->Delete($ImageID);
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
            $this->APIResponse->ChangeResponse(false, "Undefined Variable", false);
        }
    }
}
