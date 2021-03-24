<?php
include_once "../Objects/URLParameter.php";

$Game = URLParameter::getParam("Games.php");

if ($Game == null){
    echo("Null");
}
else{
    echo($Game);
}

?>