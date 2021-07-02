<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Views/ApiResponse.php";

if (isset($Image) && $Image != null) {
    $ApiResponse = new ApiResponse(true, "fetched project successfully", $Image);
    $ApiResponse->EchoResponse();
}
else {

    $ApiResponse = new ApiResponse(false, "failed to fetch project", null);
    $ApiResponse->EchoResponse();

}
