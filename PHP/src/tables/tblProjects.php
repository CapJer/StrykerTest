<?php declare(strict_types=1);

class tblProjects extends tblBase {
    public function __construct(){
        parent::__construct("Projects");
        $this->object = new doProject();
    }

    public function GetByFilter(Array $filters, string $sql = null) {
        $sql = "SELECT * FROM Projects WHERE ";

        if(isset($filters['Title'])) {
            $sql = $sql . ' TITLE = ' . $filters['Title'];
        }

        return parent::GetByFilter($filters, $sql);
    }

    public function Create(Array $input, $sql = null) {
        $sql = "INSERT INTO Projects VALUES(:OBJECT_KEY, :CREATION_DT, :MODIFICATION_DT, :REC_STATE, :NAME, :DESCRIPTION)";
        return parent::Create($input, $sql);
    }

    public function Update(Array $input, $sql = null) {
        $sql = "UPDATE Projects SET MODIFICATION_DT = :MODIFICATION_DT, NAME = :NAME, DESCRIPTION = :DESCRIPTION WHERE OBJECT_KEY = :OBJECT_KEY;";
        return parent::Update($input, $sql);
    }
}
