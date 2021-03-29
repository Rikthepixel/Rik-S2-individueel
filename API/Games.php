<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = "$Objects/Models";

include_once "$Models/API/ApiResponse.php";
include_once "$Models/GameController.php";
include_once "$Objects/URLParameter.php";

function GetSingleGame($GameID)
{
    $GameObject = new GameController();
    $ListOfGames = $GameObject->GetSingle($GameID);
    $ValidationResult = ApiResponse::GenerateResponse($ListOfGames);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    $ApiResponse->EchoResponse();
}
function GetAllGames()
{
    $GameObject = new GameController();
    $ListOfGames = $GameObject->GetAll();
    $ValidationResult = ApiResponse::GenerateResponse($ListOfGames);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    $ApiResponse->EchoResponse();
}
function CreatNewGame($CreateData)
{
    $GameObject = new GameController();
    $Response = $GameObject->Create($CreateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}
function UpdateGame($UpdateData)
{
    $GameObject = new GameController();
    $Response = $GameObject->Update($UpdateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function DeleteGame($GameID) {
    if (isset($GameID)) {
        $GameObject = new GameController();

        $Response = $GameObject->Delete($GameID);
        if ($Response != null){
            $ValidationResult = ApiResponse::GenerateResponse($Response);
            $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
            $ApiResponse->EchoResponse();
        }
        else {
            $ValidationResult = ApiResponse::GenerateResponse(false);
            $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], false);
            $ApiResponse->EchoResponse();
        }
    }
    else{
        $ApiResponse = new ApiResponse(false, "Undefined Variable", "");
        $ApiResponse->EchoResponse();
    }
}

//URL parameters
$GamesActionValue = URLParameter::getParam("Games.php");
if (isset($GamesActionValue) && $GamesActionValue != null) {
    //user wants to do something with a specific game

    if (is_numeric($GamesActionValue)) {

        $ActionValue = URLParameter::getParam("Games.php/$GamesActionValue");
        if ($ActionValue != null) {

            if($ActionValue == "Update") {
                //Update the game  
                $UpdateArray = array(
                    "ID" => $GamesActionValue,
                );
                if (array_key_exists("Name", $_POST)) {
                    $UpdateArray["Name"] = $_POST["Name"];
                }
                if (array_key_exists("Link", $_POST)) {
                    $CreateArray["Link"] = $_POST["Link"];
                }
                if (array_key_exists("Description", $_POST)) {
                    $UpdateArray["Description"] = $_POST["Description"];
                }
                if (array_key_exists("PlatformID", $_POST)) {
                    $UpdateArray["PlatformID"] = $_POST["PlatformID"];
                }
                if (array_key_exists("IconID", $_POST)) {
                    $UpdateArray["IconID"] = $_POST["IconID"];
                }
                if (array_key_exists("LaunchDate", $_POST)) {
                    $UpdateArray["LaunchDate"] = $_POST["LaunchDate"];
                }
                UpdateGame($UpdateArray);
            }
            elseif ($ActionValue == "Delete") {
                //Delete the game from the page
                DeleteGame($GamesActionValue);
            }
        }
        else {
            GetSingleGame($GamesActionValue);
        }
    } elseif ($GamesActionValue == "Create") {
        //Create a new game
        $CreateArray = array();
        if (array_key_exists("Name", $_POST)) {
            $CreateArray["Name"] = $_POST["Name"];
        }
        if (array_key_exists("Description", $_POST)) {
            $CreateArray["Description"] = $_POST["Description"];
        }
        if (array_key_exists("Link", $_POST)) {
            $CreateArray["Link"] = $_POST["Link"];
        }
        if (array_key_exists("PlatformID", $_POST)) {
            $CreateArray["PlatformID"] = $_POST["PlatformID"];
        }
        if (array_key_exists("IconID", $_POST)) {
            $CreateArray["IconID"] = $_POST["IconID"];
        }
        if (array_key_exists("LaunchDate", $_POST)) {
            $CreateArray["LaunchDate"] = $_POST["LaunchDate"];
        }
        CreatNewGame($CreateArray);
    }
} else {
    //Get All games
    GetAllGames();
}
