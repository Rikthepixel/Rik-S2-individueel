<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Route.php";

Route::add("/api/projects/get", function() {
    include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ProjectViewController.php";
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->GetApi();
}, "post");

Route::add("/api/projects/getall", function() {
    include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ProjectViewController.php";
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->GetAllApi();
}, "post");