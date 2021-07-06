<?php
use Router\Router;

use Views\ViewControllers\HomeViewController;
use Views\ViewControllers\ProjectViewController;
use Views\ViewControllers\UpdateViewController;

Router::add("/", [new HomeViewController, "GetFrontPage"]);
Router::add("/Projects", [new HomeViewController, "GetFrontPage"]);
Router::add("/Project", [new HomeViewController, "GetProjectPage"]);

//
// Admin
//
Router::add("/admin/projects", [new HomeViewController, "GetProjectAdminPanel"]);

//
// Admin Projects
//
Router::add("/admin/projects/add", [new ProjectViewController, "GetAdminProjectCreatePage"]);
Router::add("/admin/projects/addnew", [new ProjectViewController, "AdminCreateProject"], "post");
Router::add("/admin/projects/project", [new ProjectViewController, "GetAdminProjectEditPage"]);
Router::add("/admin/projects/edit", [new ProjectViewController, "AdminEditProject"], "post");
Router::add("/admin/projects/delete", [new ProjectViewController, "AdminDeleteProject"]);

//
// Admin Updates
//
Router::add("/admin/projects/editupdate", [new UpdateViewController, "GetAdminEditUpdatePage"]);
Router::add("/admin/projects/updateedit", [new UpdateViewController, "AdminEditUpdate"], "post");
Router::add("/admin/projects/addupdate", [new UpdateViewController, "GetAdminAddUpdatePage"]);
Router::add("/admin/projects/addnewupdate", [new UpdateViewController, "AdminAddUpdate"], "post");
Router::add("/admin/projects/deleteupdate", [new UpdateViewController, "AdminDeleteUpdate"]);