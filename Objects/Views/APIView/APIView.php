<?php
include_once "/ApiResponse.php";
include_once $_SERVER['DOCUMENT_ROOT']."/Objects/URLParameter.php";

class APIView {
    public $APIResponse;
    public $URLParameter;
    protected $Model;

    function __construct() {
        $this->APIResponse = new ApiResponse(null, null, null);
        $this->URLParameter = new URLParameter();
    }
}
?>