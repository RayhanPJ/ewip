<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Whfg extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->model('WipModel');
		$this->load->model('Sqlmodel');
		$this->load->model('ProdControl');

		if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '3' OR $this->session->userdata('level') == '4' OR $this->session->userdata('level') == '5') {
			echo "";
		} else {
			redirect('login','refresh');			
		}

		$this->output->delete_cache();
    }

    public function index()
    {
        $array = array(
			'fitur' => 'whfg'
		);
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('whfg/prod_scan');
		$this->load->view('template/footer');
    }

    public function forklift_monitoring()
    {
        $array = array(
			'fitur' => 'whfg'
		);
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('whfg/forklift_monitoring');
		$this->load->view('template/footer');
    }

    public function wh_scan()
    {
        $array = array(
			'fitur' => 'whfg'
		);
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('whfg/wh_scan');
		$this->load->view('template/footer');
    }

    public function chg_scan()
    {
        $array = array(
			'fitur' => 'whfg'
		);
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('whfg/chg_scan');
		$this->load->view('template/footer');
    }

    public function addressing()
    {
        $array = array(
			'fitur' => 'whfg'
		);
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('whfg/addressing');
		$this->load->view('template/footer');
    }

    public function list_tr()
    {
        $array = array(
			'fitur' => 'whfg'
		);

        $data['data'] = $this->Sqlmodel->getDataTr();
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('whfg/list_tr',$data);
		$this->load->view('template/footer');
    }

    public function addDataBarcode()
	{
		for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
			$barcode = $this->input->post('barcode')[$i];
			
			if (!empty($barcode)) {
				$cekDuplicate = $this->HomeModel->getBarcodePraTr($barcode);
				if ($cekDuplicate != null) {
                    foreach ($cekDuplicate as $cd) {
                        $data = array(
                            'year' => date('Y'), 
                            'peri' => date('d'),
                            'cwarf' => $cd->CWAR, 
                            'tagn' => $cd->TAGN, 
                            'barc' => $cd->NOTE, 
                            'dsca' => $cd->DSCA, 
                            'item' => $cd->ITEM, 
                            'actq' => $cd->QTY, 
                            'users' => $this->session->userdata('username'),
                            'refcntd' => 1, 
                            'refcntu' => 1, 
                            'status_whfg' => 1, 
                            'generate_baan' => 0, 
                        );
    
                        $result 	=	$this->Sqlmodel->insert_data('data_whfg',$data);	
                        if ($result > 0) {
                            $data2 = array(
                                'status_forklift' => 1,
                            );
            
                            $where = "no_wo = '".$cd->NO_WO."'";
            
                            $result2   =   $this->ProdControl->update('assy_schedule_wo',$data2,$where);
                                   
                            $result3 	=	$this->HomeModel->updateBarcodeWoPraTr($cd->NOTE,$cd->TAGN);
                        } else {

                        }
                    }		
				} else {
					$this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
				}
			} else {

			}
		}
		
		redirect('whfg/index');

	}

    public function wtaBarcode()
	{
        $success = 0;
		for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
			$barcode = $this->input->post('barcode')[$i];
			if (!empty($barcode)) {
                $cekDuplicate = $this->HomeModel->getBarcodePraWta($barcode);
				if ($cekDuplicate != null) {
                    
                    foreach ($cekDuplicate as $cd) {
                        $data = array('status_whfg' => 1,'cwart' => 'KFFGX');

                        $where = "barc = '".$barcode."'";

                        $result 	=	$this->Sqlmodel->update("data_whfg",$data,$where);
                        $result2	=	$this->HomeModel->updateBarcodeWoWta($cd->NOTE,$cd->TAGN);
                        if ($result > 0) {
                            // $result2	=	$this->HomeModel->updateBarcodeWoWta($cd->NOTE,$cd->TAGN);
                            $success++;
                        } else {

                        }
                    }		
				} else {
                    // $this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
                    
                    $cekDuplicatePraTr = $this->HomeModel->getBarcodePraTr($barcode);
                    if ($cekDuplicatePraTr != null) {
                        foreach ($cekDuplicatePraTr as $cd) {
                            $data = array(
                                'year' => date('Y'), 
                                'peri' => date('d'),
                                'cwarf' => $cd->CWAR, 
                                'tagn' => $cd->TAGN, 
                                'barc' => $cd->NOTE, 
                                'dsca' => $cd->DSCA, 
                                'item' => $cd->ITEM, 
                                'actq' => $cd->QTY, 
                                'users' => $this->session->userdata('username'),
                                'refcntd' => 1, 
                                'refcntu' => 1, 
                                'status_whfg' => 1, 
                                'generate_baan' => 0, 
                            );
        
                            $result 	=	$this->Sqlmodel->insert_data('data_whfg',$data);	
                            if ($result > 0) {
                                $data2 = array(
                                    'status_forklift' => 1,
                                );
                
                                $where = "no_wo = '".$cd->NO_WO."'";
                
                                $result2   =   $this->ProdControl->update('assy_schedule_wo',$data2,$where);
                                if ($this->session->userdata('level') == '3') {
                                    $result3	=	$this->HomeModel->updateBarcodeWoWta($cd->NOTE,$cd->TAGN);
                                } else {
                                    $result3 	=	$this->HomeModel->updateBarcodeWoPraTr($cd->NOTE,$cd->TAGN);
                                }
                                $success++;
                            } else {

                            }
                        }		
                    }

                    foreach ($cekDuplicate as $cd2) {
                        $data = array('status_whfg' => 1,'cwart' => 'KFFGX');

                        $where = "barc = '".$barcode."'";

                        $result 	=	$this->Sqlmodel->update("data_whfg",$data,$where);
                        if ($result > 0) {
                            $result2	=	$this->HomeModel->updateBarcodeWoWta($cd2->NOTE,$cd2->TAGN);
                            $success++;
                            // var_dump($result2);die();
                        } else {

                        }
                    }
				}
			} else {

			}
        }
        
        $this->session->set_flashdata('pesan', 'Sukses upload data : '.$success);
		
		redirect('whfg/wh_scan');

    }
    
    public function wtaBarcodeChg()
	{
		for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
			$barcode = $this->input->post('barcode')[$i];
			
			if (!empty($barcode)) {
				$cekDuplicate = $this->HomeModel->getBarcodePraWta($barcode);
                // var_dump($cekDuplicate);die();
				if ($cekDuplicate != null) {
                    
                    foreach ($cekDuplicate as $cd) {
                        $data = array('status_whfg' => 1,'cwart' => 'KPRO2');

                        $where = "barc = '".$barcode."'";

                        $result 	=	$this->Sqlmodel->update("data_whfg",$data,$where);
                        if ($result > 0) {
                            $result2	=	$this->HomeModel->updateBarcodeWoWtaChg($cd->NOTE,$cd->TAGN);
                            // var_dump($result2.'--atas');die();
                        } else {

                        }
                    }		
				} else {
					// $this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
                    $cekDuplicatePraTr = $this->HomeModel->getBarcodePraTr($barcode);
                    // var_dump($cekDuplicatePraTr.'--atas');die();
                    if ($cekDuplicatePraTr != null) {
                        foreach ($cekDuplicatePraTr as $cd) {
                            $data = array(
                                'year' => date('Y'), 
                                'peri' => date('d'),
                                'cwarf' => $cd->CWAR, 
                                'tagn' => $cd->TAGN, 
                                'barc' => $cd->NOTE, 
                                'dsca' => $cd->DSCA, 
                                'item' => $cd->ITEM, 
                                'actq' => $cd->QTY, 
                                'cwart' => 'KPRO2', 
                                'users' => $this->session->userdata('username'),
                                'refcntd' => 1, 
                                'refcntu' => 1, 
                                'status_whfg' => 1, 
                                'generate_baan' => 0, 
                            );
        
                            $result 	=	$this->Sqlmodel->insert_data('data_whfg',$data);	
                            // var_dump($result);die();
                            if ($result > 0) {
                                $data2 = array(
                                    'status_forklift' => 1,
                                );
                
                                $where = "no_wo = '".$cd->NO_WO."'";
                
                                $result2   =   $this->ProdControl->update('assy_schedule_wo',$data2,$where);

                                $result3	=	$this->HomeModel->updateBarcodeWoWtaChg($cd->NOTE,$cd->TAGN);
                                    
                                // $result3 	=	$this->HomeModel->updateBarcodeWoPraTr($cd->NOTE,$cd->TAGN);
                            } else {

                            }
                        }		
                    } else {
                        // var_dump('else');die();
                        foreach ($cekDuplicate as $cd2) {
                            $data = array('status_whfg' => 1,'cwart' => 'KPRO2');
    
                            $where = "barc = '".$barcode."'";
    
                            $result 	=	$this->Sqlmodel->update("data_whfg",$data,$where);
                            // var_dump($result.'--update-luar');die();
                            if ($result > 0) {
                                $result2	=	$this->HomeModel->updateBarcodeWoWtaChg($cd2->NOTE,$cd2->TAGN);
                                // var_dump($result2.'--bawah');die();
                            } else {
    
                            }
                        }
                    }

                    
				}
			} else {

			}
		}
		
		redirect('whfg/chg_scan');

	}

    public function addressingBarcode()
	{
		$param = $this->input->post('status_wh');

        if ($param == 'check_in') {
            for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
                $barcode = $this->input->post('barcode')[$i];
                
                if (!empty($barcode)) {
                    $cekDuplicate = $this->HomeModel->getBarcodePraTr($barcode);
                    if ($cekDuplicate != null) {
                        foreach ($cekDuplicate as $cd) {
                            $data = array(
                                'address_wh' => $this->input->post('address_wh')[$i],
                                'status_address' => 'check_in',
                                'check_in' => date('Y-m-d H:i:s')                 
                            );
    
                            $where = "barc = '".$barcode."'";
    
                            $result2 	=	$this->Sqlmodel->update("data_whfg",$data,$where);

                            $data2 = array(
                                'status_address' => 'fill',              
                            );
    
                            $where2 = "address = '".$this->input->post('address_wh')[$i]."'";
    
                            $result3 	=	$this->Sqlmodel->update("address_wh",$data2,$where2);
                        }		
                    } else {
                        $this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
                    }
                } else {
    
                }
            }
        } else {
            for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
                $barcode = $this->input->post('barcode')[$i];
                
                if (!empty($barcode)) {
                    $cekDuplicate = $this->HomeModel->getBarcodePraTr($barcode);
                    if ($cekDuplicate != null) {
                        foreach ($cekDuplicate as $cd) {
                            $data = array(
                                'status_address' => 'check_out',
                                'check_out' => date('Y-m-d H:i:s')                 
                            );
    
                            $where = "barc = '".$barcode."'";
    
                            $result2 	=	$this->Sqlmodel->update("data_whfg",$data,$where);

                            $data2 = array(
                                'status_address' => 'none',              
                            );
    
                            $where2 = "address = '".$this->input->post('address_wh')[$i]."'";
    
                            $result3 	=	$this->Sqlmodel->update("address_wh",$data2,$where2);
                        }		
                    } else {
                        $this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
                    }
                } else {
    
                }
            }
        }
		
		redirect('whfg/index');

	}

    public function getBarcodeId()
    {
        $barc = $_GET['barc'];

        $data['results'] = $this->HomeModel->getBarcodePraTr($barc);  
        echo json_encode( $data, JSON_NUMERIC_CHECK );
    }
    
    public function getBarcodeIdCheck()
    {
        $barc = $_GET['barc'];

        $data['results'] = $this->HomeModel->getBarcodeIdCheck($barc);  
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function cekBarcodeId()
    {
        $barc = $_GET['barc'];

        $data['results'] = $this->Sqlmodel->cekBarcodePraTr($barc);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function getDataPN()
    {
        $pn = $_GET['pn'];

        $data['results'] = $this->HomeModel->getDetailPn($pn);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}
}

/* End of file Wip.php */
 ?>