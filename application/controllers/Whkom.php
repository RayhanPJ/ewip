<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Whkom extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->model('WipModel');
		$this->load->model('Sqlmodel');

		if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '3' OR $this->session->userdata('level') == '4') {
			echo "";
		} else {
			redirect('login','refresh');			
		}

		// header("Cache-Control: no-cache, must-revalidate");
		// header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		// header("Content-Type: application/xml; charset=utf-8");

		$this->output->delete_cache();
    }

	public function dashboard()
	{
		// $data['data'] = $this->HomeModel->cekReservasiWo($param='R22');
		$data['data'] = $this->HomeModel->getWo('KAS');

		$this->load->view('template/header');
		$this->load->view('whkom/dashboard', $data);
		$this->load->view('template/footer');
	}
	
	public function dashboard_kab()
	{
		// $data['data'] = $this->HomeModel->cekReservasiWo($param='R22');
		$data['data'] = $this->HomeModel->getWo('KAB');

		$this->load->view('template/header');
		$this->load->view('whkom/dashboard', $data);
		$this->load->view('template/footer');
	}

	public function dashboard_klc()
	{
		// $data['data'] = $this->HomeModel->cekReservasiWo($param='R22');
		$data['data'] = $this->HomeModel->getWo('KLC');

		$this->load->view('template/header');
		$this->load->view('whkom/dashboard', $data);
		$this->load->view('template/footer');
	}

	public function dashboard_kav()
	{
		// $data['data'] = $this->HomeModel->cekReservasiWo($param='R22');
		$data['data'] = $this->HomeModel->getWo('KAV');

		$this->load->view('template/header');
		$this->load->view('whkom/dashboard', $data);
		$this->load->view('template/footer');
	}

	public function update_transaksi()
	{
		$array = array(
			'fitur' => 'update_transaksi'
		);

		$data['data'] = $this->Sqlmodel->getDataTrWhkomUpdate();  
		
		$this->session->set_userdata( $array );
		$this->load->view('template/header');
		$this->load->view('whkom/update_transaksi', $data);
		$this->load->view('template/footer');
	}

	public function edit($barc)
	{
		$array = array(
			'fitur' => 'wip'
		);

		$data['data'] = $this->Sqlmodel->getDetailTr($barc);  
		
		$this->session->set_userdata( $array );
		$this->load->view('template/header');
		$this->load->view('whkom/edit_tr', $data);
		$this->load->view('template/footer');
	}

	public function edit_do()
	{
		$data = array('actq' => $this->input->post('actq'));
		$where = "barc = '".$this->input->post('barc')."'";
		$result2 	=	$this->Sqlmodel->update("data_whkom",$data,$where);
		if ($result2 > 0) {
			$barc_exp = explode("-",$this->input->post('barc'));
			$result3 	=	$this->HomeModel->updateQtyBarcode($barc_exp[0],$barc_exp[1],$this->input->post('actq'));			
			$this->session->set_flashdata('pesan', 'Berhasil Update');
		} else {
			$this->session->set_flashdata('pesan', 'Gagal Update');
		}

		redirect('whkom/list_tr');
	}

    public function cekBarcode()
	{
        $data['data'] = $this->WipModel->cekBarcode($this->input->post('barcode'));
        // var_dump($data['data']);die();
		$this->load->view('template/header');
		$this->load->view('whkom/cekBarcode', $data);
		$this->load->view('template/footer');
	}

	public function input()
	{
		$this->session->set_userdata('username',$this->input->post('user'));		
		
		redirect('whkom/index');
		
	}

    public function index()
    {
        $array = array(
			'fitur' => 'wip'
		);
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('home/batch');
		// $this->load->view('home/index');
		$this->load->view('template/footer');
    }

	public function batch()
    {
        $array = array(
			'fitur' => 'wip'
		);

		$data['data'] = $this->Sqlmodel->getDataTrWhkomUsers('whkom',$this->session->userdata('username'));  
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('whkom/whkom_scan', $data);
		$this->load->view('template/footer');
    }

	public function batch_prod()
    {
        $array = array(
			'fitur' => 'wip'
		);

		$data['data'] = $this->Sqlmodel->getDataTrWhkomUsers('prod',$this->session->userdata('username'));  
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('whkom/prod_scan', $data);
		$this->load->view('template/footer');
    }

	public function list_tr()
	{
		$start = date('Ymd');

		$npk = $this->session->userdata('npk');

		$data['data'] = $this->Sqlmodel->getDataTrWhkom();  
		// var_dump($data['data']);die();

		$this->load->view('template/header');
		$this->load->view('whkom/list_tr', $data);
		$this->load->view('template/footer');
	}

	public function detail_reservasi($barc)
	{
		$data['data'] = $this->HomeModel->getDetailWoReservasi($barc);

		$this->load->view('template/header');
		$this->load->view('whkom/detail_reservasi', $data);
		$this->load->view('template/footer');
	}

	public function getBarcodeId()
    {
        $pono = $_GET['pono'];
        $pos = $_GET['pos'];

        $data['results'] = $this->HomeModel->getBarcodeReservasiWo($pono,$pos);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function cekBarcodeId()
    {
        $pn = $_GET['pn'];

        $data['results'] = $this->Sqlmodel->cekBarcodeReservasi($pn);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function getDataPN()
    {
        $pn = $_GET['pn'];

        $data['results'] = $this->HomeModel->getDetailPn($pn);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function addDataBarcode()
	{
		for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
			$barcode = $this->input->post('barcode')[$i];

			$barc_exp = explode("-",$barcode);
		
			$this->session->set_userdata( $array );

			if (!empty($barcode)) {
				$cekDuplicate = $this->Sqlmodel->cekBarcodeReservasi($barcode);
				// var_dump($this->input->post('barcode')[1]);die();
				if ($cekDuplicate == null) {
					$cekbarcode = $this->HomeModel->getBarcodeReservasiWo($barc_exp[0],$barc_exp[1]);
					
					if ($cekbarcode == null) {
						$this->session->set_flashdata('pesan', 'Barcode Tidak Terdeteksi');
					} else {
						foreach ($cekbarcode as $cb) {
							$actq = $cb->QTY;
							$note = $cb->PONO.'-'.$cb->POS;
							$dsca = $cb->DESC;
							$item = $cb->ITEM;
							$tagn = $cb->PONO;
							$whto = $cb->WHTO;
							$whfrom = $cb->WHFROM;
						}
		
						$start = date('Y/m/d H:i:s');
						$date = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));
	
						$data = array(
							'year' => date('Y'), 
							'peri' => date('d'), 
							'cwarf' => $whfrom, 
							'cwart' => $whto, 
							'tagn' => $tagn, 
							'barc' => $note, 
							'dsca' => $dsca, 
							'item' => $item, 
							'actq' => $actq, 
							'users' => $this->session->userdata('username'),
							'refcntd' => 1, 
							'refcntu' => 1, 
							'status_whkom' => 1, 
							'generate_baan' => 0, 
						);
	
						$result 	=	$this->Sqlmodel->insert_data('data_whkom',$data);
						if ($result > 0) {
							$barc_exp = explode("-",$note);
							$result2 	=	$this->HomeModel->updateBarcodeReservasiWoKom($barc_exp[0],$barc_exp[1],$note);
							$this->session->set_flashdata('pesan', 'Berhasil di Scan');
						} else {

						}
					}
					
				} else {
					$this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
				}
			} else {

			}
		}
		
		redirect('whkom/batch');

	}

	public function addDataBarcodeNew()
	{
		for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
			$barcode = $this->input->post('barcode')[$i];
			
			if (!empty($barcode)) {
				$cekbarcode = $this->HomeModel->getBarcodeComp($barcode);

					foreach ($cekbarcode as $cb) {
						$actq = $cb['T$ADMQ'];
						$note = $cb['T$NOTE'];
						$dsca = $cb['T$DSCA'];
						$item = $cb['T$ITEM'];
						$tagn = $cb['T$TAGN'];
						$whto = 'KPRO2';
						$whfrom = 'KWMTX';
						$year = $cb['T$YEAR'];
						$peri = $cb['T$PERI'];
					}
	
					$data = array(
						'year' => $year, 
						'peri' => $peri, 
						'cwarf' => $whfrom, 
						'cwart' => $whto, 
						'tagn' => $tagn, 
						'barc' => $note, 
						'dsca' => $dsca, 
						'item' => $item, 
						'actq' => $actq, 
						'users' => $this->session->userdata('username')
					);

					$result = $this->Sqlmodel->insert_data('data_whkom',$data);	

					if ($result > 0) {
						// Hit API
						$api_url = 'https://portal3.incoe.astra.co.id/production_control_v2/public/api/update_generate_tr_component/'.$note;
						$response = file_get_contents($api_url);
					}
			}
		}
				redirect('whkom/batch');
	}

	public function update_produksi_scan()
	{
		for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
			$barcode = $this->input->post('barcode')[$i];

			$barc_exp = explode("-",$barcode);

			if (!empty($barcode)) {
				$cekDataBcd = $this->Sqlmodel->cekBcdTrWh($barcode);
				if (empty($cekDataBcd)) {
					//insert data baru
					$cekbarcode = $this->HomeModel->getBarcodeReservasiWo($barc_exp[0],$barc_exp[1]);
					
					if ($cekbarcode == null) {
						$this->session->set_flashdata('pesan', 'Barcode Tidak Terdeteksi');
					} else {
						foreach ($cekbarcode as $cb) {
							$actq = $cb->QTY;
							$note = $cb->PONO.'-'.$cb->POS;
							$dsca = $cb->DESC;
							$item = $cb->ITEM;
							$tagn = $cb->PONO;
							$whto = $cb->WHTO;
							$whfrom = $cb->WHFROM;
						}
		
						$start = date('Y/m/d H:i:s');
						$date = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));
	
						$data = array(
							'year' => date('Y'), 
							'peri' => date('d'), 
							'cwarf' => $whfrom, 
							'cwart' => $whto, 
							'tagn' => $tagn, 
							'barc' => $note, 
							'dsca' => $dsca, 
							'item' => $item, 
							'actq' => $actq, 
							'users' => $this->session->userdata('username'),
							'refcntd' => 1, 
							'refcntu' => 1, 
							'status_whkom' => 1, 
							'generate_baan' => 0, 
						);
	
						$result 	=	$this->Sqlmodel->insert_data('data_whkom',$data);
						if ($result > 0) {
							$barc_exp = explode("-",$note);
							$result2 	=	$this->HomeModel->updateBarcodeReservasiWoKom($barc_exp[0],$barc_exp[1],$note);
							$this->session->set_flashdata('pesan', 'Berhasil di Scan');
						} else {

						}

						$data2 = array('status_whkom' => 3);

						$where2 = "barc = '".$barcode."'";

						$result2 	=	$this->Sqlmodel->update("data_whkom",$data2,$where2);

						if ($result2 > 0) {
							$this->session->set_flashdata('pesan', 'Berhasil di Scan');
						} else {
							$this->session->set_flashdata('pesan', 'Gagal di Scan');
						}
					}
				} else {
					$data = array('status_whkom' => 3);

					$where = "barc = '".$barcode."'";

					$result2 	=	$this->Sqlmodel->update("data_whkom",$data,$where);

					if ($result2 > 0) {
						$this->session->set_flashdata('pesan', 'Berhasil di Scan');
					} else {
						$this->session->set_flashdata('pesan', 'Gagal di Scan');
					}
				}
			} else {

			}
		}
		
		redirect('whkom/batch_prod');
	}

	public function upload_scan()
	{
		$getData = $this->Sqlmodel->getReservasiScan();
		foreach ($getData as $gd) {
			$barc_exp = explode("-",$gd->barc);
			$result 	=	$this->HomeModel->updateBarcodeReservasiWo($barc_exp[0],$barc_exp[1],$gd->barc);
			if ($result == true) {
				$data = array('generate_baan' => 1);
	
				$where = "barc = '".$gd->barc."'";
	
				$result2 	=	$this->Sqlmodel->update("data_whkom",$data,$where);
				$this->session->set_flashdata('pesan', 'Barcode Berhasil di Upload');
			} else {
				$this->session->set_flashdata('pesan', 'Barcode Gagal di Upload');
			}
		}

		redirect('whkom/batch_prod');
	}

	function do_export_pengecekan()
	{
		$judul = "Data Pengecekan";

		$heading=array('No','ID Apar','Nama Apar','Pin Pengaman','Kawat Segel','Selang Apar','Nozel Apar','Kondisi Tabung','Created At');
		$this->load->library('PHPExcel');
		//Create a new Object
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getActiveSheet()->setTitle($judul);

		$objPHPExcel->getProperties()->setCreator("Rinta Setyon")
							->setLastModifiedBy("Rinta Setyon")
							->setTitle("Office 2007 XLSX Test Document")
							->setSubject("Office 2007 XLSX Test Document")
							->setDescription("Test document for Office 2007 XLSX.")
							->setKeywords("office 2007 openxml php")
							->setCategory("Test result file");
		$objPHPExcel->getActiveSheet()->setCellValue("A1",$judul);


		foreach(range('A','B','C','D','E','F','G','H','I') as $columnID) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
		}

		//Loop Heading
		$rowNumberH = 5;
		$colH = 'A';
		foreach($heading as $h){
			$objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			$colH++;    
		}

		$row = 6;
		$no = 1;
		//$maxrow=count($pelamar)+1;


		$result = $this->HomeModel->getAparHistory();

		foreach($result as $D){
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$D->no_apar);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$D->apar);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$D->pin_pengaman);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$D->kawat_segel);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$D->selang_apar);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$D->nozel_apar);
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$D->kondisi_tabung);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$D->create);
			$row++;
			$no++;
		}

		//$objPHPExcel->getActiveSheet()->freezePane('A6');
		//Cell Style
		$styleArray = array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);
		$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			)
		);

		$style2 = array(
			'font' => array(
				'bold' => true
			)
		);


		$objPHPExcel->setActiveSheetIndex(0);
		$sheet = $objPHPExcel->getActiveSheet();
		$sheet->mergeCells('A1:I1');
		$sheet->getStyle("A1:I1")->applyFromArray($style);
		$sheet->getStyle("A1:I1")->applyFromArray($style2);
		$sheet->getStyle("A5:I5")->applyFromArray($style2);
		$sheet->getStyle("A5:I5")->applyFromArray($style2);
		$sheet->getStyle("A5:I".($row-1))->applyFromArray($styleArray);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
		ob_end_clean();
		


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$judul.'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter->save('php://output');
		exit();
	}

	public function delete($id){
        $where=array('barc'=>$id);
        $this->Sqlmodel->hapus_data($where,'data_whkom');
        redirect('whkom/list_tr');
    }

}

/* End of file Wip.php */
 ?>