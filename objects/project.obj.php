<?php

class Project
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add_projects()
    {
        $sql = "INSERT INTO project_tbl SET 
        project_code=?, company_code=?, project_name=?, location=?, city=?, province=?, association=?, registry=?, project_tct_no=?, condo=?, 
        contract_remarks_1=?, contract_date_1=?, contract_remarks_2=?, contract_date_2=?, contract_remarks_3=?, contract_date_3=?, contract_remarks_4=?, contract_date_4=?, contract_remarks_5=?, contract_date_5=?, 
        pagibig_remarks_1=?, pagibig_date_1=?, pagibig_remarks_2=?, pagibig_date_2=?, pagibig_remarks_3=?, pagibig_date_3=?, pagibig_remarks_4=?, pagibig_date_4=?, pagibig_remarks_5=?, pagibig_date_5=?, 
        titling_remarks_1=?, titling_date_1=?, titling_remarks_2=?, titling_date_2=?, titling_remarks_3=?, titling_date_3=?, titling_remarks_4=?, titling_date_4=?, titling_remarks_5=?, titling_date_5=?, 
        created_by=?, date_created=NOW(), is_active=1";
        $add_project = $this->conn->prepare($sql);

        $add_project->bindParam(1, $this->project_code);
        $add_project->bindParam(2, $this->company_code);
        $add_project->bindParam(3, $this->project_name);
        $add_project->bindParam(4, $this->location);
        $add_project->bindParam(5, $this->city);
        $add_project->bindParam(6, $this->province);
        $add_project->bindParam(7, $this->association);
        $add_project->bindParam(8, $this->registry);
        $add_project->bindParam(9, $this->project_tct_no);
        $add_project->bindParam(10, $this->condo);
        $add_project->bindParam(11, $this->contract_remarks_1);
        $add_project->bindParam(12, $this->contract_date_1);
        $add_project->bindParam(13, $this->contract_remarks_2);
        $add_project->bindParam(14, $this->contract_date_2);
        $add_project->bindParam(15, $this->contract_remarks_3);
        $add_project->bindParam(16, $this->contract_date_3);
        $add_project->bindParam(17, $this->contract_remarks_4);
        $add_project->bindParam(18, $this->contract_date_4);
        $add_project->bindParam(19, $this->contract_remarks_5);
        $add_project->bindParam(20, $this->contract_date_5);
        $add_project->bindParam(21, $this->pagibig_remarks_1);
        $add_project->bindParam(22, $this->pagibig_date_1);
        $add_project->bindParam(23, $this->pagibig_remarks_2);
        $add_project->bindParam(24, $this->pagibig_date_2);
        $add_project->bindParam(25, $this->pagibig_remarks_3);
        $add_project->bindParam(26, $this->pagibig_date_3);
        $add_project->bindParam(27, $this->pagibig_remarks_4);
        $add_project->bindParam(28, $this->pagibig_date_4);
        $add_project->bindParam(29, $this->pagibig_remarks_5);
        $add_project->bindParam(30, $this->pagibig_date_5);
        $add_project->bindParam(31, $this->titling_remarks_1);
        $add_project->bindParam(32, $this->titling_date_1);
        $add_project->bindParam(33, $this->titling_remarks_2);
        $add_project->bindParam(34, $this->titling_date_2);
        $add_project->bindParam(35, $this->titling_remarks_3);
        $add_project->bindParam(36, $this->titling_date_3);
        $add_project->bindParam(37, $this->titling_remarks_4);
        $add_project->bindParam(38, $this->titling_date_4);
        $add_project->bindParam(39, $this->titling_remarks_5);
        $add_project->bindParam(40, $this->titling_date_5);
        $add_project->bindParam(41, $this->created_by);


        if ($add_project->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function increment_project_codes()
    {
        $sql = "SELECT MAX(project_code) AS max_code FROM project_tbl WHERE is_active = 1";
        $increment_project_code = $this->conn->prepare($sql);

        $increment_project_code->execute();
        return $increment_project_code;
    }

    public function view_projects()
    {
        $sql = "SELECT p.id, p.project_code, c.company_name, p.project_name FROM project_tbl p, company_tbl c WHERE p.company_code = c.id AND p.is_active = 1 ORDER BY p.date_created DESC";
        $view_project = $this->conn->prepare($sql);

        $view_project->execute();
        return $view_project;
    }

    public function get_projects()
    {
        $sql = "SELECT p.id, p.project_code, c.company_code, c.id AS company_id, p.project_name, p.location, p.city, p.province, p.association, p.registry, p.project_tct_no, p.condo, p.contract_remarks_1, p.contract_date_1, p.contract_remarks_2, p.contract_date_2, p.contract_remarks_3, p.contract_date_3, p.contract_remarks_4, p.contract_date_4, p.contract_remarks_5, p.contract_date_5, p.pagibig_remarks_1, p.pagibig_date_1, p.pagibig_remarks_2, p.pagibig_date_2, p.pagibig_remarks_3, p.pagibig_date_3, p.pagibig_remarks_4, p.pagibig_date_4, p.pagibig_remarks_5, p.pagibig_date_5, p.titling_remarks_1, p.titling_date_1, p.titling_remarks_2, p.titling_date_2, p.titling_remarks_3, p.titling_date_3, p.titling_remarks_4, p.titling_date_4, p.titling_remarks_5, p.titling_date_5 FROM project_tbl p, company_tbl c WHERE p.company_code = c.id AND p.id=?";
        $get_project = $this->conn->prepare($sql);

        $get_project->bindParam(1, $this->id);

        $get_project->execute();
        return $get_project;
    }

    public function update_projects()
    {
        $sql = "UPDATE project_tbl SET project_code=?, company_code=?, project_name=?, location=?, city=?, province=?, association=?, registry=?, project_tct_no=?, condo=?, 
        contract_remarks_1=?, contract_date_1=?, contract_remarks_2=?, contract_date_2=?, contract_remarks_3=?, contract_date_3=?, contract_remarks_4=?, contract_date_4=?, contract_remarks_5=?, contract_date_5=?, 
        pagibig_remarks_1=?, pagibig_date_1=?, pagibig_remarks_2=?, pagibig_date_2=?, pagibig_remarks_3=?, pagibig_date_3=?, pagibig_remarks_4=?, pagibig_date_4=?, pagibig_remarks_5=?, pagibig_date_5=?, 
        titling_remarks_1=?, titling_date_1=?, titling_remarks_2=?, titling_date_2=?, titling_remarks_3=?, titling_date_3=?, titling_remarks_4=?, titling_date_4=?, titling_remarks_5=?, titling_date_5=? WHERE id=?";
        $update_project = $this->conn->prepare($sql);

        $update_project->bindParam(1, $this->project_code);
        $update_project->bindParam(2, $this->company_code);
        $update_project->bindParam(3, $this->project_name);
        $update_project->bindParam(4, $this->location);
        $update_project->bindParam(5, $this->city);
        $update_project->bindParam(6, $this->province);
        $update_project->bindParam(7, $this->association);
        $update_project->bindParam(8, $this->registry);
        $update_project->bindParam(9, $this->project_tct_no);
        $update_project->bindParam(10, $this->condo);
        $update_project->bindParam(11, $this->contract_remarks_1);
        $update_project->bindParam(12, $this->contract_date_1);
        $update_project->bindParam(13, $this->contract_remarks_2);
        $update_project->bindParam(14, $this->contract_date_2);
        $update_project->bindParam(15, $this->contract_remarks_3);
        $update_project->bindParam(16, $this->contract_date_3);
        $update_project->bindParam(17, $this->contract_remarks_4);
        $update_project->bindParam(18, $this->contract_date_4);
        $update_project->bindParam(19, $this->contract_remarks_5);
        $update_project->bindParam(20, $this->contract_date_5);
        $update_project->bindParam(21, $this->pagibig_remarks_1);
        $update_project->bindParam(22, $this->pagibig_date_1);
        $update_project->bindParam(23, $this->pagibig_remarks_2);
        $update_project->bindParam(24, $this->pagibig_date_2);
        $update_project->bindParam(25, $this->pagibig_remarks_3);
        $update_project->bindParam(26, $this->pagibig_date_3);
        $update_project->bindParam(27, $this->pagibig_remarks_4);
        $update_project->bindParam(28, $this->pagibig_date_4);
        $update_project->bindParam(29, $this->pagibig_remarks_5);
        $update_project->bindParam(30, $this->pagibig_date_5);
        $update_project->bindParam(31, $this->titling_remarks_1);
        $update_project->bindParam(32, $this->titling_date_1);
        $update_project->bindParam(33, $this->titling_remarks_2);
        $update_project->bindParam(34, $this->titling_date_2);
        $update_project->bindParam(35, $this->titling_remarks_3);
        $update_project->bindParam(36, $this->titling_date_3);
        $update_project->bindParam(37, $this->titling_remarks_4);
        $update_project->bindParam(38, $this->titling_date_4);
        $update_project->bindParam(39, $this->titling_remarks_5);
        $update_project->bindParam(40, $this->titling_date_5);
        $update_project->bindParam(41, $this->project_id);

        if ($update_project->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_projects()
    {
        $sql = "UPDATE project_tbl SET is_active=0 WHERE id=?";
        $delete_project = $this->conn->prepare($sql);

        $delete_project->bindParam(1, $this->id);

        if ($delete_project->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function get_project_names()
    {
        $sql = "SELECT id, project_name FROM project_tbl WHERE is_active=1";
        $get_project_name = $this->conn->prepare($sql);

        $get_project_name->execute();
        return $get_project_name;
    }

    public function count_projects()
    {
        $sql = "SELECT COUNT(id) AS total_project FROM project_tbl WHERE is_active=1;";
        $count_project = $this->conn->prepare($sql);

        $count_project->execute();
        return $count_project;
    }
}
