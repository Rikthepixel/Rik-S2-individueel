<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Database/DatabaseHandler.php";
include_once $_SERVER["DOCUMENT_ROOT"]."Objects/Models/IModel.php";

abstract class ObjectRepository {
    
    protected $DatabaseHandler;
    protected $table = "";
    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->TestConnect();
    }

    abstract public function GetAll();
    abstract public function GetSingle(int $id);
    abstract public function Create($ObjectModel);
    abstract public function Update($ObjectModel);
    abstract public function Delete(int $id);
}
?>