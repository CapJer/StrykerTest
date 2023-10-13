<?php declare(strict_types=1);

class ctlTasks extends ctlBase {

    public function __construct() {
        parent::__construct();

        $this->table = new tblTasks();
    }

    protected function Validation($input): bool {
        return true;
    }
}
