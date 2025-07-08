<?php

class ContractFile
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add_contract_files()
    {
        $sql = "INSERT INTO contract_files_tbl SET contract_name=?, contract_file=?, contract_type_id=?, created_by=?, date_created=NOW(), is_active=1";
        $add_contract_file = $this->conn->prepare($sql);

        $add_contract_file->bindParam(1, $this->contract_name);
        $add_contract_file->bindParam(2, $this->doc_file, PDO::PARAM_LOB);
        $add_contract_file->bindParam(3, $this->type);
        $add_contract_file->bindParam(4, $this->created_by);

        if ($add_contract_file->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function view_contract_files()
    {
        //cf = contract_files_tbl and ct = contract_type_tbl
        $sql = "SELECT cf.id, cf.contract_name, cf.contract_file, ct.description, cf.is_active FROM contract_files_tbl cf, contract_type_tbl ct WHERE ct.id = cf.contract_type_id AND cf.is_active =1 ORDER BY cf.date_created DESC";
        $view_contract_file = $this->conn->prepare($sql);

        $view_contract_file->execute();
        return $view_contract_file;
    }

    public function get_contract_files()
    {
        $sql = "SELECT cf.id, cf.contract_name, cf.contract_file, ct.description, cf.is_active, cf.contract_type_id FROM contract_files_tbl cf, contract_type_tbl ct WHERE ct.id = cf.contract_type_id AND cf.id=?";
        $get_contract_file = $this->conn->prepare($sql);

        $get_contract_file->bindParam(1, $this->id);

        $get_contract_file->execute();
        return $get_contract_file;
    }

    public function update_contract_files()
    {
        $sql = "UPDATE contract_files_tbl SET contract_name=?, contract_file=?, contract_type_id=? WHERE id=?";
        $update_contract_file = $this->conn->prepare($sql);

        $update_contract_file->bindParam(1, $this->contract_name);
        $update_contract_file->bindParam(2, $this->contract_file, PDO::PARAM_LOB);
        $update_contract_file->bindParam(3, $this->contract_type_id);
        $update_contract_file->bindParam(4, $this->id);

        if ($update_contract_file->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_contract_files()
    {
        $sql = "UPDATE contract_files_tbl SET is_active=0 WHERE id=?";
        $delete_contract_file = $this->conn->prepare($sql);

        $delete_contract_file->bindParam(1, $this->id);

        if ($delete_contract_file->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function download_contract_files()
    {
        $sql = "SELECT contract_file FROM contract_files_tbl WHERE id = ?";
        $download_contract_file = $this->conn->prepare($sql);

        $download_contract_file->bindParam(1, $this->id, PDO::PARAM_INT);

        $download_contract_file->execute();
        return $download_contract_file;
    }

    public function count_contracts()
    {
        $sql = "SELECT COUNT(id) AS total_contract FROM contract_files_tbl WHERE is_active=1;";
        $count_contract = $this->conn->prepare($sql);

        $count_contract->execute();
        return $count_contract;
    }
}
