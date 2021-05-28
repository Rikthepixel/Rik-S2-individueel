<?php
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Models/UpdateModel.php";
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Repositories/ObjectRepository.php";

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
                $Update = new UpdateModel($Data[$i]->id, $Data[$i]->project_id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->visible);
                array_push($Updates, $Update);
            }
        }

        return $Updates;
    }

    public function GetSingle($id)
    {
        $Query = "SELECT updates.* FROM $this->table updates WHERE updates.id = ?id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement, [
            "?id" => $id
        ]);

        $Update = null;
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                $Update = new UpdateModel($Data[$i]->id, $Data[$i]->project_id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->visible);
            }
        }

        return $Update;
    }

    public function GetAllByProject($project_id)
    {
        $Query = "SELECT updates.* FROM $this->table updates WHERE updates.project_id = ?project_id ORDER BY updates.id DESC";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement, [
            "?project_id" => $project_id
        ]);

        $Updates = array();
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                $Update = new UpdateModel($Data[$i]->id, $Data[$i]->project_id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->visible);
                array_push($Updates, $Update);
            }
        }

        return $Updates;
    }
    
    public function Create(Model $UpdateModel)
    {
        $Query = "INSERT INTO $this->table ('name', 'description', 'visible', 'project_id') VALUES ('?name', '?description', '?visible', '?project_id')";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            "project_id" => $UpdateModel->project_id,
            "?name" => $UpdateModel->name,
            "?description" => $UpdateModel->descriptionm,
            "?visible" => $UpdateModel->visible,
        ]);
    }

    public function Update(Model $UpdateModel)
    {
        $Query = "UPDATE $this->table SET 'name' = '?name', 'project_id' = '?project_id', 'description' = '?description', 'visible' = '?visible' WHERE id = ?id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            "?id" => $UpdateModel->id,
            "?project_id" => $UpdateModel->project_id,
            "?name" => $UpdateModel->name,
            "?description" => $UpdateModel->descriptionm,
            "?visible" => $UpdateModel->visible,
        ]);
    }

    public function SetVisibility(Model $UpdateModel, $Visible)
    {
        $Query = "UPDATE $this->table SET 'visible' = '?visible' WHERE id = ?id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            "?id" => $UpdateModel->id,
            "?visible" => $Visible,
        ]);
    }
 

    public function Delete($id)
    {
        $Query = "DELETE FROM $this->table WHERE id = ?id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            "?id" => $id
        ]);
    }
}