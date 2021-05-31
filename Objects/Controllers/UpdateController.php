<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Repositories/UpdateRepository.php";

class UpdateController extends ObjectController
{
    function __construct()
    {
        $this->Repository = new UpdateRepository();
    }
}