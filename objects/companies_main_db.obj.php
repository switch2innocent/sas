<?php

class CompaniesMainDB
{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get_companies()
    {
        $sql = "SELECT id, comp_name FROM companies WHERE id IN (1, 3) AND status=1";
        $get_company = $this->conn->prepare($sql);

        $get_company->execute();
        return $get_company;
    }

    public function get_companies_ids()
    {
        $sql = "SELECT comp_name FROM companies WHERE id=? AND status=1";
        $get_company_id = $this->conn->prepare($sql);

        $get_company_id->bindParam(1, $this->comp_id);

        $get_company_id->execute();
        return $get_company_id;
    }
}
