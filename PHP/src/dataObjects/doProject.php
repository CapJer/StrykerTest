<?php declare(strict_types=1);

final class doProject extends doBase {
    public function __construct() {
        parent::__construct();
        $this->properties["Name"] = new doProperty("NAME", "Name", '', \PDO::PARAM_STR);
        $this->properties["Description"] = new doProperty("DESCRIPTION", "Description", '', \PDO::PARAM_STR);
    }
}
