<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Order_plate extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('OrderPlateModel');
        $this->load->model('HomeModel');

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
		$this->load->view('order_plate/list_line');
		$this->load->view('template/footer');
    }

    public function list_wo($lines = null)
    {
        $line = $lines ;

        $data['data'] = $this->OrderPlateModel->getListWO($line);
        $data['line'] = $line;
        
        $this->load->view('template/header');
		$this->load->view('order_plate/list_wo',$data);
		$this->load->view('template/footer');
    }

    public function saveDraftOrderPlate()
    {
        $data = [
            "line" => $this->input->post('line'),
            "no_wo" => $this->input->post('no_wo'),
            "part_number" => $this->input->post('part_number'),
            "jenis_plate" => $this->input->post('jenis_plate'),
            "type_plate" => $this->input->post('type_plate'),
            "qty_wo" => $this->input->post('qty_wo'),
            "status" => 'Draft'
        ];

        $this->OrderPlateModel->saveDraftOrderPlate($data);

        echo json_encode($data);
    }

    public function deleteDraftOrderPlate()
    {
        $no_wo = $this->input->post('no_wo');
        $data = [
            "Message" =>"Success"
        ];

        $this->OrderPlateModel->deleteDraftOrderPlate($no_wo);

        echo json_encode($data);
    }

    public function list_order($dates = null)
    {
        $time_now = date('H:i');
        if ($dates == null) {
            if ($time_now >= '00:00' && $time_now <= '07:00') {
                $date = date('Y-m-d', strtotime('-1 day'));
            } else {
                $date = date('Y-m-d');
            }
        } else {
            $date = $dates;
        }

        $data['data'] = $this->OrderPlateModel->getListOrder($date);
        $data['date'] = $date;

        // var_dump($data); die();
        
        $this->load->view('template/header');
		$this->load->view('order_plate/list_order_plate',$data);
		$this->load->view('template/footer');
    }

    public function draftOrderPlatePositif($lines = null)
    {
        $data = $this->OrderPlateModel->getDraftOrderPlatePositif($lines);

        echo json_encode($data);
    }

    public function draftOrderPlateNegatif($lines = null)
    {
        $data = $this->OrderPlateModel->getDraftOrderPlateNegatif($lines);

        echo json_encode($data);
    }

    public function menu_report()
    {
        $data['data'] = $this->OrderPlateModel->getEndStock();
        // $data['type'] = $this->OrderPlateModel->getPartNumberPlate();

        $this->load->view('template/header');
        $this->load->view('order_plate/report_end_stock', $data);
        $this->load->view('template/footer');
    }

    public function update_stock()
    {
        $data = $this->OrderPlateModel->getListWO();
        $arrPartNumberPlate = [];
        foreach ($data as $d) {
            $part_number = $this->OrderPlateModel->getListPartNumber(trim($d['PART_NUMBER']));
            foreach ($part_number as $pn) {
                array_push($arrPartNumberPlate, $pn['pn_plate']);
            }
        }

        $pn_plate['pn_plate'] = array_values(array_unique($arrPartNumberPlate));

        $this->load->view('template/header');
        $this->load->view('order_plate/update_stock', $pn_plate);
        $this->load->view('template/footer');
    }

    public function updateEndStock()
    {
        $type = $this->input->post('type_plate');
        $qty_cutting = $this->input->post('qty_cutting');
        $reject = $this->input->post('reject');
        $end_stock = (int)$qty_cutting - (int)$reject;
        $tanggal = $this->input->post('tanggal');
        $shift = $this->input->post('shift');

        $data = [
            "type" => $type,
            "qty_cutting" => $qty_cutting,
            "reject" => $reject,
            "end_stock" => $end_stock,
            "tanggal" => $tanggal,
            "shift" => $shift
        ];

        $this->OrderPlateModel->updateEndStock($data);
        redirect('order_plate/menu_report');
    }

    public function saveOrderPlatePositif()
    {
        $line_plate_positif = $this->input->post('line_plate_positif');
        $type_plate_positif = $this->input->post('type_plate_positif');
        $tanggal_order = date('Y-m-d H:i:s');
        $jumlah_order_plan = $this->input->post('qty_order_positif');
        $qty_per_basket = $this->input->post('qty_per_basket');
        $jumlah_basket = $this->input->post('basket_order_positif');

        $sisa_positif_after = $this->input->post('sisa_positif_after');
        $sisa_positif_before = $this->input->post('sisa_positif_before');

        // CEK SESI
        // $tanggal = date('Y-m-d');
        // $nextTanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
        // $allDates= array (
        //     $tanggal.' 07:30',
        //     $tanggal.' 16:30',
        //     $nextTanggal.' 00:00',
        // );
        
        // function date_sort($a, $b) {
        //         return strtotime($a) - strtotime($b);
        // }
        
        // usort($allDates, "date_sort");
        
        // foreach ($allDates as $count => $dateSingle) {
        //     if (strtotime($tanggal_order) < strtotime($dateSingle))  {
        //         $nextDate = date('d-m-Y H:i', strtotime($dateSingle));
        //         break;
        //     }
        // }

        // $a = '2022-10-07 23:15';

        $jam_sesi = date("H:i",strtotime($tanggal_order));

        if ($jam_sesi >= '07:30' && $jam_sesi <= '16:30') {
            $sesi = 1;
        } else if ($jam_sesi > '16:30' && $jam_sesi <= '23:59') {
            $sesi = 5;
        } else if ($jam_sesi >= '00:00' && $jam_sesi <= '07:29') {
            $sesi = 9;
        }

        // END CEK SESI

        for ($i=0; $i < count($type_plate_positif); $i++) { 
            if (strpos($type_plate_positif[$i], 'FOPL')) {
                if ($jumlah_basket[$i] > 5) {
                    $count = floor($jumlah_basket[$i] / 5);
                    $total_order = $qty_per_basket[$i] * 5;
                    $qty_max = 0;
                    for ($j=0; $j < $count; $j++) { 
                        $data = [
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line_plate_positif[$i],
                            'type_plate' => $type_plate_positif[$i],
                            'tanggal_order' => $tanggal_order,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order,
                            'qty_per_basket' => $qty_per_basket[$i],
                            'status' => 'Open'
                        ];
                        $this->OrderPlateModel->saveOrderPlate($data);
                        $qty_max += $total_order;
                    }

                    // $mod = fmod($jumlah_order_plan[$i], $qty_per_basket[$i]);
                    $sisa = $jumlah_order_plan[$i] - $qty_max;
                    if ($sisa != 0) {
                        $data = [
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line_plate_positif[$i],
                            'type_plate' => $type_plate_positif[$i],
                            'tanggal_order' => $tanggal_order,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $sisa,
                            'qty_per_basket' => $qty_per_basket[$i],
                            'status' => 'Open'
                        ];
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
                } elseif ($jumlah_basket[$i] <= 5) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line_plate_positif[$i],
                        'type_plate' => $type_plate_positif[$i],
                        'tanggal_order' => $tanggal_order,
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan[$i],
                        'qty_per_basket' => $qty_per_basket[$i],
                        'status' => 'Open'
                    ];

                    $this->OrderPlateModel->saveOrderPlate($data);
                }
            } elseif (strpos($type_plate_positif[$i], 'UNPL')) {
                if ($jumlah_basket[$i] > 3) {
                    $count = floor($jumlah_basket[$i] / 3);
                    $total_order = $qty_per_basket[$i] * 3;
                    $qty_max = 0;
                    for ($j=0; $j < $count; $j++) { 
                        $data = [
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line_plate_positif[$i],
                            'type_plate' => $type_plate_positif[$i],
                            'tanggal_order' => $tanggal_order,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order,
                            'qty_per_basket' => $qty_per_basket[$i],
                            'status' => 'Open'
                        ];
                        $this->OrderPlateModel->saveOrderPlate($data);
                        $qty_max += $total_order;
                    }

                    // $mod = fmod($jumlah_order_plan[$i], $qty_per_basket[$i]);
                    $sisa = $jumlah_order_plan[$i] - $qty_max;
                    if ($sisa != 0) {
                        $data = [
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line_plate_positif[$i],
                            'type_plate' => $type_plate_positif[$i],
                            'tanggal_order' => $tanggal_order,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $sisa,
                            'qty_per_basket' => $qty_per_basket[$i],
                            'status' => 'Open'
                        ];
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
                } elseif ($jumlah_basket[$i] <= 3) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line_plate_positif[$i],
                        'type_plate' => $type_plate_positif[$i],
                        'tanggal_order' => $tanggal_order,
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan[$i],
                        'qty_per_basket' => $qty_per_basket[$i],
                        'status' => 'Open'
                    ];

                    $this->OrderPlateModel->saveOrderPlate($data);
                }
            }
            
            $dataUpdateStatusDraft = [
                'status' => 'Order',
            ];
            $this->OrderPlateModel->updateStatusDraftOrderPlate($type_plate_positif[$i], $dataUpdateStatusDraft);
        }

        echo "  <script type='text/javascript'>
                    alert('Order berhasil');
                    window.location.href = '" . base_url() . "order_plate/list_order';
                </script>
            ";
    }

    public function saveOrderPlateNegatif()
    {
        $line_plate_negatif = $this->input->post('line_plate_negatif');
        $type_plate_negatif = $this->input->post('type_plate_negatif');
        $tanggal_order = date('Y-m-d H:i:s');
        $jumlah_order_plan = $this->input->post('qty_order_negatif');
        $qty_per_basket = $this->input->post('qty_per_basket_negatif');
        $jumlah_basket = $this->input->post('basket_order_negatif');

        $sisa_negatif_after = $this->input->post('sisa_negatif_after');
        $sisa_negatif_before = $this->input->post('sisa_negatif_before');

        // CEK SESI
        // $tanggal = date('Y-m-d');
        // $nextTanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
        // $allDates= array (
        //     $tanggal.' 07:30',
        //     $tanggal.' 16:30',
        //     $nextTanggal.' 00:00',
        // );
        
        // function date_sort($a, $b) {
        //         return strtotime($a) - strtotime($b);
        // }
        
        // usort($allDates, "date_sort");
        
        // foreach ($allDates as $count => $dateSingle) {
        //     if (strtotime($tanggal_order) < strtotime($dateSingle))  {
        //         $nextDate = date('d-m-Y H:i', strtotime($dateSingle));
        //         break;
        //     }
        // }

        // $a = '2022-10-07 23:15';

        $jam_sesi = date("H:i",strtotime($tanggal_order));

        if ($jam_sesi >= '07:30' && $jam_sesi <= '16:30') {
            $sesi = 1;
        } else if ($jam_sesi > '16:30' && $jam_sesi <= '23:59') {
            $sesi = 5;
        } else if ($jam_sesi >= '00:00' && $jam_sesi <= '07:29') {
            $sesi = 9;
        }

        // END CEK SESI

        for ($i=0; $i < count($type_plate_negatif); $i++) { 
                 
            if (strpos($type_plate_negatif[$i], 'FOPL')) {
                if ($jumlah_basket[$i] > 5) {
                    $count = floor($jumlah_basket[$i] / 5);
                    $total_order = $qty_per_basket[$i] * 5;
                    $qty_max = 0;
                    for ($j=0; $j < $count; $j++) { 
                        $data = [
                            'line' => $line_plate_negatif[$i],
                            'type_plate' => $type_plate_negatif[$i],
                            'tanggal_order' => $tanggal_order,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order,
                            'qty_per_basket' => $qty_per_basket[$i],
                            'status' => 'Open'
                        ];
                        $this->OrderPlateModel->saveOrderPlate($data);
                        $qty_max += $total_order;
                    }

                    // $mod = fmod($jumlah_order_plan[$i], $qty_per_basket[$i]);
                    $sisa = $jumlah_order_plan[$i] - $qty_max;
                    if ($sisa != 0) {
                        $data = [
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line_plate_negatif[$i],
                            'type_plate' => $type_plate_negatif[$i],
                            'tanggal_order' => $tanggal_order,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $sisa,
                            'qty_per_basket' => $qty_per_basket[$i],
                            'status' => 'Open'
                        ];
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
                } elseif ($jumlah_basket[$i] <= 5) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line_plate_negatif[$i],
                        'type_plate' => $type_plate_negatif[$i],
                        'tanggal_order' => $tanggal_order,
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan[$i],
                        'qty_per_basket' => $qty_per_basket[$i],
                        'status' => 'Open'
                    ];

                    $this->OrderPlateModel->saveOrderPlate($data);
                }
            } elseif (strpos($type_plate_negatif[$i], 'UNPL')) {
                if ($jumlah_basket[$i] > 3) {
                    $count = floor($jumlah_basket[$i] / 3);
                    $total_order = $qty_per_basket[$i] * 3;
                    $qty_max = 0;
                    for ($j=0; $j < $count; $j++) { 
                        $data = [
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line_plate_negatif[$i],
                            'type_plate' => $type_plate_negatif[$i],
                            'tanggal_order' => $tanggal_order,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order,
                            'qty_per_basket' => $qty_per_basket[$i],
                            'status' => 'Open'
                        ];

                        $this->OrderPlateModel->saveOrderPlate($data);
                        $qty_max += $total_order;
                    }

                    // $mod = fmod($jumlah_order_plan[$i], $qty_per_basket[$i]);
                    $sisa = $jumlah_order_plan[$i] - $qty_max;
                    if ($sisa != 0) {
                        $data = [
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line_plate_negatif[$i],
                            'type_plate' => $type_plate_negatif[$i],
                            'tanggal_order' => $tanggal_order,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $sisa,
                            'qty_per_basket' => $qty_per_basket[$i],
                            'status' => 'Open'
                        ];
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
                } elseif ($jumlah_basket[$i] <= 3) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line_plate_negatif[$i],
                        'type_plate' => $type_plate_negatif[$i],
                        'tanggal_order' => $tanggal_order,
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan[$i],
                        'qty_per_basket' => $qty_per_basket[$i],
                        'status' => 'Open'
                    ];

                    $this->OrderPlateModel->saveOrderPlate($data);
                }
            }
            
            $dataUpdateStatusDraft = [
                'status' => 'Order',
            ];
            $this->OrderPlateModel->updateStatusDraftOrderPlate($type_plate_negatif[$i], $dataUpdateStatusDraft);
        }

        echo "  <script type='text/javascript'>
                    alert('Order berhasil');
                    window.location.href = '" . base_url() . "order_plate/list_order';
                </script>
            ";
    }

    public function updateKonfirmasiSupply()
    {
        $id_order_plate = $this->input->post('id_order_plate_konfirmasi');
        $qty_supply = $this->input->post('konfirmasi_qty_actual');

        $total_qty_supply = 0;

        for ($i=0; $i < count($qty_supply); $i++) { 
            $dataDetailQty = [
                'id_order_plate' => $id_order_plate,
                'qty_order_plate' => $qty_supply[$i]
            ];

            $this->OrderPlateModel->insertDetailOrderPlate($dataDetailQty);

            $total_qty_supply += $qty_supply[$i];
        }

        $cekQtyOrder = $this->OrderPlateModel->getOrderPlate($id_order_plate);

        $selisih = $cekQtyOrder[0]['jumlah_order_plan'] - $total_qty_supply;
        
        if ($selisih <= 0) {
            $status_supply = 'Close';
        } elseif ($selisih > 0) {
            $status_supply = 'Open';
        }

        $data = [
            'status' => 'Close',
            'closed_order' => date('Y-m-d H:i:s'),
            'qty_supply' => $total_qty_supply,
            'status_supply' => $status_supply,
            'closed_supply' => date('Y-m-d H:i:s'),
        ];

        $this->OrderPlateModel->updateKonfirmasiSupply($id_order_plate, $data);


        echo "  <script type='text/javascript'>
                    alert('Konfirmasi berhasil');
                    window.location.href = '" . base_url() . "order_plate/list_order';
                </script>
            ";
    }

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

        // if ($date == null) {
        //     $filterDate = date('Y-m-d');
        //     $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
        // } else {
        //     $filterDate = $date;
        //     if ($sesi_now > 5) {
        //         $filterDateMin = date('Y-m-d', strtotime('+1 days', strtotime($filterDate)));
        //         $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDateMin,$sesi_now);
                
        //     } else {
        //         $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
        //     }
        // }

        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
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
		$this->load->view('order_plate/activity_supply', $data);
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

        // if ($date == null) {
        //     $filterDate = date('Y-m-d');
        //     $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
        // } else {
        //     $filterDate = $date;
        //     if ($sesi_now > 5) {
        //         $filterDateMin = date('Y-m-d', strtotime('+1 days', strtotime($filterDate)));
        //         $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDateMin,$sesi_now);
                
        //     } else {
        //         $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
        //     }
        // }

        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderPlateModel->getQueueScheduleFormation($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderPlateModel->getQueueScheduleFormation($filterDate,$sesi_now);
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
		$this->load->view('order_plate/activity_supply_formation', $data);
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
            $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
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
		$this->load->view('order_plate/activity_supply_assy_a', $data);
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
            $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderPlateModel->getQueueSchedule($filterDate,$sesi_now);
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
		$this->load->view('order_plate/activity_supply_assy_g', $data);
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
            $getSupply = $this->OrderPlateModel->getQueueScheduleFormation($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderPlateModel->getQueueScheduleFormation($filterDate,$sesi_now);
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
		$this->load->view('order_plate/activity_supply_formation_c', $data);
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
            $getSupply = $this->OrderPlateModel->getQueueScheduleFormation($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderPlateModel->getQueueScheduleFormation($filterDate,$sesi_now);
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
		$this->load->view('order_plate/activity_supply_formation_f', $data);
		$this->load->view('template/footer');
    }

    public function getTypePlate($param)
    {
        $jenis_plate = $this->input->post('jenis_plate');
        $dataTypePlate = $this->OrderPlateModel->getTypePlate($jenis_plate,$param);
        
        if ($param == 'negatif') {
            echo '
                
                    <select class="form-control" id="type_plate_neg" name="type_plate_neg" required>
                        <option value="" selected disabled>-- Pilih ---</option>';
                        foreach ($dataTypePlate as $tp) {
                            echo '
                                <option value="'.$tp['id_plate'].'">'.$tp['type_plate'].'</option>
                            ';
                        }					
            echo '
                    </select>
                
            ';
        } else {
            echo '
                    
                    <select class="form-control" id="type_plate" name="type_plate_pos" required>
                        <option value="" selected disabled>-- Pilih ---</option>';
                        foreach ($dataTypePlate as $tp) {
                            echo '
                                <option value="'.$tp['id_plate'].'">'.$tp['type_plate'].'</option>
                            ';
                        }					
            echo '
                    </select>
                
            ';
        }
    }

    public function getTypePlateEdit()
    {
        $jenis_plate = $this->input->post('jenis_plate');
		$dataTypePlate = $this->OrderPlateModel->getTypePlate($jenis_plate,'');
        // var_dump($jenis_plate);die();

		echo '
            
                <select class="form-control" id="type_plate_edit" name="type_plate_edit" required>
                    <option value="" selected disabled>-- Pilih ---</option>';
                    foreach ($dataTypePlate as $tp) {
                        echo '
                            <option value="'.$tp['id_plate'].'">'.$tp['type_plate'].'</option>
                        ';
                    }					
		echo '
                </select>
             
        ';
    }

    public function getQtyPlate()
    {
        $id_plate = $this->input->post('id_plate');
        $dataTypePlate = $this->OrderPlateModel->getTypePlateById($id_plate);

        echo json_encode($dataTypePlate);
    }

    public function saveOrderPlate()
    {
        $action = $this->input->post('action');
        $line = $this->input->post('line');
        $id_plate = $this->input->post('type_plate_pos');
        $sesi = $this->input->post('sesi_pos');
        $jumlah_order_plan = $this->input->post('qty_pnl_pos');
        $jumlah_basket = $this->input->post('qty_pos');

        $status = ($action == 'Draft') ? "Draft" : "Open" ;

        $dataTypePlate = $this->OrderPlateModel->getTypePlateById($id_plate);

        // if (date('H:i:s') > '07:00:00' and date('H:i:s') < '07:30:00') {
        //     $tanggal_order_puasa = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime(date('Y-m-d H:i:s'))));
        // } else {
        //     $tanggal_order_puasa = date('Y-m-d H:i:s');
        // }

        $tanggal_order_puasa = date('Y-m-d H:i:s');

        if(($jumlah_basket != 0 AND $jumlah_order_plan != 0) OR ($jumlah_basket == 0 AND $jumlah_order_plan == 0))
        {
            if ($dataTypePlate != NULL) {
                if ($dataTypePlate[0]['max_tempat'] < $jumlah_basket) {
                    $iterai = $jumlah_basket/$dataTypePlate[0]['max_tempat'];
                    $hasil = floor($iterai);
        
                    for ($i=0; $i < $hasil; $i++) { 
                        $total_order_plan = $dataTypePlate[0]['max_tempat'] * $dataTypePlate[0]['qty_per_tempat'];
        
                        $data = array (
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line,
                            'id_plate' => $id_plate,
                            'tanggal_order' => $tanggal_order_puasa,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order_plan,
                            'jumlah_basket' => $dataTypePlate[0]['max_tempat'],
                            'status' => $status,
                            'status_supply' => 'Open'
                        );
                
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
        
                    $mod = fmod($jumlah_basket, $dataTypePlate[0]['max_tempat']);
                    if ($mod != 0) {
                        $total_order_plan = $mod * $dataTypePlate[0]['qty_per_tempat'];
        
                        $data = array (
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line,
                            'id_plate' => $id_plate,
                            'tanggal_order' => $tanggal_order_puasa,
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order_plan,
                            'jumlah_basket' => $mod,
                            'status' => $status,
                            'status_supply' => 'Open'
                        );
                
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
                } elseif ($jumlah_basket <= $dataTypePlate[0]['max_tempat']) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line,
                        'id_plate' => $id_plate,
                        'tanggal_order' => date('Y-m-d H:i:s'),
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan,
                        'jumlah_basket' => $jumlah_basket,
                        'status' => $status,
                        'status_supply' => 'Open'
                    ];
            
                    $this->OrderPlateModel->saveOrderPlate($data);
                }
            } else {
    
            }
        } else {
            echo "  <script type='text/javascript'>
                        alert('Pastikan qty panel sudah terisi ketika input qty rak lebih dari 0');
                        window.location.href = '" . base_url() . "order_plate/list_order';
                    </script>
                ";
        }

        

    
        $id_plate = $this->input->post('type_plate_neg');
        $sesi = $this->input->post('sesi_neg');
        $jumlah_order_plan = $this->input->post('qty_pnl_neg');
        $jumlah_basket_neg = $this->input->post('qty_neg');

        $status = ($action == 'Draft') ? "Draft" : "Open" ;

        $dataTypePlate = $this->OrderPlateModel->getTypePlateById($id_plate);

        if(($jumlah_basket_neg != 0 AND $jumlah_order_plan != 0) OR ($jumlah_basket_neg == 0 AND $jumlah_order_plan == 0))
        {
            if ($dataTypePlate != NULL) {
                if ($dataTypePlate[0]['max_tempat'] < $jumlah_basket_neg) {
                    $iterai = $jumlah_basket_neg/$dataTypePlate[0]['max_tempat'];
                    $hasil = floor($iterai);
        
                    for ($ii=0; $ii < $hasil; $ii++) { 
                        $total_order_plan = $dataTypePlate[0]['max_tempat'] * $dataTypePlate[0]['qty_per_tempat'];
        
                        $data = array (
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line,
                            'id_plate' => $id_plate,
                            'tanggal_order' => date('Y-m-d H:i:s'),
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order_plan,
                            'jumlah_basket' => $dataTypePlate[0]['max_tempat'],
                            'status' => $status,
                            'status_supply' => 'Open'
                        );
                
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
        
                    $mod = fmod($jumlah_basket_neg, $dataTypePlate[0]['max_tempat']);
                    // var_dump($mod);die();
                    if ($mod != 0) {
                        $total_order_plan = $mod * $dataTypePlate[0]['qty_per_tempat'];
        
                        $data = array (
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line,
                            'id_plate' => $id_plate,
                            'tanggal_order' => date('Y-m-d H:i:s'),
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order_plan,
                            'jumlah_basket' => $mod,
                            'status' => $status,
                            'status_supply' => 'Open'
                        );
                
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
                } elseif ($jumlah_basket_neg <= $dataTypePlate[0]['max_tempat']) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line,
                        'id_plate' => $id_plate,
                        'tanggal_order' => date('Y-m-d H:i:s'),
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan,
                        'jumlah_basket' => $jumlah_basket_neg,
                        'status' => $status,
                        'status_supply' => 'Open'
                    ];
            
                    $this->OrderPlateModel->saveOrderPlate($data);
                }
            } else {
                echo "  <script type='text/javascript'>
                            alert('Pastikan qty panel sudah terisi ketika input qty rak lebih dari 0');
                            window.location.href = '" . base_url() . "order_plate/list_order';
                        </script>
                    ";
            }
        }    
        
        echo "  <script type='text/javascript'>
                    alert('Order berhasil');
                    window.location.href = '" . base_url() . "order_plate/list_order';
                </script>
            ";
    }

    public function confirmSupply()
    {
        $id_order_plate = $this->input->post('id_order_plate');
        $action = $this->input->post('action_supply');

        $cek_wh = $this->OrderPlateModel->check_wh_supply($id_order_plate);

        

        if ($action == 'Submit') {
            $qty_supply = 0;

            $i = 0;
            foreach($_POST['actual_supply'] as $value) {
                $qty_actq_detail = str_replace('.', ',', $value); 
                

                // if (strpos($cek_wh[0]['line'], 'FOR') !== true) {
                    
                    // ========== Update Data Infor ================ //
                //     $stkn = 1;
                //     $sttr = 1;
                //     $dtkn = date('Y/m/d H:i:s');
                //     $dttr = date('Y/m/d H:i:s');
                //     $grp3 = 'KPRO2';

                //     // CEK WH SUPPLY
                //     if ($cek_wh[0]['line'] == '1' || $cek_wh[0]['line'] == '2' || $cek_wh[0]['line'] == '3') {
                //         $grp2 = 'AMB';
                //     } elseif ($cek_wh[0]['line'] == '4' || $cek_wh[0]['line'] == '5' || $cek_wh[0]['line'] == '6' || $cek_wh[0]['line'] == '7') {
                //         $grp2 = 'AMB2';
                //     } elseif ($cek_wh[0]['line'] == 'MCB') {
                //         $grp2 = 'MCB';
                //     } else {
                //         $grp2 = '';
                //     }

                //     $update_tr_infor = $this->HomeModel->update_data_tr($this->input->post('barcode')[$i], $stkn, $sttr, $dtkn, $dttr, $grp3, $grp2);
                //     if ($update_tr_infor > 0) {
                //         $detail_generate_infor = 1;
                //     } else {
                //         $detail_generate_infor = NULL;
                //     }
                // } else {
                //     $detail_generate_infor = NULL;
                // }

                $detail_supply = array(
                    'id_order_plate' => $id_order_plate,
                    'qty_order_plate' => $qty_actq_detail,
                    'barcode' => $this->input->post('barcode')[$i],
                    // 'generate_infor' => $detail_generate_infor,
                    'username' => $this->session->userdata('username')
                );
                $this->OrderPlateModel->inputDetailOrder($detail_supply);
                // var_dump($detail_supply);die();
                $qty_supply += (float)$value;    
                $i++;        
            }

            $qty_actq = str_replace(',', '.', $qty_supply);  

            // if ($update_tr_infor > 0) {
            //     $generate_infor = 1;
            // } else {
            //     $generate_infor = NULL;
            // } 

            $data = array(
                'qty_supply' => $qty_actq,
                'status_supply' => 'Progress',
                'closed_supply' => date('Y-m-d H:i:s'),
                'keterangan' => $this->input->post('keterangan'),
                'supply_by' => $this->input->post('supply_by'),
                // 'generate_infor' => $generate_infor
            );

            $this->OrderPlateModel->updateKonfirmasi($data, $id_order_plate);
            if ($this->input->post('gedung') != 'formation') {
                if ($this->input->post('line') == 1 or $this->input->post('line') == 2 or $this->input->post('line') == 3) {
                    redirect('order_plate/activity_supply_assy_a/');
                } elseif ($this->input->post('line') == 4 or $this->input->post('line') == 5 or $this->input->post('line') == 6 or $this->input->post('line') == 7) {
                    redirect('order_plate/activity_supply_assy_g/');
                }
            } else {
                redirect('order_plate/activity_supply_formation/');
            }
        } else {
            $data = array(
                'status' => 'Close',
                'status_supply' => 'Close',
                'closed_supply' => date('Y-m-d H:i:s')
            );

            $this->OrderPlateModel->updateKonfirmasi($data, $id_order_plate);
            if ($this->input->post('gedung') != 'formation') {
                if ($this->input->post('line') == 1 or $this->input->post('line') == 2 or $this->input->post('line') == 3) {
                    redirect('order_plate/activity_supply_assy_a/');
                } elseif ($this->input->post('line') == 4 or $this->input->post('line') == 5 or $this->input->post('line') == 6 or $this->input->post('line') == 7) {
                    redirect('order_plate/activity_supply_assy_g/');
                }
            } else {
                redirect('order_plate/activity_supply_formation/');
            }
        }       
        
    }

    public function getListOrderPlateById()
    {
        $id_order_plate = $this->input->post('id_order_plate');
        $data = $this->OrderPlateModel->getListOrderPlateById($id_order_plate);

        echo json_encode($data);
    }

    public function deleteOrderPlate()
    {
        $id_order_plate = $this->input->get('id');

        $this->OrderPlateModel->deleteOrderPlate($id_order_plate);

        redirect('order_plate/list_order');
    }

    public function editOrderPlate()
    {
        $id_order_plate = $this->input->post('id_order_plate_edit');
        $action = $this->input->post('action_edit');
        $line = $this->input->post('line_edit');
        $id_plate = $this->input->post('type_plate_edit');
        $sesi = $this->input->post('sesi_edit');
        $jumlah_order_plan = $this->input->post('qty_pnl_edit');
        $jumlah_basket = $this->input->post('qty_edit');

        $status = ($action == 'Draft') ? "Draft" : "Open" ;

        $dataTypePlate = $this->OrderPlateModel->getTypePlateById($id_plate);

        // var_dump($dataTypePlate);die();

        $deleteOldData = $this->OrderPlateModel->deleteOrderPlate($id_order_plate);

        if ($dataTypePlate != NULL) {
            if ($deleteOldData > 0) {
                if ($dataTypePlate[0]['max_tempat'] < $jumlah_basket) {
                    $iterai = $jumlah_basket/$dataTypePlate[0]['max_tempat'];
                    $hasil = floor($iterai);
        
                    for ($i=0; $i < $hasil; $i++) { 
                        $total_order_plan = $dataTypePlate[0]['max_tempat'] * $dataTypePlate[0]['qty_per_tempat'];
        
                        $data = array (
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line,
                            'id_plate' => $id_plate,
                            'tanggal_order' => date('Y-m-d H:i:s'),
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order_plan,
                            'jumlah_basket' => $dataTypePlate[0]['max_tempat'],
                            'status' => $status,
                            'status_supply' => 'Open'
                        );
                
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
        
                    $mod = fmod($jumlah_basket, $dataTypePlate[0]['max_tempat']);
                    if ($mod != 0) {
                        $total_order_plan = $mod * $dataTypePlate[0]['qty_per_tempat'];
        
                        $data = array (
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line,
                            'id_plate' => $id_plate,
                            'tanggal_order' => date('Y-m-d H:i:s'),
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order_plan,
                            'jumlah_basket' => $mod,
                            'status' => $status,
                            'status_supply' => 'Open'
                        );
                
                        $this->OrderPlateModel->saveOrderPlate($data);
                    }
                } elseif ($jumlah_basket <= $dataTypePlate[0]['max_tempat']) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line,
                        'id_plate' => $id_plate,
                        'tanggal_order' => date('Y-m-d H:i:s'),
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan,
                        'jumlah_basket' => $jumlah_basket,
                        'status' => $status,
                        'status_supply' => 'Open'
                    ];
            
                    $this->OrderPlateModel->saveOrderPlate($data);
                }
                
                echo "  <script type='text/javascript'>
                            alert('Edit order berhasil');
                            window.location.href = '" . base_url() . "order_plate/list_order';
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
        $data['status'] = $this->OrderPlateModel->checkStatusBarcode($barc);
        if($data['status'] == 'Barcode dapat digunakan') {
            // if (count($arr_code) > 3) {
                $data['barcode'] = $this->OrderPlateModel->checkQtyBarcode($barc);
            // } else {
                // $year = $arr_code[0];
                // $peri = $arr_code[1];
                // $code_barc = $arr_code[2];
        
                // $data = $this->OrderTimahModel->checkQtyByCode($year, $peri, $code_barc);
            // }
        }
        

        echo json_encode($data);
    }
}

 ?>