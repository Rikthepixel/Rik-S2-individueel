<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Database/DatabaseHandler.php";

abstract class ObjectRepository {
    
    protected $DatabaseHandler;
    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->TestConnect();
    }

    abstract public function GetAll();
    abstract public function GetSingle($id);
    abstract public function Create($data);
    abstract public function Update($data);
    abstract public function Delete($id);
}
?>