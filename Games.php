<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Objects/URLParameter.php";
$GameID = URLParameter::getParam("Games.php");
if (isset($GameID) && $GameID != null) {
    //Show specific game
} else{
    //Show all games
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action=<?php echo "./API/Games.php/Create"?> method="post">
        <label for="">Create game</label><br>
        <input type="text" id="Name" placeholder="Name" name="Name" value=""><br>
        <input type="text" id="Description" placeholder="Description" name="Description" value=""><br>
        <input type="text" id="PlatformID" placeholder="PlatformID" name="PlatformID" value=""><br>
        <input type="text" id="IconID" placeholder="IconID" name="IconID" value=""><br>
        <input type="text" id="LaunchDate" placeholder="LaunchDate" name="LaunchDate" value=""><br>

        <input type="Submit" id="Submit" name="Submit" value="Create game">
    </form><br>
    <form action=<?php echo "./API/Games.php/$GameID/Update"?> method="post">
        <label for="">Update game</label><br>
        <input type="text" id="Name" placeholder="Name" name="Name" value=""><br>
        <input type="Submit" id="Submit" name="Submit" value="Update game">
    </form>
</body>
</html>