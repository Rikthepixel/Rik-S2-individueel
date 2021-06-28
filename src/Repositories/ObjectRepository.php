<?php
include_once $_SERVER['DOCUMENT_ROOT']."/src/Repositories/Database/DatabaseHandler.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Resources/Utility/HtmlTags.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Models/Model.php";

abstract class ObjectRepository {
    
    protected DatabaseHandler $DatabaseHandler;
    protected string $table = "";

    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->TestConnect();
    }

    abstract public function GetAll();
    abstract public function GetSingle(int $id);
    abstract public function Create(Model $ObjectModel);
    abstract public function Update(Model $ObjectModel);
    abstract public function Delete(int $id);
}
?>