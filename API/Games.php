<?php
$Objects = $_SERVER['DOCUMENT_ROOT']."/Objects";
include_once "$Objects/API/APIPages/GamesAPIView.php";

$APIPage = new GamesAPIView();

//Decide which response the API should give
$GamesActionValue = $APIPage->URLParameter::getParam("Games.php");
if (isset($GamesActionValue) && $GamesActionValue != null) {
    //user wants to do something with a specific game
    if (is_numeric($GamesActionValue)) {

        $ActionValue = $APIPage->URLParameter::getParam("Games.php", 1);
        if ($ActionValue != null) {

            if($ActionValue == "Update") {
                //Update the game  x
                $PostData = $_POST;
                $PostData["GameID"] = $GamesActionValue;
                $APIPage->UpdateGame($PostData);
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
                                $PostData = $_POST;
                                $PostData["GameID"] = $GamesActionValue;
                                $PostData["UpdateID"] = $UpdateAction;
                                $APIPage->ChangeUpdate($PostData);
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
                        $PostData = $_POST;
                        $PostData["GameID"] = $GamesActionValue;

                        //INSERT INTO `updates` ( `GameID`, `Name`, `Description`, `WebsiteAdminID`) VALUES ('1','Duel Update', 'A new update', '0'); 
                        $APIPage->CreateNewUpdate($PostData);
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
        $PostData = $_POST;
        $APIPage->CreateNewGame($PostData);
    }
} else {
    //Get All games
    $APIPage->GetAllGames();
}

//Print the API response that was generated
$APIPage->APIResponse->EchoResponse();
