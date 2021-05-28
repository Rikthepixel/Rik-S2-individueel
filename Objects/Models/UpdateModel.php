<?php 
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Models/Model.php";

class UpdateModel extends Model
{
    public int $project_id;
    public string $name;
    public string $description;
    public bool $visible;

    function __construct(int $id, int $project_id, string $name, string $description, bool $visible)
    {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->name = $name;
        $this->description = $description;
        $this->visible = $visible;
    }
}