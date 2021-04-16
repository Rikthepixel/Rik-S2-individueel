<?php

class Route {
    public $Location;
    public $Callback;
    public $Method;

    function __construct($Location, $CallbackFunction, $Method)
    {
        $this->Location = $Location;
        $this->Callback = $CallbackFunction;
        $this->Method = $Method;
    }

    public function ExecuteCallback() {
        call_user_func($this->Callback);
    }
}