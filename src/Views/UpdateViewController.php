<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ProjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/UpdateController.php";

class UpdateViewController
{
    public function __construct()
    {
        $this->ProjectController = new ProjectController();
        $this->UpdateController = new UpdateController();    
    }

    public function AdminEditUpdate(Request $request)
    {

        if (!isset($request->id)) { return null; }
       
        $update = $this->UpdateController->getUpdate($request->id);
        $update->name =  $request->Name;
        $update->description = $request->Description;
        $update->visible = $request->Visible;
        $update->version = $request->Version;

        $success = $this->UpdateController->changeUpdate($update);
        header('Location: /admin/projects/project?id='.$request->project_id);
    }

    public function GetAdminEditUpdatePage(Request $request)
    {
        $Update = $this->UpdateController->getUpdate($request->id);

        if (!$Update) {
            header('Location: /admin/projects');
        }

        $Project = $this->ProjectController->GetProject($Update->project_id);

        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/AdminViews/Update/EditUpdate.php";
    }

    public function GetAdminAddUpdatePage(Request $request)
    {

        if (!isset($request->project_id)) {
            header('Location: /admin/projects');
        }

        $Project = $this->ProjectController->GetProject($request->project_id);
        include $_SERVER["DOCUMENT_ROOT"]."/src/Views/AdminViews/Update/Add.php";
    }

    public function AdminAddUpdate(Request $request)
    {

        if (!isset($request->project_id)) { return null; }

        if (!isset($request->Visible) || $request->Visible == null) { $request->Visible = false; }

        $update = new UpdateModel(0, $request->project_id, $request->Name, $request->Description, $request->Visible, $request->Version);
        $success = $this->UpdateController->createUpdate($update);

        header('Location: /admin/projects/project?id='.$request->project_id);
    }

    public function AdminDeleteUpdate(Request $request)
    {

        if (!isset($request->id)) { return null; }
        $success = $this->UpdateController->removeUpdate($request->id);

        if (isset($request->project_id)) { 
            header('Location: /admin/projects/project?id='.$request->project_id); 
        } else {
            header('Location: /admin/projects');
        }

    }
}