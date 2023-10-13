<?php declare(strict_types=1);

class ctlProjects extends ctlBase {

    public function __construct() {
        parent::__construct();

        $this->table = new tblProjects();
    }

    protected function Validation($input): bool {
        return true;
    }
}
