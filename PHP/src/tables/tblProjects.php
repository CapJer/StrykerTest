<?php
namespace Src\tables;

use Src\base\tblBase;
use Src\dataObjects\doProject;

class tblProjects extends tblBase {
    public function __construct($db){
        parent::__construct($db, "Projects");
        $this->object = new doProject();
    }

    public function GetByFilter(Array $filters, string $statement = null) {
        $statement = "SELECT * FROM Projects WHERE ";

        if(isset($filters['Title'])) {
            $statement = $statement . ' TITLE = ' . $filters['Title'];
        }

        return parent::GetByFilter($filters, $statement);
    }

    public function Create(Array $input, $statement = null) {
        $statement = "INSERT INTO Projects VALUES(:OBJECT_KEY, :CREATION_DT, :MODIFICATION_DT, :REC_STATE, :NAME, :DESCRIPTION)";
        return parent::Create($input, $statement);
    }

    public function Update(Array $input, $statement = null) {
        $statement = "UPDATE Projects SET MODIFICATION_DT = :MODIFICATION_DT, NAME = :NAME, DESCRIPTION = :DESCRIPTION WHERE OBJECT_KEY = :OBJECT_KEY;";
        return parent::Update($input, $statement);
    }
}
