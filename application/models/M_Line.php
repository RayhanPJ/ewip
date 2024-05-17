<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Line extends CI_Model
{

    public function getData()
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);

        // Define the join condition
        $db2->join('data_whfg_timah', 'store_timah.barc = data_whfg_timah.barc', 'left');
        // $db2->where('data_whfg_timah.actq !=', 0);

        // Order by store_timah.line in ascending order
        $db2->order_by('data_whfg_timah.created_at', 'DESC');

        // Get data from the store_timah table
        $query = $db2->get('store_timah');

        // Return the result
        return $query->result();
    }


    public function getDataWHFGTimah()
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $db2->select('*');
        $db2->from('data_whfg_timah');
        $db2->order_by('created_at', 'DESC');
        $db2->limit(3000); // Adding limit to retrieve only the top 1 record
        $query = $db2->get();
        return $query->result();

    }


    public function getDataById($barc)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);

        $query = $db2->from('store_timah')
            ->join('data_whfg_timah', 'store_timah.barc = data_whfg_timah.barc', 'left')
            ->where('store_timah.barc', $barc) // Make sure to specify the table name in the where clause
            ->order_by('store_timah.id', 'ASC')
            ->get();

        $result = $query->result();
        return $result;
    }
    public function getLocationById($id)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);

        $query = $db2->select('locations')
            ->from('store_timah')
            ->where('id', $id)
            ->get();

        if ($query->num_rows() > 0) {
            return $query->row()->locations;
        } else {
            return null;
        }
    }

    public function insert_data($tabel, $data)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $db2->insert($tabel, $data);
        return TRUE;
    }

    public function insert_batch($tabel, $data)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $db2->insert($tabel, $data);
        return TRUE;
    }


    public function update_data($table, $data, $id)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $db2->where('id', $id); // Menambahkan kondisi where berdasarkan ID
        $db2->update($table, $data);
        return TRUE;
    }

    public function update_data_by_barcode($table, $data, $barc)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $db2->where('barc', $barc); // Menambahkan kondisi where berdasarkan ID
        $db2->update($table, $data);
        return TRUE;
    }

    public function deleteById($id)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        return $db2->delete('store_timah', array('id' => $id));
    }

    public function getLastData()
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $db2->select('*');
        $db2->from('store_timah');
        $db2->order_by('created_at_storing', 'DESC');
        $db2->limit(1); // Adding limit to retrieve only the top 1 record
        $query = $db2->get();

        // Return the result
        return $query->result_array();
    }
}


/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */