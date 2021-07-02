<?php
include_once $GLOBALS["PATHS"]->Views."/ViewControllers/HomeViewController.php";
include_once $GLOBALS["PATHS"]->Views."/ViewControllers/ProjectViewController.php";
include_once $GLOBALS["PATHS"]->Views."/ViewControllers/UpdateViewController.php";

Route::add("/", [new HomeViewController(), "GetFrontPage"]);
Route::add("/Projects", [new HomeViewController(), "GetFrontPage"]);
Route::add("/Project", [new HomeViewController(), "GetProjectPage"]);

//
// Admin
//
Route::add("/admin/projects", [new HomeViewController(), "GetProjectAdminPanel"]);

//
// Admin Projects
//
Route::add("/admin/projects/add", [new ProjectViewController(), "GetAdminProjectCreatePage"]);
Route::add("/admin/projects/addnew", [new ProjectViewController(), "AdminCreateProject"], "post");
Route::add("/admin/projects/project", [new ProjectViewController(), "GetAdminProjectEditPage"]);
Route::add("/admin/projects/edit", [new ProjectViewController(), "AdminEditProject"], "post");
Route::add("/admin/projects/delete", [new ProjectViewController(), "AdminDeleteProject"]);

//
// Admin Updates
//
Route::add("/admin/projects/editupdate", [new UpdateViewController(), "GetAdminEditUpdatePage"]);
Route::add("/admin/projects/updateedit", [new UpdateViewController(), "AdminEditUpdate"], "post");
Route::add("/admin/projects/addupdate", [new UpdateViewController(), "GetAdminAddUpdatePage"]);
Route::add("/admin/projects/addnewupdate", [new UpdateViewController(), "AdminAddUpdate"], "post");
Route::add("/admin/projects/deleteupdate", [new UpdateViewController(), "AdminDeleteUpdate"]);