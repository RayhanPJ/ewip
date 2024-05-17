<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Order_lead_part extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('OrderLeadPartModel');
        // $this->load->model('HomeModel');

        if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '8' OR $this->session->userdata('level') == '9' OR $this->session->userdata('level') == '6') {
			echo "";
		} else {
			redirect('login','refresh');			
		}

		$this->output->delete_cache();
        $data = [];
    }

    public function index()
    {
        $this->list_wo();
    }

    public function list_line()
    {        
        $this->load->view('template/header');
        $this->load->view('order_lead_part/list_line');
        $this->load->view('template/footer');
    }

    public function list_wo($lines = null)
    {
        $line = $lines ;

        $data['data'] = $this->OrderLeadPartModel->getListWO($line);
        $data['line'] = $line;
        
        $this->load->view('template/header');
        $this->load->view('order_lead_part/list_wo',$data);
        $this->load->view('template/footer');
    }

    public function saveDraftOrderLeadPart()
    {
        $data = [
            "line" => $this->input->post('line'),
            "no_wo" => $this->input->post('no_wo'),
            "part_number" => $this->input->post('part_number'),
            "jenis_lead_part" => $this->input->post('jenis_lead_part'),
            "type_lead_part" => $this->input->post('type_lead_part'),
            "qty_wo" => $this->input->post('qty_wo'),
            "status" => 'Draft'
        ];

        $this->OrderLeadPartModel->saveDraftOrderLeadPart($data);

        echo json_encode($data);
    }

    public function deleteDraftOrderLeadPart()
    {
        $no_wo = $this->input->post('no_wo');
        $data = [
            "Message" =>"Success"
        ];

        $this->OrderLeadPartModel->deleteDraftOrderLeadPart($no_wo);

        echo json_encode($data);
    }

    public function list_order($dates = null)
    {
        $date = ($dates == null) ? date('Y-m-d') : $dates ;

        $data['data'] = $this->OrderLeadPartModel->getListOrder($date);
        $data['date'] = $date;

        // var_dump($data); die();
        
        $this->load->view('template/header');
        $this->load->view('order_lead_part/list_order_lead_part',$data);
        $this->load->view('template/footer');
    }

    // public function draftOrderLeadPartPositif($lines = null)
    // {
    //     $data = $this->OrderLeadPartModel->getDraftOrderLeadPartPositif($lines);

    //     echo json_encode($data);
    // }

    // public function draftOrderLeadPartNegatif($lines = null)
    // {
    //     $data = $this->OrderLeadPartModel->getDraftOrderLeadPartNegatif($lines);

    //     echo json_encode($data);
    // }

    // public function menu_report()
    // {
    //     $data['data'] = $this->OrderLeadPartModel->getEndStock();
    //     // $data['type'] = $this->OrderLeadPartModel->getPartNumberLeadPart();

    //     $this->load->view('template/header');
    //     $this->load->view('order_lead_part/report_end_stock', $data);
    //     $this->load->view('template/footer');
    // }

    // public function update_stock()
    // {
    //     $data = $this->OrderLeadPartModel->getListWO();
    //     $arrPartNumberLeadPart = [];
    //     foreach ($data as $d) {
    //         $part_number = $this->OrderLeadPartModel->getListPartNumber(trim($d['PART_NUMBER']));
    //         foreach ($part_number as $pn) {
    //             array_push($arrPartNumberLeadPart, $pn['pn_plate']);
    //         }
    //     }

    //     $pn_plate['pn_plate'] = array_values(array_unique($arrPartNumberLeadPart));

    //     $this->load->view('template/header');
    //     $this->load->view('order_lead_part/update_stock', $pn_plate);
    //     $this->load->view('template/footer');
    // }

    // public function updateEndStock()
    // {
    //     $type = $this->input->post('type_lead_part');
    //     $qty_cutting = $this->input->post('qty_cutting');
    //     $reject = $this->input->post('reject');
    //     $end_stock = (int)$qty_cutting - (int)$reject;
    //     $tanggal = $this->input->post('tanggal');
    //     $shift = $this->input->post('shift');

    //     $data = [
    //         "type" => $type,
    //         "qty_cutting" => $qty_cutting,
    //         "reject" => $reject,
    //         "end_stock" => $end_stock,
    //         "tanggal" => $tanggal,
    //         "shift" => $shift
    //     ];

    //     $this->OrderLeadPartModel->updateEndStock($data);
    //     redirect('order_lead_part/menu_report');
    // }

    // public function saveOrderLeadPartPositif()
    // {
    //     $line_plate_positif = $this->input->post('line_plate_positif');
    //     $type_lead_part_positif = $this->input->post('type_lead_part_positif');
    //     $tanggal_order = date('Y-m-d H:i:s');
    //     $jumlah_order_plan = $this->input->post('qty_order_positif');
    //     $qty_per_basket = $this->input->post('qty_per_basket');
    //     $jumlah_box = $this->input->post('basket_order_positif');

    //     $sisa_positif_after = $this->input->post('sisa_positif_after');
    //     $sisa_positif_before = $this->input->post('sisa_positif_before');

    //     // CEK SESI
    //     // $tanggal = date('Y-m-d');
    //     // $nextTanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
    //     // $allDates= array (
    //     //     $tanggal.' 07:30',
    //     //     $tanggal.' 16:30',
    //     //     $nextTanggal.' 00:00',
    //     // );
        
    //     // function date_sort($a, $b) {
    //     //         return strtotime($a) - strtotime($b);
    //     // }
        
    //     // usort($allDates, "date_sort");
        
    //     // foreach ($allDates as $count => $dateSingle) {
    //     //     if (strtotime($tanggal_order) < strtotime($dateSingle))  {
    //     //         $nextDate = date('d-m-Y H:i', strtotime($dateSingle));
    //     //         break;
    //     //     }
    //     // }

    //     // $a = '2022-10-07 23:15';

    //     $jam_sesi = date("H:i",strtotime($tanggal_order));

    //     if ($jam_sesi >= '07:30' && $jam_sesi <= '16:30') {
    //         $sesi = 1;
    //     } else if ($jam_sesi > '16:30' && $jam_sesi <= '23:59') {
    //         $sesi = 5;
    //     } else if ($jam_sesi >= '00:00' && $jam_sesi <= '07:29') {
    //         $sesi = 9;
    //     }

    //     // END CEK SESI

    //     for ($i=0; $i < count($type_lead_part_positif); $i++) { 
    //         if (strpos($type_lead_part_positif[$i], 'FOPL')) {
    //             if ($jumlah_box[$i] > 5) {
    //                 $count = floor($jumlah_box[$i] / 5);
    //                 $total_order = $qty_per_basket[$i] * 5;
    //                 $qty_max = 0;
    //                 for ($j=0; $j < $count; $j++) { 
    //                     $data = [
    //                         'id_users' => $this->session->userdata('id_users'),
    //                         'line' => $line_plate_positif[$i],
    //                         'type_lead_part' => $type_lead_part_positif[$i],
    //                         'tanggal_order' => $tanggal_order,
    //                         'sesi' => $sesi,
    //                         'jumlah_order_plan' => $total_order,
    //                         'qty_per_basket' => $qty_per_basket[$i],
    //                         'status' => 'Open'
    //                     ];
    //                     $this->OrderLeadPartModel->saveOrderLeadPart($data);
    //                     $qty_max += $total_order;
    //                 }

    //                 // $mod = fmod($jumlah_order_plan[$i], $qty_per_basket[$i]);
    //                 $sisa = $jumlah_order_plan[$i] - $qty_max;
    //                 if ($sisa != 0) {
    //                     $data = [
    //                         'id_users' => $this->session->userdata('id_users'),
    //                         'line' => $line_plate_positif[$i],
    //                         'type_lead_part' => $type_lead_part_positif[$i],
    //                         'tanggal_order' => $tanggal_order,
    //                         'sesi' => $sesi,
    //                         'jumlah_order_plan' => $sisa,
    //                         'qty_per_basket' => $qty_per_basket[$i],
    //                         'status' => 'Open'
    //                     ];
    //                     $this->OrderLeadPartModel->saveOrderLeadPart($data);
    //                 }
    //             } elseif ($jumlah_box[$i] <= 5) {
    //                 $data = [
    //                     'id_users' => $this->session->userdata('id_users'),
    //                     'line' => $line_plate_positif[$i],
    //                     'type_lead_part' => $type_lead_part_positif[$i],
    //                     'tanggal_order' => $tanggal_order,
    //                     'sesi' => $sesi,
    //                     'jumlah_order_plan' => $jumlah_order_plan[$i],
    //                     'qty_per_basket' => $qty_per_basket[$i],
    //                     'status' => 'Open'
    //                 ];

    //                 $this->OrderLeadPartModel->saveOrderLeadPart($data);
    //             }
    //         } elseif (strpos($type_lead_part_positif[$i], 'UNPL')) {
    //             if ($jumlah_box[$i] > 3) {
    //                 $count = floor($jumlah_box[$i] / 3);
    //                 $total_order = $qty_per_basket[$i] * 3;
    //                 $qty_max = 0;
    //                 for ($j=0; $j < $count; $j++) { 
    //                     $data = [
    //                         'id_users' => $this->session->userdata('id_users'),
    //                         'line' => $line_plate_positif[$i],
    //                         'type_lead_part' => $type_lead_part_positif[$i],
    //                         'tanggal_order' => $tanggal_order,
    //                         'sesi' => $sesi,
    //                         'jumlah_order_plan' => $total_order,
    //                         'qty_per_basket' => $qty_per_basket[$i],
    //                         'status' => 'Open'
    //                     ];
    //                     $this->OrderLeadPartModel->saveOrderLeadPart($data);
    //                     $qty_max += $total_order;
    //                 }

    //                 // $mod = fmod($jumlah_order_plan[$i], $qty_per_basket[$i]);
    //                 $sisa = $jumlah_order_plan[$i] - $qty_max;
    //                 if ($sisa != 0) {
    //                     $data = [
    //                         'id_users' => $this->session->userdata('id_users'),
    //                         'line' => $line_plate_positif[$i],
    //                         'type_lead_part' => $type_lead_part_positif[$i],
    //                         'tanggal_order' => $tanggal_order,
    //                         'sesi' => $sesi,
    //                         'jumlah_order_plan' => $sisa,
    //                         'qty_per_basket' => $qty_per_basket[$i],
    //                         'status' => 'Open'
    //                     ];
    //                     $this->OrderLeadPartModel->saveOrderLeadPart($data);
    //                 }
    //             } elseif ($jumlah_box[$i] <= 3) {
    //                 $data = [
    //                     'id_users' => $this->session->userdata('id_users'),
    //                     'line' => $line_plate_positif[$i],
    //                     'type_lead_part' => $type_lead_part_positif[$i],
    //                     'tanggal_order' => $tanggal_order,
    //                     'sesi' => $sesi,
    //                     'jumlah_order_plan' => $jumlah_order_plan[$i],
    //                     'qty_per_basket' => $qty_per_basket[$i],
    //                     'status' => 'Open'
    //                 ];

    //                 $this->OrderLeadPartModel->saveOrderLeadPart($data);
    //             }
    //         }
            
    //         $dataUpdateStatusDraft = [
    //             'status' => 'Order',
    //         ];
    //         $this->OrderLeadPartModel->updateStatusDraftOrderLeadPart($type_lead_part_positif[$i], $dataUpdateStatusDraft);
    //     }

    //     echo "  <script type='text/javascript'>
    //                 alert('Order berhasil');
    //                 window.location.href = '" . base_url() . "order_lead_part/list_order';
    //             </script>
    //         ";
    // }

    // public function updateKonfirmasiSupply()
    // {
    //     $id_order_lead_part = $this->input->post('id_order_lead_part_konfirmasi');
    //     $qty_supply = $this->input->post('konfirmasi_qty_actual');

    //     $total_qty_supply = 0;

    //     for ($i=0; $i < count($qty_supply); $i++) { 
    //         $dataDetailQty = [
    //             'id_order_lead_part' => $id_order_lead_part,
    //             'qty_order_lead_part' => $qty_supply[$i]
    //         ];

    //         $this->OrderLeadPartModel->insertDetailOrderLeadPart($dataDetailQty);

    //         $total_qty_supply += $qty_supply[$i];
    //     }

    //     $cekQtyOrder = $this->OrderLeadPartModel->getOrderLeadPart($id_order_lead_part);

    //     $selisih = $cekQtyOrder[0]['jumlah_order_plan'] - $total_qty_supply;
        
    //     if ($selisih <= 0) {
    //         $status_supply = 'Close';
    //     } elseif ($selisih > 0) {
    //         $status_supply = 'Open';
    //     }

    //     $data = [
    //         'status' => 'Close',
    //         'closed_order' => date('Y-m-d H:i:s'),
    //         'qty_supply' => $total_qty_supply,
    //         'status_supply' => $status_supply,
    //         'closed_supply' => date('Y-m-d H:i:s'),
    //     ];

    //     $this->OrderLeadPartModel->updateKonfirmasiSupply($id_order_lead_part, $data);


    //     echo "  <script type='text/javascript'>
    //                 alert('Konfirmasi berhasil');
    //                 window.location.href = '" . base_url() . "order_lead_part/list_order';
    //             </script>
    //         ";
    // }

    public function activity_supply($date = null, $sesi = null, $page = null)
    {
        $time_now = date('H:i');
        // $time_now = '14:00';
        // var_dump($time_now); die();
        if ($sesi == null) {
            if ($time_now >= '20:00') {
                $sesi_now = 4;
            } elseif ($time_now >= '16:30') {
                $sesi_now = 3;
            } elseif ($time_now >= '10:30') {
                $sesi_now = 2;
            } elseif ($time_now >= '07:00') {
                $sesi_now = 1;
            } elseif ($time_now > '03:00') {
                $sesi_now = 6;
            } elseif ($time_now > '00:30') {
                $sesi_now = 5;
            }
        } else {
            $sesi_now = $sesi;
        }
        
        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderLeadPartModel->getQueueSchedule($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderLeadPartModel->getQueueSchedule($filterDate,$sesi_now);
        }
        
        $open = array_filter($getSupply, function ($var) {                                    
            return ($var['status'] == 'Open');
        });
        $num = array_keys($open);

        if ($page == null) {
            if (!empty($num[0])) {
                $count = $num[0];
            } else {
                $count = 0;
            }            
        } else {
            $count = $page - 1;
        }

        $data['data'] = $getSupply;
        $data['tanggal'] = $filterDate;
        $data['count'] = $count;
        $data['sesi_now'] = $sesi_now;
        

        $this->load->view('template/header');
		$this->load->view('order_lead_part/activity_supply', $data);
		$this->load->view('template/footer');
    }

    public function activity_supply_formation($date = null, $sesi = null, $page = null)
    {
        $time_now = date('H:i');
        // $time_now = '14:00';
        // var_dump($time_now); die();
        if ($sesi == null) {
            if ($time_now >= '20:00') {
                $sesi_now = 4;
            } elseif ($time_now >= '16:30') {
                $sesi_now = 3;
            } elseif ($time_now >= '10:30') {
                $sesi_now = 2;
            } elseif ($time_now >= '07:00') {
                $sesi_now = 1;
            } elseif ($time_now > '03:00') {
                $sesi_now = 6;
            } elseif ($time_now > '00:30') {
                $sesi_now = 5;
            }
        } else {
            $sesi_now = $sesi;
        }

        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderLeadPartModel->getQueueScheduleFormation($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderLeadPartModel->getQueueScheduleFormation($filterDate,$sesi_now);
        }
        
        $open = array_filter($getSupply, function ($var) {                                    
            return ($var['status'] == 'Open');
        });
        $num = array_keys($open);

        if ($page == null) {
            if (!empty($num[0])) {
                $count = $num[0];
            } else {
                $count = 0;
            }            
        } else {
            $count = $page - 1;
        }

        $data['data'] = $getSupply;
        $data['tanggal'] = $filterDate;
        $data['count'] = $count;
        $data['sesi_now'] = $sesi_now;
        

        $this->load->view('template/header');
		$this->load->view('order_lead_part/activity_supply_formation', $data);
		$this->load->view('template/footer');
    }

    public function activity_supply_assy_a($date = null, $sesi = null, $page = null)
    {
        $time_now = date('H:i');

        if ($sesi == null) {
            if ($time_now >= '20:00') {
                $sesi_now = 4;
            } elseif ($time_now >= '16:30') {
                $sesi_now = 3;
            } elseif ($time_now >= '10:30') {
                $sesi_now = 2;
            } elseif ($time_now >= '07:00') {
                $sesi_now = 1;
            } elseif ($time_now > '03:00') {
                $sesi_now = 6;
            } elseif ($time_now > '00:30') {
                $sesi_now = 5;
            }
        } else {
            $sesi_now = $sesi;
        }

        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderLeadPartModel->getQueueSchedule($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderLeadPartModel->getQueueSchedule($filterDate,$sesi_now);
        }

        $filteredArray = array_filter($getSupply, function($item) {
            return $item["line"] == 1 || $item["line"] == 2 || $item["line"] == 3 || $item["line"] == 'MCB';
        });

        $filteredArray = array_values($filteredArray);
        
        $open = array_filter($filteredArray, function ($var) {                                    
            return ($var['status'] == 'Open');
        });
        $num = array_keys($open);

        if ($page == null) {
            if (!empty($num[0])) {
                $count = $num[0];
            } else {
                $count = 0;
            }            
        } else {
            $count = $page - 1;
        }

        $data['data'] = $filteredArray;
        $data['tanggal'] = $filterDate;
        $data['count'] = $count;
        $data['sesi_now'] = $sesi_now;
        

        $this->load->view('template/header');
		$this->load->view('order_lead_part/activity_supply_assy_a', $data);
		$this->load->view('template/footer');
    }

    public function activity_supply_assy_g($date = null, $sesi = null, $page = null)
    {
        $time_now = date('H:i');

        if ($sesi == null) {
            if ($time_now >= '20:00') {
                $sesi_now = 4;
            } elseif ($time_now >= '16:30') {
                $sesi_now = 3;
            } elseif ($time_now >= '10:30') {
                $sesi_now = 2;
            } elseif ($time_now >= '07:00') {
                $sesi_now = 1;
            } elseif ($time_now > '03:00') {
                $sesi_now = 6;
            } elseif ($time_now > '00:30') {
                $sesi_now = 5;
            }
        } else {
            $sesi_now = $sesi;
        }

        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderLeadPartModel->getQueueSchedule($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderLeadPartModel->getQueueSchedule($filterDate,$sesi_now);
        }

        $filteredArray = array_filter($getSupply, function($item) {
            return $item["line"] >= 4 && $item["line"] <= 7;
        });

        $filteredArray = array_values($filteredArray);
        
        $open = array_filter($filteredArray, function ($var) {                                    
            return ($var['status'] == 'Open');
        });
        $num = array_keys($open);

        if ($page == null) {
            if (!empty($num[0])) {
                $count = $num[0];
            } else {
                $count = 0;
            }            
        } else {
            $count = $page - 1;
        }

        $data['data'] = $filteredArray;
        $data['tanggal'] = $filterDate;
        $data['count'] = $count;
        $data['sesi_now'] = $sesi_now;
        

        $this->load->view('template/header');
		$this->load->view('order_lead_part/activity_supply_assy_g', $data);
		$this->load->view('template/footer');
    }

    public function activity_supply_formation_c($date = null, $sesi = null, $page = null)
    {
        $time_now = date('H:i');

        if ($sesi == null) {
            if ($time_now >= '20:00') {
                $sesi_now = 4;
            } elseif ($time_now >= '16:30') {
                $sesi_now = 3;
            } elseif ($time_now >= '10:30') {
                $sesi_now = 2;
            } elseif ($time_now >= '07:00') {
                $sesi_now = 1;
            } elseif ($time_now > '03:00') {
                $sesi_now = 6;
            } elseif ($time_now > '00:30') {
                $sesi_now = 5;
            }
        } else {
            $sesi_now = $sesi;
        }

        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderLeadPartModel->getQueueScheduleFormation($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderLeadPartModel->getQueueScheduleFormation($filterDate,$sesi_now);
        }

        $filteredArray = array_filter($getSupply, function($item) {
            return $item["line"] == 'FOR_C_Barat' || $item["line"] == 'FOR_C_Timur';
        });

        $filteredArray = array_values($filteredArray);
        
        $open = array_filter($filteredArray, function ($var) {                                    
            return ($var['status'] == 'Open');
        });
        $num = array_keys($open);

        if ($page == null) {
            if (!empty($num[0])) {
                $count = $num[0];
            } else {
                $count = 0;
            }            
        } else {
            $count = $page - 1;
        }

        $data['data'] = $filteredArray;
        $data['tanggal'] = $filterDate;
        $data['count'] = $count;
        $data['sesi_now'] = $sesi_now;
        

        $this->load->view('template/header');
		$this->load->view('order_lead_part/activity_supply_formation_c', $data);
		$this->load->view('template/footer');
    }

    public function activity_supply_formation_f($date = null, $sesi = null, $page = null)
    {
        $time_now = date('H:i');

        if ($sesi == null) {
            if ($time_now >= '20:00') {
                $sesi_now = 4;
            } elseif ($time_now >= '16:30') {
                $sesi_now = 3;
            } elseif ($time_now >= '10:30') {
                $sesi_now = 2;
            } elseif ($time_now >= '07:00') {
                $sesi_now = 1;
            } elseif ($time_now > '03:00') {
                $sesi_now = 6;
            } elseif ($time_now > '00:30') {
                $sesi_now = 5;
            }
        } else {
            $sesi_now = $sesi;
        }

        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderLeadPartModel->getQueueScheduleFormation($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderLeadPartModel->getQueueScheduleFormation($filterDate,$sesi_now);
        }

        $filteredArray = array_filter($getSupply, function($item) {
            return $item["line"] == 'FOR_F_Barat' || $item["line"] == 'FOR_F_Timur';
        });

        $filteredArray = array_values($filteredArray);
        
        $open = array_filter($filteredArray, function ($var) {                                    
            return ($var['status'] == 'Open');
        });
        $num = array_keys($open);

        if ($page == null) {
            if (!empty($num[0])) {
                $count = $num[0];
            } else {
                $count = 0;
            }            
        } else {
            $count = $page - 1;
        }

        $data['data'] = $filteredArray;
        $data['tanggal'] = $filterDate;
        $data['count'] = $count;
        $data['sesi_now'] = $sesi_now;
        

        $this->load->view('template/header');
		$this->load->view('order_lead_part/activity_supply_formation_f', $data);
		$this->load->view('template/footer');
    }

    public function getTypeLeadPart($param)
    {
        $jenis_lead_part = $this->input->post('jenis_lead_part');
        if($param == 'lead_part')
            $param = '';
        $dataTypeLeadPart = $this->OrderLeadPartModel->getTypeLeadPart($jenis_lead_part,$param);
        echo '
                
                <select class="form-control" id="type_lead_part" name="type_lead_part" required>
                    <option value="" selected disabled>-- Pilih ---</option>';
                    foreach ($dataTypeLeadPart as $tp) {
                        echo '
                            <option value="'.$tp['id_lead_part'].'">'.$tp['type_lead_part'].'</option>
                        ';
                    }					
        echo '
                </select>
            
        ';
    }

    public function getTypeLeadPartEdit()
    {
        $jenis_lead_part = $this->input->post('jenis_lead_part');
		$dataTypeLeadPart = $this->OrderLeadPartModel->getTypeLeadPart($jenis_lead_part,'');
        // var_dump($jenis_lead_part);die();

		echo '
            
                <select class="form-control" id="type_lead_part_edit" name="type_lead_part_edit" required>
                    <option value="" selected disabled>-- Pilih ---</option>';
                    foreach ($dataTypeLeadPart as $tp) {
                        echo '
                            <option value="'.$tp['id_lead_part'].'">'.$tp['type_lead_part'].'</option>
                        ';
                    }					
		echo '
                </select>
             
        ';
    }

    public function getQtyLeadPart()
    {
        $id_lead_part = $this->input->post('id_lead_part');
        $dataTypeLeadPart = $this->OrderLeadPartModel->getTypeLeadPartById($id_lead_part);

        echo json_encode($dataTypeLeadPart);
    }

    public function saveOrderLeadPart()
    {
        $action = $this->input->post('action');
        $line = $this->input->post('line');
        $id_lead_part = $this->input->post('type_lead_part');
        $sesi = $this->input->post('sesi');
        $jumlah_box = $this->input->post('qty');
        
        $status = ($action == 'Draft') ? "Draft" : "Open" ;
        
        $dataTypeLeadPart = $this->OrderLeadPartModel->getTypeLeadPartById($id_lead_part);

        $tanggal_order_puasa = date('Y-m-d H:i:s');

        if($jumlah_box > 0)
        {
            if ($dataTypeLeadPart != NULL) {
                // if ($dataTypeLeadPart[0]['max_tempat'] < $jumlah_box) {
                //     $iterai = $jumlah_box/$dataTypeLeadPart[0]['max_tempat'];
                //     $hasil = floor($iterai);
        
                //     for ($i=0; $i < $hasil; $i++) { 
                //         $total_order_plan = $dataTypeLeadPart[0]['max_tempat'] * $dataTypeLeadPart[0]['qty_per_tempat'];
        
                //         $data = array (
                //             'id_users' => $this->session->userdata('id_users'),
                //             'line' => $line,
                //             'id_lead_part' => $id_lead_part,
                //             'tanggal_order' => $tanggal_order_puasa,
                //             'sesi' => $sesi,
                //             'jumlah_order_plan' => $total_order_plan,
                //             'jumlah_box' => $dataTypeLeadPart[0]['max_tempat'],
                //             'status' => $status,
                //             'status_supply' => 'Open'
                //         );
                //         var_dump($data);die;
                
                //         $this->OrderLeadPartModel->saveOrderLeadPart($data);
                //     }
        
                //     $mod = fmod($jumlah_box, $dataTypeLeadPart[0]['max_tempat']);
                //     if ($mod != 0) {
                //         $total_order_plan = $mod * $dataTypeLeadPart[0]['qty_per_tempat'];
        
                //         $data = array (
                //             'id_users' => $this->session->userdata('id_users'),
                //             'line' => $line,
                //             'id_lead_part' => $id_lead_part,
                //             'tanggal_order' => $tanggal_order_puasa,
                //             'sesi' => $sesi,
                //             'jumlah_order_plan' => $total_order_plan,
                //             'jumlah_box' => $mod,
                //             'status' => $status,
                //             'status_supply' => 'Open'
                //         );
                //         var_dump($data);die;
                
                //         $this->OrderLeadPartModel->saveOrderLeadPart($data);
                //     }
                // } elseif ($jumlah_box <= $dataTypeLeadPart[0]['max_tempat']) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line,
                        'id_lead_part' => $id_lead_part,
                        'tanggal_order' => date('Y-m-d H:i:s'),
                        'sesi' => $sesi,
                        'jumlah_box' => $jumlah_box,
                        'status' => $status,
                        'status_supply' => 'Open'
                    ];
            
                    $this->OrderLeadPartModel->saveOrderLeadPart($data);
                // }
            } else {
    
            }
        } else {
            echo "  <script type='text/javascript'>
                        alert('Pastikan qty panel sudah terisi ketika input qty rak lebih dari 0');
                        window.location.href = '" . base_url() . "order_lead_part/list_order';
                    </script>
                ";
        }    
        
        echo "  <script type='text/javascript'>
                    alert('Order berhasil');
                    window.location.href = '" . base_url() . "order_lead_part/list_order';
                </script>
            ";
    }

    public function confirmSupply()
    {
        $id_order_lead_part = $this->input->post('id_order_lead_part');
        $action = $this->input->post('action_supply');

        $cek_wh = $this->OrderLeadPartModel->check_wh_supply($id_order_lead_part);

        

        if ($action == 'Submit') {
            $qty_supply = 0;

            $i = 0;
            foreach($_POST['actual_supply'] as $value) {
                $qty_actq_detail = str_replace('.', ',', $value); 

                $detail_supply = array(
                    'id_order_lead_part' => $id_order_lead_part,
                    'qty_order_lead_part' => $qty_actq_detail,
                    'barcode' => $this->input->post('barcode')[$i],
                    'username' => $this->session->userdata('username')
                );
                $this->OrderLeadPartModel->inputDetailOrder($detail_supply);
                // var_dump($detail_supply);die();
                $qty_supply += (float)$value;    
                $i++;        
            }

            $qty_actq = str_replace(',', '.', $qty_supply);  

            $data = array(
                'qty_supply' => $qty_actq,
                'status_supply' => 'Progress',
                'closed_supply' => date('Y-m-d H:i:s'),
            );

            $this->OrderLeadPartModel->updateKonfirmasi($data, $id_order_lead_part);
            if ($this->input->post('gedung') != 'formation') {
                redirect('order_lead_part/activity_supply/');
            } else {
                redirect('order_lead_part/activity_supply_formation/');
            }
        } else {
            $data = array(
                'status' => 'Close',
                'status_supply' => 'Close',
                'closed_supply' => date('Y-m-d H:i:s')
            );

            $this->OrderLeadPartModel->updateKonfirmasi($data, $id_order_lead_part);
            if ($this->input->post('gedung') != 'formation') {
                redirect('order_lead_part/activity_supply/');
            } else {
                redirect('order_lead_part/activity_supply_formation/');
            }
        }       
        
    }

    public function getListOrderLeadPartById()
    {
        $id_order_lead_part = $this->input->post('id_order_lead_part');
        $data = $this->OrderLeadPartModel->getListOrderLeadPartById($id_order_lead_part);

        echo json_encode($data);
    }

    public function deleteOrderLeadPart()
    {
        $id_order_lead_part = $this->input->get('id');

        $this->OrderLeadPartModel->deleteOrderLeadPart($id_order_lead_part);

        redirect('order_lead_part/list_order');
    }

    public function editOrderLeadPart()
    {
        $id_order_lead_part = $this->input->post('id_order_lead_part_edit');
        $action = $this->input->post('action_edit');
        $line = $this->input->post('line_edit');
        $id_lead_part = $this->input->post('type_lead_part_edit');
        $sesi = $this->input->post('sesi_edit');
        $jumlah_order_plan = $this->input->post('qty_pnl_edit');
        $jumlah_box = $this->input->post('qty_edit');

        $status = ($action == 'Draft') ? "Draft" : "Open" ;

        $dataTypeLeadPart = $this->OrderLeadPartModel->getTypeLeadPartById($id_lead_part);

        // var_dump($dataTypeLeadPart);die();

        $deleteOldData = $this->OrderLeadPartModel->deleteOrderLeadPart($id_order_lead_part);

        if ($dataTypeLeadPart != NULL) {
            if ($deleteOldData > 0) {
                // if ($dataTypeLeadPart[0]['max_tempat'] < $jumlah_box) {
                //     $iterai = $jumlah_box/$dataTypeLeadPart[0]['max_tempat'];
                //     $hasil = floor($iterai);
        
                //     for ($i=0; $i < $hasil; $i++) { 
                //         $total_order_plan = $dataTypeLeadPart[0]['max_tempat'] * $dataTypeLeadPart[0]['qty_per_tempat'];
        
                //         $data = array (
                //             'id_users' => $this->session->userdata('id_users'),
                //             'line' => $line,
                //             'id_lead_part' => $id_lead_part,
                //             'tanggal_order' => date('Y-m-d H:i:s'),
                //             'sesi' => $sesi,
                //             'jumlah_order_plan' => $total_order_plan,
                //             'jumlah_box' => $dataTypeLeadPart[0]['max_tempat'],
                //             'status' => $status,
                //             'status_supply' => 'Open'
                //         );
                
                //         $this->OrderLeadPartModel->saveOrderLeadPart($data);
                //     }
        
                //     $mod = fmod($jumlah_box, $dataTypeLeadPart[0]['max_tempat']);
                //     if ($mod != 0) {
                //         $total_order_plan = $mod * $dataTypeLeadPart[0]['qty_per_tempat'];
        
                //         $data = array (
                //             'id_users' => $this->session->userdata('id_users'),
                //             'line' => $line,
                //             'id_lead_part' => $id_lead_part,
                //             'tanggal_order' => date('Y-m-d H:i:s'),
                //             'sesi' => $sesi,
                //             'jumlah_order_plan' => $total_order_plan,
                //             'jumlah_box' => $mod,
                //             'status' => $status,
                //             'status_supply' => 'Open'
                //         );
                
                //         $this->OrderLeadPartModel->saveOrderLeadPart($data);
                //     }
                // } elseif ($jumlah_box <= $dataTypeLeadPart[0]['max_tempat']) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line,
                        'id_lead_part' => $id_lead_part,
                        'tanggal_order' => date('Y-m-d H:i:s'),
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan,
                        'jumlah_box' => $jumlah_box,
                        'status' => $status,
                        'status_supply' => 'Open'
                    ];
            
                    $this->OrderLeadPartModel->saveOrderLeadPart($data);
                // }
                
                echo "  <script type='text/javascript'>
                            alert('Edit order berhasil');
                            window.location.href = '" . base_url() . "order_lead_part/list_order';
                        </script>
                    ";
            } else {
                echo "GAGAL";
            }
        } else {

        }
    }

    public function checkQtyBarcode()
    {
        $barc = $this->input->post('barc');
        // $arr_code = explode("-", $barc);
        $data['status'] = $this->OrderLeadPartModel->checkStatusBarcode($barc);
        if($data['status'] == 'Barcode dapat digunakan') {
            $data['barcode'] = $this->OrderLeadPartModel->checkQtyBarcode($barc);
        }
        

        echo json_encode($data);
    }
}

 ?>