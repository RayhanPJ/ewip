<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_AndonForklift extends CI_Model {
    public function __construct(){
		parent::__construct();
        $this->db2 = $this->load->database('dbsqlsrv', TRUE);
	}

    function getQueueScheduleAndonForklift($tanggal_andon, $shift) {
        $next_day = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_andon)));

        $this->db2->select('*');
        $this->db2->from('data_andon_forklift');
        $this->db2->where('data_andon_forklift.tanggal_andon >',$tanggal_andon.' 07:30:00.000');
        $this->db2->where('data_andon_forklift.tanggal_andon <=',$next_day.' 07:30:00.000');
        $this->db2->where('data_andon_forklift.shift', $shift);
        if($this->session->userdata('departemen') == 'forklift_prod1')
          $this->db2->where('data_andon_forklift.departement', 'Production 1');
        else if($this->session->userdata('departemen') == 'forklift_prod2')
          $this->db2->where('data_andon_forklift.departement', 'Production 2');
        $this->db2->order_by('data_andon_forklift.created_at', 'ASC');
        return $this->db2->get()->result_array();
    }

    public function update_andon_forklift($id_andon_forklift, $data)
    {
      if($id_andon_forklift != '') {
          $this->db2->where('id_andon_forklift', $id_andon_forklift);
          $this->db2->update('data_andon_forklift', $data);
          return $id_andon_forklift;
        } else {
          $this->db2->insert('data_andon_forklift', $data);
          return $this->db2->insertID();
        }
    }
}