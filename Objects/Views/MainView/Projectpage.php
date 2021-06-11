<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/inc/header.html";

if (!isset($Project))
{
    header("Location:".$_SERVER["DOCUMENT_ROOT"]."/Projects.php");
}
?>


<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/inc/footer.html";
?>