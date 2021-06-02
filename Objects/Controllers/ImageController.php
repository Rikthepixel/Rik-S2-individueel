<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Repositories/ImageRepository.php";

class ImageController extends ObjectController
{
    function __construct()
    {
        parent::$Repository = new ImageRepository();
    }
}