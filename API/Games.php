<?php


$Root = "../";
$Objects = "$Root/Objects";
$Models = "$Objects/Models";

include_once "$Models/API/ApiResponse.php";
include_once "$Models/GameController.php";
include_once "$Objects/URLParameter.php";
include_once "$Root/Database/DatabaseHandler.php";


//URL parameters
$GamesActionValue = URLParameter::getParam("Games.php");

//Objects
$DBHandler = new DatabaseHandler();
$DBHandler->Connect();

function GetSingleGame($DatabaseHandler, $GameID)
{
    $GameObject = new GameController($DatabaseHandler);
    $ListOfGames = $GameObject->GetSingle($GameID);
    $ValidationResult = $DatabaseHandler->ValidateSQLResponse($ListOfGames);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    $ApiResponse->EchoResponse();
}
function GetAllGames($DatabaseHandler)
{
    $GameObject = new GameController($DatabaseHandler);
    $ListOfGames = $GameObject->GetAll();
    $ValidationResult = $DatabaseHandler->ValidateSQLResponse($ListOfGames);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    $ApiResponse->EchoResponse();
}
function CreatNewGame($DatabaseHandler, $CreateData)
{
    $GameObject = new Game($DatabaseHandler);
    $Response = $GameObject->Create($CreateData);
    $ValidationResult = $DatabaseHandler->ValidateSQLResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}
function UpdateGame($DatabaseHandler, $UpdateData)
{
    $GameObject = new GameController($DatabaseHandler);
    $Response = $GameObject->Update($UpdateData);
    $ValidationResult = $DatabaseHandler->ValidateSQLResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function DeleteGame($DatabaseHandler, $GameID) {
    if ( isset($DatabaseHandler) && isset($GameID)) {
        $GameObject = new GameController($DatabaseHandler);

        $Response = $GameObject->Delete($GameID);
        if ($Response != null){
            $ValidationResult = $DatabaseHandler->ValidateSQLResponse($Response);
            $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
            $ApiResponse->EchoResponse();
        }
        else {
            $ValidationResult = $DatabaseHandler->ValidateSQLResponse(false);
            $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], false);
            $ApiResponse->EchoResponse();
        }
    }
    else{
        echo "Undefinedvariable";
    }
}

if (isset($GamesActionValue) && $GamesActionValue != null) {
    //user wants to do something with a specific game

    if (is_numeric($GamesActionValue)) {

        $ActionValue = URLParameter::getParam("Games.php/$GamesActionValue");
        echo $ActionValue;
        if ($ActionValue != null) {

            if($ActionValue == "Update") {
                //Update the game  

                echo "Update";
                UpdateGame($DatabaseHandler, array(
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
                echo "Deleting";
                DeleteGame($DBHandler, $GamesActionValue);
            }
        }
        else {
            GetSingleGame($DBHandler, $GamesActionValue);
        }
    } elseif ($GamesActionValue == "Create") {
        //Create a new game
        CreatNewGame($DatabaseHandler, array(
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
    GetAllGames($DBHandler);
}
