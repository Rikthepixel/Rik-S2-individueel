<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = "$Objects/Models";
include_once "$Models/API/ApiResponse.php";
include_once "$Models/PlatformController.php";
include_once "$Objects/URLParameter.php";
$PlatformObject = new PlatformController();

function GetSinglePlatform($PlatformID)
{
    global $PlatformObject;
    $ListOfPlatforms = $PlatformObject->GetSingle($PlatformID);
    $ValidationResult = ApiResponse::GenerateResponse($ListOfPlatforms);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfPlatforms);
    $ApiResponse->EchoResponse();
}
function GetAllPlatforms()
{
    global $PlatformObject;
    $ListOfPlatforms = $PlatformObject->GetAll();
    $ValidationResult = ApiResponse::GenerateResponse($ListOfPlatforms);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfPlatforms);
    $ApiResponse->EchoResponse();
}
function CreatNewPlatform($CreateData)
{
    global $PlatformObject;
    $Response = $PlatformObject->Create($CreateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}
function UpdatePlatform($UpdateData)
{
    global $PlatformObject;
    $Response = $PlatformObject->Update($UpdateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function DeletePlatform($PlatformID) {
    if (isset($PlatformID)) {
        global $PlatformObject;

        $Response = $PlatformObject->Delete($PlatformID);
        if ($Response != null){
            $ValidationResult = ApiResponse::GenerateResponse($Response);
            $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
            $ApiResponse->EchoResponse();
        }
        else {
            $ValidationResult = ApiResponse::GenerateResponse(false);
            $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], "");
            $ApiResponse->EchoResponse();
        }
    }
    else{
        $ApiResponse = new ApiResponse(false, "UndefinedVariable", "");
        $ApiResponse->EchoResponse();
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
                    "Name" => $_POST["Name"],
                    "Link" => $_POST["Link"],
                    "IconID" => $_POST["IconID"]
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
            "Name" => $_POST["Name"],
            "Link" => $_POST["Link"],
            "IconID" => $_POST["IconID"]
        ));
    }
} else {
    //Get All games
    GetAllPlatforms();
}
