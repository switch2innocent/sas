<?php

class Signatories
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add_signatories()
    {
        $sql = "INSERT INTO signatories_tbl SET company_person=?, company_position=?, company_person_tin=?, person_ctc=?, person_ctc_date_place=?, created_by=?, date_created=NOW(), is_active=1";
        $add_category = $this->conn->prepare($sql);

        $add_category->bindParam(1, $this->company_person);
        $add_category->bindParam(2, $this->company_position);
        $add_category->bindParam(3, $this->company_person_tin);
        $add_category->bindParam(4, $this->person_ctc);
        $add_category->bindParam(5, $this->person_ctc_date_place);
        $add_category->bindParam(6, $this->created_by);

        if ($add_category->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function view_signatories()
    {
        $sql = "SELECT id, company_person, company_position, company_person_tin, person_ctc, person_ctc_date_place FROM signatories_tbl WHERE is_active = 1";
        $view_signatory = $this->conn->prepare($sql);

        $view_signatory->execute();
        return $view_signatory;
    }

    public function get_signatories()
    {
        $sql = "SELECT id, company_person FROM signatories_tbl WHERE is_active = 1";
        $get_signatory = $this->conn->prepare($sql);

        $get_signatory->execute();
        return $get_signatory;
    }

    public function get_signatories_ids()
    {
        $sql = "SELECT 
                s1.company_person AS company_person1, 
                s1.company_person_tin AS company_person_tin1, 
                s1.person_ctc_date_place AS person_ctc_date_place1,
                s2.company_person AS company_person2, 
                s2.company_person_tin AS company_person_tin2, 
                s2.person_ctc_date_place AS person_ctc_date_place2
                FROM signatories_tbl s1, signatories_tbl s2
                WHERE s1.id = ?
                AND s2.id = ?
                AND s1.is_active = 1 
                AND s2.is_active = 1;";
        $get_signatories_id = $this->conn->prepare($sql);

        $get_signatories_id->bindParam(1, $this->signatory1);
        $get_signatories_id->bindParam(2, $this->signatory2);

        $get_signatories_id->execute();
        return $get_signatories_id;
    }

    public function edit_signatories()
    {
        $sql = "SELECT id, company_person, company_position, company_person_tin, person_ctc, person_ctc_date_place FROM signatories_tbl WHERE id=? AND is_active=1";
        $edit_signatory = $this->conn->prepare($sql);

        $edit_signatory->bindParam(1, $this->id);

        $edit_signatory->execute();
        return $edit_signatory;
    }

    public function update_signatories()
    {
        $sql = "UPDATE signatories_tbl SET company_person=?, company_position=?, company_person_tin=?, person_ctc=?, person_ctc_date_place=?, updated_by=?, date_updated=NOW() WHERE id=?";
        $update_signatory = $this->conn->prepare($sql);

        $update_signatory->bindParam(1, $this->company_person);
        $update_signatory->bindParam(2, $this->company_position);
        $update_signatory->bindParam(3, $this->company_person_tin);
        $update_signatory->bindParam(4, $this->person_ctc);
        $update_signatory->bindParam(5, $this->person_ctc_date_place);
        $update_signatory->bindParam(6, $this->updated_by);
        $update_signatory->bindParam(7, $this->id);

        $update_signatory->execute();
        return $update_signatory;
    }

    public function delete_signatories()
    {
        $sql = "UPDATE signatories_tbl SET is_active=0 WHERE id=?";
        $delete_signatory = $this->conn->prepare($sql);

        $delete_signatory->bindParam(1, $this->id);

        $delete_signatory->execute();
        return $delete_signatory;
    }
}
