<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Utility/Route.php";


Route::add("/api/projects/get", function(Request $request) {
    include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ProjectViewController.php";
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->GetApi($request);
}, "post");

Route::add("/api/projects/getall", function(Request $request) {
    include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Views/ProjectViewController.php";
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->GetAllApi($request);
}, "post");