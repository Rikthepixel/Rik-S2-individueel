<?php 
include_once __DIR__."/Model.php";

class ImageModel extends Model
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