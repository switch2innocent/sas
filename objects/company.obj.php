<?php

class Company
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add_companys()
    {
        $sql = "INSERT INTO company_tbl SET company_code=?, company_name=?, company_address=?, city_notary=?, company_city=?, company_tin=?, company_ctc=?, company_ctc_date=?, company_ctc_place=?, company_person_a=?, company_position_a=?, company_person_tin_a=?, person_ctc_a=?, person_ctc_date_place_a=?, company_person_b=?, company_position_b=?, company_person_tin_b=?, person_ctc_b=?, person_ctc_date_place_b=?, pagibig_person=?, pagibig_address=?, pagibig_position=?, created_by=?, date_created=NOW(), is_active=1";
        $add_company = $this->conn->prepare($sql);

        $add_company->bindParam(1, $this->company_code);
        $add_company->bindParam(2, $this->company_name);
        $add_company->bindParam(3, $this->company_address);
        $add_company->bindParam(4, $this->city_notary);
        $add_company->bindParam(5, $this->company_city);
        $add_company->bindParam(6, $this->company_tin);
        $add_company->bindParam(7, $this->company_ctc);
        $add_company->bindParam(8, $this->company_ctc_date);
        $add_company->bindParam(9, $this->company_ctc_place);
        $add_company->bindParam(10, $this->company_person_a);
        $add_company->bindParam(11, $this->company_position_a);
        $add_company->bindParam(12, $this->company_person_tin_a);
        $add_company->bindParam(13, $this->person_ctc_a);
        $add_company->bindParam(14, $this->person_ctc_date_place_a);
        $add_company->bindParam(15, $this->company_person_b);
        $add_company->bindParam(16, $this->company_position_b);
        $add_company->bindParam(17, $this->company_person_tin_b);
        $add_company->bindParam(18, $this->person_ctc_b);
        $add_company->bindParam(19, $this->person_ctc_date_place_b);
        $add_company->bindParam(20, $this->pagibig_person);
        $add_company->bindParam(21, $this->pagibig_address);
        $add_company->bindParam(22, $this->pagibig_position);
        $add_company->bindParam(23, $this->created_by);

        if ($add_company->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function view_companys()
    {
        $sql = "SELECT id, company_code, company_name FROM company_tbl WHERE is_active=1 ORDER BY date_created DESC";
        $sview_company = $this->conn->prepare($sql);

        $sview_company->execute();
        return $sview_company;
    }

    public function get_companys()
    {
        $sql = "SELECT * FROM company_tbl WHERE id=?";
        $get_company = $this->conn->prepare($sql);

        $get_company->bindParam(1, $this->id);

        $get_company->execute();
        return $get_company;
    }

    public function update_companys()
    {
        $sql = "UPDATE company_tbl SET company_code=?, company_name=?, company_address=?, city_notary=?, company_city=?, company_tin=?, company_ctc=?, company_ctc_date=?, company_ctc_place=?, company_person_a=?, company_position_a=?, company_person_tin_a=?, person_ctc_a=?, person_ctc_date_place_a=?, company_person_b=?, company_position_b=?, company_person_tin_b=?, person_ctc_b=?, person_ctc_date_place_b=?, pagibig_person=?, pagibig_address=?, pagibig_position=? WHERE id=?";
        $update_company = $this->conn->prepare($sql);

        $update_company->bindParam(1, $this->company_code);
        $update_company->bindParam(2, $this->company_name);
        $update_company->bindParam(3, $this->company_address);
        $update_company->bindParam(4, $this->city_notary);
        $update_company->bindParam(5, $this->company_city);
        $update_company->bindParam(6, $this->company_tin);
        $update_company->bindParam(7, $this->company_ctc);
        $update_company->bindParam(8, $this->company_ctc_date);
        $update_company->bindParam(9, $this->company_ctc_place);
        $update_company->bindParam(10, $this->company_person_a);
        $update_company->bindParam(11, $this->company_position_a);
        $update_company->bindParam(12, $this->company_person_tin_a);
        $update_company->bindParam(13, $this->person_ctc_a);
        $update_company->bindParam(14, $this->person_ctc_date_place_a);
        $update_company->bindParam(15, $this->company_person_b);
        $update_company->bindParam(16, $this->company_position_b);
        $update_company->bindParam(17, $this->company_person_tin_b);
        $update_company->bindParam(18, $this->person_ctc_b);
        $update_company->bindParam(19, $this->person_ctc_date_place_b);
        $update_company->bindParam(20, $this->pagibig_person);
        $update_company->bindParam(21, $this->pagibig_address);
        $update_company->bindParam(22, $this->pagibig_position);
        $update_company->bindParam(23, $this->id);

        if ($update_company->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function count_companys()
    {
        $sql = "SELECT COUNT(id) AS total_company FROM company_tbl WHERE is_active=1;";
        $count_company = $this->conn->prepare($sql);

        $count_company->execute();
        return $count_company;
    }
}
