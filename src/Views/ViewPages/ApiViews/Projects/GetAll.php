<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/ApiResponse.php";

if (isset($Projects)) {
    $ApiResponse = new ApiResponse(true, "fetched projects successfully", $Projects);
    $ApiResponse->EchoResponse();
}
else {

    $ApiResponse = new ApiResponse(false, "failed to fetch projects", null);
    $ApiResponse->EchoResponse();

}