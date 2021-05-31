<?php

class Request
{

    function __construct()
    {
        $this->GetRequestVariables();
    }

    public function GetRequestVariables()
    {
        $Variables = array_merge($_GET, $_POST, (array)$this);

        foreach ($Variables as $key => $value) {
            $this->$key = $value;
        }
    }

}