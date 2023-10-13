<?php declare(strict_types=1);
class tblFinances extends tblBase {
    public function __construct(){
        parent::__construct("FINANCES");
        $this->object = new doFinance();
    }

    public function Create(Array $input, $sql = null) {
        $sql = "INSERT INTO FINANCES VALUES(NULL, CURRENT_TIMESTAMP, 1, :AMOUNT, :IN_OUT, :FREQUENCY, :DESCRIPTION)";
        return parent::Create($input, $sql);
    }

    public function Update(Array $input, $sql = null) {
        $sql = "UPDATE FINANCES SET CREATION_DATE = CURRENT_TIMESTAMP, AMOUNT = :AMOUNT, IN_OUT  = :IN_OUT, FREQUENCY = :FREQUENCY, DESCRIPTION = :DESCRIPTION WHERE OBJECT_KEY = :OBJECT_KEY;";
        return parent::Update($input, $sql);
    }
}
