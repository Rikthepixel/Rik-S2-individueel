<?php
include_once __DIR__."/Database/DatabaseHandler.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Resources/utility/HtmlTags.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Models/Model.php";

abstract class ObjectRepository {
    
    protected DatabaseHandler $DatabaseHandler;
    protected string $table = "";

    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->Connect($_ENV["Database"]->Server, $_ENV["Database"]->DatabaseName , $_ENV["Database"]->Username, $_ENV["Database"]->Password);
    }

    abstract public function GetAll();
    abstract public function GetSingle(int $id);
    abstract public function Create(Model $ObjectModel);
    abstract public function Update(Model $ObjectModel);
    abstract public function Delete(int $id);
}
?>