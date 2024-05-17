<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderPlateModel extends CI_Model {
    public function __construct(){
		parent::__construct();
        $this->db2 = $this->load->database('dbsqlsrv', TRUE);
        $this->db3 = $this->load->database('baan', TRUE);
        
	}

    function getListWo($line) {
        $like = "'"."%KAS%"."'";

        if ($line == null) {
            $hasil = $this->db3->query('SELECT      t$pdno AS no_wo, 
                                                t$mitm AS part_number, 
                                                t$qrdr AS lot_qty,
                                                t$prcd AS line
                                    FROM        baan.ttisfc001720 
                                    WHERE       t$pdno 
                                    LIKE        '.$like.'
                                    AND         t$osta = 5 
                                    ORDER BY    t$prcd ASC, t$pdno ASC');
        } else {
            $hasil = $this->db3->query('SELECT      t$pdno AS no_wo, 
                                                t$mitm AS part_number, 
                                                t$qrdr AS lot_qty,
                                                t$prcd AS line
                                    FROM        baan.ttisfc001720
                                    WHERE       t$pdno 
                                    LIKE        '.$like.'
                                    AND         t$osta = 5 
                                    AND         t$prcd = '.$line.'
                                    ORDER BY    t$prcd ASC, t$pdno ASC');
        }
        
        return $hasil->result_array();
    }

    function getListOrder($date) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($date)));

        // return $this->db2->select('*')
        //                 ->from('order_plate')
        //                 ->where('tanggal_order >=',$date.' 07:30:00.000')
        //                 ->where('tanggal_order <',$next_day.' 07:30:00.000')
        //                 ->order_by('id_order_plate', 'ASC')
        //                 ->get()->result_array();

        if ($this->session->userdata('username') == 'forklift_plate_1' or $this->session->userdata('username') == 'amb_1') {
            return $this->db2->select('*')
                        ->from('order_plate')
                        ->join('data_plate', 'data_plate.id_plate = order_plate.id_plate')
                        ->where('order_plate.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_plate.tanggal_order <',$next_day.' 07:00:00.000')
                        // ->where('order_plate.line >=', 1)
                        // ->where('order_plate.line <=', 3)
                        ->where("(order_plate.line='1' OR order_plate.line='2' OR order_plate.line='3' OR order_plate.line='MCB')")
                        ->order_by('order_plate.tanggal_order ASC', 'order_plate.status ASC')
                        ->get()->result_array();
        } elseif ($this->session->userdata('username') == 'forklift_plate_2' or $this->session->userdata('username') == 'amb_2' or $this->session->userdata('username') == 'assy_g') {
            return $this->db2->select('*')
                        ->from('order_plate')
                        ->join('data_plate', 'data_plate.id_plate = order_plate.id_plate')
                        ->where('order_plate.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_plate.tanggal_order <',$next_day.' 07:00:00.000')
                        // ->where('order_plate.line >=', 4)
                        // ->where('order_plate.line <=', 7)
                        ->where("(order_plate.line='4' OR order_plate.line='5' OR order_plate.line='6' OR order_plate.line='7')")
                        ->order_by('order_plate.tanggal_order ASC', 'order_plate.status ASC')
                        ->get()->result_array();
        } else {
            return $this->db2->select('*')
                        ->from('order_plate')
                        ->join('data_plate', 'data_plate.id_plate = order_plate.id_plate')
                        ->where('order_plate.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_plate.tanggal_order <',$next_day.' 07:00:00.000')
                        ->order_by('order_plate.status ASC', 'order_plate.tanggal_order ASC')
                        ->get()->result_array();
        }
    }

    function getListOrderPlateById($id_order_plate) {
        $this->db2->select('*');
        $this->db2->from('order_plate');
        $this->db2->join('data_plate', 'data_plate.id_plate = order_plate.id_plate');
        $this->db2->where('order_plate.id_order_plate',$id_order_plate);

        return $this->db2->get()->result_array();
    }

    function getListPartNumber($part_number) {
        return $this->db2->get_where('part_number_fgx', array('part_number' => $part_number))->result_array();
    }

    function saveDraftOrderPlate($data) {
        $this->db2->insert('order_plate_temp', $data);
    }

    function deleteDraftOrderPlate($no_wo) {
        $this->db2->where('no_wo', $no_wo);
        $this->db2->delete('order_plate_temp');
    }

    function deleteOrderPlate($id_order_plate) {
        $this->db2->where('id_order_plate', $id_order_plate);
        $this->db2->delete('order_plate');
        return $this->db2->affected_rows();
    }

    function getDraftOrderPlatePositif($lines) {
        if (empty($lines)) {
            $hasil = $this->db2->select('type_plate, line')
                            ->select_sum('qty_wo')
                            ->from('order_plate_temp')
                            ->where('jenis_plate','Positif')
                            ->where('status','Draft')
                            ->group_by('type_plate, line')
                            ->get();
        } else {
            $hasil = $this->db2->select('type_plate, line')
                            ->select_sum('qty_wo')
                            ->from('order_plate_temp')
                            ->where('jenis_plate','Positif')
                            ->where('status','Draft')
                            ->where('line', $lines)
                            ->group_by('type_plate, line')
                            ->get();
        }
        // $sql = 'select o.type_plate, sum(o.qty_wo) as qty_wo, r.end_stock
        // from order_plate_temp o
        // join report_end_stok r ON r.type=o.type_plate
        // group by o.type_plate, r.end_stock';

        // $hasil = $this->db2->query($sql);
        return $hasil->result();
    }

    function getDraftOrderPlateNegatif($lines) {
        if (empty($lines)) {
            $hasil = $this->db2->select('type_plate, line')
                            ->select_sum('qty_wo')
                            ->from('order_plate_temp')
                            ->where('jenis_plate','Negatif')
                            ->where('status','Draft')
                            ->group_by('type_plate, line')
                            ->get();
        } else {
            $hasil = $this->db2->select('type_plate, line')
                            ->select_sum('qty_wo')
                            ->from('order_plate_temp')
                            ->where('jenis_plate','Negatif')
                            ->where('status','Draft')
                            ->where('line', $lines)
                            ->group_by('type_plate, line')
                            ->get();
        }
        return $hasil->result();
    }

    function getCheckDraft($no_wo, $type_plate) {
        return $this->db2->get_where('order_plate_temp', array('no_wo' => $no_wo, 'type_plate' => $type_plate))->num_rows();
    }

    function getCheckDraftOrder($no_wo, $type_plate) {
        return $this->db2->get_where('order_plate_temp', array('no_wo' => $no_wo, 'type_plate' => $type_plate, 'status' => 'Order'))->num_rows();
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

    function saveOrderPlate($data) {
        $this->db2->insert('order_plate', $data);
    }

    function updateStatusDraftOrderPlate($type_plate, $data) {
        $this->db2->where('type_plate', $type_plate);
        $this->db2->update('order_plate_temp', $data);
    }

    function getDetailOrder($id_order_plate) {
        return $this->db2->get_where('detail_order_plate', array('id_order_plate' => $id_order_plate))->result_array();
    }

    function updateKonfirmasiSupply($id_order_plate, $data) {
        $this->db2->where('id_order_plate', $id_order_plate);
        $this->db2->update('order_plate', $data);
    }

    function insertDetailOrderPlate($data) {
        $this->db2->insert('detail_order_plate', $data);
    }

    function getOrderPlate($id_order_plate) {
        return $this->db2->get_where('order_plate', array('id_order_plate' => $id_order_plate))->result_array();
    }
    
    function getTypePlate($jenis_plate,$param) {
        // return $this->db2->get_where('data_plate', array('jenis_plate' => $jenis_plate))->result_array();

        $this->db2->select('*');
        $this->db2->from('data_plate');
        $this->db2->where('jenis_plate',$jenis_plate);
        if ($param == '') {

        } else {
            $this->db2->like('type_plate', $param);
        }
        
        return $this->db2->get()->result_array();
    }

    function getTypePlateById($id_plate) {
        return $this->db2->get_where('data_plate', array('id_plate' => $id_plate))->result_array();
    }

    function getQueueSchedule($tanggal_order, $sesi_now) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_order)));

        $this->db2->select('*');
        $this->db2->from('order_plate');
        $this->db2->join('data_plate', 'data_plate.id_plate = order_plate.id_plate');
        $this->db2->where('order_plate.tanggal_order >',$tanggal_order.' 05:30:00.000');
        $this->db2->where('order_plate.tanggal_order <=',$next_day.' 05:30:00.000');
        $this->db2->where('order_plate.sesi', $sesi_now);
        $this->db2->where('order_plate.status !=', 'Draft');
        // $this->db2->where('order_plate.status', 'Open');
        // $this->db2->or_where('order_plate.status', 'Close');
        if ($this->session->userdata('username') == 'forklift_plate_1') {
            // $this->db2->where('order_plate.line >=', 1);
            // $this->db2->where('order_plate.line <=', 3);
            $this->db2->where("(order_plate.line='1' OR order_plate.line='2' OR order_plate.line='3' OR order_plate.line='MCB' OR order_plate.line='Formation_c_barat' OR order_plate.line='Formation_c_timur')");
        } elseif ($this->session->userdata('username') == 'forklift_plate_2') {
            // $this->db2->where('order_plate.line >=', 4);
            // $this->db2->where('order_plate.line <=', 7);
            $this->db2->where("(order_plate.line='4' OR order_plate.line='5' OR order_plate.line='6' OR order_plate.line='7' OR order_plate.line='Formation_f_barat' OR order_plate.line='Formation_f_timur')");
        }
        $this->db2->order_by('order_plate.id_order_plate', 'ASC');
        $this->db2->order_by('order_plate.jumlah_order_plan', 'DESC');
        return $this->db2->get()->result_array();
    }

    function getQueueScheduleFormation($tanggal_order, $sesi_now) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_order)));

        $this->db2->select('*');
        $this->db2->from('order_plate');
        $this->db2->join('data_plate', 'data_plate.id_plate = order_plate.id_plate');
        $this->db2->where('order_plate.tanggal_order >',$tanggal_order.' 05:30:00.000');
        $this->db2->where('order_plate.tanggal_order <=',$next_day.' 05:30:00.000');
        $this->db2->where('order_plate.sesi', $sesi_now);
        $this->db2->where('order_plate.status !=', 'Draft');
        // $this->db2->where('order_plate.status', 'Open');
        // $this->db2->or_where('order_plate.status', 'Close');
        if ($this->session->userdata('username') == 'forklift_plate_1' OR $this->session->userdata('username') == 'formation_c') {
            // $this->db2->where('order_plate.line >=', 1);
            // $this->db2->where('order_plate.line <=', 3);
            $this->db2->where("(order_plate.line='FOR_C_BARAT' OR order_plate.line='FOR_C_TIMUR')");
        } elseif ($this->session->userdata('username') == 'forklift_plate_2' OR $this->session->userdata('username') == 'formation_c') {
            // $this->db2->where('order_plate.line >=', 4);
            // $this->db2->where('order_plate.line <=', 7);
            $this->db2->where("(order_plate.line='FOR_F_BARAT' OR order_plate.line='FOR_F_TIMUR')");
        } else {
            $this->db2->like("order_plate.line", "FOR_");
        }
        $this->db2->order_by('order_plate.id_order_plate', 'ASC');
        $this->db2->order_by('order_plate.jumlah_order_plan', 'DESC');
        return $this->db2->get()->result_array();
    }

    function inputDetailOrder($data) {
        $this->db2->insert('detail_order_plate', $data);
    }

    function updateKonfirmasi($data, $id_order_plate) {
        $this->db2->where('id_order_plate', $id_order_plate);
        $this->db2->update('order_plate', $data);
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
                                    FROM        detail_order_plate dop
                                    JOIN        order_plate op ON dop.id_order_plate = op.id_order_plate
                                    WHERE       barcode = \''.$barc.'\'
                                ');
        if(count($hasil->result_array()) > 0) {
            return 'Barcode sudah digunakan';
        } else {
            return 'Barcode dapat digunakan';
        }
    }

    function check_wh_supply($id_order_plate) {
        $hasil = $this->db2->query('SELECT      *
                                    FROM        order_plate
                                    WHERE       id_order_plate = '.$id_order_plate);
        return $hasil->result_array();
    }
}