<?php
include_once('storage.php');

class EmployeeStorage extends Storage {
    public function __construct() {
        parent::__construct(new JsonIO('employees.json'));
    }
}