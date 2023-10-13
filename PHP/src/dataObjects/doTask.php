<?php declare(strict_types=1);

final class doTask extends doBase {
    public function __construct() {
        parent::__construct();
        $this->properties["ProjectKey"] = new doProperty("FK_PROJECT", "ProjectKey", -1, \PDO::PARAM_INT);
        $this->properties["Title"] = new doProperty("TITLE", "Title", '', \PDO::PARAM_STR);
        $this->properties["Description"] = new doProperty("DESCRIPTION", "Description", '', \PDO::PARAM_STR);
    }
}
