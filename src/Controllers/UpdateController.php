<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Controllers/ObjectController.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/src/Repositories/UpdateRepository.php";

class UpdateController extends ObjectController
{
    function __construct()
    {
        $this->Repository = new UpdateRepository();
    }

    public function getUpdates(int $Project_id)
    {
        return $this->Repository->GetAllByProject($Project_id);
    }

    public function getVisibleUpdates(int $Project_id)
    {
        $updates = $this->Repository->GetAllByProject($Project_id);

        $visibleUpdates = array();
        foreach ($updates as $key => $value) {
            if ($value->visible) {
                array_push($visibleUpdates, $value);
            }
        }

        return $visibleUpdates;
    }

    public function createUpdate(UpdateModel $update)
    {
        return $this->Repository->Create($update);
    }

    public function changeUpdate(UpdateModel $update)
    {
        return $this->Repository->Update();
    }

    public function SetProjectVisiblilty(UpdateModel $update, bool $visible)
    {
        $this->Repository->SetVisibility($update->id, $visible);
    }
}