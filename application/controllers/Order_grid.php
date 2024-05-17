<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Order_grid extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('OrderGridModel');

        if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '8' OR $this->session->userdata('level') == '9' OR $this->session->userdata('level') == '6') {
			echo "";
		} else {
			redirect('login','refresh');			
		}

		$this->output->delete_cache();
        $data = [];
    }

    public function saveDraftOrderGrid()
    {
        $data = [
            "line" => $this->input->post('line'),
            "no_wo" => $this->input->post('no_wo'),
            "type_grid" => $this->input->post('type_grid'),
            "status" => 'Draft'
        ];

        $this->OrderGridModel->saveDraftOrderGrid($data);

        echo json_encode($data);
    }

    public function deleteDraftOrderGrid()
    {
        $no_wo = $this->input->post('no_wo');
        $data = [
            "Message" =>"Success"
        ];

        $this->OrderGridModel->deleteDraftOrderGrid($no_wo);

        echo json_encode($data);
    }

    public function list_order($dates = null)
    {
        $date = ($dates == null) ? date('Y-m-d') : $dates ;

        $data['data'] = $this->OrderGridModel->getListOrder($date);
        $data['date'] = $date;
        $data['type_grid'] = $this->OrderGridModel->dataGrid();

        // var_dump($data); die();
        
        $this->load->view('template/header');
		$this->load->view('order_grid/list_order_grid',$data);
		$this->load->view('template/footer');
    }

    public function draftOrderGridPositif($lines = null)
    {
        $data = $this->OrderGridModel->getDraftOrderGridPositif($lines);

        echo json_encode($data);
    }

    public function draftOrderGridNegatif($lines = null)
    {
        $data = $this->OrderGridModel->getDraftOrderGridNegatif($lines);

        echo json_encode($data);
    }

    public function menu_report()
    {
        $data['data'] = $this->OrderGridModel->getEndStock();
        // $data['type'] = $this->OrderGridModel->getPartNumberGrid();

        $this->load->view('template/header');
        $this->load->view('order_grid/report_end_stock', $data);
        $this->load->view('template/footer');
    }

    public function update_stock()
    {
        $data = $this->OrderGridModel->getListWO();
        $arrPartNumberGrid = [];
        foreach ($data as $d) {
            $part_number = $this->OrderGridModel->getListPartNumber(trim($d['PART_NUMBER']));
            foreach ($part_number as $pn) {
                array_push($arrPartNumberGrid, $pn['pn_grid']);
            }
        }

        $pn_grid['pn_grid'] = array_values(array_unique($arrPartNumberGrid));

        $this->load->view('template/header');
        $this->load->view('order_grid/update_stock', $pn_grid);
        $this->load->view('template/footer');
    }

    public function updateEndStock()
    {
        $type = $this->input->post('type_grid');
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

        $this->OrderGridModel->updateEndStock($data);
        redirect('order_grid/menu_report');
    }

    public function updateKonfirmasiSupply()
    {
        $id_order_grid = $this->input->post('id_order_grid_konfirmasi');
        $qty_supply = $this->input->post('konfirmasi_qty_actual');

        $total_qty_supply = 0;

        for ($i=0; $i < count($qty_supply); $i++) { 
            $dataDetailQty = [
                'id_order_grid' => $id_order_grid,
                'qty_order_grid' => $qty_supply[$i]
            ];

            $this->OrderGridModel->insertDetailOrderGrid($dataDetailQty);

            $total_qty_supply += $qty_supply[$i];
        }

        $cekQtyOrder = $this->OrderGridModel->getOrderGrid($id_order_grid);

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

        $this->OrderGridModel->updateKonfirmasiSupply($id_order_grid, $data);


        echo "  <script type='text/javascript'>
                    alert('Konfirmasi berhasil');
                    window.location.href = '" . base_url() . "order_grid/list_order';
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
        //     $getSupply = $this->OrderGridModel->getQueueSchedule($filterDate,$sesi_now);
        // } else {
        //     $filterDate = $date;
        //     if ($sesi_now > 5) {
        //         $filterDateMin = date('Y-m-d', strtotime('+1 days', strtotime($filterDate)));
        //         $getSupply = $this->OrderGridModel->getQueueSchedule($filterDateMin,$sesi_now);
                
        //     } else {
        //         $getSupply = $this->OrderGridModel->getQueueSchedule($filterDate,$sesi_now);
        //     }
        // }

        if ($date == null) {
            $filterDate = date('Y-m-d');
            $getSupply = $this->OrderGridModel->getQueueSchedule($filterDate,$sesi_now);
        } else {
            $filterDate = $date;
            $getSupply = $this->OrderGridModel->getQueueSchedule($filterDate,$sesi_now);
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
		$this->load->view('order_grid/activity_supply', $data);
		$this->load->view('template/footer');
    }

    public function getTypeGrid($param)
    {
        $jenis_grid = $this->input->post('jenis_grid');
        $dataTypeGrid = $this->OrderGridModel->getTypeGrid($jenis_grid,$param);
        
        if ($param == 'negatif') {
            echo '
                
                    <select class="form-control" id="type_grid_neg" name="type_grid_neg" required>
                        <option value="" selected disabled>-- Pilih ---</option>';
                        foreach ($dataTypeGrid as $tp) {
                            echo '
                                <option value="'.$tp['id_grid'].'">'.$tp['type_grid'].'</option>
                            ';
                        }					
            echo '
                    </select>
                
            ';
        } else {
            echo '
                    
                    <select class="form-control" id="type_grid" name="type_grid_pos" required>
                        <option value="" selected disabled>-- Pilih ---</option>';
                        foreach ($dataTypeGrid as $tp) {
                            echo '
                                <option value="'.$tp['id_grid'].'">'.$tp['type_grid'].'</option>
                            ';
                        }					
            echo '
                    </select>
                
            ';
        }
    }

    public function getTypeGridEdit()
    {
        $jenis_grid = $this->input->post('jenis_grid');
		$dataTypeGrid = $this->OrderGridModel->getTypeGrid($jenis_grid,'');
        // var_dump($jenis_grid);die();

		echo '
            
                <select class="form-control" id="type_grid_edit" name="type_grid_edit" required>
                    <option value="" selected disabled>-- Pilih ---</option>';
                    foreach ($dataTypeGrid as $tp) {
                        echo '
                            <option value="'.$tp['id_grid'].'">'.$tp['type_grid'].'</option>
                        ';
                    }					
		echo '
                </select>
             
        ';
    }

    public function getQtyGrid()
    {
        $type_grid = $this->input->post('type_grid');
        $dataTypeGrid = $this->OrderGridModel->getTypeGridByType($type_grid);

        echo json_encode($dataTypeGrid);
    }

    public function saveOrderGrid()
    {
        $action = $this->input->post('action');
        $line = $this->input->post('line');
        $type_grid = $this->input->post('type_grid');
        $sesi = $this->input->post('sesi');
        $jumlah_order_plan = $this->input->post('qty_pnl');
        $jumlah_basket = $this->input->post('qty');

        $status = ($action == 'Draft') ? "Draft" : "Open" ;

        $dataTypeGrid = $this->OrderGridModel->getTypeGridByType($type_grid);

        // if (date('H:i:s') > '07:00:00' and date('H:i:s') < '07:30:00') {
        //     $tanggal_order_puasa = date('Y-m-d H:i:s', strtotime('+30 minutes', strtotime(date('Y-m-d H:i:s'))));
        // } else {
        //     $tanggal_order_puasa = date('Y-m-d H:i:s');
        // }

        $tanggal_order_puasa = date('Y-m-d H:i:s');

        if ($dataTypeGrid != NULL) {
            if ($dataTypeGrid[0]['max_tempat'] < $jumlah_basket) {
                $iterai = $jumlah_basket/$dataTypeGrid[0]['max_tempat'];
                $hasil = floor($iterai);
    
                for ($i=0; $i < $hasil; $i++) { 
                    $total_order_plan = $dataTypeGrid[0]['max_tempat'] * $dataTypeGrid[0]['lot_size'];
    
                    $data = array (
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line,
                        'type_grid' => $type_grid,
                        'tanggal_order' => $tanggal_order_puasa,
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $total_order_plan,
                        'jumlah_rak' => $dataTypeGrid[0]['max_tempat'],
                        'status' => $status,
                        'status_supply' => 'Open'
                    );
            
                    $this->OrderGridModel->saveOrderGrid($data);
                }
    
                $mod = fmod($jumlah_basket, $dataTypeGrid[0]['max_tempat']);
                if ($mod != 0) {
                    $total_order_plan = $mod * $dataTypeGrid[0]['lot_size'];
    
                    $data = array (
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line,
                        'type_grid' => $type_grid,
                        'tanggal_order' => $tanggal_order_puasa,
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $total_order_plan,
                        'jumlah_rak' => $mod,
                        'status' => $status,
                        'status_supply' => 'Open'
                    );
            
                    $this->OrderGridModel->saveOrderGrid($data);
                }
            } elseif ($jumlah_basket <= $dataTypeGrid[0]['max_tempat']) {
                $data = [
                    'id_users' => $this->session->userdata('id_users'),
                    'line' => $line,
                    'type_grid' => $type_grid,
                    'tanggal_order' => date('Y-m-d H:i:s'),
                    'sesi' => $sesi,
                    'jumlah_order_plan' => $jumlah_order_plan,
                    'jumlah_rak' => $jumlah_basket,
                    'status' => $status,
                    'status_supply' => 'Open'
                ];
        
                $this->OrderGridModel->saveOrderGrid($data);
            }
        } else {
            echo 'GAGAL';
            die();
        }
    
        
        echo "  <script type='text/javascript'>
                    alert('Order berhasil');
                    window.location.href = '" . base_url() . "order_grid/list_order';
                </script>
            ";
    }

    public function confirmSupply()
    {
        $id_order_grid = $this->input->post('id_order_grid');
        $action = $this->input->post('action_supply');
        if ($action == 'Submit') {
            $qty_supply = 0;

            $i = 0;
            foreach($_POST['actual_supply'] as $value) {
                $qty_actq_detail = str_replace('.', ',', $value); 
                $detail_supply = array(
                    'id_order_grid' => $id_order_grid,
                    'qty_rak' => $qty_actq_detail,
                    'rak' => $this->input->post('barcode')[$i]
                );
                $this->OrderGridModel->inputDetailOrder($detail_supply);
                // var_dump($detail_supply);die();
                $qty_supply += (float)$value;    
                $i++;        
            }

            $qty_actq = str_replace(',', '.', $qty_supply);  

            $data = array(
                'qty_supply' => $qty_actq,
                'status' => 'Close',
                'status_supply' => 'Close',
                'closed_supply' => date('Y-m-d H:i:s')
            );

            $this->OrderGridModel->updateKonfirmasi($data, $id_order_grid);
            // if ($this->input->post('gedung') != 'formation') {
            //     redirect('order_grid/activity_supply/');
            // } else {
            //     redirect('order_grid/activity_supply_formation/');
            // }

            redirect('order_grid/activity_supply/');
        } else {
            $data = array(
                'status' => 'Close',
                'status_supply' => 'Close',
                'closed_supply' => date('Y-m-d H:i:s')
            );

            $this->OrderGridModel->updateKonfirmasi($data, $id_order_grid);
            // if ($this->input->post('gedung') != 'formation') {
            //     redirect('order_grid/activity_supply/');
            // } else {
            //     redirect('order_grid/activity_supply_formation/');
            // }

            redirect('order_grid/activity_supply/');
        }       
        
    }

    public function getListOrderGridById()
    {
        $id_order_grid = $this->input->post('id_order_grid');
        $data = $this->OrderGridModel->getListOrderGridById($id_order_grid);

        echo json_encode($data);
    }

    public function deleteOrderGrid()
    {
        $id_order_grid = $this->input->get('id');

        $this->OrderGridModel->deleteOrderGrid($id_order_grid);

        redirect('order_grid/list_order');
    }

    public function editOrderGrid()
    {
        $id_order_grid = $this->input->post('id_order_grid_edit');
        $action = $this->input->post('action_edit');
        $line = $this->input->post('line_edit');
        $type_grid = $this->input->post('type_grid_edit');
        $sesi = $this->input->post('sesi_edit');
        $jumlah_order_plan = $this->input->post('qty_pnl_edit');
        $jumlah_rak = $this->input->post('qty_edit');

        $status = ($action == 'Draft') ? "Draft" : "Open" ;

        $dataTypeGrid = $this->OrderGridModel->getTypeGridByType($type_grid);

        // var_dump($dataTypeGrid);die();

        $deleteOldData = $this->OrderGridModel->deleteOrderGrid($id_order_grid);

        if ($dataTypeGrid != NULL) {
            if ($deleteOldData > 0) {
                if ($dataTypeGrid[0]['max_tempat'] < $jumlah_rak) {
                    $iterai = $jumlah_rak/$dataTypeGrid[0]['max_tempat'];
                    $hasil = floor($iterai);
        
                    for ($i=0; $i < $hasil; $i++) { 
                        $total_order_plan = $dataTypeGrid[0]['max_tempat'] * $dataTypeGrid[0]['lot_size'];
        
                        $data = array (
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line,
                            'type_grid' => $type_grid,
                            'tanggal_order' => date('Y-m-d H:i:s'),
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order_plan,
                            'jumlah_rak' => $dataTypeGrid[0]['max_tempat'],
                            'status' => $status,
                            'status_supply' => 'Open'
                        );
                
                        $this->OrderGridModel->saveOrderGrid($data);
                    }
        
                    $mod = fmod($jumlah_rak, $dataTypeGrid[0]['max_tempat']);
                    if ($mod != 0) {
                        $total_order_plan = $mod * $dataTypeGrid[0]['lot_size'];
        
                        $data = array (
                            'id_users' => $this->session->userdata('id_users'),
                            'line' => $line,
                            'type_grid' => $type_grid,
                            'tanggal_order' => date('Y-m-d H:i:s'),
                            'sesi' => $sesi,
                            'jumlah_order_plan' => $total_order_plan,
                            'jumlah_rak' => $mod,
                            'status' => $status,
                            'status_supply' => 'Open'
                        );
                
                        $this->OrderGridModel->saveOrderGrid($data);
                    }
                } elseif ($jumlah_rak <= $dataTypeGrid[0]['max_tempat']) {
                    $data = [
                        'id_users' => $this->session->userdata('id_users'),
                        'line' => $line,
                        'type_grid' => $type_grid,
                        'tanggal_order' => date('Y-m-d H:i:s'),
                        'sesi' => $sesi,
                        'jumlah_order_plan' => $jumlah_order_plan,
                        'jumlah_rak' => $jumlah_rak,
                        'status' => $status,
                        'status_supply' => 'Open'
                    ];
            
                    $this->OrderGridModel->saveOrderGrid($data);
                }
                
                echo "  <script type='text/javascript'>
                            alert('Edit order berhasil');
                            window.location.href = '" . base_url() . "order_grid/list_order';
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
        
        $url = 'https://portal3.incoe.astra.co.id/production_control_v2/api/get_detail_rak/'.$barc;
        $data = json_decode(file_get_contents($url), true);

        echo json_encode($data);
    }
}

 ?>