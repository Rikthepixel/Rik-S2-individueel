<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/ApiResponse.php";

if (isset($Project)) {
    $ApiResponse = new ApiResponse(true, "fetched project successfully", $Project);
    $ApiResponse->EchoResponse();
}
else {

    $ApiResponse = new ApiResponse(false, "failed to fetch project", null);
    $ApiResponse->EchoResponse();

}
