<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Route.php";

Route::add("/", function() {
    include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetFrontPage();
});

Route::add("/Projects", function() {
    include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetFrontPage();
});

Route::add("/Project", function() {
    include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetProjectPage();
});