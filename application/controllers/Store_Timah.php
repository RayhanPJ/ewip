<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Store_timah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Line');
    }

    public function index()
    {
        $datas = $this->M_Line->getData();
        // var_dump($datas);die;

        $uniqueRack = [];
        $uniqueItems = [];
        $totalQtyAktual = [];
        $barcCounts = [];
        $barcFilledCounts = [];
        $barcAllCounts = 0;
        $itemAllCounts = 0;
        $qtyAllCounts = 0;

        foreach ($datas as $v) {
            $locations = $v->locations;
            $itemCode = $v->item;

            // Data locations unique
            if (!in_array($locations, $uniqueRack)) {
                $uniqueRack[] = $locations;
            }

            // Data item unique
            if (!isset($uniqueItems[$locations])) {
                $uniqueItems[$locations] = [];
            }

            if (is_array($itemCode)) {
                // Jika $itemCode adalah array, Anda dapat menambahkan nilai-nilai unik ke dalam $uniqueItems[$locations]
                foreach ($itemCode as $code) {
                    if (!in_array($code, $uniqueItems[$locations], true)) {
                        if ($code !== null && $code !== '') {
                            $uniqueItems[$locations][] = $code;
                        } else {
                            $uniqueItems[$locations][] = null;
                        }
                    }
                }
            } else {
                // Jika $itemCode bukan array, lakukan pengecekan seperti sebelumnya
                if (!in_array($itemCode, $uniqueItems[$locations], true)) {
                    if ($itemCode !== null && $itemCode !== '') {
                        $uniqueItems[$locations][] = $itemCode;
                    } else {
                        $uniqueItems[$locations][] = null;
                    }
                }
            }

            // var_dump($uniqueItems);
            // die;
            // Inisialisasi totalQtyAktual dengan 0 jika belum ada di array
            if (!isset($totalQtyAktual[$locations])) {
                $totalQtyAktual[$locations] = 0;
            }

            // Menambahkan actq ke totalQtyAktual berdasarkan lokasinya
            $totalQtyAktual[$locations] += $v->actq;

            // Menghitung barc yang ada dalam 1 locations
            if (!isset($barcCounts[$locations])) {
                $barcCounts[$locations] = 0;
                $barcFilledCounts[$locations] = 0;
            }

            if ($v->barc !== null && $v->barc !== '') {
                $barcFilledCounts[$locations]++;
            }

            if ($v->barc !== null && $v->barc !== '') {
                $barcCounts[$locations]++;
            }

            // Menghitung barc yang ada pada tiap locations
            if ($v->barc !== null && $v->barc !== '') {
                $barcAllCounts++;
            }

            // Menghitung item yang ada pada tiap locations
            if ($v->item !== null && $v->item !== '') {
                $itemAllCounts++;
            }

            // Menghitung actq yang ada pada tiap locations
            if ($v->actq !== null && $v->actq !== '') {
                $qtyAllCounts += $v->actq;
            }
        }

        // var_dump($barcAllCounts);die;
        // var_dump($uniqueItems);die;

        $barcPercentages = [];
        $totalBarcInLocation = 66; // Total barc dalam 1 locations

        $totalAllBarcInLocation = 1080; // Total barc dalam tiap locations

        // Menghitung persentase barc yang terisi dalam 1 locations
        foreach ($barcCounts as $locations => $count) {
            $barcFilled = $barcFilledCounts[$locations];
            
            if ($locations == 'O1') {
                $percentage = ($barcFilled / 100) * 100;
            } else {
                $percentage = ($barcFilled / $totalBarcInLocation) * 100;
            }
            
            // Lakukan pembulatan ke satu angka desimal
            $roundedPercentage = round($percentage, 1);
            // Ubah ke dalam format string dengan satu angka desimal
            $formattedPercentage = number_format($roundedPercentage, 1);
            $barcPercentages[$locations] = max(0, min(100, $formattedPercentage));
        }

        // Menghitung persentase barc yang terisi dalam tiap locations

        $barcAllFilled = $barcAllCounts;
        $percentageAll = ($barcAllFilled / $totalAllBarcInLocation) * 100;
        // Lakukan pembulatan ke satu angka desimal
        $roundedPercentageAll = round($percentageAll, 1);
        // Ubah ke dalam format string dengan satu angka desimal
        $formattedPercentageAll = number_format($roundedPercentageAll, 1);
        $barcAllPercentages = max(0, min(100, $formattedPercentageAll));


        $fixDatas = [
            'uniqueRack' => $uniqueRack,
            'uniqueItems' => $uniqueItems,
            'totalQtyAktual' => $totalQtyAktual,
            'barcCounts' => $barcCounts,
            'barcPercentages' => $barcPercentages,
        ];

        $totalFullLine = 0;
        $totalEmptyLine = 0;
        $totalNoFullLine = 0;
        foreach ($fixDatas['uniqueRack'] as $rack) {
            if ($fixDatas['barcPercentages'][$rack] >= 1 && $fixDatas['barcPercentages'][$rack] <= 99) {
                $totalNoFullLine++;
            } elseif ($fixDatas['barcPercentages'][$rack] == 100) {
                $totalFullLine++;
            } else {
                $totalEmptyLine++;
            }
        }

        $dataMLine =
            [
                'item' => $fixDatas,
                'barcAllPercentages' => $barcAllPercentages,
                'itemAllCounts' => $itemAllCounts,
                'qtyAllCounts' => $qtyAllCounts,
                'totalFullLine' => $totalFullLine,
                'totalEmptyLine' => $totalEmptyLine,
                'totalNoFullLine' => $totalNoFullLine,
            ];

        $this->load->view('template/header');
        $this->load->view('store_timah/dashboard_store_timah', $dataMLine);
        $this->load->view('template/footer');
    }

    public function listItem($line)
    {
        $datas = $this->M_Line->getData();
        // var_dump($datas);die;
        $datas2 = $this->M_Line->getDataWHFGTimah();
        $getLine = $line;
        $dataMLine = array(
            'item' => $datas,
            'getLine' => $getLine,
            'whfg_timah' => $datas2,
        );
        $this->load->view('template/header');
        $this->load->view('store_timah/list_item_timah', $dataMLine);
        $this->load->view('template/footer');
    }

    public function updateData()
    {
        $id = $this->input->post('id'); // Mengambil nilai ID dari input
        $locations = $this->input->post('locations');
        $barcString = $this->input->post('barc');
        $date = date('Y-m-d H:i:s.u');

        $data = [
            // 'line' => $this->input->post('line'),
            'barc' => $barcString,
            'created_at_storing' => $date,
        ];

        // var_dump($data);die;

        $this->M_Line->update_data('store_timah', $data, $id);
        redirect(base_url('Store_Timah/listItem/' . $locations));
    }

    public function sendListReceipt()
    {
        $id = $this->input->post('id'); // Mengambil nilai ID dari input
        $barcString = $this->input->post('barc');
        $date = date('Y-m-d H:i:s.u');

        $data = [
            // 'line' => $this->input->post('line'),
            'barc' => $barcString,
            'created_at_storing' => $date,
        ];

        $this->M_Line->update_data('store_timah', $data, $id);
        redirect(base_url('Whfg_timah/print_receipt/' . $id));
    }

    public function resetData($id)
    {
        $idData = $id;
        $datasLoc = $this->M_Line->getLocationById($idData);

        $data = [
            'barc' => "",
        ];

        $this->M_Line->update_data('store_timah', $data, $id);
        redirect(base_url('Store_Timah/listItem/' . $datasLoc));
    }
}