<?php 
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Models/Model.php";
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Models/ImageModel.php";

class ProjectModel extends Model
{
    public string $name;
    public string $description;
    public string $link;
    public bool $visible;
    public ImageModel $image;

    function __construct(int $id, string $name, string $description, string $link, bool $visible, ImageModel $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->link = $link;
        $this->visible = $visible;

        $this->image = $image;
    }
}