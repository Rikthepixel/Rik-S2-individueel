<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = "$Objects/Models";

include_once "$Models/API/ApiResponse.php";
include_once "$Models/PlatformController.php";
include_once "$Objects/URLParameter.php";

function GetSingle($GameID)
{
    $GameObject = new PlatformController();
    $ListOfGames = $GameObject->GetSingle($GameID);
    $ValidationResult = ApiResponse::GenerateResponse($ListOfGames);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    $ApiResponse->EchoResponse();
}
function GetAll()
{
    $GameObject = new PlatformController();
    $ListOfGames = $GameObject->GetAll();
    $ValidationResult = ApiResponse::GenerateResponse($ListOfGames);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfGames);
    $ApiResponse->EchoResponse();
}
function CreatNew($CreateData)
{
    $GameObject = new PlatformController();
    $Response = $GameObject->Create($CreateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}
function Update($UpdateData)
{
    $GameObject = new PlatformController();
    $Response = $GameObject->Update($UpdateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function Delete($GameID) {
    if (isset($GameID)) {
        $GameObject = new PlatformController();

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
$FirstActionValue = URLParameter::getParam("Platform.php");
if (isset($FirstActionValue) && $FirstActionValue != null) {
    //user wants to do something with a specific game

    if (is_numeric($FirstActionValue)) {

        $SecondActionValue = URLParameter::getParam("Platform.php/$FirstActionValue");
        if ($SecondActionValue != null) {

            if($SecondActionValue == "Update") {
                //Update the game  
                $UpdateArray = array(
                    "ID" => $FirstActionValue,
                );
                if (array_key_exists("Name", $_POST)) {
                    $UpdateArray["Name"] = $_POST["Name"];
                }
                if (array_key_exists("Link", $_POST)) {
                    $UpdateArray["Link"] = $_POST["Link"];
                }
                if (array_key_exists("IconID", $_POST)) {
                    $UpdateArray["IconID"] = $_POST["IconID"];
                }
                Update($UpdateArray);
            }
            elseif ($SecondActionValue == "Delete") {
                //Delete the game from the page
                Delete($FirstActionValue);
            }
        }
        else {
            GetSingle($FirstActionValue);
        }
    } elseif ($FirstActionValue == "Create") {
        //Create a new game
        $CreateArray = array();
        if (array_key_exists("Name", $_POST)) {
            $CreateArray["Name"] = $_POST["Name"];
        }
        if (array_key_exists("Link", $_POST)) {
            $CreateArray["Link"] = $_POST["Link"];
        }
        if (array_key_exists("IconID", $_POST)) {
            $CreateArray["IconID"] = $_POST["IconID"];
        }
        CreatNew($CreateArray);
    }
} else {
    //Get All games
    GetAll();
}
