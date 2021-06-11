<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/HomeViewController.php";
$HomeViewController = new HomeViewController();
$HomeViewController->GetFrontPage();