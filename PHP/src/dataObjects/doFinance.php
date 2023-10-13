<?php declare(strict_types=1);

final class doFinance extends doBase {
    public function __construct() {
        parent::__construct();
        $this->properties["Amount"] = new doProperty("AMOUNT", "Amount", -1, \PDO::PARAM_STR);
        $this->properties["InOut"] = new doProperty("IN_OUT", "InOut", 0, \PDO::PARAM_BOOL);
        $this->properties["Frequency"] = new doProperty("FREQUENCY", "Frequency", -1, \PDO::PARAM_INT);
        $this->properties["Description"] = new doProperty("DESCRIPTION", "Description", '', \PDO::PARAM_STR);
    }
}
