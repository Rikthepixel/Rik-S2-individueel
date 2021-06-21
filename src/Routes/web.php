<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Utility/Route.php";

include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/HomeViewController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/ProjectViewController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/UpdateViewController.php";

Route::add("/", function(Request $request) {
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetFrontPage($request);
});

Route::add("/Projects", function(Request $request) {
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetFrontPage($request);
});

Route::add("/Project", function(Request $request) {
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetProjectPage($request);
});

//
// Admin
//
Route::add("/admin/projects", function(Request $request)
{
    $HomeViewController = new HomeViewController();
    $HomeViewController->GetProjectAdminPanel($request);
});

//
// Admin Projects
//
Route::add("/admin/projects/add", function(Request $request)
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->GetAdminProjectCreatePage($request);
});
Route::add("/admin/projects/addnew", function(Request $request)
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->AdminCreateProject($request);
}, "post");

Route::add("/admin/projects/project", function(Request $request)
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->GetAdminProjectEditPage($request);
});
Route::add("/admin/projects/edit", function(Request $request)
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->AdminEditProject($request);
}, "post");
Route::add("/admin/projects/delete", function(Request $request)
{
    $ProjectViewController = new ProjectViewController();
    $ProjectViewController->AdminDeleteProject($request);
});


//
// Admin Updates
//
Route::add("/admin/projects/editupdate", function(Request $request)
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->GetAdminEditUpdatePage($request);
});
Route::add("/admin/projects/updateedit", function(Request $request)
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->AdminEditUpdate($request);
}, "post");

Route::add("/admin/projects/addupdate", function(Request $request)
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->GetAdminAddUpdatePage($request);
});
Route::add("/admin/projects/addnewupdate", function(Request $request)
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->AdminAddUpdate($request);
}, "post");
Route::add("/admin/projects/deleteupdate", function(Request $request)
{
    $UpdateViewController = new UpdateViewController();
    $UpdateViewController->AdminDeleteUpdate($request);
});