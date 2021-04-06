<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
include_once "$Objects/API/APIView/PlatformsAPIView.php";
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
                $PostData = $_POST;
                $PostData["ID"] = $PlatformsActionValue;
                $APIPage->Update($PostData);
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
        $PostData = $_POST;
        $APIPage->CreateNew($PostData);
    }
} else {
    //Get All Platforms
    $APIPage->GetAll();
}

//Print the API response that was generated
$APIPage->APIResponse->EchoResponse();