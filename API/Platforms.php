<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = "$Objects/Models";

include_once "$Models/API/ApiResponse.php";
include_once "$Models/PlatformController.php";
include_once "$Objects/URLParameter.php";

function GetSingle($PlatformID)
{
    $PlatformObject = new PlatformController();
    $ListOfPlatforms = $PlatformObject->GetSingle($PlatformID);
    $ValidationResult = ApiResponse::GenerateResponse($ListOfPlatforms);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfPlatforms);
    $ApiResponse->EchoResponse();
}
function GetAll()
{
    $PlatformObject = new PlatformController();
    $ListOfPlatforms = $PlatformObject->GetAll();
    $ValidationResult = ApiResponse::GenerateResponse($ListOfPlatforms);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfPlatforms);
    $ApiResponse->EchoResponse();
}
function CreatNew($CreateData)
{
    $PlatformObject = new PlatformController();
    $Response = $PlatformObject->Create($CreateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);
    
    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}
function Update($UpdateData)
{
    $PlatformObject = new PlatformController();
    $Response = $PlatformObject->Update($UpdateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function Delete($PlatformID) {
    if (isset($PlatformID)) {
        $PlatformObject = new PlatformController();

        $Response = $PlatformObject->Delete($PlatformID);
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
$PlatformsActionValue = URLParameter::getParam("Platforms.php");
if (isset($PlatformsActionValue) && $PlatformsActionValue != null) {
    //user wants to do something with a specific Platform

    if (is_numeric($PlatformsActionValue)) {

        $ActionValue = URLParameter::getParam("Platforms.php/$PlatformsActionValue");
        if ($ActionValue != null) {

            if($ActionValue == "Update") {
                //Update the Platform  
                $UpdateArray = array(
                    "ID" => $PlatformsActionValue,
                );
                if (array_key_exists("Name", $_POST)) {
                    $UpdateArray["Name"] = $_POST["Name"];
                }
                if (array_key_exists("Link", $_POST)) {
                    $CreateArray["Link"] = $_POST["Link"];
                }
                if (array_key_exists("IconID", $_POST)) {
                    $UpdateArray["IconID"] = $_POST["IconID"];
                }
                Update($UpdateArray);
            }
            elseif ($ActionValue == "Delete") {
                //Delete the Platform from the page
                Delete($PlatformsActionValue);
            }
        }
        else {
            GetSingle($PlatformsActionValue);
        }
    } elseif ($PlatformsActionValue == "Create") {
        //Create a new Platform
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
    //Get All Platforms
    GetAll();
}
