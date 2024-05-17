<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Order_timah extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('OrderTimahModel');
		$this->load->model('HomeModel');
		$this->load->model('Sqlmodel');
		$this->load->model('ProdControl');
		$this->load->model('M_Line');

        if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '3' OR $this->session->userdata('level') == '7' OR $this->session->userdata('level') == '6' OR $this->session->userdata('level') == '8') {
			echo "";
		} else {
			redirect('login','refresh');			
		}

		$this->output->delete_cache();
    }

    public function index()
    {
        $this->list_order();
    }

    public function list_order($date=null)
    {
        if ($date == null) {
            $time_now = date("H:i");
            if ($time_now > "00:00" && $time_now < "06:00") {
                $filterDate = date('Y-m-d', strtotime("-1 day"));
            } else {
                $filterDate = date('Y-m-d');
            }
        } else {
            $filterDate = $date;
        }

        $data['data'] = $this->OrderTimahModel->getListOrder($filterDate);
        $data['tanggal'] = $filterDate;
        $data['subseksi'] = $this->OrderTimahModel->getSubseksi();
        
        $this->load->view('template/header');
		$this->load->view('order_timah/list_order_timah',$data);
		$this->load->view('template/footer');
    }

    public function checkConfirm($date=null)
    {
        if ($date == null) {
            $filterDate = date('Y-m-d');
        } else {
            $filterDate = $date;
        }

        $data = $this->OrderTimahModel->getListOrder($filterDate);
        echo json_encode($data);
    }

    public function input_order()
    {
        $data['subseksi'] = $this->OrderTimahModel->getSubseksi();

        $this->load->view('template/header');
		$this->load->view('order_timah/input_order',$data);
		$this->load->view('template/footer');
    }

    public function getPartNumber()
    {
        $id_subseksi = $this->input->post('id_subseksi');
		$part_number = $this->OrderTimahModel->getPartNumber($id_subseksi);

		echo '
            
                <select class="form-control" id="part_number" name="part_number">
                    <option value="0" selected disabled>-- Pilih ---</option>';
                    foreach ($part_number as $pn) {
                        // if ($pn['ingot_number'] != 'M-MOAL-CAXXXXX-0100-00-0700') {
                            echo '
                                <option value="'.$pn['id_part'].'">'.$pn['ingot_number'].' ('.$pn['keterangan'].')</option>
                            ';
                        // }
                    }					
		echo '
                </select>
             
        ';
    }

    public function saveProsesOrder()
    {      
        $id_subseksi = $this->input->post('subseksi');
        $id_part = $this->input->post('part_number');
        $tanggal_order = date('Y-m-d H:i');
        $jumlah_order = $this->input->post('jumlah_order');

        // $tanggal_order = '2022-10-07 23:15';

        $tanggal = date('Y-m-d');
  
        if ($tanggal_order >= $tanggal.' 23:01' && $tanggal_order <= $tanggal.' 23:59') {
            $date = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
            $allDates= array
            (
                $tanggal.' 08:30',
                $tanggal.' 13:30',
                $tanggal.' 18:30',
                $tanggal.' 23:00',
                $date.' 01:30',
                $date.' 05:30',
            );
        } else {
            $allDates= array
            (
                $tanggal.' 08:30',
                $tanggal.' 13:30',
                $tanggal.' 18:30',
                $tanggal.' 23:00',
                $tanggal.' 01:30',
                $tanggal.' 05:30',
            );
        }
        
        function date_sort($a, $b) {
                return strtotime($a) - strtotime($b);
        }
        
        usort($allDates, "date_sort");
        
        foreach ($allDates as $count => $dateSingle) {
            if (strtotime($tanggal_order) < strtotime($dateSingle))  {
                $nextDate = date('d-m-Y H:i', strtotime($dateSingle));
                break;
            }
        }
        
        // var_dump(date("Y-m-d",strtotime($nextDate)));
        $jam_sesi = date("H:i",strtotime($nextDate));

        if ($jam_sesi == '08:30') {
            $sesi = 1;
        } else if ($jam_sesi == '13:30') {
            $sesi = 2;
        } else if ($jam_sesi == '18:30') {
            $sesi = 3;
        } else if ($jam_sesi == '23:00') {
            $sesi = 4;
        } else if ($jam_sesi == '01:30') {
            $sesi = 5;
        } else if ($jam_sesi == '05:30') {
            $sesi = 6;
        }

        $rawOrder = $jumlah_order;
        if ($rawOrder > 2) {            
            $iterai = $rawOrder/2;
            $hasil = floor($iterai);

            for ($i=0; $i < $hasil; $i++) { 
                $data = array (
                    'id_subseksi' => $id_subseksi,
                    'id_part' => $id_part,
                    'id_users' => $this->session->userdata('id_users'),
                    'tanggal_order' => $tanggal_order,
                    'sesi' => $sesi,
                    'jumlah_order_plan' => 2,
                    'status' => 'Open',
                    'status_supply' => 'Open'
                );
        
                $this->OrderTimahModel->saveInputOrder($data);
            }

            $mod = fmod($jumlah_order, 2);
            if ($mod != 0) {
                $data = array (
                    'id_subseksi' => $id_subseksi,
                    'id_part' => $id_part,
                    'id_users' => $this->session->userdata('id_users'),
                    'tanggal_order' => $tanggal_order,
                    'sesi' => $sesi,
                    'jumlah_order_plan' => $mod,
                    'status' => 'Open',
                    'status_supply' => 'Open'
                );
        
                $this->OrderTimahModel->saveInputOrder($data);
            }             
        } elseif ($rawOrder <= 2) {
            $data = array (
                'id_subseksi' => $id_subseksi,
                'id_part' => $id_part,
                'id_users' => $this->session->userdata('id_users'),
                'tanggal_order' => $tanggal_order,
                'sesi' => $sesi,
                'jumlah_order_plan' => $rawOrder,
                'status' => 'Open',
                'status_supply' => 'Open'
            );
    
            $this->OrderTimahModel->saveInputOrder($data);
        }


        echo "  <script type='text/javascript'>
                    alert('Order berhasil');
                    window.location.href = '" . base_url() . "order_timah/';
                </script>
            ";
    }

    public function schedule($date=null)
    {
        $data['subseksi'] = $this->OrderTimahModel->getSubseksi();
        $data['tanggal'] = $date;

        $this->load->view('template/header');
		$this->load->view('order_timah/schedule_order', $data);
		$this->load->view('template/footer');
    }

    public function delete_order($id_order=null)
    {
        if ($id_order==null) {
            echo "  <script type='text/javascript'>
                        alert('Error');
                        window.location.href = '" . base_url() . "order_timah/';
                    </script>";
        } else {
            $this->OrderTimahModel->deleteOrder($id_order);
            redirect('order_timah');
        }
    }

    public function edit_order($id_order=null)
    {
        if ($id_order==null) {
            echo "  <script type='text/javascript'>
                        alert('Error');
                        window.location.href = '" . base_url() . "order_timah/';
                    </script>";
        } else {
            $data['data'] = $this->OrderTimahModel->getListOrderById($id_order);
            $data['subseksi'] = $this->OrderTimahModel->getSubseksi();
            $data['id_order'] = $id_order;

            $this->load->view('template/header');
            $this->load->view('order_timah/edit_order', $data);
            $this->load->view('template/footer');
        }        
    }

    public function prosesEditOrder()
    {
        $id_order = $this->input->post('id_order');
        $id_subseksi = $this->input->post('subseksi');
        $id_part = $this->input->post('part_number');
        $jumlah_order = $this->input->post('jumlah_order');

        $data = array (
            'id_subseksi' => $id_subseksi,
            'id_part' => $id_part,
            'id_users' => $this->session->userdata('id_users'),
            'jumlah_order_plan' => $jumlah_order
        );

        $this->OrderTimahModel->saveEditOrder($data,$id_order);
        redirect('order_timah');

    }

    public function updateKonfirmasi()
    {
        $id_order = $this->input->post('id_order_konfirmasi');
        $jumlah_order_actual = $this->input->post('jumlah_order_actual');

        $data = array(
            // 'jumlah_order_actual' => $jumlah_order_actual,
            'status' => 'Close',
            'closed_order' => date('Y-m-d H:i:s')
        );

        $this->OrderTimahModel->updateKonfirmasi($data, $id_order);
        redirect('order_timah');
    }

    public function autoConfirm()
    {
        $id_order = $this->input->post('id_order');

        $data = array(
            'status' => 'Close',
            'closed_order' => date('Y-m-d H:i:s')
        );

        $this->OrderTimahModel->updateKonfirmasi($data, $id_order);
        redirect('order_timah');
    }

    public function activity_supply($date= null, $sesi = null, $page = null)
    {
        if ($date == null) {
            $filterDate = date('Y-m-d');
        } else {
            $filterDate = $date;
        }

        $time_now = date('H:i');
        // $time_now = '14:00';

        if ($sesi == null) {
            // CHECK QUEUE SCHEDULE BY SESI
            if ($time_now > '21:30') {
                $sesi_now = 4;
            } elseif ($time_now > '16:00') {
                $sesi_now = 3;
            } elseif ($time_now > '11:00') {
                $sesi_now = 2;
            } elseif ($time_now > '07:00') {
                $sesi_now = 1;
            } elseif ($time_now > '04:00') {
                $sesi_now = 6;
            } elseif ($time_now > '00:00') {
                $sesi_now = 5;
            }
        } else {
            $sesi_now = $sesi;
        }        

        $getSupply = $this->OrderTimahModel->getQueueSchedule($filterDate,$sesi_now);
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
		$this->load->view('order_timah/activity_supply',$data);
		$this->load->view('template/footer');
    }

    public function confirmSupplyOld()
    {
        $id_order = $this->input->post('id_order');
        $qty_supply = 0;

        foreach($_POST['actual_supply'] as $value) {
            $qty_actq_detail = str_replace('.', ',', $value); 
            $detail_supply = array(
                'id_order' => $id_order,
                'qty_bundle' => $qty_actq_detail
            );
            $this->OrderTimahModel->inputDetailOrder($detail_supply);
            // var_dump($detail_supply);die();
            $qty_supply += (float)$value;            
        }

        $qty_actq = str_replace(',', '.', $qty_supply);  

        $data = array(
            'qty_supply' => $qty_actq,
            'status_supply' => 'Close',
            'closed_supply' => date('Y-m-d H:i:s')
        );

        $this->OrderTimahModel->updateKonfirmasi($data, $id_order);
        redirect('order_timah/activity_supply/');
    }

    public function queue_schedule($date=null, $sesi=null)
    {
        if ($date == null) {
            $filterDate = date('Y-m-d');
        } else {
            $filterDate = $date;
        }

        $time_now = date('H:i');
        // $time_now = '14:00';

        if ($sesi == null) {
            // CHECK QUEUE SCHEDULE BY SESI
            if ($time_now > '21:30') {
                $sesi_now = 4;
            } elseif ($time_now > '16:00') {
                $sesi_now = 3;
            } elseif ($time_now > '11:00') {
                $sesi_now = 2;
            } elseif ($time_now > '07:00') {
                $sesi_now = 1;
            } elseif ($time_now > '04:00') {
                $sesi_now = 6;
            } elseif ($time_now > '00:00') {
                $sesi_now = 5;
            }
        } else {
            $sesi_now = $sesi;
        }

        $getSupply = $this->OrderTimahModel->getQueueSchedule($filterDate,$sesi_now);

        $data['subseksi'] = $this->OrderTimahModel->getSubseksi();
        $data['tanggal'] = $filterDate;
        $data['data'] = $getSupply;
        $data['sesi_now'] = $sesi_now;

        $this->load->view('template/header');
		$this->load->view('order_timah/queue_schedule', $data);
		$this->load->view('template/footer');
    }

    public function confirmSupply()
    {
        $id_order = $this->input->post('id_order');
        $qty_supply = 0;

        $cekTR = $this->Sqlmodel->cekDetailOrderTimah($id_order);
        if ($cekTR == NULL) {
            for ($i=0; $i < count($_POST['actual_supply']); $i++) { 
                if ($_POST['actual_supply'][$i] <= 0 OR $_POST['actual_supply'][$i] >= 2001) {
                    echo 'error1'; die;
                } else {
                    $value = $_POST['actual_supply'][$i];
                    $qty_actq_detail = str_replace(',', '.', $value); 
                    $detail_supply = array(
                        'id_order' => $id_order,
                        'generate_baan' => 1,
                        'qty_bundle' => $qty_actq_detail,
                        'barcode' => $this->input->post('barcode')[$i]
                    );
        
                    $this->OrderTimahModel->inputDetailOrder($detail_supply);
                    $qty_supply += (float)$qty_actq_detail;   
                    
                    $data_update_store = [
                        'barc' => ''
                    ];

                    $this->M_Line->update_data_by_barcode('store_timah', $data_update_store, $this->input->post('barcode')[$i]);
                    
                    //==================== Input BAAN =======================//
                    $qty_actq_bundle = str_replace(',', '.', $value); 
        
                    $getDataTr = $this->OrderTimahModel->getListOrderById($id_order);
                    foreach ($getDataTr as $gdt) {
                        $pn = $getDataTr[0]['ingot_number'];
                        $sub_seksi = $getDataTr[0]['id_subseksi'];
                        $generate_baan = $getDataTr[0]['generate_baan'];
                    }
        
                    $wh_from = 'KWMTX';
                    $rfq = 'KWMTX';
                    $bpid = 'KWMTX';
                    $id_line = '0';
                    $counter = $qty_actq_bundle;            
            
                    // if ($sub_seksi == 1) {
                    //     $whto = 'K-CAS';
                    // } elseif ($sub_seksi == 2) {
                    //     $whto = 'K-PUN';
                    // } elseif ($sub_seksi == 3) {
                    //     $whto = 'K-PAS';
                    // } elseif ($sub_seksi == 4) {
                    //     $whto = 'K-PAS';
                    // } elseif ($sub_seksi == 5) {
                    //     $whto = 'K-AMB';
                    // } elseif ($sub_seksi == 6) {
                    //     $whto = 'K-AMB2';
                    // } elseif ($sub_seksi == 7) {
                    //     $whto = 'K-AVR';
                    // }   
                    
                    if ($sub_seksi == 1) {
                        $whto = 'KPRO1';
                    } elseif ($sub_seksi == 2) {
                        $whto = 'KPRO1';
                    } elseif ($sub_seksi == 3) {
                        $whto = 'KPRO1';
                    } elseif ($sub_seksi == 4) {
                        $whto = 'KPRO1';
                    } elseif ($sub_seksi == 5) {
                        $whto = 'KPRO2';
                    } elseif ($sub_seksi == 6) {
                        $whto = 'KPRO2';
                    } elseif ($sub_seksi == 7) {
                        $whto = 'KPRO2';
                    }   
        
                    // UPDATE TO K-PUN
                    // if ($whto == 'K-PUN' OR $whto == 'K-CAS' OR $whto == 'K-PAS' OR $whto == 'K-PAS' OR $whto == 'K-AMB' OR $whto == 'K-AMB2' OR $whto == 'K-AVR') {      
                    if ($whto == 'KPRO1' OR $whto == 'KPRO2') {      
                        $searchCean = $this->HomeModel->searchCean(trim($pn));
                        foreach ($searchCean as $sc) {
                            $cean = $sc->CEAN;
                            $dsca = $sc->DSCA;
                            $cuni = $sc->CUNI;
                        }                
                
                        $cekTagn = $this->HomeModel->cekTagnAutoWo(date('Y'),date('m'),$wh_from);
                        if ($cekTagn == NULL) {
                            $tagn = 1;
                            $barc_convert = date('ym').'KWMTX00001';
                        } else {
                            foreach ($cekTagn as $ct) {
                                $tag = $ct->TAGN;
                            }
                            $tagn = $tag+1+$i;
                            if ((int)$tagn < 10) {
                                $tambahan = '0000';
                            } elseif ((int)$tagn < 100) {
                                $tambahan = '000';
                            } elseif ((int)$tagn > 100 AND (int)$tagn < 1000) {
                                $tambahan = '00';
                            } elseif ((int)$tagn > 1000 AND(int)$tagn < 10000) {
                                $tambahan = '0';
                            }
        
                            $barc_convert = date('ym').'KWMTX'.$tambahan.(int)$tagn;
                        }      
                
                        $start = date('Y/m/d H:i:s');
                        $apdt = date('Y/m/d H:i:s',strtotime('-0 hours',strtotime($start)));        
                        $prdt = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));      
                        $dtkn = date('Y/m/d H:i:s',strtotime('-45 years',strtotime($start)));      
                        
                        $barc = $barc_convert;
            
                        $insert = $this->HomeModel->insert_data_tr_timah(date('Y'),date('m'),$wh_from,$tagn,$barc,' ',trim($pn),$dsca,$qty_actq_bundle,$cuni,'wh',' ',' ',$id_line,'0',$counter,$apdt,'2',$whto,'0','0',$prdt,' ',$prdt,2,2,1,2,$dtkn,$i);
                        // var_dump($insert);die();
                        // $insert = 1;
                        if ($insert > 0) {
                            $id_log = (!empty($this->input->post('barcode')[$i])) ? $this->input->post('barcode')[$i] : $id_order;
                            $insert = $this->decrease_stock($id_log, trim($pn), $qty_actq_bundle, 1, $this->session->userdata('username'));
                            if (!empty($this->input->post('barcode')[$i])) {
                                $data_status = [
                                    'status' => 'Out'
                                ];
                                $barc_status = "'".$this->input->post('barcode')[$i]."'";
                                $this->Sqlmodel->update('data_whfg_timah',$data_status, 'barc='.$barc_status);
                            }
                        } else {
        
                        }
                    } else {
                        echo 'error2'; die;
                    }
                }
            }
    
            $qty_actq = str_replace(',', '.', $qty_supply);  
    
            $data = array(
                'qty_supply' => $qty_actq,
                'status_supply' => 'Close',
                'closed_supply' => date('Y-m-d H:i:s')
            );
    
            $this->OrderTimahModel->updateKonfirmasi($data, $id_order);
    
            if ($insert > 0) {
                $data = array(
                    'generate_baan' => 1
                );
        
                $this->OrderTimahModel->updateKonfirmasi($data, $id_order);
            }
        } else {
            echo 'error3'; die;
        }

        redirect('order_timah/activity_supply/');
    }

    public function checkQtyBarcode()
    {
        $barc = $this->input->post('barc');
        // $arr_code = explode("-", $barc);

        $delimiters = array(".", "-");
        $arr_code = explode($delimiters[0], str_replace($delimiters, $delimiters[0], $barc));

        if (strlen($arr_code[0]) > 4) {
            $data = $this->OrderTimahModel->checkQtyBarcode($barc);
        } else {
            $year = $arr_code[0];
            $peri = $arr_code[1];
            $code_barc = $arr_code[2];
    
            $data = $this->OrderTimahModel->checkQtyByCode($year, $peri, $code_barc);
        }

        echo json_encode($data);
    }

    public function decrease_stock($id_order, $pn, $qty_actq, $qty_bundle, $user_login)
    {

        $getStockTimah = $this->ProdControl->getStockTimah(trim($pn));
        foreach ($getStockTimah as $gs) {
            $pn             = $gs->pn;
            $currentStock   = $gs->qty_actual;
            $bundle         = $gs->qty_bundle;
        }

        $totalStock = $currentStock-$qty_actq;
        $totalBundle = (int) $bundle - 1;

        $totalStockConvert = str_replace(',', '.', $totalStock); 
        $qty_actqConvert = str_replace(',', '.', $qty_actq); 

        $data = array(
            // 'jumlah_order_actual' => $jumlah_order_actual,
            'qty_actual' => $totalStockConvert,
            'qty_bundle' => $totalBundle
        );

        $pnConvert = "'".trim($pn)."'";

        $resultUpdate = $this->Sqlmodel->update('stock_timah',$data, 'pn='.$pnConvert);       
        
        if ($resultUpdate > 0) {
            $data2 = array(
                // 'jumlah_order_actual' => $jumlah_order_actual,
                'status_trans' => 'Out',
                'id_order' => $id_order,
                'qty_act' => round($qty_actqConvert),
                'pn' => $pn,
                'qty_bundle' => $qty_bundle,
                'user_login' => $this->session->userdata('username'),
            );
    
            $resultUpdate = $this->ProdControl->insert_data_ewip('log_transaction_timah',$data2);
            return true;
        } else {
            return false;
        }
    }

    public function timahInformation()
    {
        $this->load->view('template/header');
		$this->load->view('order_timah/timah_information');
		$this->load->view('template/footer');
    }

    public function checkDetailBarcode()
    {
        $barc = $this->input->post('barcode');
        $data = $this->OrderTimahModel->checkDetailBarcode($barc);

        echo json_encode($data);
    }
}

 ?>