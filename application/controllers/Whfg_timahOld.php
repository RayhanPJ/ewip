<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Whfg_timah extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->model('WipModel');
		$this->load->model('Sqlmodel');
		$this->load->model('ProdControl');

        // header("Location: https://10.19.16.22/e-wip/", true, 301);

		if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '3' OR $this->session->userdata('level') == '4' OR $this->session->userdata('level') == '7') {
			echo "";
		} else {
			redirect('login','refresh');			
		}

		$this->output->delete_cache();
    }

    public function getLastDataReceived($no_dn)
    {
        $data['results'] = $this->ProdControl->getLastDataReceived($no_dn);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
    }

    public function getLastWeight()
    {
        $data['results'] = $this->ProdControl->lastQtyLead();    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
    }

    public function list_receipt()
    {
        $data['data2']   =   $this->ProdControl->getDataReceipt();
        $this->load->view('template/header');
		$this->load->view('whfg_timah/list_receipt', $data);
		$this->load->view('template/footer');
    }

    public function print_receipt($id)
    {
        $data['data']   =   $this->ProdControl->getDataScan($id);
		$this->load->view('whfg_timah/print', $data);
    }

    public function print_receipt_adj($id)
    {
        $data['data']   =   $this->ProdControl->getDataScan($id);
		$this->load->view('whfg_timah/print_adj', $data);
    }

    public function index()
    {
        $array = array(
			'fitur' => 'wh_timah'
		);
		
		$this->session->set_userdata( $array );

        $this->load->view('template/header');
		$this->load->view('whfg_timah/scan_dn');
		$this->load->view('template/footer');
    }

    public function adj()
    {
        $array = array(
			'fitur' => 'wh_timah'
		);
		
		$this->session->set_userdata( $array );

        $this->load->view('template/header');
		$this->load->view('whfg_timah/scan_dn_adj');
		$this->load->view('template/footer');
    }

    public function getDataDn($id='')
    {
        if ($id == NULL) {
            $noDn = $this->input->post('no_dn');
        } else {
            $noDn = $id;
        }        

        $data['data'] = $this->ProdControl->getLineDn(strtoupper($noDn));
        $data['data2'] = $this->ProdControl->getLineDnSummary(strtoupper($noDn));
        // var_dump($data['data']);die();

        $array = array(
			'fitur' => 'whfg',
			'no_dn' => $noDn
		);
		
		$this->session->set_userdata( $array );

        $this->load->view('template/header');
		$this->load->view('whfg_timah/whfg_receipt',$data);
		$this->load->view('template/footer');
    }

    public function getDataDnAdj($id='')
    {
        if ($id == NULL) {
            $noDn = $this->input->post('no_dn');
        } else {
            $noDn = $id;
        }        

        $data['data'] = $this->ProdControl->getLineDn(strtoupper($noDn));
        $data['data2'] = $this->ProdControl->getLineDnSummary(strtoupper($noDn));
        // var_dump($data['data']);die();

        foreach ($data['data'] as $d) { 
            $po = $d->PO; 
            $pono = $d->PONO; 
            $nodn = $d->NODN; 
            $item = $d->ITEM; 
            $qty = $d->QTY;
        }

        $this->session->set_userdata('po',$po);	
        $this->session->set_userdata('pono',$pono);	
        $this->session->set_userdata('nodn',$nodn);	
        $this->session->set_userdata('pn',$item);

        // var_dump($this->session->userdata('pn'));die();

        $array = array(
			'fitur' => 'whfg',
			'no_dn' => $noDn
		);
		
		$this->session->set_userdata( $array );

        $this->load->view('template/header');
		$this->load->view('whfg_timah/whfg_receipt_adj',$data);
		$this->load->view('template/footer');
    }

    public function addDataTimah()
    {
        $line_dn    = $this->input->post('line_dn');
        $qty_scan   = $this->input->post('qty_lead');
        $cekQtyScan = $this->ProdControl->cekLastQtyScan();
        foreach ($cekQtyScan as $cqs) {
            $lastQty = $cqs->actq;
            $lastDate = $cqs->created_at;
        }
        $date1 = new DateTime($lastDate);
        $date2 = new DateTime(date('Y-m-d H:i:s'));
        $diff_mins = abs($date1->getTimestamp() - $date2->getTimestamp()) / 60;
        if ($diff_mins < 1 AND $lastQty == $qty_scan) {
            echo json_encode(array(
                "statusCode"=>201
            ));
        } else {
            $dataDn     = explode("|",$line_dn);
            $po         = $dataDn[0];
            $pono       = $dataDn[1];
            $nodn       = $dataDn[2];
            $pn_item    = $dataDn[3];
            $cekTagn    = $this->ProdControl->cekDnTransaction($po,$pono,$nodn);
            if ($cekTagn == NULL) {
                $tagn = '';
                $uniq_code = '';
            } else {
                $tag = $cekTagn[0]['tagn'];
                $uniq_code = $cekTagn[0]['uniq_code'];
                if ($tag != NULL) {
                    $tagn = $tag+1;
                    $uniq_code = $uniq_code+1;
                } else {
                    $tagn = 1;
                    $uniq_code = 1;
                }
            }

            $dn         = $this->ProdControl->getLineDnDetail($nodn);
            foreach ($dn as $d) {
                    
                if ($d->BP == 'SPRGS0044') {
                    $cwar = 'K-NFU';
                } elseif ($d->BP == 'SPRGS0023') {
                    $cwar = 'K-IML';
                } elseif ($d->BP == 'SPRGS0034') {
                    $cwar = 'K-KRB';
                } elseif ($d->BP == '') {
                    $cwar = 'K-EMA';
                } elseif ($d->BP == 'SNPGS0570') {
                    $cwar = 'K-NFU';
                } elseif ($d->BP == 'SNPCB1478') {
                    $cwar = 'K-NFU';
                } elseif ($d->BP == 'SNPFA0213') {
                    $cwar = 'K-NFU';
                }

            }

            //=================================================//
            $getCodeBarc = $this->ProdControl->getCodeBarc(date('Y'),date('m'));
            if ($getCodeBarc == NULL) {
                $codeBarc = 1;
                $cekbulan = date('m');
            } else {
                $codeBarc = $getCodeBarc[0]['code_barc'];
                $cekbulan = $getCodeBarc[0]['peri'];
            }

            if ($cekbulan != date('m')) {
                
            } else {
                
                if ((int)$codeBarc < 10) {
                    $tambahan = '0000';
                } elseif ((int)$codeBarc < 100) {
                    $tambahan = '000';
                } elseif ((int)$codeBarc < 1000) {
                    $tambahan = '00';
                } elseif ((int)$codeBarc < 10000) {
                    $tambahan = '00';
                    $tambahan = '';
                } elseif ((int)$codeBarc < 100000) {
                    $tambahan = '';
                }
                
                $searchCean = $this->ProdControl->searchCean($pn_item);
                foreach ($searchCean as $sc) {
                    $cean = $sc->CEAN;
                }

                $prefiks1 = date('ym');
                $prefiks2 = 'T';
                $prefiks3 = $tambahan;
                $prefiks4 = (int)$codeBarc+1;
                $prefiks5 = $cwar;
                $prefiks6 = $cean;

                $barc = $prefiks1.''.$prefiks2.''.$tambahan.''.$prefiks4.''.$prefiks5.''.$prefiks6;

            }

            //================================================//    

            if (trim($pn_item) == 'SM-LEAL-SB17S') {
                $pn_item = 'SM-LEAL-SB17';
            } else {
                $pn_item = $pn_item;
            }
            
            $updateStockLead = $this->increase_stock($barc, trim($pn_item), $qty_scan, 1, $this->session->userdata('username'));

            if ($updateStockLead == TRUE) {
                $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    
                $config['cacheable']    = true; //boolean, the default is true
                $config['cachedir']     = './assets/'; //string, the default is application/cache/
                $config['errorlog']     = './assets/'; //string, the default is application/logs/
                $config['imagedir']     = './assets/img_qr/'; //direktori penyimpanan qr code
                $config['quality']      = true; //boolean, the default is true
                $config['size']         = '1024'; //interger, the default is 1024
                $config['black']        = array(224,255,255); // array, default is array(255,255,255)
                $config['white']        = array(70,130,180); // array, default is array(0,0,0)
                $this->ciqrcode->initialize($config);
        
                $image_name=$barc.'.png'; //buat name dari qr code sesuai dengan nim
        
                $params['data'] = $barc; //data yang akan di jadikan QR CODE
                $params['level'] = 'H'; //H=High
                $params['size'] = 10;
                $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
                $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        
                foreach ($dn as $d) {
    
                    $qty_actq = str_replace(array('.', ','), array('.', '.'), $qty_scan); 
    
                    $data = array(
                        'year' => date('Y'), 
                        'peri' => date('m'),
                        'cwarf' => $cwar, 
                        'orno' => $d->PO, 
                        'pono' => $d->PONO, 
                        'no_dn' => $d->NODN, 
                        'tagn' => $tagn, 
                        'barc' => $barc, 
                        'dsca' => ' ', 
                        'item' => $d->ITEM, 
                        'actq' => $qty_actq, 
                        'sysqty' => $d->QTY, 
                        'code_barc' => $prefiks4, 
                        'users' => $this->session->userdata('username'),
                        'refcntd' => 1, 
                        'refcntu' => 1, 
                        'status_whfg_timah' => 1, 
                        'generate_baan' => 0, 
                        'qr_code' => $image_name,
                        'uniq_code' => $uniq_code
                    );
            
                    $result 	=	$this->Sqlmodel->insert_data('data_whfg_timah',$data);	
                }
                
                if ($result > 0) {
                    // redirect('whfg_timah/print_receipt/'.$barc);
                    echo json_encode(array(
                        "statusCode"=>200
                    ));
                } else {
                    echo json_encode(array(
                        "statusCode"=>201
                    ));
                }
            } else {
                echo json_encode(array(
                    "statusCode"=>201
                ));
            }
        }
        
    }

    public function addDataTimahAdj()
    {
        $line_dn    = $this->input->post('line_dn');
        $qty_scan_adj    = $this->input->post('qty_adj');
        if ($qty_scan_adj == NULL) {
            $qty_scan    = $this->input->post('qty_lead');
        } else {
            $qty_scan    = $this->input->post('qty_adj');
        }
        $dataDn     = explode("|",$line_dn);
        $po         = $dataDn[0];
        $pono       = $dataDn[1];
        $nodn       = $dataDn[2];
        $pn_item    = $dataDn[3];
        $this->session->set_userdata('po',$po);	
        $this->session->set_userdata('pono',$pono);	
        $this->session->set_userdata('nodn',$nodn);	
        $this->session->set_userdata('pn',$pn_item);	
        $cekTagn    = $this->ProdControl->cekDnTransaction($po,$pono,$nodn);
        if ($cekTagn == NULL) {
            $tagn = 0;
            $uniq_code = 0;
        } else {
            $tag = $cekTagn[0]['tagn'];
            $uniq_code = $cekTagn[0]['uniq_code'];
            if ($tag != NULL) {
                $tagn = $tag+1;
                $uniq_code = $uniq_code+1;
            } else {
                $tagn = 1;
                $uniq_code = 1;
            }
        }

        $dn         = $this->ProdControl->getLineDnDetail($nodn);
        foreach ($dn as $d) {
                
            if ($d->BP == 'SPRGS0044') {
                $cwar = 'K-NFU';
            } elseif ($d->BP == 'SPRGS0023') {
                $cwar = 'K-IML';
            } elseif ($d->BP == 'SPRGS0034') {
                $cwar = 'K-KRB';
            } elseif ($d->BP == '') {
                $cwar = 'K-EMA';
            } elseif ($d->BP == 'SNPGS0570') {
                $cwar = 'K-NFU';
            } elseif ($d->BP == 'SNPCB1478') {
                $cwar = 'K-NFU';
            } elseif ($d->BP == 'SNPFA0213') {
                $cwar = 'K-NFU';
            }

        }

        //=================================================//
        $getCodeBarc = $this->ProdControl->getCodeBarc(date('Y'),date('m'));
        
        
        if ($getCodeBarc == NULL) {
            $codeBarc = 0;
            $cekbulan = date('m');
        } else {
            $codeBarc = $getCodeBarc[0]['code_barc'];
            $cekbulan = $getCodeBarc[0]['peri'];
        }

        if ($cekbulan != date('m')) {
            
        } else {
            if ((int)$codeBarc < 10) {
                $tambahan = '0000';
            } elseif ((int)$codeBarc < 100) {
                $tambahan = '000';
            } elseif ((int)$codeBarc < 1000) {
                $tambahan = '00';
            } elseif ((int)$codeBarc < 10000) {
                $tambahan = '00';
                $tambahan = '';
            } elseif ((int)$codeBarc < 100000) {
                $tambahan = '';
            }

            
            $searchCean = $this->ProdControl->searchCean($pn_item);
            foreach ($searchCean as $sc) {
                $cean = $sc->CEAN;
            }

            $prefiks1 = date('ym');
            $prefiks2 = 'T';
            $prefiks3 = $tambahan;
            $prefiks4 = (int)$codeBarc+1;
            $prefiks5 = $cwar;
            $prefiks6 = $cean;


            // var_dump($prefiks4);die();

            $barc = $prefiks1.''.$prefiks2.''.$tambahan.''.$prefiks4.''.$prefiks5.''.$prefiks6;

        }

        //================================================//   
        
        if (trim($pn_item) == 'SM-LEAL-SB17S') {
            $pn_item = 'SM-LEAL-SB17';
        } else {
            $pn_item = $pn_item;
        }

        $updateStockLead = $this->increase_stock($barc, trim($pn_item), $qty_scan, 1, $this->session->userdata('username'));

        if ($updateStockLead == TRUE) {
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    
            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/img_qr/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224,255,255); // array, default is array(255,255,255)
            $config['white']        = array(70,130,180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);
    
            $image_name=$barc.'.png'; //buat name dari qr code sesuai dengan nim
    
            $params['data'] = $barc; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    
            foreach ($dn as $d) {

                $qty_actq = str_replace(array('.', ','), array('', '.'), $qty_scan); 
                // var_dump($qty_scan);die();

                $data = array(
                    'year' => date('Y'), 
                    'peri' => date('m'),
                    'cwarf' => $cwar, 
                    'orno' => $d->PO, 
                    'pono' => $d->PONO, 
                    'no_dn' => $d->NODN, 
                    'tagn' => $tagn, 
                    'barc' => $barc, 
                    'dsca' => ' ', 
                    'item' => $pn_item, 
                    'actq' => $qty_scan, 
                    'sysqty' => $d->QTY, 
                    'users' => $this->session->userdata('username'),
                    'refcntd' => 1, 
                    'refcntu' => 1, 
                    'status_whfg_timah' => 1, 
                    'generate_baan' => 0, 
                    'qr_code' => $image_name,
                    'code_barc' => $prefiks4,
                    'uniq_code' => $uniq_code,
                    'status' => 'On Hand'
                );
                
        
                $result 	=	$this->Sqlmodel->insert_data('data_whfg_timah',$data);	
                // var_dump($result);die();
            }
            
            if ($result > 0) {
                redirect('whfg_timah/print_receipt_adj/'.$barc);
            } else {
                redirect('whfg_timah/print_receipt_adj/'.$barc);
            }
        } else {
            redirect('whfg_timah/print_receipt_adj/'.$barc);
        }
    }

    public function whfg_receipt($po,$bp)
    {
        $array = array(
			'fitur' => 'whfg'
		);
		
		$this->session->set_userdata( $array );

        if ($bp == 'SPRGS0044') {
            $data['whfrom'] = 'K-NFU';
        } elseif ($bp == 'SPRGS0023') {
            $data['whfrom'] = 'K-IML';
        } elseif ($bp == 'SPRGS0034') {
            $data['whfrom'] = 'K-KRB';
        } elseif ($bp == '') {
            $data['whfrom'] = 'K-EMA';
        }

        $data['data'] = $this->ProdControl->getLinePo($po);
        // var_dump($data['data']);die();

        $this->load->view('template/header');
		$this->load->view('whfg_timah/whfg_receipt',$data);
		$this->load->view('template/footer');
    }

    public function delete($barc){
        $getDataDn = $this->Sqlmodel->getDataDnTransaction($barc);
        foreach ($getDataDn as $gd) {
            $barc = $gd->barc;
            $pn_item = $gd->item;
            $qty_scan = $gd->actq;
        }

        $updateStockLead = $this->decrease_stock($barc, trim($pn_item), round($qty_scan), 1, $this->session->userdata('username'),'delete');

        if ($updateStockLead == TRUE) {
            $where=array('barc'=>$barc);
            $this->Sqlmodel->hapus_data($where,'data_whfg_timah');
            redirect('whfg_timah/list_receipt');
        } else {
            redirect('whfg_timah/list_receipt');
        }        
    }

    public function lead_stock()
    {
        $array = array(
			'fitur' => 'whfg'
        );
        
        $this->session->set_userdata( $array );
		
        $this->load->view('template/header');
		$this->load->view('whfg_timah/lead_stock');
		$this->load->view('template/footer');
    }

    public function increase_stock($id_order, $pn, $qty_actq, $qty_bundle, $user_login, $status_trans='')
    {
        $getStockTimah = $this->ProdControl->getStockTimah($pn);
        foreach ($getStockTimah as $gs) {
            $pn             = $gs->pn;
            $currentStock   = $gs->qty_actual;
            $bundle         = $gs->qty_bundle;
        }

        $totalStock = $currentStock+$qty_actq;
        $totalBundle = $bundle+$qty_bundle;

        $totalStockConvert = str_replace(',', '.', $totalStock); 

        $data = array(
            'qty_actual' => $totalStockConvert,
            'qty_bundle' => $totalBundle
        );

        $pnConvert = "'".trim($pn)."'";

        $resultUpdate = $this->Sqlmodel->update('stock_timah',$data, 'pn='.$pnConvert);

        if ($resultUpdate > 0) {
            if ($status_trans != '') {
                $data = array(
                    // 'jumlah_order_actual' => $jumlah_order_actual,
                    'status_trans' => 'Delete',
                    'id_order' => $id_order,
                    'qty_act' => $qty_actq,
                    'pn' => $pn,
                    'qty_bundle' => $qty_bundle,
                    'user_login' => $this->session->userdata('username'),
                );
            } else {
                $data = array(
                    // 'jumlah_order_actual' => $jumlah_order_actual,
                    'status_trans' => 'In',
                    'id_order' => $id_order,
                    'qty_act' => $qty_actq,
                    'pn' => $pn,
                    'qty_bundle' => $qty_bundle,
                    'user_login' => $this->session->userdata('username'),
                );
            }        
    
            $resultUpdate = $this->ProdControl->insert_data_ewip('log_transaction_timah',$data);

            return true;
        } else {
            return false;
        }
    }

    public function decrease_stock($id_order, $pn, $qty_actq, $qty_bundle, $user_login, $status_trans='')
    {

        $getStockTimah = $this->ProdControl->getStockTimah(trim($pn));
        foreach ($getStockTimah as $gs) {
            $pn             = $gs->pn;
            $currentStock   = $gs->qty_actual;
            $bundle         = $gs->qty_bundle;
        }

        $totalStock = $currentStock-$qty_actq;
        $totalBundle = $bundle-$qty_bundle;

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
            if ($status_trans != '') {
                $data = array(
                    // 'jumlah_order_actual' => $jumlah_order_actual,
                    'status_trans' => 'Delete',
                    'id_order' => $id_order,
                    'qty_act' => round($qty_actqConvert),
                    'pn' => $pn,
                    'qty_bundle' => $qty_bundle,
                    'user_login' => $this->session->userdata('username'),
                );
            } else {
                $data = array(
                    // 'jumlah_order_actual' => $jumlah_order_actual,
                    'status_trans' => 'Out',
                    'id_order' => $id_order,
                    'qty_act' => $qty_actqConvert,
                    'pn' => $pn,
                    'qty_bundle' => $qty_bundle,
                    'user_login' => $this->session->userdata('username'),
                );
            }      
    
            $resultUpdate = $this->ProdControl->insert_data_ewip('log_transaction_timah',$data);
            return true;
        } else {
            return false;
        }
    }

    public function report_dn($tanggal='')
    {
        if ($tanggal == NULL) {
            $tanggal = date('Y-m-d');
        }
        $data['month'] = $tanggal;
        $data['data'] = $this->ProdControl->reportDn($tanggal);
        $this->load->view('template/header');
		$this->load->view('whfg_timah/report_dn',$data);
		$this->load->view('template/footer');
    }
}

/* End of file Wip.php */
 ?>