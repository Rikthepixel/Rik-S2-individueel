<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
$Models = "$Objects/Models";

include_once "$Models/API/ApiResponse.php";
include_once "$Models/UpdateController.php";
include_once "$Objects/URLParameter.php";

function GetSingle($UpdateID)
{
    $UpdateObject = new UpdateController();
    $ListOfUpdates = $UpdateObject->GetSingle($UpdateID);
    $ValidationResult = ApiResponse::GenerateResponse($ListOfUpdates);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfUpdates);
    $ApiResponse->EchoResponse();
}
function GetAll()
{
    $UpdateObject = new UpdateController();
    $ListOfUpdates = $UpdateObject->GetAll();
    $ValidationResult = ApiResponse::GenerateResponse($ListOfUpdates);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $ListOfUpdates);
    $ApiResponse->EchoResponse();
}
function CreatNew($CreateData)
{
    $UpdateObject = new UpdateController();
    $Response = $UpdateObject->Create($CreateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);
    
    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}
function Update($UpdateData)
{
    $UpdateObject = new UpdateController();
    $Response = $UpdateObject->Update($UpdateData);
    $ValidationResult = ApiResponse::GenerateResponse($Response);

    $ApiResponse = new ApiResponse($ValidationResult["Result"], $ValidationResult["Message"], $Response);
    $ApiResponse->EchoResponse();
}

function Delete($UpdateID) {
    if (isset($UpdateID)) {
        $UpdateObject = new UpdateController();

        $Response = $UpdateObject->Delete($UpdateID);
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
$UpdatesActionValue = URLParameter::getParam("Updates.php");
if (isset($UpdatesActionValue) && $UpdatesActionValue != null) {
    //user wants to do something with a specific Update

    if (is_numeric($UpdatesActionValue)) {

        $ActionValue = URLParameter::getParam("Updates.php/$UpdatesActionValue");
        if ($ActionValue != null) {

            if($ActionValue == "Update") {
                //Update the Update  
                $UpdateArray = array(
                    "ID" => $UpdatesActionValue,
                );
                if (array_key_exists("Name", $_POST)) {
                    $UpdateArray["Name"] = $_POST["Name"];
                }
                if (array_key_exists("Description", $_POST)) {
                    $CreateArray["Description"] = $_POST["Description"];
                }
                if (array_key_exists("ReleaseDate", $_POST)) {
                    $UpdateArray["ReleaseDate"] = $_POST["ReleaseDate"];
                }
                Update($UpdateArray);
            }
            elseif ($ActionValue == "Delete") {
                //Delete the Update from the page
                Delete($UpdatesActionValue);
            }
        }
        else {
            GetSingle($UpdatesActionValue);
        }
    } elseif ($UpdatesActionValue == "Create") {
        //Create a new Update
        $CreateArray = array();
        if (array_key_exists("GameID", $_POST)) {
            $CreateArray["GameID"] = $_POST["GameID"];
        }
        if (array_key_exists("Name", $_POST)) {
            $CreateArray["Name"] = $_POST["Name"];
        }
        if (array_key_exists("Description", $_POST)) {
            $CreateArray["Description"] = $_POST["Description"];
        }
        if (array_key_exists("ReleaseDate", $_POST)) {
            $CreateArray["ReleaseDate"] = $_POST["ReleaseDate"];
        }
        if (array_key_exists("WebsiteAdminID", $_POST)) {
            $CreateArray["WebsiteAdminID"] = $_POST["WebsiteAdminID"];
        }
        CreatNew($CreateArray);
    }
} else {
    //Get All Updates
    GetAll();
}
