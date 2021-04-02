<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
include_once "$Objects/API/APIPages/ImagesAPIPage.php";
$APIPage = new ImagesAPIPage();

//Decide which response the API should give
$ImagesActionValue = $APIPage->URLParameter::getParam("Images.php");
if (isset($ImagesActionValue) && $ImagesActionValue != null) {
    //user wants to do something with a specific Image

    if (is_numeric($ImagesActionValue)) {

        $ActionValue = $APIPage->URLParameter::getParam("Images.php", 1);
        if ($ActionValue != null) {

            if($ActionValue == "Image") {
                //Image the Image  
                $ImageArray = array(
                    "ID" => $ImagesActionValue,
                );
                if (array_key_exists("Name", $_POST)) {
                    $ImageArray["Name"] = $_POST["Name"];
                }
                $APIPage->Update($ImageArray);
            }
            elseif ($ActionValue == "Delete") {
                //Delete the Image from the page
                $APIPage->Delete($ImagesActionValue);
            }
        }
        else {
            $APIPage->GetSingle($ImagesActionValue);
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
        $APIPage->CreateNew($CreateArray);
    }
} else {
    //Get All Images
    $APIPage->GetAll();
}

//Print the API response that was generated
$APIPage->APIResponse->EchoResponse();