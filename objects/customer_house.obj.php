<?php

class CustomerHouse
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add_customer_houses()
    {
        $sql = "INSERT INTO customer_house_tbl SET customer_id=?, project_id=?, house_no=?, lot=?, block=?, house_type=?, lot_area=?, floor_area=?, condo_type=?, unit_no=?, unit_floor_area=?, unit_floor=?, unit_floor_sup=?, parking_unit=?, parking_unit_area=?, parking_title_no=?, parking_floor=?, parking_floor_sup=?, net_selling_price=?, net_selling_price_word=?, equity=?, equity_word=?, payment_term=?, repricing=?, loan_amount=?, loan_amount_word=?, loan_term=?, loan_term_word=?, pagibig_interest=?, pagibig_interest_word=?, parking_nsp=?, parking_nsp_word=?, processing_fee=?, processing_fee_word=?, regfees=?, admin_fee=?, additional_work=?, transfer_tax=?, docstamp_tax=?, technical_description_1=?, technical_description_2=?, house_description=?, purpose=?, co_borrower_name_1=?, co_borrower_id_1=?, co_borrower_spouse_1=?, co_borrower_ctc_1=?, co_borrower_date_place_1=?, co_borrower_name_2=?, co_borrower_id_2=?, co_borrower_spouse_2=?, co_borrower_ctc_2=?, co_borrower_date_place_2=?, witness_a=?, witness_b=?, created_by=?, date_created=NOW(), is_active=1";
        $add_customer_house = $this->conn->prepare($sql);

        $add_customer_house->bindParam(1, $this->customer_id);
        $add_customer_house->bindParam(2, $this->project_id);
        $add_customer_house->bindParam(3, $this->house_no);
        $add_customer_house->bindParam(4, $this->lot);
        $add_customer_house->bindParam(5, $this->block);
        $add_customer_house->bindParam(6, $this->house_type);
        $add_customer_house->bindParam(7, $this->lot_area);
        $add_customer_house->bindParam(8, $this->floor_area);
        $add_customer_house->bindParam(9, $this->condo_type);
        $add_customer_house->bindParam(10, $this->unit_no);
        $add_customer_house->bindParam(11, $this->unit_floor_area);
        $add_customer_house->bindParam(12, $this->unit_floor);
        $add_customer_house->bindParam(13, $this->unit_floor_sup);
        $add_customer_house->bindParam(14, $this->parking_unit);
        $add_customer_house->bindParam(15, $this->parking_unit_area);
        $add_customer_house->bindParam(16, $this->parking_title_no);
        $add_customer_house->bindParam(17, $this->parking_floor);
        $add_customer_house->bindParam(18, $this->parking_floor_sup);
        $add_customer_house->bindParam(19, $this->net_selling_price);
        $add_customer_house->bindParam(20, $this->net_selling_price_word);
        $add_customer_house->bindParam(21, $this->equity);
        $add_customer_house->bindParam(22, $this->equity_word);
        $add_customer_house->bindParam(23, $this->payment_term);
        $add_customer_house->bindParam(24, $this->repricing);
        $add_customer_house->bindParam(25, $this->loan_amount);
        $add_customer_house->bindParam(26, $this->loan_amount_word);
        $add_customer_house->bindParam(27, $this->loan_term);
        $add_customer_house->bindParam(28, $this->loan_term_word);
        $add_customer_house->bindParam(29, $this->pagibig_interest);
        $add_customer_house->bindParam(30, $this->pagibig_interest_word);
        $add_customer_house->bindParam(31, $this->parking_nsp);
        $add_customer_house->bindParam(32, $this->parking_nsp_word);
        $add_customer_house->bindParam(33, $this->processing_fee);
        $add_customer_house->bindParam(34, $this->processing_fee_word);
        $add_customer_house->bindParam(35, $this->regfees);
        $add_customer_house->bindParam(36, $this->admin_fee);
        $add_customer_house->bindParam(37, $this->additional_work);
        $add_customer_house->bindParam(38, $this->transfer_tax);
        $add_customer_house->bindParam(39, $this->docstamp_tax);
        $add_customer_house->bindParam(40, $this->technical_description_1);
        $add_customer_house->bindParam(41, $this->technical_description_2);
        $add_customer_house->bindParam(42, $this->house_description);
        $add_customer_house->bindParam(43, $this->purpose);
        $add_customer_house->bindParam(44, $this->co_borrower_name_1);
        $add_customer_house->bindParam(45, $this->co_borrower_id_1);
        $add_customer_house->bindParam(46, $this->co_borrower_spouse_1);
        $add_customer_house->bindParam(47, $this->co_borrower_ctc_1);
        $add_customer_house->bindParam(48, $this->co_borrower_date_place_1);
        $add_customer_house->bindParam(49, $this->co_borrower_name_2);
        $add_customer_house->bindParam(50, $this->co_borrower_id_2);
        $add_customer_house->bindParam(51, $this->co_borrower_spouse_2);
        $add_customer_house->bindParam(52, $this->co_borrower_ctc_2);
        $add_customer_house->bindParam(53, $this->co_borrower_date_place_2);
        $add_customer_house->bindParam(54, $this->witness_a);
        $add_customer_house->bindParam(55, $this->witness_b);
        $add_customer_house->bindParam(56, $this->created_by);

        if ($add_customer_house->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_customer_houses()
    {
        $sql = "UPDATE customer_house_tbl SET project_id=?, house_no=?, lot=?, block=?, house_type=?, lot_area=?, floor_area=?, condo_type=?, unit_no=?, unit_floor_area=?, unit_floor=?, unit_floor_sup=?, parking_unit=?, parking_unit_area=?, parking_title_no=?, parking_floor=?, parking_floor_sup=?, net_selling_price=?, net_selling_price_word=?, equity=?, equity_word=?, payment_term=?, repricing=?, loan_amount=?, loan_amount_word=?, loan_term=?, loan_term_word=?, pagibig_interest=?, pagibig_interest_word=?, parking_nsp=?, parking_nsp_word=?, processing_fee=?, processing_fee_word=?, regfees=?, admin_fee=?, additional_work=?, transfer_tax=?, docstamp_tax=?, technical_description_1=?, technical_description_2=?, house_description=?, purpose=?, co_borrower_name_1=?, co_borrower_id_1=?, co_borrower_spouse_1=?, co_borrower_ctc_1=?, co_borrower_date_place_1=?, co_borrower_name_2=?, co_borrower_id_2=?, co_borrower_spouse_2=?, co_borrower_ctc_2=?, co_borrower_date_place_2=?, witness_a=?, witness_b=? WHERE id=?";
        $update_customer_house = $this->conn->prepare($sql);

        $update_customer_house->bindParam(1, $this->project_id);
        $update_customer_house->bindParam(2, $this->house_no);
        $update_customer_house->bindParam(3, $this->lot);
        $update_customer_house->bindParam(4, $this->block);
        $update_customer_house->bindParam(5, $this->house_type);
        $update_customer_house->bindParam(6, $this->lot_area);
        $update_customer_house->bindParam(7, $this->floor_area);
        $update_customer_house->bindParam(8, $this->condo_type);
        $update_customer_house->bindParam(9, $this->unit_no);
        $update_customer_house->bindParam(10, $this->unit_floor_area);
        $update_customer_house->bindParam(11, $this->unit_floor);
        $update_customer_house->bindParam(12, $this->unit_floor_sup);
        $update_customer_house->bindParam(13, $this->parking_unit);
        $update_customer_house->bindParam(14, $this->parking_unit_area);
        $update_customer_house->bindParam(15, $this->parking_title_no);
        $update_customer_house->bindParam(16, $this->parking_floor);
        $update_customer_house->bindParam(17, $this->parking_floor_sup);
        $update_customer_house->bindParam(18, $this->net_selling_price);
        $update_customer_house->bindParam(19, $this->net_selling_price_word);
        $update_customer_house->bindParam(20, $this->equity);
        $update_customer_house->bindParam(21, $this->equity_word);
        $update_customer_house->bindParam(22, $this->payment_term);
        $update_customer_house->bindParam(23, $this->repricing);
        $update_customer_house->bindParam(24, $this->loan_amount);
        $update_customer_house->bindParam(25, $this->loan_amount_word);
        $update_customer_house->bindParam(26, $this->loan_term);
        $update_customer_house->bindParam(27, $this->loan_term_word);
        $update_customer_house->bindParam(28, $this->pagibig_interest);
        $update_customer_house->bindParam(29, $this->pagibig_interest_word);
        $update_customer_house->bindParam(30, $this->parking_nsp);
        $update_customer_house->bindParam(31, $this->parking_nsp_word);
        $update_customer_house->bindParam(32, $this->processing_fee);
        $update_customer_house->bindParam(33, $this->processing_fee_word);
        $update_customer_house->bindParam(34, $this->regfees);
        $update_customer_house->bindParam(35, $this->admin_fee);
        $update_customer_house->bindParam(36, $this->additional_work);
        $update_customer_house->bindParam(37, $this->transfer_tax);
        $update_customer_house->bindParam(38, $this->docstamp_tax);
        $update_customer_house->bindParam(39, $this->technical_description_1);
        $update_customer_house->bindParam(40, $this->technical_description_2);
        $update_customer_house->bindParam(41, $this->house_description);
        $update_customer_house->bindParam(42, $this->purpose);
        $update_customer_house->bindParam(43, $this->co_borrower_name_1);
        $update_customer_house->bindParam(44, $this->co_borrower_id_1);
        $update_customer_house->bindParam(45, $this->co_borrower_spouse_1);
        $update_customer_house->bindParam(46, $this->co_borrower_ctc_1);
        $update_customer_house->bindParam(47, $this->co_borrower_date_place_1);
        $update_customer_house->bindParam(48, $this->co_borrower_name_2);
        $update_customer_house->bindParam(49, $this->co_borrower_id_2);
        $update_customer_house->bindParam(50, $this->co_borrower_spouse_2);
        $update_customer_house->bindParam(51, $this->co_borrower_ctc_2);
        $update_customer_house->bindParam(52, $this->co_borrower_date_place_2);
        $update_customer_house->bindParam(53, $this->witness_a);
        $update_customer_house->bindParam(54, $this->witness_b);
        $update_customer_house->bindParam(55, $this->id);

        if ($update_customer_house->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
