<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Resources/Utility/router/Route.php";

Route::add("/api/projects/get", [new ProjectViewController(), "GetApi"], "post");
Route::add("/api/projects/getall", [new ProjectViewController(), "GetAllApi"], "post");