<?php
abstract class ObjectController {
    
    abstract public function GetAll();
    abstract public function GetSingle($ID);
    abstract public function Create($Data);
    abstract public function Update($Data);
    abstract public function Delete($ID);
}
?>