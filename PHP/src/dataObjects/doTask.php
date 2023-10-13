<?php
namespace Src\dataObjects;

use Src\base\doBase;
use Src\base\doProperty;

class doTask extends doBase {
    public function __construct() {
        parent::__construct();
        $this->properties["ProjectKey"] = new doProperty("FK_PROJECT", "ProjectKey", -1, \PDO::PARAM_INT);
        $this->properties["Title"] = new doProperty("TITLE", "Title", '', \PDO::PARAM_STR);
        $this->properties["Description"] = new doProperty("DESCRIPTION", "Description", '', \PDO::PARAM_STR);
    }
}
