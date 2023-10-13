<?php declare(strict_types=1);

class ctlFinances extends ctlBase {

    public function __construct() {
        parent::__construct();

        $this->table = new tblFinances();
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
