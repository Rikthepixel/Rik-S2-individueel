<?php


$Root = "../";
$Objects = "$Root/Objects";
$Models = "$Objects/Models";

include_once "$Models/API/ApiResponse.php";
include_once "$Models/PlatformController.php";
include_once "$Objects/URLParameter.php";

function GetSinglePlatform($PlatformID)
{
    $PlatformObject = new PlatformController();
    $ListOfPlatforms = $PlatformObject->GetSingle($PlatformID);
    $ValidationResult = ApiResponse::GenerateResponse($ListOfPlatforms);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfPlatforms);
    $ApiResponse->EchoResponse();
}
function GetAllPlatforms()
{
    $PlatformObject = new PlatformController();
    $ListOfPlatforms = $PlatformObject->GetAll();
    $ValidationResult = ApiResponse::GenerateResponse($ListOfPlatforms);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfPlatforms);
    $ApiResponse->EchoResponse();
}
function CreatNewPlatform($CreateData)
{
    $PlatformObject = new PlatformController();
    $Response = $PlatformObject->Create($CreateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}
function UpdatePlatform($UpdateData)
{
    $PlatformObject = new PlatformController();
    $Response = $PlatformObject->Update($UpdateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function DeletePlatform($GameID) {
    if ( isset($DatabaseHandler) && isset($GameID)) {
        $PlatformObject = new PlatformController($DatabaseHandler);

        $Response = $PlatformObject->Delete($GameID);
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
$PlatformActionValue = URLParameter::getParam("Platforms.php");
if (isset($PlatformActionValue) && $PlatformActionValue != null) {
    //user wants to do something with a specific game

    if (is_numeric($PlatformActionValue)) {

        $ActionValue = URLParameter::getParam("Platforms.php/$PlatformActionValue");
        if ($ActionValue != null) {

            if($ActionValue == "Update") {
                //Update the game  
                UpdatePlatform(array(
                    "ID" => $PlatformActionValue,
                    "Name" => $_GET["Name"],
                    "Link" => $_GET["Link"],
                    "IconID" => $_GET["IconID"]
                ));
            }
            elseif ($ActionValue == "Delete") {
                //Delete the game from the page
                DeletePlatform($PlatformActionValue);
            }
        }
        else {
            GetSinglePlatform($PlatformActionValue);
        }
    } elseif ($PlatformActionValue == "Create") {
        //Create a new game
        CreatNewPlatform(array(
            "Name" => $_GET["Name"],
            "Link" => $_GET["Link"],
            "IconID" => $_GET["IconID"]
        ));
    }
} else {
    //Get All games
    GetAllPlatforms();
}
