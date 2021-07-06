<?php
namespace Controllers;

use Repositories\UpdateRepository;
use Models\UpdateModel;

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
        $updates = $this->Repository->GetAllVisibleByProject($Project_id);

        return $updates;
    }

    public function createUpdate(UpdateModel $update)
    {
        return $this->Repository->Create($update);
    }

    public function changeUpdate(UpdateModel $update)
    {
        return $this->Repository->Update($update);
    }

    public function getUpdate(int $id)
    {
        return $this->Repository->GetSingle($id);
    }

    public function removeUpdate(int $id)
    {
        return $this->Repository->Delete($id);
    }

    public function removeProjectUpdates(int $project_id)
    {
        $updates = $this->Repository->GetAllByProject($project_id);

        foreach ($updates as $key => $update) {
            $this->Repository->Delete($update->id);
        }
    }

    public function SetProjectVisiblilty(UpdateModel $update, bool $visible)
    {
        $this->Repository->SetVisibility($update->id, $visible);
    }
}