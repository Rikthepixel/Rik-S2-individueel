<?php


$Root = "../";
$Objects = "$Root/Objects";
$Models = "$Objects/Models";

include_once "$Models/API/ApiResponse.php";
include_once "$Models/Game.php";
include_once "$Objects/URLParameter.php";
include_once "$Root/Database/DatabaseHandler.php";


//URL parameters
$GamesActionValue = URLParameter::getParam("Games.php");

//Objects
$DBHandler = new DatabaseHandler();
$DBHandler->Connect();

function GetSingleGame($GameID, $DatabaseHandler)
{
    $GameObject = new Game($DatabaseHandler);
    $ListOfGames = $GameObject->GetSingle($GameID);
    $ValidationResult = $DatabaseHandler->ValidateSQLResponse($ListOfGames);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    $ApiResponse->EchoResponse();
}
function GetAllGames($DatabaseHandler)
{
    $GameObject = new Game($DatabaseHandler);
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
    $GameObject = new Game($DatabaseHandler);
    $Response = $GameObject->Update($UpdateData);
    $ValidationResult = $DatabaseHandler->ValidateSQLResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function DeleteGame($DatabaseHandler, $GameID) {
    $GameObject = new Game($DatabaseHandler);
    if ($Response = $GameObject->Delete($GameID)){
        echo "wtf";
        $ValidationResult = $DatabaseHandler->ValidateSQLResponse($Response);
        echo "wtf";
        $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
        echo "wtf";
        $ApiResponse->EchoResponse();
    }
    else {
        echo "wtf";
    }
}

if (isset($GamesActionValue) && $GamesActionValue != null) {
    //user wants to do something with a specific game

    if (is_numeric($GamesActionValue)) {

        $ActionValue = URLParameter::getParam("Games.php/$GamesActionValue");

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
                
                DeleteGame($DatabaseHandler, $GamesActionValue);
            }
        }
        else {
            GetSingleGame($GamesActionValue, $DBHandler);
        }
    } elseif ($GamesActionValue == "Create") {
        //Create a new game
        echo "Create";
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
