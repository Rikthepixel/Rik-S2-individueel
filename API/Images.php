<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = "$Objects/Models";

include_once "$Models/API/ApiResponse.php";
include_once "$Models/Controllers/ImageController.php";
include_once "$Objects/URLParameter.php";

function GetSingle($ImageID)
{
    $ImageObject = new ImageController();
    $ListOfImages = $ImageObject->GetSingle($ImageID);
    $ValidationResult = ApiResponse::GenerateResponse($ListOfImages);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfImages);
    $ApiResponse->EchoResponse();
}
function GetAll()
{
    $ImageObject = new ImageController();
    $ListOfImages = $ImageObject->GetAll();
    $ValidationResult = ApiResponse::GenerateResponse($ListOfImages);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfImages);
    $ApiResponse->EchoResponse();
}
function CreatNew($CreateData)
{
    $ImageObject = new ImageController();
    $Response = $ImageObject->Create($CreateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);
    
    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}
function Update($ImageData)
{
    $ImageObject = new ImageController();
    $Response = $ImageObject->Update($ImageData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function Delete($ImageID) {
    if (isset($ImageID)) {
        $ImageObject = new ImageController();

        $Response = $ImageObject->Delete($ImageID);
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
$ImagesActionValue = URLParameter::getParam("Images.php");
if (isset($ImagesActionValue) && $ImagesActionValue != null) {
    //user wants to do something with a specific Image

    if (is_numeric($ImagesActionValue)) {

        $ActionValue = URLParameter::getParam("Images.php/$ImagesActionValue");
        if ($ActionValue != null) {

            if($ActionValue == "Image") {
                //Image the Image  
                $ImageArray = array(
                    "ID" => $ImagesActionValue,
                );
                if (array_key_exists("Name", $_POST)) {
                    $ImageArray["Name"] = $_POST["Name"];
                }
                Update($ImageArray);
            }
            elseif ($ActionValue == "Delete") {
                //Delete the Image from the page
                Delete($ImagesActionValue);
            }
        }
        else {
            GetSingle($ImagesActionValue);
        }
    } elseif ($ImagesActionValue == "Create") {
        //Create a new Image
        $CreateArray = array();
        if (array_key_exists("Name", $_POST)) {
            $CreateArray["Name"] = $_POST["Name"];
        } 
        if (array_key_exists("Image", $_POST)) {
            $CreateArray["Image"] = $_POST["Image"];
        } 
        CreatNew($CreateArray);
    }
} else {
    //Get All Images
    GetAll();
}
