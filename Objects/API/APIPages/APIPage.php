<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Objects/API/ApiResponse.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Objects/URLParameter.php";

class APIPage {
    public $APIResponse;
    public $URLParameter;
    protected $Model;

    function __construct() {
        $this->APIResponse = new ApiResponse(null, null, null);
        $this->URLParameter = new URLParameter();
    }
}
?>