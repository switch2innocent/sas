<?php

class ProjectContract
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add_project_contracts()
    {
        $sql = "INSERT INTO project_contract_tbl SET project_id=?, contract_id=?, created_by_id=?, date_created=NOW(), is_active=1";
        $add_project_contract = $this->conn->prepare($sql);

        $add_project_contract->bindParam(1, $this->project_id);
        $add_project_contract->bindParam(2, $this->contract_id);
        $add_project_contract->bindParam(3, $this->created_by_id);

        if ($add_project_contract->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_project_contracts()
    {
        $sql = "SELECT p.id, p.project_code, c.company_code, p.project_name, p.location, p.city, p.province, p.association, p.registry, p.project_tct_no, p.condo, p.contract_remarks_1, p.contract_date_1, p.contract_remarks_2, p.contract_date_2, p.contract_remarks_3, p.contract_date_3, p.contract_remarks_4, p.contract_date_4, p.contract_remarks_5, p.contract_date_5, p.pagibig_remarks_1, p.pagibig_date_1, p.pagibig_remarks_2, p.pagibig_date_2, p.pagibig_remarks_3, p.pagibig_date_3, p.pagibig_remarks_4, p.pagibig_date_4, p.pagibig_remarks_5, p.pagibig_date_5, p.titling_remarks_1, p.titling_date_1, p.titling_remarks_2, p.titling_date_2, p.titling_remarks_3, p.titling_date_3, p.titling_remarks_4, p.titling_date_4, p.titling_remarks_5, p.titling_date_5 FROM project_tbl p, company_tbl c WHERE p.company_code = c.id AND p.id=? AND p.is_active = 1 ORDER BY p.date_created DESC";
        $view_project_contract = $this->conn->prepare($sql);

        $view_project_contract->bindParam(1, $this->project_id);

        $view_project_contract->execute();
        return $view_project_contract;
    }

    public function get_contracts()
    {
        $sql = "SELECT pc.id, cf.contract_name, ct.description FROM project_contract_tbl pc, contract_files_tbl cf, contract_type_tbl ct WHERE cf.contract_type_id = ct.id AND pc.contract_id = cf.id AND pc.project_id=? AND pc.is_active = 1";
        $get_contract = $this->conn->prepare($sql);

        $get_contract->bindParam(1, $this->project_id);

        $get_contract->execute();
        return $get_contract;
    }

    public function get_contract_ids()
    {
        $sql = "SELECT id, contract_id FROM project_contract_tbl WHERE project_id=? AND is_active=1";
        $get_contract_id = $this->conn->prepare($sql);

        $get_contract_id->bindParam(1, $this->project_id);

        $get_contract_id->execute();
        return $get_contract_id;
    }

    public function delete_project_contracts()
    {
        $sql = "UPDATE project_contract_tbl SET is_active=0 WHERE project_id=?";
        $delete_project_contract = $this->conn->prepare($sql);

        $delete_project_contract->bindParam(1, $this->project_id);

        $delete_project_contract->execute();
        return $delete_project_contract;
    }
}
