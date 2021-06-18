<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Models/UpdateModel.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Repositories/ObjectRepository.php";

class UpdateRepository extends ObjectRepository
{

    function __construct()
    {
        parent::__construct();
        $this->table = "updates";
    }

    public function GetAll()
    {
        $Query = "SELECT updates.* FROM $this->table updates ORDER BY updates.id DESC";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement);

        $Updates = array();
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                $Update = new UpdateModel($Data[$i]->id, $Data[$i]->project_id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->visible, $Data[$i]->version);
                array_push($Updates, $Update);
            }
        }

        return $Updates;
    }

    public function GetSingle($id)
    {
        $Query = "SELECT updates.* FROM $this->table updates WHERE updates.id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $id
        ]);

        $Update = null;
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                $Update = new UpdateModel($Data[$i]->id, $Data[$i]->project_id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->visible, $Data[$i]->version);
            }
        }

        return $Update;
    }

    public function GetAllByProject($project_id)
    {
        $Query = "SELECT updates.* FROM $this->table updates WHERE updates.project_id = :project_id ORDER BY updates.id DESC";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":project_id" => $project_id
        ]);

        $Updates = array();
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                $Update = new UpdateModel($Data[$i]->id, $Data[$i]->project_id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->visible, $Data[$i]->version);
                array_push($Updates, $Update);
            }
        }

        return $Updates;
    }
    
    public function Create(Model $UpdateModel)
    {
        $Query = "INSERT INTO $this->table (name, description, visible, project_id, version) VALUES (:name, :description, :visible, :project_id, :version)";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            "project_id" => $UpdateModel->project_id,
            ":name" => $UpdateModel->name,
            ":description" => $UpdateModel->description,
            ":visible" => $UpdateModel->visible,
            ":version" => $UpdateModel->version
        ]);
    }

    public function Update(Model $UpdateModel)
    {
        $Query = "UPDATE $this->table SET name = :name, description = :description, visible = :visible, version = :version WHERE id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $UpdateModel->id,
            ":name" => $UpdateModel->name,
            ":description" => $UpdateModel->description,
            ":visible" => $UpdateModel->visible,
            ":version" => $UpdateModel->version
        ]);
    }

    public function SetVisibility(Model $UpdateModel, $Visible)
    {
        $Query = "UPDATE $this->table SET visible = :visible WHERE id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $UpdateModel->id,
            ":visible" => $Visible,
        ]);
    }
 

    public function Delete($id)
    {
        $Query = "DELETE FROM $this->table WHERE id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $id
        ]);
    }
}