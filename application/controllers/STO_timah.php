<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class STO_timah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_STO_Timah');
    }

    public function index()
    {
        $datas = $this->M_STO_Timah->getData();
        $filterItems = [];
        $itemCounts = [];

        foreach ($datas as $v) {
            $items = $v->item;
            $qty = $v->actq;

            if (!isset($filterItems[$items])) {
                // Jika item belum ada dalam array $filterItems, tambahkan sebagai elemen baru
                $filterItems[$items] = $qty;
            } else {
                // Jika item sudah ada dalam array $filterItems, tambahkan quantity ke total yang ada
                $filterItems[$items] += $qty;
            }

            if (isset($itemCounts[$items])) {
                $itemCounts[$items]++;
            } else {
                $itemCounts[$items] = 1;
            }
        }

        $dataMRack =
            [
                'datas' => $datas,
                'summary' => $filterItems,
                'itemCounts' => $itemCounts,
            ];
            
        $this->load->view('template/header');
        $this->load->view('order_timah/sto_timah', $dataMRack);
        $this->load->view('template/footer');
    }

    public function inputData()
    {
        $barcString = implode(',', $this->input->post('barc') ?? []);
        $itemString = implode(',', $this->input->post('item') ?? []);
        $actqString = implode(',', $this->input->post('actq') ?? [0]);
        $created_atString = implode(',', $this->input->post('created_at') ?? []);
        $ponoString = implode(',', $this->input->post('pono') ?? []);
        $ornoString = implode(',', $this->input->post('orno') ?? []);
        $yearString = implode(',', $this->input->post('year') ?? []);
        $cwarfString = implode(',', $this->input->post('cwarf') ?? []);
        $tagnString = implode(',', $this->input->post('tagn') ?? []);
        $dscaString = implode(',', $this->input->post('dsca') ?? []);
        $cuniString = implode(',', $this->input->post('cuni') ?? []);
        $admqString = implode(',', $this->input->post('admq') ?? []);
        $varqString = implode(',', $this->input->post('varq') ?? []);
        $endtString = implode(',', $this->input->post('endt') ?? []);
        $cwartString = implode(',', $this->input->post('cwart') ?? []);
        $apdtString = implode(',', $this->input->post('apdt') ?? []);
        $refcntdString = implode(',', $this->input->post('refcntd') ?? [0]);
        $refcntuString = implode(',', $this->input->post('refcntu') ?? [0]);
        $status_whfg_timahString = implode(',', $this->input->post('status_whfg_timah') ?? [0]);
        $generate_baanString = implode(',', $this->input->post('generate_baan') ?? [0]);
        $users_prodString = implode(',', $this->input->post('users_prod') ?? []);
        $sysqtyString = implode(',', $this->input->post('sysqty') ?? [0]);
        $no_dnString = implode(',', $this->input->post('no_dn') ?? []);
        $qr_codeString = implode(',', $this->input->post('qr_code') ?? []);
        $uniq_codeString = implode(',', $this->input->post('uniq_code') ?? []);
        $code_barcString = implode(',', $this->input->post('code_barc') ?? [0]);

        $data = [
            // 'line' => $this->input->post('line'),
            'barc' => $barcString,
            'item' => $itemString,
            'actq' => $actqString,
            'created_data_at' => $created_atString,
            'pono' => $ponoString,
            'orno' => $ornoString,
            'year' => $yearString,
            'cwarf' => $cwarfString,
            'tagn' => $tagnString,
            'dsca' => $dscaString,
            'cuni' => $cuniString,
            'admq' => $admqString,
            'varq' => $varqString,
            'endt' => $endtString,
            'cwart' => $cwartString,
            'apdt' => $apdtString,
            'refcntd' => $refcntdString,
            'refcntu' => $refcntuString,
            'status_whfg_timah' => $status_whfg_timahString,
            'generate_baan' => $generate_baanString,
            'users_prod' => $users_prodString,
            'sysqty' => $sysqtyString,
            'no_dn' => $no_dnString,
            'qr_code' => $qr_codeString,
            'uniq_code' => $uniq_codeString,
            'code_barc' => $code_barcString,
        ];
        $this->M_STO_Timah->insert_data('sto_timah', $data);
        redirect(base_url('STO_timah/'));
    }
}
