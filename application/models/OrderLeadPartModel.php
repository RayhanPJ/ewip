<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderLeadPartModel extends CI_Model {
    public function __construct(){
		parent::__construct();
        $this->db2 = $this->load->database('dbsqlsrv', TRUE);
        // $this->db3 = $this->load->database('baan', TRUE);
        
	}

    function getListOrder($date) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($date)));

        if ($this->session->userdata('username') == 'forklift_plate_1' or $this->session->userdata('username') == 'amb_1') {
            return $this->db2->select('*')
                        ->from('order_lead_part')
                        ->join('data_lead_part', 'data_lead_part.id_lead_part = order_lead_part.id_lead_part')
                        ->where('order_lead_part.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_lead_part.tanggal_order <',$next_day.' 07:00:00.000')
                        ->where("(order_lead_part.line='1' OR order_lead_part.line='2' OR order_lead_part.line='3' OR order_lead_part.line='MCB')")
                        ->order_by('order_lead_part.tanggal_order ASC', 'order_lead_part.status ASC')
                        ->get()->result_array();
        } elseif ($this->session->userdata('username') == 'forklift_plate_2' or $this->session->userdata('username') == 'amb_2' or $this->session->userdata('username') == 'assy_g') {
            return $this->db2->select('*')
                        ->from('order_lead_part')
                        ->join('data_lead_part', 'data_lead_part.id_lead_part = order_lead_part.id_lead_part')
                        ->where('order_lead_part.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_lead_part.tanggal_order <',$next_day.' 07:00:00.000')
                        ->where("(order_lead_part.line='4' OR order_lead_part.line='5' OR order_lead_part.line='6' OR order_lead_part.line='7')")
                        ->order_by('order_lead_part.tanggal_order ASC', 'order_lead_part.status ASC')
                        ->get()->result_array();
        } else {
            return $this->db2->select('*')
                        ->from('order_lead_part')
                        ->join('data_lead_part', 'data_lead_part.id_lead_part = order_lead_part.id_lead_part')
                        ->where('order_lead_part.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_lead_part.tanggal_order <',$next_day.' 07:00:00.000')
                        ->order_by('order_lead_part.status ASC', 'order_lead_part.tanggal_order ASC')
                        ->get()->result_array();
        }
    }

    function getListOrderLeadPartById($id_order_lead_part) {
        $this->db2->select('*');
        $this->db2->from('order_lead_part');
        $this->db2->join('data_lead_part', 'data_lead_part.id_lead_part = order_lead_part.id_lead_part');
        $this->db2->where('order_lead_part.id_order_lead_part',$id_order_lead_part);

        return $this->db2->get()->result_array();
    }

    function getListPartNumber($part_number) {
        return $this->db2->get_where('part_number_fgx', array('part_number' => $part_number))->result_array();
    }

    function saveDraftOrderLeadPart($data) {
        $this->db2->insert('order_lead_part_temp', $data);
    }

    function deleteDraftOrderLeadPart($no_wo) {
        $this->db2->where('no_wo', $no_wo);
        $this->db2->delete('order_lead_part_temp');
    }

    function deleteOrderLeadPart($id_order_lead_part) {
        $this->db2->where('id_order_lead_part', $id_order_lead_part);
        $this->db2->delete('order_lead_part');
        return $this->db2->affected_rows();
    }

    function getDraftOrderLeadPartPositif($lines) {
        if (empty($lines)) {
            $hasil = $this->db2->select('type_lead_part, line')
                            ->select_sum('qty_wo')
                            ->from('order_lead_part_temp')
                            ->where('jenis_lead_part','Positif')
                            ->where('status','Draft')
                            ->group_by('type_lead_part, line')
                            ->get();
        } else {
            $hasil = $this->db2->select('type_lead_part, line')
                            ->select_sum('qty_wo')
                            ->from('order_lead_part_temp')
                            ->where('jenis_lead_part','Positif')
                            ->where('status','Draft')
                            ->where('line', $lines)
                            ->group_by('type_lead_part, line')
                            ->get();
        }
        // $sql = 'select o.type_lead_part, sum(o.qty_wo) as qty_wo, r.end_stock
        // from order_lead_part_temp o
        // join report_end_stok r ON r.type=o.type_lead_part
        // group by o.type_lead_part, r.end_stock';

        // $hasil = $this->db2->query($sql);
        return $hasil->result();
    }

    function getDraftOrderLeadPartNegatif($lines) {
        if (empty($lines)) {
            $hasil = $this->db2->select('type_lead_part, line')
                            ->select_sum('qty_wo')
                            ->from('order_lead_part_temp')
                            ->where('jenis_lead_part','Negatif')
                            ->where('status','Draft')
                            ->group_by('type_lead_part, line')
                            ->get();
        } else {
            $hasil = $this->db2->select('type_lead_part, line')
                            ->select_sum('qty_wo')
                            ->from('order_lead_part_temp')
                            ->where('jenis_lead_part','Negatif')
                            ->where('status','Draft')
                            ->where('line', $lines)
                            ->group_by('type_lead_part, line')
                            ->get();
        }
        return $hasil->result();
    }

    function getEndStock() {
        return $this->db2->get('report_end_stok')->result_array();
    }

    function getPartNumberPlate() {
        return $this->db2->get('part_number_fgx')->result_array();
    }

    function updateEndStock($data) {
        $this->db2->insert('report_end_stok', $data);
    }

    function saveOrderLeadPart($data) {
        $this->db2->insert('order_lead_part', $data);
    }

    function updateStatusDraftOrderLeadPart($type_lead_part, $data) {
        $this->db2->where('type_lead_part', $type_lead_part);
        $this->db2->update('order_lead_part_temp', $data);
    }

    function getDetailOrder($id_order_lead_part) {
        return $this->db2->get_where('detail_order_lead_part', array('id_order_lead_part' => $id_order_lead_part))->result_array();
    }

    function updateKonfirmasiSupply($id_order_lead_part, $data) {
        $this->db2->where('id_order_lead_part', $id_order_lead_part);
        $this->db2->update('order_lead_part', $data);
    }

    function insertDetailOrderLeadPart($data) {
        $this->db2->insert('detail_order_lead_part', $data);
    }

    function getOrderLeadPart($id_order_lead_part) {
        return $this->db2->get_where('order_lead_part', array('id_order_lead_part' => $id_order_lead_part))->result_array();
    }
    
    function getTypeLeadPart($jenis_lead_part,$param) {
        // return $this->db2->get_where('data_lead_part', array('jenis_lead_part' => $jenis_lead_part))->result_array();

        $this->db2->select('*');
        $this->db2->from('data_lead_part');
        $this->db2->where('jenis_lead_part',$jenis_lead_part);
        if ($param == '') {

        } else {
            $this->db2->like('type_lead_part', $param);
        }
        
        return $this->db2->get()->result_array();
    }

    function getTypeLeadPartById($id_lead_part) {
        return $this->db2->get_where('data_lead_part', array('id_lead_part' => $id_lead_part))->result_array();
    }

    function getQueueSchedule($tanggal_order, $sesi_now) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_order)));

        $this->db2->select('*');
        $this->db2->from('order_lead_part');
        $this->db2->join('data_lead_part', 'data_lead_part.id_lead_part = order_lead_part.id_lead_part');
        $this->db2->where('order_lead_part.tanggal_order >',$tanggal_order.' 05:30:00.000');
        $this->db2->where('order_lead_part.tanggal_order <=',$next_day.' 05:30:00.000');
        $this->db2->where('order_lead_part.sesi', $sesi_now);
        $this->db2->where('order_lead_part.status !=', 'Draft');
        // $this->db2->where('order_lead_part.status', 'Open');
        // $this->db2->or_where('order_lead_part.status', 'Close');
        if ($this->session->userdata('username') == 'forklift_plate_1') {
            // $this->db2->where('order_lead_part.line >=', 1);
            // $this->db2->where('order_lead_part.line <=', 3);
            $this->db2->where("(order_lead_part.line='1' OR order_lead_part.line='2' OR order_lead_part.line='3' OR order_lead_part.line='MCB' OR order_lead_part.line='Formation_c_barat' OR order_lead_part.line='Formation_c_timur')");
        } elseif ($this->session->userdata('username') == 'forklift_plate_2') {
            // $this->db2->where('order_lead_part.line >=', 4);
            // $this->db2->where('order_lead_part.line <=', 7);
            $this->db2->where("(order_lead_part.line='4' OR order_lead_part.line='5' OR order_lead_part.line='6' OR order_lead_part.line='7' OR order_lead_part.line='Formation_f_barat' OR order_lead_part.line='Formation_f_timur')");
        }
        $this->db2->order_by('order_lead_part.id_order_lead_part', 'ASC');
        $this->db2->order_by('order_lead_part.jumlah_order_plan', 'DESC');
        return $this->db2->get()->result_array();
    }

    function getQueueScheduleFormation($tanggal_order, $sesi_now) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_order)));

        $this->db2->select('*');
        $this->db2->from('order_lead_part');
        $this->db2->join('data_lead_part', 'data_lead_part.id_lead_part = order_lead_part.id_lead_part');
        $this->db2->where('order_lead_part.tanggal_order >',$tanggal_order.' 05:30:00.000');
        $this->db2->where('order_lead_part.tanggal_order <=',$next_day.' 05:30:00.000');
        $this->db2->where('order_lead_part.sesi', $sesi_now);
        $this->db2->where('order_lead_part.status !=', 'Draft');
        // $this->db2->where('order_lead_part.status', 'Open');
        // $this->db2->or_where('order_lead_part.status', 'Close');
        if ($this->session->userdata('username') == 'forklift_plate_1' OR $this->session->userdata('username') == 'formation_c') {
            // $this->db2->where('order_lead_part.line >=', 1);
            // $this->db2->where('order_lead_part.line <=', 3);
            $this->db2->where("(order_lead_part.line='FOR_C_BARAT' OR order_lead_part.line='FOR_C_TIMUR')");
        } elseif ($this->session->userdata('username') == 'forklift_plate_2' OR $this->session->userdata('username') == 'formation_c') {
            // $this->db2->where('order_lead_part.line >=', 4);
            // $this->db2->where('order_lead_part.line <=', 7);
            $this->db2->where("(order_lead_part.line='FOR_F_BARAT' OR order_lead_part.line='FOR_F_TIMUR')");
        } else {
            $this->db2->like("order_lead_part.line", "FOR_");
        }
        $this->db2->order_by('order_lead_part.id_order_lead_part', 'ASC');
        $this->db2->order_by('order_lead_part.jumlah_order_plan', 'DESC');
        return $this->db2->get()->result_array();
    }

    function inputDetailOrder($data) {
        $this->db2->insert('detail_order_lead_part', $data);
    }

    function updateKonfirmasi($data, $id_order_lead_part) {
        $this->db2->where('id_order_lead_part', $id_order_lead_part);
        $this->db2->update('order_lead_part', $data);
    }

    function checkQtyBarcode($barc) {
        $hasil = $this->db3->query('SELECT      t$actq AS qty, 
                                                t$note AS barc
                                    FROM        baan.CBI_avinh020720
                                    WHERE       t$note = \''.$barc.'\'
                                    FETCH FIRST 1 ROWS ONLY');
        return $hasil->result_array();
    }

    function checkStatusBarcode($barc) {
        $hasil = $this->db2->query('SELECT      barcode
                                    FROM        detail_order_lead_part dop
                                    JOIN        order_lead_part op ON dop.id_order_lead_part = op.id_order_lead_part
                                    WHERE       barcode = \''.$barc.'\'
                                ');
        if(count($hasil->result_array()) > 0) {
            return 'Barcode sudah digunakan';
        } else {
            return 'Barcode dapat digunakan';
        }
    }

    function check_wh_supply($id_order_lead_part) {
        $hasil = $this->db2->query('SELECT      *
                                    FROM        order_lead_part
                                    WHERE       id_order_lead_part = '.$id_order_lead_part);
        return $hasil->result_array();
    }
}