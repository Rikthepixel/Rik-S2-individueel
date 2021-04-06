<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = $Objects."/Models";
include_once $Models."/GameModel.php";
include_once $Models."/UpdateModel.php";
include_once $Objects."/API/APIView/APIPage.php";

class GamesAPIView extends APIView
{
    protected $UpdateModel;
    function __construct()
    {
        parent::__construct();
        $this->Model = new GameModel();
        $this->UpdateController = new UpdateModel();
    }

    //
    // Games
    //
    public function GetSingleGame($GameID)
    {
        $Game = $this->Model->GetSingle($GameID);
        $ValidationResult = $this->APIResponse::GenerateResponse($Game);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Game);
    }
    public function GetAllGames()
    {
        $ListOfGames = $this->Model->GetAll();
        $ValidationResult = $this->APIResponse::GenerateResponse($ListOfGames);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    }
    public function CreateNewGame($CreateData)
    {
        $Response = $this->Model->Create($CreateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function UpdateGame($UpdateData)
    {
        $Response = $this->Model->Update($UpdateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function DeleteGame($GameID)
    {
        if (isset($GameID)) {
            $Response = $this->Model->Delete($GameID);
            if ($Response != null) {
                $ValidationResult = $this->APIResponse::GenerateResponse($Response);
                $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
                
            } else {
                $ValidationResult = $this->APIResponse::GenerateResponse(false);
                $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], false);
                
            }
        } else {
            $this->APIResponse->ChangeResponse(false, "Undefined Variable", "");
            
        }
    }

    //
    // GameUpdates
    //
    public function GetSingleUpdate($GameID, $UpdateID)
    {
        if (isset($GameID) && isset($UpdateID)) {
            $Update = $this->UpdateModel->GetSingleGameUpdate($GameID, $UpdateID);
            $ValidationResult = $this->APIResponse::GenerateResponse($Update);

            $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Update);
            
        } else {
            $this->APIResponse->ChangeResponse(false, "Invalid parameters", false);
        }
    }
    public function GetAllUpdates($GameID)
    {
        $ListOfUpdates = $this->UpdateModel->GetAllByGame($GameID);
        $ValidationResult = $this->APIResponse::GenerateResponse($ListOfUpdates);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfUpdates);
        
    }
    public function CreateNewUpdate($CreateData)
    {
        $Response = $this->UpdateModel->Create($CreateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function ChangeUpdate($UpdateData)
    {
        $Response = $this->UpdateModel->Update($UpdateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function DeleteUpdate($GameID, $UpdateID)
    {
        if (isset($GameID) && isset($UpdateID)) {

            $Response = $this->UpdateModel->DeleteGameUpdate($GameID, $UpdateID);
            if ($Response != null) {
                $ValidationResult = $this->APIResponse::GenerateResponse($Response);
                $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
                
            } else {
                $ValidationResult = $this->APIResponse::GenerateResponse(false);
                $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], false);
                
            }
        } else {
            $this->APIResponse->ChangeResponse(false, "Undefined Variable", "");
            
        }
    }
}
