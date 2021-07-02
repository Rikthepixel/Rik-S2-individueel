<?php
include_once $GLOBALS["PATHS"]->Views."/ViewControllers/ProjectViewController.php";

Route::add("/api/projects/get", [new ProjectViewController(), "GetApi"], "post");
Route::add("/api/projects/getall", [new ProjectViewController(), "GetAllApi"], "post");