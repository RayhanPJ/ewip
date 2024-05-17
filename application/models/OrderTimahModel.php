<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderTimahModel extends CI_Model {
    public function __construct(){
		parent::__construct();
        $this->db2 = $this->load->database('dbsqlsrv', TRUE);

	}

    function getSubseksi() {
        return $this->db2->get('data_subseksi')->result_array();
    }

    function getPartNumber($id_subseksi) {
        $this->db2->select('*');
        $this->db2->from('data_jenis_ingot');
        $this->db2->where('id_subseksi', $id_subseksi);
        $this->db2->where('ingot_number !=', 'SM-LEAL-SB17');
        return $this->db2->get()->result_array();
    }

    function saveInputOrder($data) {
        $this->db2->insert('order_timah', $data);
    }

    function getSchedule($id_part, $tanggal_order, $sesi) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_order)));

        // $this->db2->select('*');
        $this->db2->select_sum('jumlah_order_plan');
        $this->db2->select_sum('jumlah_order_actual');
        $this->db2->from('order_timah');
        $this->db2->where('id_part', $id_part);
        $this->db2->where('tanggal_order >',$tanggal_order.' 05:30:00.000');
        $this->db2->where('tanggal_order <=',$next_day.' 05:30:00.000');
        $this->db2->where('sesi', $sesi);
        return $this->db2->get()->result_array();
    }

    function getListOrder($tanggal_order) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_order)));
        $this->db2->select('*');
        $this->db2->from('order_timah');
        $this->db2->join('data_subseksi', 'data_subseksi.id_subseksi = order_timah.id_subseksi');
        $this->db2->join('data_jenis_ingot', 'data_jenis_ingot.id_part = order_timah.id_part');
        $this->db2->where('order_timah.tanggal_order >',$tanggal_order.' 05:30:00.000');
        $this->db2->where('order_timah.tanggal_order <=',$next_day.' 05:30:00.000');
        if ($this->session->userdata('level') == 6 and $this->session->userdata('seksi') != null OR $this->session->userdata('level') == 8 and $this->session->userdata('seksi') != null) {
            $this->db2->where('data_subseksi.id_subseksi',$this->session->userdata('seksi'));
        }
        // $this->db2->order_by('order_timah.created_at', 'DESC');
        $this->db2->order_by('order_timah.id_order', 'DESC');
        $this->db2->order_by('order_timah.jumlah_order_plan', 'ASC');
        return $this->db2->get()->result_array();
    }

    function getQueueSchedule($tanggal_order, $sesi_now) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_order)));

        $this->db2->select('*');
        $this->db2->from('order_timah');
        $this->db2->join('data_subseksi', 'data_subseksi.id_subseksi = order_timah.id_subseksi');
        $this->db2->join('data_jenis_ingot', 'data_jenis_ingot.id_part = order_timah.id_part');
        $this->db2->where('order_timah.tanggal_order >',$tanggal_order.' 05:30:00.000');
        $this->db2->where('order_timah.tanggal_order <=',$next_day.' 05:30:00.000');
        $this->db2->where('order_timah.sesi', $sesi_now);
        // if ($this->session->userdata('level') == 6 and $this->session->userdata('seksi') != null) {
        //     $this->db2->where('data_subseksi.id_subseksi',$this->session->userdata('seksi'));
        // }
        // $this->db2->order_by('order_timah.created_at', 'ASC');
        $this->db2->order_by('order_timah.id_order', 'ASC');
        $this->db2->order_by('order_timah.jumlah_order_plan', 'DESC');
        return $this->db2->get()->result_array();
    }

    function getListOrderById($id_order) {
        $this->db2->select('*');
        $this->db2->from('order_timah');
        $this->db2->join('data_subseksi', 'data_subseksi.id_subseksi = order_timah.id_subseksi');
        $this->db2->join('data_jenis_ingot', 'data_jenis_ingot.id_part = order_timah.id_part');
        $this->db2->where('order_timah.id_order',$id_order);
        return $this->db2->get()->result_array();
    }

    function deleteOrder($id_order) {
        $this->db2->where('id_order', $id_order);
        $this->db2->delete('order_timah');
    }

    function saveEditOrder($data, $id_order) {
        $this->db2->where('id_order', $id_order);
        $this->db2->update('order_timah', $data);
    }

    function updateKonfirmasi($data, $id_order) {
        $this->db2->where('id_order', $id_order);
        $this->db2->update('order_timah', $data);
    }

    function updateSupply($data, $id_order) {
        $this->db2->where('id_order', $id_order);
        $this->db2->update('order_timah', $data);
    }

    function inputDetailOrder($data) {
        $this->db2->insert('detail_order_timah', $data);
    }

    function getDetailOrder($id_order) {
        return $this->db2->get_where('detail_order_timah', array('id_order' => $id_order))->result_array();
    }

    function checkQtyBarcode($barc) {
        $this->db2->select('actq,barc');
        $this->db2->from('data_whfg_timah');
        $this->db2->where('barc', $barc);
        return $this->db2->get()->result_array();
    }

    function checkQtyByCode($year, $peri, $code_barc) {
        $this->db2->select('actq,barc');
        $this->db2->from('data_whfg_timah');
        $this->db2->where('year', $year);
        $this->db2->where('peri', $peri);
        $this->db2->where('code_barc', $code_barc);
        return $this->db2->get()->result_array();
    }

    function checkDetailBarcode($barc) {
        return $this->db2->get_where('data_whfg_timah', array('barc' => $barc))->result_array();
    }
}