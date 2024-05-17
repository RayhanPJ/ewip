<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Master_store_timah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Line');
    }

    public function index()
    {
        $datas = $this->M_Line->getData();
        $dataMLine =
            [
                'item' => $datas
            ];

        $this->load->view('template/header');
        $this->load->view('master_store_timah/form_master_store_timah', $dataMLine);
        $this->load->view('template/footer');
    }

    public function deleteData($id)
    {
        // Panggil fungsi deleteById dari model
        $this->M_Line->deleteById($id);
        redirect(base_url('Master_store_timah/'));
    }

    public function inputLineData()
    {
        $data = $this->input->post('line') ?? [];
        $locations = $this->input->post('locations') ?? [];
        $number_items = $this->input->post('number_items') ?? [];

        $insert_data = [];
        for ($i = 0; $i < count($data); $i++) {
            $insert_data[] = [
                'line' => $data[$i],
                'locations' => $locations[$i],
                'sub_locations' => $number_items[$i],
            ];
        }

        // Gunakan metode insert_batch() untuk melakukan multiple insert
        $this->db->insert_batch('store_timah', $insert_data);
        redirect(base_url('Master_store_timah/'));
    }
}