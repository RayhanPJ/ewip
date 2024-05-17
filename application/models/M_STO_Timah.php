<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_STO_Timah extends CI_Model
{

    public function getData()
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $query = $db2->select('*')->from('sto_timah')->order_by('created_data_at', 'DESC')->get();
        $result = $query->result();
        return $result;
    }

    public function insert_data($tabel, $data)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $db2->insert($tabel, $data);
        return TRUE;
    }
}


/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */
