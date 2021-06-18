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

Route::add("/admin/projects", function()
{
    include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetProjectAdminPanel();
});

Route::add("/admin/projects/project", function()
{
    include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetProjectEditPage();
});

Route::add("/admin/projects/add", function()
{
    include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetProjectCreatePage();
});

Route::add("/admin/projects/addnew", function()
{
    include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
    $HomeViewController = new HomeViewController();
    $HomeViewController->CreateProject();
}, "post");

Route::add("/admin/projects/edit", function()
{
    include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
    $HomeViewController = new HomeViewController();
    $HomeViewController->EditProject();
}, "post");