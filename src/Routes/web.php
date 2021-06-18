<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Route.php";

include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/ProjectViewController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/UpdateViewController.php";

Route::add("/", function() {
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetFrontPage();
});

Route::add("/Projects", function() {
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetFrontPage();
});

Route::add("/Project", function() {
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetProjectPage();
});

//
// Admin
//
Route::add("/admin/projects", function()
{
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetProjectAdminPanel();
});

//
// Admin Projects
//
Route::add("/admin/projects/add", function()
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->GetAdminProjectCreatePage();
});
Route::add("/admin/projects/addnew", function()
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->AdminCreateProject();
}, "post");

Route::add("/admin/projects/project", function()
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->GetAdminProjectEditPage();
});
Route::add("/admin/projects/edit", function()
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->AdminEditProject();
}, "post");
Route::add("/admin/projects/delete", function()
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->AdminDeleteProject();
});


//
// Admin Updates
//
Route::add("/admin/projects/editupdate", function()
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->GetAdminEditUpdatePage();
});
Route::add("/admin/projects/updateedit", function()
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->AdminEditUpdate();
}, "post");

Route::add("/admin/projects/addupdate", function()
{

    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->GetAdminAddUpdatePage();
});
Route::add("/admin/projects/addnewupdate", function()
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->AdminAddUpdate();
}, "post");
Route::add("/admin/projects/deleteupdate", function()
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->AdminDeleteUpdate();
});