<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
include_once "$Objects/API/APIPages/GamesAPIPage.php";

$APIPage = new GamesAPIPage();

//Decide which response the API should give
$GamesActionValue = $APIPage->URLParameter::getParam("Games.php");
if (isset($GamesActionValue) && $GamesActionValue != null) {
    //user wants to do something with a specific game
    if (is_numeric($GamesActionValue)) {

        $ActionValue = $APIPage->URLParameter::getParam("Games.php", 1);
        if ($ActionValue != null) {

            if($ActionValue == "Update") {
                //Update the game  
                $UpdateArray = array(
                    "ID" => $GamesActionValue,
                );
                if (array_key_exists("Name", $_POST)) {
                    $UpdateArray["Name"] = $_POST["Name"];
                }
                if (array_key_exists("Link", $_POST)) {
                    $CreateArray["Link"] = $_POST["Link"];
                }
                if (array_key_exists("Description", $_POST)) {
                    $UpdateArray["Description"] = $_POST["Description"];
                }
                if (array_key_exists("PlatformID", $_POST)) {
                    $UpdateArray["PlatformID"] = $_POST["PlatformID"];
                }
                if (array_key_exists("IconID", $_POST)) {
                    $UpdateArray["IconID"] = $_POST["IconID"];
                }
                if (array_key_exists("LaunchDate", $_POST)) {
                    $UpdateArray["LaunchDate"] = $_POST["LaunchDate"];
                }
                $APIPage->UpdateGame($UpdateArray);
            }
            elseif ($ActionValue == "Delete") {
                //Delete the game from the page
                $APIPage->DeleteGame($GamesActionValue);
            }
            elseif ($ActionValue == "Updates") {
                //Game Updates
                $UpdateAction = $APIPage->URLParameter::getParam("Games.php", 2);
                if (isset($UpdateAction) && $UpdateAction != null) {
                    if (is_numeric($UpdateAction)) {
                        //If Updates is a number aka an index value
                        $UpdateActionValue = $APIPage->URLParameter::getParam("Games.php", 3);
                        if ($UpdateActionValue != null) {
                            if ($UpdateActionValue == "Update") {
                                $UpdateArray = array(
                                    "GameID" =>  $GamesActionValue,
                                    "UpdateID" => $UpdateAction
                                );
                                if (array_key_exists("Name", $_POST)) {
                                    $UpdateArray["Name"] = $_POST["Name"];
                                }
                                if (array_key_exists("Description", $_POST)) {
                                    $UpdateArray["Description"] = $_POST["Description"];
                                }
                                if (array_key_exists("ReleaseDate", $_POST)) {
                                    $UpdateArray["ReleaseDate"] = $_POST["ReleaseDate"];
                                }
                                if (array_key_exists("Visible", $_POST)) {
                                    $UpdateArray["Visible"] = $_POST["Visible"];
                                }
                                $APIPage->ChangeUpdate($UpdateArray);
                            }
                            elseif ($UpdateActionValue == "Delete") {
                                $APIPage->DeleteUpdate($GamesActionValue, $UpdateAction);
                            }
                        }
                        else {
                            $APIPage->GetSingleUpdate($GamesActionValue, $UpdateAction);
                        }
                    }
                    elseif ($UpdateAction == "Create") {
                        $CreateArray = array(
                            "GameID" => $GamesActionValue
                        );
                        if (array_key_exists("Name", $_POST)) {
                            $CreateArray["Name"] = $_POST["Name"];
                        }
                        if (array_key_exists("Description", $_POST)) {
                            $CreateArray["Description"] = $_POST["Description"];
                        }
                        if (array_key_exists("ReleaseDate", $_POST)) {
                            $CreateArray["ReleaseDate"] = $_POST["ReleaseDate"];
                        }
                        if (array_key_exists("Visible", $_POST)) {
                            $CreateArray["Visible"] = $_POST["Visible"];
                        }
                        if (array_key_exists("WebsiteAdminID", $_POST)) {
                            $CreateArray["WebsiteAdminID"] = $_POST["WebsiteAdminID"];
                        }
                        //INSERT INTO `updates` ( `GameID`, `Name`, `Description`, `WebsiteAdminID`) VALUES ('1','Duel Update', 'A new update', '0'); 
                        ($CreateArray);
                    }
                }
                else {
                    //Get all updates from game
                    $APIPage->GetAllUpdates($GamesActionValue);
                }
            }
        }
        else {
            $APIPage->GetSingleGame($GamesActionValue);
        }
    } elseif ($GamesActionValue == "Create") {
        //Create a new game
        $CreateArray = array();
        if (array_key_exists("Name", $_POST)) {
            $CreateArray["Name"] = $_POST["Name"];
        }
        if (array_key_exists("Description", $_POST)) {
            $CreateArray["Description"] = $_POST["Description"];
        }
        if (array_key_exists("Link", $_POST)) {
            $CreateArray["Link"] = $_POST["Link"];
        }
        if (array_key_exists("PlatformID", $_POST)) {
            $CreateArray["PlatformID"] = $_POST["PlatformID"];
        }
        if (array_key_exists("IconID", $_POST)) {
            $CreateArray["IconID"] = $_POST["IconID"];
        }
        if (array_key_exists("LaunchDate", $_POST)) {
            $CreateArray["LaunchDate"] = $_POST["LaunchDate"];
        }
        $APIPage->CreateNewGame($CreateArray);
    }
} else {
    //Get All games
    $APIPage->GetAllGames();
}

//Print the API response that was generated
$APIPage->APIResponse->EchoResponse();
