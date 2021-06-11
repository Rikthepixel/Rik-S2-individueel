<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
$HomeViewController = new HomeViewController();
$HomeViewController->GetProjectPage();