<?php 
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Models/IModel.php";

class ImageModel implements IModel
{
    public string $name;
    public string $created_at;

    function __construct(int $id, string $name, string $created_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->created_at = $created_at;
    }
}