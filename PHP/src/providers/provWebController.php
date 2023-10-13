<?php
namespace Src\providers;

use Src\controllers\ctlTasks;
use Src\controllers\ctlFinances;
use Src\controllers\ctlProjects;

class provWebController {
    private array $registeredControllers;
    private $currentController;

    public function __construct($db){
        $this->registeredControllers['Tasks'] = new ctlTasks($db);
        $this->registeredControllers['Projects'] = new ctlProjects($db);
        $this->registeredControllers['Finances'] = new ctlFinances($db);
    }

    public function ValidURL($URL): bool {
        if($this->registeredControllers[$URL] != null) {
            $this->currentController = $this->registeredControllers[$URL];
            return true;
        } else {
            return false;
        }
    }

    public function HandleRequest($requestMethod, $key = null) {
        $this->currentController->ProcessRequest($requestMethod, $key);
    }
}
