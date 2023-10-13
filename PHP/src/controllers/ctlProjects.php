<?php
namespace Src\controllers;

use Src\base\ctlBase;
use Src\tables\tblProjects;

class ctlProjects extends ctlBase {

    public function __construct($db) {
        parent::__construct($db);

        $this->table = new tblProjects($db);
    }

    protected function Validation($input): bool {
        return true;
    }
}
