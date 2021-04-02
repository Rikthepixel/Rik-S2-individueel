<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Controllers = $Objects."/Controllers";
include_once $Controllers."/GameController.php";
include_once $Controllers."/UpdateController.php";
include_once $Objects."/API/APIPages/APIPage.php";

class GamesAPIPage extends APIPage
{
    protected $UpdateController;
    function __construct()
    {
        parent::__construct();
        $this->Controller = new GameController();
        $this->UpdateController = new UpdateController();
    }

    //
    // Games
    //
    public function GetSingleGame($GameID)
    {
        $Game = $this->Controller->GetSingle($GameID);
        $ValidationResult = $this->APIResponse::GenerateResponse($Game);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Game);
    }
    public function GetAllGames()
    {
        $ListOfGames = $this->Controller->GetAll();
        $ValidationResult = $this->APIResponse::GenerateResponse($ListOfGames);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    }
    public function CreateNewGame($CreateData)
    {
        $Response = $this->Controller->Create($CreateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function UpdateGame($UpdateData)
    {
        $Response = $this->Controller->Update($UpdateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function DeleteGame($GameID)
    {
        if (isset($GameID)) {
            $this->Controller = new GameController();

            $Response = $this->Controller->Delete($GameID);
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
            $Update = $this->UpdateController->GetSingleGameUpdate($GameID, $UpdateID);
            $ValidationResult = $this->APIResponse::GenerateResponse($Update);

            $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Update);
            
        } else {
            $this->APIResponse->ChangeResponse(false, "Invalid parameters", false);
        }
    }
    public function GetAllUpdates($GameID)
    {
        $ListOfUpdates = $this->UpdateController->GetAllByGame($GameID);
        $ValidationResult = $this->APIResponse::GenerateResponse($ListOfUpdates);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfUpdates);
        
    }
    public function CreateNewUpdate($CreateData)
    {
        $Response = $this->UpdateController->Create($CreateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function ChangeUpdate($UpdateData)
    {
        $Response = $this->UpdateController->Update($UpdateData);
        $ValidationResult = $this->APIResponse::GenerateResponse($Response);

        $this->APIResponse->ChangeResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        
    }
    public function DeleteUpdate($GameID, $UpdateID)
    {
        if (isset($GameID) && isset($UpdateID)) {

            $Response = $this->UpdateController->DeleteGameUpdate($GameID, $UpdateID);
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
