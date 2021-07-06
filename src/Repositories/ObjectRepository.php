<?php
namespace Repositories;

use Models\Model;
use Repositories\Database\DatabaseHandler;

abstract class ObjectRepository {
    
    protected DatabaseHandler $DatabaseHandler;
    protected string $table = "";

    function __construct()
    {
        $this->DatabaseHandler = new DatabaseHandler();
        $this->DatabaseHandler->Connect($_ENV["Database"]->Server, $_ENV["Database"]->DatabaseName , $_ENV["Database"]->Username, $_ENV["Database"]->Password);
    }

    abstract public function GetAll();
    abstract public function GetSingle(int $id);
    abstract public function Create(Model $ObjectModel);
    abstract public function Update(Model $ObjectModel);
    abstract public function Delete(int $id);
}
?>