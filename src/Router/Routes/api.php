<?php
use Router\Router;

use Views\ViewControllers\ProjectViewController;

Router::add("/api/projects/get", [new ProjectViewController, "GetApi"], "post");
Router::add("/api/projects/getall", [new ProjectViewController, "GetAllApi"], "post");