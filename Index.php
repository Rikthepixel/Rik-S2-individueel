<?php
include_once $_SERVER['DOCUMENT_ROOT']."Objects/Router/Router.php";
Router::Route(preg_replace('/\?.+/', '', $_SERVER['REQUEST_URI']));