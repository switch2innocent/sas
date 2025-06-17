<?php

class ContractType
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get_contract_types()
    {
        $sql = "SELECT id, description FROM contract_type_tbl WHERE is_active != 0";
        $contract_types = $this->conn->prepare($sql);
        $contract_types->execute();
        return $contract_types;
    }
}
