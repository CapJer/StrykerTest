<?php declare(strict_types=1);

class provWebController {
    private array $registeredControllers;
    private ctlBase $currentController;

    public function __construct(){
        $this->registeredControllers['Tasks'] = new ctlTasks();
        $this->registeredControllers['Projects'] = new ctlProjects();
        $this->registeredControllers['Finances'] = new ctlFinances();
    }

    public function ValidURL($URL): bool {
        if($this->registeredControllers[$URL] != null) {
            $this->currentController = $this->registeredControllers[$URL];
            return true;
        } else {
            return false;
        }
    }

    public function HandleRequest($requestMethod, $key = null): void {
        $this->currentController->ProcessRequest($requestMethod, $key);
    }
}
