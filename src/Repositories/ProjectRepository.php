<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Models/ProjectModel.php";
include_once __DIR__."/ObjectRepository.php";

class ProjectRepository extends ObjectRepository
{

    function __construct()
    {
        parent::__construct();
        $this->table = "projects";
    }

    public function GetAll()
    {
        $Query = "SELECT projects.*, imgs.name as image_name, imgs.created_at as image_created_at FROM $this->table projects LEFT JOIN images imgs ON imgs.id = projects.image_id ORDER BY projects.name ASC";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement);

        $Projects = array();
        if ($Data != null && gettype($Data) == "array") 
        {
            for ($i=0; $i < count($Data); $i++) { 

                $Project = new ProjectModel($Data[$i]->id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->link, $Data[$i]->visible, 
                    new ImageModel((int)$Data[$i]->image_id, $Data[$i]->image_name, $Data[$i]->image_created_at));

                array_push($Projects, $Project);
            }
        }

        return $Projects;
    }

    public function GetAllVisible()
    {
        $Query = "SELECT projects.*, imgs.name as image_name, imgs.created_at as image_created_at FROM $this->table projects LEFT JOIN images imgs ON imgs.id = projects.image_id WHERE projects.visible = 1 ORDER BY projects.name ASC";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement);

        $Projects = array();
        if ($Data != null && gettype($Data) == "array") 
        {
            for ($i=0; $i < count($Data); $i++) { 

                $Project = new ProjectModel($Data[$i]->id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->link, $Data[$i]->visible, 
                    new ImageModel((int)$Data[$i]->image_id, $Data[$i]->image_name, $Data[$i]->image_created_at));

                array_push($Projects, $Project);
            }
        }

        return $Projects;
    }

    public function GetSingle($id)
    {
        $Query = "SELECT projects.*, imgs.name as image_name, imgs.created_at as image_created_at FROM $this->table projects LEFT JOIN images imgs ON imgs.id = projects.image_id WHERE projects.id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        
        $Data = $this->DatabaseHandler->ExecuteStatement($Statement, array(
            ":id" => $id
        ));

        $Project = null;
        if ($Data) 
        {
            for ($i=0; $i < count($Data); $i++) { 
                
                $Project = new ProjectModel($Data[$i]->id, $Data[$i]->name, $Data[$i]->description, $Data[$i]->link, $Data[$i]->visible, 
                    new ImageModel($Data[$i]->image_id, $Data[$i]->image_name, $Data[$i]->image_created_at));
            }
        }

        return $Project;
    }

 
    public function Create(Model $ProjectModel)
    {
        $Query = "INSERT INTO $this->table (name, description, link, visible, image_id) VALUES (:name, :description, :link, :visible, :image_id )";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":name" => $this->DatabaseHandler->escapeInjection($ProjectModel->name),
            ":description" => $this->DatabaseHandler->escapeInjection($ProjectModel->description, HtmlTags::getDescriptionTags()),
            ":link" => $this->DatabaseHandler->escapeInjection($ProjectModel->link),
            ":visible" => $this->DatabaseHandler->escapeInjection($ProjectModel->visible),
            ":image_id" => $this->DatabaseHandler->escapeInjection($ProjectModel->image->id)
        ], false);
    }

    public function Update(Model $ProjectModel)
    {
        $Query = "UPDATE $this->table SET name = :name, description = :description, link = :link, image_id = :image_id, visible = :visible WHERE id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $this->DatabaseHandler->escapeInjection($ProjectModel->id),
            ":name" => $this->DatabaseHandler->escapeInjection($ProjectModel->name),
            ":description" => $this->DatabaseHandler->escapeInjection($ProjectModel->description, HtmlTags::getDescriptionTags()),
            ":link" => $this->DatabaseHandler->escapeInjection($ProjectModel->link),
            ":visible" => $this->DatabaseHandler->escapeInjection($ProjectModel->visible),
            ":image_id" => $this->DatabaseHandler->escapeInjection($ProjectModel->image->id)
        ], false);
    }

    public function SetVisibility(int $id, $Visible)
    {
        $Query = "UPDATE $this->table SET visible = :visible WHERE id = :id";
        $Statement = $this->DatabaseHandler->CreateStatement($Query);
        return $this->DatabaseHandler->ExecuteStatement($Statement, [
            ":id" => $id,
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