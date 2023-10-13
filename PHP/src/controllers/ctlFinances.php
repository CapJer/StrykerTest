<?php
namespace Src\controllers;

use Src\base\ctlBase;
use Src\tables\tblFinances;

class ctlFinances extends ctlBase {

    public function __construct($db) {
        parent::__construct($db);

        $this->table = new tblFinances($db);
    }

    protected function Validation($input): bool {
        if (! isset($input['Amount'])) {
            return false;
        }
        if (! isset($input['InOut'])) {
            return false;
        }
        if (! isset($input['Frequency'])) {
            return false;
        }
        return true;
    }
}
