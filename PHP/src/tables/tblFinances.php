<?php
namespace Src\tables;

use Src\base\tblBase;
use Src\dataObjects\doFinance;

class tblFinances extends tblBase {
    public function __construct($db){
        parent::__construct($db, "FINANCES");
        $this->object = new doFinance();
    }

    public function Create(Array $input, $statement = null) {
        $statement = "INSERT INTO FINANCES VALUES(NULL, CURRENT_TIMESTAMP, 1, :AMOUNT, :IN_OUT, :FREQUENCY, :DESCRIPTION)";
        return parent::Create($input, $statement);
    }

    public function Update(Array $input, $statement = null) {
        $statement = "UPDATE FINANCES SET CREATION_DATE = CURRENT_TIMESTAMP, AMOUNT = :AMOUNT, IN_OUT  = :IN_OUT, FREQUENCY = :FREQUENCY, DESCRIPTION = :DESCRIPTION WHERE OBJECT_KEY = :OBJECT_KEY;";
        return parent::Update($input, $statement);
    }
}
