<?php
namespace Src\controllers;

use Src\base\ctlBase;
use Src\tables\tblTasks;

class ctlTasks extends ctlBase {

    public function __construct($db) {
        parent::__construct($db);

        $this->table = new tblTasks($db);
    }

    protected function Validation($input): bool {
        return true;
    }
}
