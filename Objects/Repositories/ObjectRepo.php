<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Database/DatabaseHandler.php";

abstract class ObjectRepo {
    
    protected $DatabaseHandler;
    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->TestConnect();
    }

    abstract public function GetAll();
    abstract public function GetSingle($ID);
    abstract public function Create($Data);
    abstract public function Update($Data);
    abstract public function Delete($ID);
}
?>