<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
include_once "$Objects/API/APIPages/ImagesAPIView.php";
$APIPage = new ImagesAPIView();

//Decide which response the API should give
$ImagesActionValue = $APIPage->URLParameter::getParam("Images.php");
if (isset($ImagesActionValue) && $ImagesActionValue != null) {
    //user wants to do something with a specific Image

    if (is_numeric($ImagesActionValue)) {

        $ActionValue = $APIPage->URLParameter::getParam("Images.php", 1);
        if ($ActionValue != null) {

            if($ActionValue == "Image") {
                //Image the Image 
                $PostData = $_POST; 
                $PostData["ID"] = $ImagesActionValue;

                $APIPage->Update($PostData);
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
        $PostData = $_POST;
        $APIPage->CreateNew($PostData);
    }
} else {
    //Get All Images
    $APIPage->GetAll();
}

//Print the API response that was generated
$APIPage->APIResponse->EchoResponse();