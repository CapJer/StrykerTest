<?php declare(strict_types=1);

class tblTasks extends tblBase {
    public function __construct(){
        parent::__construct("Tasks");
        $this->object = new doTask();
    }

    public function GetByFilter(Array $filters, string $sql = null) {
        $sql = "SELECT * FROM Tasks WHERE REC_STATE = 1 AND ";

        if(isset($filters['ProjectKey'])) {
            $sql = $sql . ' FK_PROJECT = ' . $filters['ProjectKey'];
        }

        if(isset($filters['Title'])) {
            $sql = $sql . ' AND TITLE = ' . $filters['Title'];
        }

        if(isset($filters['Finished'])) {
            $sql = $sql . ' AND FINISHED = ' . $filters['Finished'];
        }

        return parent::GetByFilter($filters, $sql);
    }

    public function Create(Array $input, $sql = null) {
        $sql = "INSERT INTO Tasks VALUES(:OBJECT_KEY, :CREATION_DT, :MODIFICATION_DT, :REC_STATE, :FK_PROJECT, :TITLE, :DESCRIPTION)";
        return parent::Create($input, $sql);
    }

    public function Update(Array $input, $sql = null) {
        $sql = "UPDATE Tasks SET MODIFICATION_DT = :MODIFICATION_DT, FK_PROJECT  = :FK_PROJECT, TITLE = :TITLE, DESCRIPTION = :DESCRIPTION WHERE OBJECT_KEY = :OBJECT_KEY;";
        return parent::Update($input, $sql);
    }
}
