<?php

class Customer
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function increment_customer_codes()
    {
        $sql = "SELECT MAX(customer_code) AS max_code FROM customer_tbl";
        $increment_customer_code = $this->conn->prepare($sql);

        $increment_customer_code->execute();
        return $increment_customer_code;
    }

    public function add_customers()
    {
        $sql = "INSERT INTO customer_tbl SET customer_code=?, customer_name=?, customer_address=?, customer_valid_id=?, customer_tct_no=?, customer_ctc=?, 	customer_ctc_date=?, customer_ctc_place=?, civil_status=?, citizenship=?, employment=?, designation=?, company=?, contact_no=?, gender=?, legality=?, customer_spouse=?, customer_spouse_id=?, customer_spouse_ctc=?, customer_spouse_ctc_date=?, customer_spouse_ctc_place=?, customer_contact_company=?, customer_contact_position=?, customer_contact_address=?, income=?, birthdate=?, email=?, created_by=?, date_created= now(), is_active=1";
        $add_customer = $this->conn->prepare($sql);

        $add_customer->bindParam(1, $this->customer_code);
        $add_customer->bindParam(2, $this->customer_name);
        $add_customer->bindParam(3, $this->customer_address);
        $add_customer->bindParam(4, $this->customer_id);
        $add_customer->bindParam(5, $this->customer_tct_no);
        $add_customer->bindParam(6, $this->customer_ctc);
        $add_customer->bindParam(7, $this->customer_ctc_date);
        $add_customer->bindParam(8, $this->customer_ctc_place);
        $add_customer->bindParam(9, $this->civil_status);
        $add_customer->bindParam(10, $this->citizenship);
        $add_customer->bindParam(11, $this->employment);
        $add_customer->bindParam(12, $this->designation);
        $add_customer->bindParam(13, $this->company);
        $add_customer->bindParam(14, $this->contact_no);
        $add_customer->bindParam(15, $this->gender);
        $add_customer->bindParam(16, $this->legality);
        $add_customer->bindParam(17, $this->customer_spouse);
        $add_customer->bindParam(18, $this->customer_spouse_id);
        $add_customer->bindParam(19, $this->customer_spouse_ctc);
        $add_customer->bindParam(20, $this->customer_spouse_ctc_date);
        $add_customer->bindParam(21, $this->customer_spouse_ctc_place);
        $add_customer->bindParam(22, $this->customer_contact_company);
        $add_customer->bindParam(23, $this->customer_contact_position);
        $add_customer->bindParam(24, $this->customer_contact_address);
        $add_customer->bindParam(25, $this->income);
        $add_customer->bindParam(26, $this->birthdate);
        $add_customer->bindParam(27, $this->email);
        $add_customer->bindParam(28, $this->created_by);

        if ($add_customer->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_customers()
    {
        $sql = "UPDATE customer_tbl SET customer_code=?, customer_name=?, customer_address=?, customer_valid_id=?, customer_tct_no=?, customer_ctc=?, customer_ctc_date=?, customer_ctc_place=?, civil_status=?, citizenship=?, employment=?, designation=?, company=?, contact_no=?, gender=?, legality=?, customer_spouse=?, customer_spouse_id=?, customer_spouse_ctc=?, customer_spouse_ctc_date=?, customer_spouse_ctc_place=?, customer_contact_company=?, customer_contact_position=?, customer_contact_address=?, income=?, birthdate=?, email=?, updated_by=?, date_updated=NOW() WHERE id=?";
        $update_customer = $this->conn->prepare($sql);

        $update_customer->bindParam(1, $this->customer_code);
        $update_customer->bindParam(2, $this->customer_name);
        $update_customer->bindParam(3, $this->customer_address);
        $update_customer->bindParam(4, $this->customer_id);
        $update_customer->bindParam(5, $this->customer_tct_no);
        $update_customer->bindParam(6, $this->customer_ctc);
        $update_customer->bindParam(7, $this->customer_ctc_date);
        $update_customer->bindParam(8, $this->customer_ctc_place);
        $update_customer->bindParam(9, $this->civil_status);
        $update_customer->bindParam(10, $this->citizenship);
        $update_customer->bindParam(11, $this->employment);
        $update_customer->bindParam(12, $this->designation);
        $update_customer->bindParam(13, $this->company);
        $update_customer->bindParam(14, $this->contact_no);
        $update_customer->bindParam(15, $this->gender);
        $update_customer->bindParam(16, $this->legality);
        $update_customer->bindParam(17, $this->customer_spouse);
        $update_customer->bindParam(18, $this->customer_spouse_id);
        $update_customer->bindParam(19, $this->customer_spouse_ctc);
        $update_customer->bindParam(20, $this->customer_spouse_ctc_date);
        $update_customer->bindParam(21, $this->customer_spouse_ctc_place);
        $update_customer->bindParam(22, $this->customer_contact_company);
        $update_customer->bindParam(23, $this->customer_contact_position);
        $update_customer->bindParam(24, $this->customer_contact_address);
        $update_customer->bindParam(25, $this->income);
        $update_customer->bindParam(26, $this->birthdate);
        $update_customer->bindParam(27, $this->email);
        $update_customer->bindParam(28, $this->updated_by);
        $update_customer->bindParam(29, $this->id);

        if ($update_customer->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function count_customers()
    {
        $sql = "SELECT COUNT(id) AS total_customer FROM customer_tbl WHERE is_active=1;";
        $count_customer = $this->conn->prepare($sql);

        $count_customer->execute();
        return $count_customer;
    }
}
