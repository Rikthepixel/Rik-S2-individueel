<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
include_once "$Objects/API/APIPages/PlatformsAPIView.php";
$APIPage = new PlatformsAPIView();

//Decide which response the API should give
$PlatformsActionValue = $APIPage->URLParameter::getParam("Platforms.php");
if (isset($PlatformsActionValue) && $PlatformsActionValue != null) {
    //user wants to do something with a specific Platform

    if (is_numeric($PlatformsActionValue)) {

        $ActionValue = $APIPage->URLParameter::getParam("Platforms.php", 1);
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
                $APIPage->Update($UpdateArray);
            }
            elseif ($ActionValue == "Delete") {
                //Delete the Platform from the page
                $APIPage->Delete($PlatformsActionValue);
            }
        }
        else {
            $APIPage->GetSingle($PlatformsActionValue);
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
        $APIPage->CreateNew($CreateArray);
    }
} else {
    //Get All Platforms
    $APIPage->GetAll();
}

//Print the API response that was generated
$APIPage->APIResponse->EchoResponse();