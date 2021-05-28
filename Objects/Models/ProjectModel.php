<?php 
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Models/IModel.php";

class ProjectModel implements IModel
{
    public string $name;
    public string $description;
    public string $link;
    public bool $visible;

    function __construct(int $id, string $name, string $description, string $link, bool $visible)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->link = $link;
        $this->visible = $visible;
    }
}