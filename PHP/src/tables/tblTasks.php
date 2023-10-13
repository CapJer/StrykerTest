<?php
namespace Src\tables;

use Src\base\tblBase;
use Src\dataObjects\doTask;

class tblTasks extends tblBase {
    public function __construct($db){
        parent::__construct($db, "Tasks");
        $this->object = new doTask();
    }

    public function GetByFilter(Array $filters, string $statement = null) {
        $statement = "SELECT * FROM Tasks WHERE REC_STATE = 1 AND ";

        if(isset($filters['ProjectKey'])) {
            $statement = $statement . ' FK_PROJECT = ' . $filters['ProjectKey'];
        }

        if(isset($filters['Title'])) {
            $statement = $statement . ' AND TITLE = ' . $filters['Title'];
        }

        if(isset($filters['Finished'])) {
            $statement = $statement . ' AND FINISHED = ' . $filters['Finished'];
        }

        return parent::GetByFilter($filters, $statement);
    }

    public function Create(Array $input, $statement = null) {
        $statement = "INSERT INTO Tasks VALUES(:OBJECT_KEY, :CREATION_DT, :MODIFICATION_DT, :REC_STATE, :FK_PROJECT, :TITLE, :DESCRIPTION)";
        return parent::Create($input, $statement);
    }

    public function Update(Array $input, $statement = null) {
        $statement = "UPDATE Tasks SET MODIFICATION_DT = :MODIFICATION_DT, FK_PROJECT  = :FK_PROJECT, TITLE = :TITLE, DESCRIPTION = :DESCRIPTION WHERE OBJECT_KEY = :OBJECT_KEY;";
        return parent::Update($input, $statement);
    }
}
