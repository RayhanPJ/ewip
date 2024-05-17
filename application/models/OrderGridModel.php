<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderGridModel extends CI_Model {
    public function __construct(){
		parent::__construct();
        $this->db2 = $this->load->database('dbsqlsrv', TRUE);
        $this->db3 = $this->load->database('baan', TRUE);
        
	}

    function getListOrder($date) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($date)));

        if ($this->session->userdata('username') == 'forklift_plate_1' or $this->session->userdata('username') == 'pasting_b') {
            return $this->db2->select('*')
                        ->from('order_grid')
                        ->where('order_grid.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_grid.tanggal_order <',$next_day.' 07:00:00.000')
                        ->where("order_grid.line='C'")
                        ->order_by('order_grid.tanggal_order ASC', 'order_grid.status ASC')
                        ->get()->result_array();
        } elseif ($this->session->userdata('username') == 'forklift_plate_2' or $this->session->userdata('username') == 'pasting_e') {
            return $this->db2->select('*')
                        ->from('order_grid')
                        ->where('order_grid.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_grid.tanggal_order <',$next_day.' 07:00:00.000')
                        ->where("order_grid.line='E'")
                        ->order_by('order_grid.tanggal_order ASC', 'order_grid.status ASC')
                        ->get()->result_array();
        } else {
            return $this->db2->select('*')
                        ->from('order_grid')
                        ->where('order_grid.tanggal_order >=',$date.' 07:00:00.000')
                        ->where('order_grid.tanggal_order <',$next_day.' 07:00:00.000')
                        ->order_by('order_grid.status ASC', 'order_grid.tanggal_order ASC')
                        ->get()->result_array();
        }
    }

    function getListOrderGridById($id_order_grid) {
        $this->db2->select('*');
        $this->db2->from('order_grid');
        $this->db2->where('order_grid.id_order_grid',$id_order_grid);

        return $this->db2->get()->result_array();
    }

    function getListPartNumber($part_number) {
        return $this->db2->get_where('part_number_fgx', array('part_number' => $part_number))->result_array();
    }

    function saveDraftOrderGrid($data) {
        $this->db2->insert('order_grid_temp', $data);
    }

    function deleteDraftOrderGrid($no_wo) {
        $this->db2->where('no_wo', $no_wo);
        $this->db2->delete('order_grid_temp');
    }

    function deleteOrderGrid($id_order_grid) {
        $this->db2->where('id_order_grid', $id_order_grid);
        $this->db2->delete('order_grid');
        return $this->db2->affected_rows();
    }

    function getDraftOrderGridPositif($lines) {
        if (empty($lines)) {
            $hasil = $this->db2->select('type_plate, line')
                            ->select_sum('qty_wo')
                            ->from('order_grid_temp')
                            ->where('jenis_plate','Positif')
                            ->where('status','Draft')
                            ->group_by('type_plate, line')
                            ->get();
        } else {
            $hasil = $this->db2->select('type_plate, line')
                            ->select_sum('qty_wo')
                            ->from('order_grid_temp')
                            ->where('jenis_plate','Positif')
                            ->where('status','Draft')
                            ->where('line', $lines)
                            ->group_by('type_plate, line')
                            ->get();
        }
        // $sql = 'select o.type_plate, sum(o.qty_wo) as qty_wo, r.end_stock
        // from order_grid_temp o
        // join report_end_stok r ON r.type=o.type_plate
        // group by o.type_plate, r.end_stock';

        // $hasil = $this->db2->query($sql);
        return $hasil->result();
    }

    function getDraftOrderGridNegatif($lines) {
        if (empty($lines)) {
            $hasil = $this->db2->select('type_plate, line')
                            ->select_sum('qty_wo')
                            ->from('order_grid_temp')
                            ->where('jenis_plate','Negatif')
                            ->where('status','Draft')
                            ->group_by('type_plate, line')
                            ->get();
        } else {
            $hasil = $this->db2->select('type_plate, line')
                            ->select_sum('qty_wo')
                            ->from('order_grid_temp')
                            ->where('jenis_plate','Negatif')
                            ->where('status','Draft')
                            ->where('line', $lines)
                            ->group_by('type_plate, line')
                            ->get();
        }
        return $hasil->result();
    }

    function getCheckDraft($no_wo, $type_plate) {
        return $this->db2->get_where('order_grid_temp', array('no_wo' => $no_wo, 'type_plate' => $type_plate))->num_rows();
    }

    function getCheckDraftOrder($no_wo, $type_plate) {
        return $this->db2->get_where('order_grid_temp', array('no_wo' => $no_wo, 'type_plate' => $type_plate, 'status' => 'Order'))->num_rows();
    }

    function getEndStock() {
        return $this->db2->get('report_end_stok')->result_array();
    }

    function getPartNumberGrid() {
        return $this->db2->get('part_number_fgx')->result_array();
    }

    function updateEndStock($data) {
        $this->db2->insert('report_end_stok', $data);
    }

    function saveOrderGrid($data) {
        $this->db2->insert('order_grid', $data);
    }

    function updateStatusDraftOrderGrid($type_plate, $data) {
        $this->db2->where('type_plate', $type_plate);
        $this->db2->update('order_grid_temp', $data);
    }

    function getDetailOrder($id_order_grid) {
        return $this->db2->get_where('detail_order_grid', array('id_order_grid' => $id_order_grid))->result_array();
    }

    function updateKonfirmasiSupply($id_order_grid, $data) {
        $this->db2->where('id_order_grid', $id_order_grid);
        $this->db2->update('order_grid', $data);
    }

    function insertDetailOrderGrid($data) {
        $this->db2->insert('detail_order_grid', $data);
    }

    function getOrderGrid($id_order_grid) {
        return $this->db2->get_where('order_grid', array('id_order_grid' => $id_order_grid))->result_array();
    }
    
    function getTypeGrid($jenis_plate,$param) {
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

    function getTypeGridByType($type_grid) {
        return $this->db2->get_where('data_grid', array('type_grid' => $type_grid))->result_array();
    }

    function getQueueSchedule($tanggal_order, $sesi_now) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_order)));

        $this->db2->select('*');
        $this->db2->from('order_grid');
        $this->db2->where('order_grid.tanggal_order >',$tanggal_order.' 05:30:00.000');
        $this->db2->where('order_grid.tanggal_order <=',$next_day.' 05:30:00.000');
        $this->db2->where('order_grid.sesi', $sesi_now);
        $this->db2->where('order_grid.status !=', 'Draft');
        if ($this->session->userdata('username') == 'forklift_plate_1') {
            $this->db2->where("(order_grid.line='Pasting B (Mesin 2)' OR order_grid.line='Pasting B (Mesin 3)')");
        } elseif ($this->session->userdata('username') == 'forklift_plate_2') {
            $this->db2->where("(order_grid.line='Pasting E (Mesin 3)' OR order_grid.line='Pasting E (Mesin 4)' OR order_grid.line='Pasting E (Mesin 5)')");
        }
        $this->db2->order_by('order_grid.id_order_grid', 'ASC');
        $this->db2->order_by('order_grid.jumlah_order_plan', 'DESC');
        return $this->db2->get()->result_array();
    }

    function inputDetailOrder($data) {
        $this->db2->insert('detail_order_grid', $data);
    }

    function updateKonfirmasi($data, $id_order_grid) {
        $this->db2->where('id_order_grid', $id_order_grid);
        $this->db2->update('order_grid', $data);
    }

    function checkQtyBarcode($barc) {
        $hasil = $this->db3->query('SELECT      t$actq AS qty, 
                                                t$note AS barc
                                    FROM        baan.CBI_avinh020720
                                    WHERE       t$note = \''.$barc.'\'
                                    FETCH FIRST 1 ROWS ONLY');
        return $hasil->result_array();
    }

    function dataGrid()
    {
        $this->db2->select('*');
        $this->db2->from('data_grid');
        $this->db2->order_by('id_grid', 'ASC');
        return $this->db2->get()->result_array();
    }
}