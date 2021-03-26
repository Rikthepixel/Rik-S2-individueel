<?php


$Root = "../";
$Objects = "$Root/Objects";
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
    if ( isset($DatabaseHandler) && isset($GameID)) {
        $GameObject = new GameController($DatabaseHandler);

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
        echo "Undefinedvariable";
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
                UpdateGame(array(
                    "ID" => $GamesActionValue,
                    "Name" => $_GET["Name"],
                    "Description" => $_GET["Description"],
                    "Link" => $_GET["Link"],
                    "PlatformID" => $_GET["PlatformID"],
                    "IconID" => $_GET["IconID"],
                    "LaunchDate" => $_GET["LaunchDate"]
                ));
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
        CreatNewGame(array(
            "Name" => $_GET["Name"],
            "Description" => $_GET["Description"],
            "Link" => $_GET["Link"],
            "PlatformID" => $_GET["PlatformID"],
            "IconID" => $_GET["IconID"],
            "LaunchDate" => $_GET["LaunchDate"]
        ));
    }
} else {
    //Get All games
    GetAllGames();
}
