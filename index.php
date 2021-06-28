<?php

include_once $_SERVER["DOCUMENT_ROOT"]."/src/Resources/utility/router/Route.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Routes/web.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Routes/api.php";

Route::run("/");