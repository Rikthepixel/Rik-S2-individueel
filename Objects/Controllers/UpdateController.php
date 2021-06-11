<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/Objects/Repositories/UpdateRepository.php";

class UpdateController extends ObjectController
{
    function __construct()
    {
        $this->Repository = new UpdateRepository();
    }

    public function GetUpdates(int $Project_id)
    {
        return $this->Repository->GetAllByProject($Project_id);
    }
}