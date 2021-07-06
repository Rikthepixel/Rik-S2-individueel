<?php 
namespace Models;

class UpdateModel extends Model
{
    public int $project_id;
    public string $name;
    public string $description;
    public bool $visible;
    public string $version;

    function __construct(int $id, int $project_id, string $name, string $description, bool $visible, string $version)
    {
        $this->id = $id;
        $this->project_id = $project_id;
        $this->name = $name;
        $this->description = $description;
        $this->version = $version;
        $this->visible = $visible;
    }
}