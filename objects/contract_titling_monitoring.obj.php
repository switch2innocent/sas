<?php

class ContractTitlingMonitoring
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add_contract_titling_monitorings()
    {
        $sql = "INSERT INTO contract_titling_monitoring_tbl SET project_id=?, customer_id=?, customer_house_id=?, submitted_to_bir=?, bir_actual_release=?, remarks_car_processing_1=?, actual_dockets_preparation_for_rd=?, remarks_car_processing_2=?, actual_preparation_of_docket_for_rd=?, remarks_rd_assessment_1=?, actual_submitted_to_rd_for_assessment=?, actual_release_of_rd_assessment=?, remarks_rd_assessment_2=?, rd_assessment_received=?, rcp_processed_signed=?, accounting_received_rcp_for_m_check=?, accounting_processed_m_check=?, accounting_m_check_for_released=?, remarks_check_processing_1=?, m_check_received=?, remarks_check_processing_2=?, date_submitted_to_rd=?, estimated_date_of_release=?, actual_date_released=?, created_by=?, date_created=NOW(), is_active=1";
        $add_contract_titling_monitoring = $this->conn->prepare($sql);

        $add_contract_titling_monitoring->bindParam(1, $this->project_id);
        $add_contract_titling_monitoring->bindParam(2, $this->customer_id);
        $add_contract_titling_monitoring->bindParam(3, $this->customer_house_id);
        $add_contract_titling_monitoring->bindParam(4, $this->submitted_to_bir);
        $add_contract_titling_monitoring->bindParam(5, $this->bir_actual_release);
        $add_contract_titling_monitoring->bindParam(6, $this->car_process_remarks1);
        $add_contract_titling_monitoring->bindParam(7, $this->actual_dockets_preparation_for_rd);
        $add_contract_titling_monitoring->bindParam(8, $this->car_process_remarks2);
        $add_contract_titling_monitoring->bindParam(9, $this->actual_preparation_of_docket_for_rd);
        $add_contract_titling_monitoring->bindParam(10, $this->rd_assessment_remarks1);
        $add_contract_titling_monitoring->bindParam(11, $this->actual_submitted_to_rd_for_assessment);
        $add_contract_titling_monitoring->bindParam(12, $this->actual_release_of_rd_assessment);
        $add_contract_titling_monitoring->bindParam(13, $this->rd_assessment_remarks2);
        $add_contract_titling_monitoring->bindParam(14, $this->rd_assessment_received);
        $add_contract_titling_monitoring->bindParam(15, $this->rcp_processed_signed);
        $add_contract_titling_monitoring->bindParam(16, $this->accounting_received_rcp_for_m_check);
        $add_contract_titling_monitoring->bindParam(17, $this->accounting_processed_m_check);
        $add_contract_titling_monitoring->bindParam(18, $this->accounting_m_check_for_released);
        $add_contract_titling_monitoring->bindParam(19, $this->check_process_remarks1);
        $add_contract_titling_monitoring->bindParam(20, $this->m_check_received);
        $add_contract_titling_monitoring->bindParam(21, $this->check_process_remarks2);
        $add_contract_titling_monitoring->bindParam(22, $this->date_submitted_to_rd);
        $add_contract_titling_monitoring->bindParam(23, $this->estimated_date_of_release);
        $add_contract_titling_monitoring->bindParam(24, $this->actual_date_released);
        $add_contract_titling_monitoring->bindParam(25, $this->created_by);

        if ($add_contract_titling_monitoring->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function view_customer_details($sql)
    {
        // $sql = "SELECT c.id, c.customer_code, c.customer_name, p.project_name, ch.house_no, ch.lot, ch.block FROM customer_tbl c, project_tbl p, customer_house_tbl ch WHERE c.id = ch.customer_id AND p.id = ch.project_id AND c.is_active = 1";
        $view_customer_detail = $this->conn->prepare($sql);

        $view_customer_detail->execute();
        return $view_customer_detail;
    }

    public function get_customer_details()
    {
        $sql = "SELECT c.id AS custom_id, ch.id AS house_id, ct.id AS cont_tit_id, c.*, ch.*, ct.*, p.project_name FROM customer_tbl c, customer_house_tbl ch, contract_titling_monitoring_tbl ct, project_tbl p WHERE c.id = ch.customer_id AND ch.id = ct.customer_house_id AND ch.project_id = p.id AND c.id=? AND c.is_active = 1";
        $get_customer_detail = $this->conn->prepare($sql);

        $get_customer_detail->bindParam(1, $this->id);

        $get_customer_detail->execute();
        return $get_customer_detail;
    }

    public function get_contract_monitorings()
    {
        $sql = "SELECT cf.id, cf.contract_name FROM project_contract_tbl pc, contract_files_tbl cf WHERE pc.contract_id = cf.id AND project_id = ? AND pc.is_active=1";
        $get_contract_monitoring = $this->conn->prepare($sql);

        $get_contract_monitoring->bindParam(1, $this->id);

        $get_contract_monitoring->execute();
        return $get_contract_monitoring;
    }

    public function download_contract_monitorings()
    {

        // $sql = "SELECT c.customer_name, c.civil_status, c.legality, c.citizenship, ch.net_selling_price_word, ch.net_selling_price, ch.unit_no, ch.condo_type, ch.unit_floor, ch.unit_floor_sup, ch.unit_floor_area, ch.witness_a, ch.witness_b, c.customer_address, cf.contract_name, cf.contract_file FROM customer_tbl c, customer_house_tbl ch, project_contract_tbl pc, contract_files_tbl cf WHERE c.id=ch.customer_id AND ch.project_id = pc.project_id AND pc.contract_id = cf.id AND c.id=? AND cf.id=?;";

        $sql = "SELECT CONCAT(u.firstname, ' ', u.lastname) AS full_name, c.customer_name, c.civil_status, c.legality, c.citizenship, ch.net_selling_price_word, ch.net_selling_price, ch.unit_no, ch.condo_type, ch.unit_floor, ch.unit_floor_sup, ch.unit_floor_area, ch.witness_a, ch.witness_b,c.customer_address, cf.contract_name,cf.contract_file FROM maindb.users u, idsdb.customer_tbl c, idsdb.customer_house_tbl ch, idsdb.project_contract_tbl pc, idsdb.contract_files_tbl cf WHERE c.created_by = u.id AND c.id=ch.customer_id AND ch.project_id = pc.project_id AND pc.contract_id = cf.id AND c.id=? AND cf.id=?;";
        $print_contract_monitoring = $this->conn->prepare($sql);

        $print_contract_monitoring->bindParam(1, $this->customer_id);
        $print_contract_monitoring->bindParam(2, $this->contract_id);

        $print_contract_monitoring->execute();
        return $print_contract_monitoring;
    }

    public function delete_customer_details()
    {
        $sql = "UPDATE customer_tbl SET is_active=0 WHERE id=?";
        $delete_customer_detail = $this->conn->prepare($sql);

        $delete_customer_detail->bindParam(1, $this->id);

        $delete_customer_detail->execute();
        return $delete_customer_detail;
    }

    public function update_contract_titling_monitorings()
    {
        $sql = "UPDATE contract_titling_monitoring_tbl SET submitted_to_bir=?, bir_actual_release=?, remarks_car_processing_1=?, actual_dockets_preparation_for_rd=?, remarks_car_processing_2=?, actual_preparation_of_docket_for_rd=?, remarks_rd_assessment_1=?, actual_submitted_to_rd_for_assessment=?, actual_release_of_rd_assessment=?, remarks_rd_assessment_2=?, rd_assessment_received=?, rcp_processed_signed=?, accounting_received_rcp_for_m_check=?, accounting_processed_m_check=?, accounting_m_check_for_released=?, remarks_check_processing_1=?, m_check_received=?, remarks_check_processing_2=?, date_submitted_to_rd=?, estimated_date_of_release=?, actual_date_released=? WHERE id=?";
        $update_contract_titling_monitoring = $this->conn->prepare($sql);

        $update_contract_titling_monitoring->bindParam(1, $this->submitted_to_bir);
        $update_contract_titling_monitoring->bindParam(2, $this->bir_actual_release);
        $update_contract_titling_monitoring->bindParam(3, $this->car_process_remarks1);
        $update_contract_titling_monitoring->bindParam(4, $this->actual_dockets_preparation_for_rd);
        $update_contract_titling_monitoring->bindParam(5, $this->car_process_remarks2);
        $update_contract_titling_monitoring->bindParam(6, $this->actual_preparation_of_docket_for_rd);
        $update_contract_titling_monitoring->bindParam(7, $this->rd_assessment_remarks1);
        $update_contract_titling_monitoring->bindParam(8, $this->actual_submitted_to_rd_for_assessment);
        $update_contract_titling_monitoring->bindParam(9, $this->actual_release_of_rd_assessment);
        $update_contract_titling_monitoring->bindParam(10, $this->rd_assessment_remarks2);
        $update_contract_titling_monitoring->bindParam(11, $this->rd_assessment_received);
        $update_contract_titling_monitoring->bindParam(12, $this->rcp_processed_signed);
        $update_contract_titling_monitoring->bindParam(13, $this->accounting_received_rcp_for_m_check);
        $update_contract_titling_monitoring->bindParam(14, $this->accounting_processed_m_check);
        $update_contract_titling_monitoring->bindParam(15, $this->accounting_m_check_for_released);
        $update_contract_titling_monitoring->bindParam(16, $this->check_process_remarks1);
        $update_contract_titling_monitoring->bindParam(17, $this->m_check_received);
        $update_contract_titling_monitoring->bindParam(18, $this->check_process_remarks2);
        $update_contract_titling_monitoring->bindParam(19, $this->date_submitted_to_rd);
        $update_contract_titling_monitoring->bindParam(20, $this->estimated_date_of_release);
        $update_contract_titling_monitoring->bindParam(21, $this->actual_date_released);
        $update_contract_titling_monitoring->bindParam(22, $this->id);

        if ($update_contract_titling_monitoring->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
