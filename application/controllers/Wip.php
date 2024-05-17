<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Wip extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->model('WipModel');
		$this->load->model('Sqlmodel');

		if ($this->session->userdata('level') == '1' OR $this->session->userdata('level') == '2') {
			echo "";
		} else {
			redirect('login','refresh');			
		}

		// header("Cache-Control: no-cache, must-revalidate");
		// header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		// header("Content-Type: application/xml; charset=utf-8");

		$this->output->delete_cache();
	}

    public function cekBarcode()
	{
        $data['data'] = $this->WipModel->cekBarcode($this->input->post('barcode'));
        // var_dump($data['data']);die();
		$this->load->view('template/header');
		$this->load->view('wip/cekBarcode', $data);
		$this->load->view('template/footer');
	}

	public function input()
	{
		$this->session->set_userdata('username',$this->input->post('user'));		
		
		redirect('wip/index');
		
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
		
		$this->session->set_userdata( $array );
        $this->load->view('template/header');
		$this->load->view('home/batch');
		$this->load->view('template/footer');
    }

	public function list_tr()
	{
		$start = date('Ymd');

		$npk = $this->session->userdata('npk');
		

		if (date('H:i') >= '07:30' and date('H:i') <= '16:30') {
			$tgl = date('Ymd',strtotime('-0 days',strtotime($start)));
		} elseif (date('H:i') >= '16:30' and date('H:i') <= '23:59') {
			$tgl = date('Ymd',strtotime('-0 days',strtotime($start)));
		} elseif (date('H:i') >= '00:00' and date('H:i') <= '00:30') {
			$tgl = date('Ymd',strtotime('-1 days',strtotime($start)));
		} elseif (date('H:i') >= '00:30' and date('H:i') <= '07:30') {
			$tgl = date('Ymd',strtotime('-1 days',strtotime($start)));
		}
		$data['data'] = $this->Sqlmodel->getDataWip($npk);     
		$data['result'] = $this->Sqlmodel->getDataWipScan($tgl,$npk);    

		$belumUpload = $this->Sqlmodel->getDataUpload(0,$npk);     
		$gagalUpload = $this->Sqlmodel->getDataUpload(2,$npk); 
		
		foreach ($belumUpload as $bu) {
			$data['belumUpload']	=	$bu->jml;
		}

		foreach ($gagalUpload as $gu) {
			$data['gagalUpload']	=	$gu->jml;
		}

		$data['tgl_transaksi']	=	$tgl;

		$data['param'] = 'list_tr';

		$this->load->view('template/header');
		$this->load->view('wip/list_tr', $data);
		$this->load->view('template/footer');
	}

	public function history()
	{
		$data['data'] = $this->Sqlmodel->getDataWipSuccess();     

		$this->load->view('template/header');
		$this->load->view('wip/history_tr', $data);
		$this->load->view('template/footer');
	}

	public function getBarcodeId()
    {
        $pn = $_GET['pn'];

        $data['results'] = $this->HomeModel->getBarcodeId($pn);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function cekBarcodeId()
    {
        $pn = $_GET['pn'];

        $data['results'] = $this->Sqlmodel->cekBarcodeId($pn);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function cekBarcodeIdBack()
    {
        $pn = $_GET['pn'];

        $data['results'] = $this->Sqlmodel->cekBarcodeIdBack($pn);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function getDataPN()
    {
        $pn = $_GET['pn'];

        $data['results'] = $this->HomeModel->getDetailPn($pn);    
        echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function doInsertData()
	{
		$barcode = $this->input->post('barcode');
		
		$array = array(
			'whto' => $this->input->post('whto')
		);
		
		$this->session->set_userdata( $array );
		
		$cekDuplicate = $this->Sqlmodel->cekBarcodeId($barcode);
		// var_dump($ekDuplicate);die();
		if ($cekDuplicate == null) {
			$cekbarcode = $this->HomeModel->getBarcodeId($barcode);

			foreach ($cekbarcode as $cb) {
				// $year = $cb->YEAR;
				$year = date('Y');
				$peri = date('m');
				// $peri = $cb->PERI;
				$cwarf = $cb->CWAR;
				$grp3 = $cb->GRP3;
				$tagn = $cb->TAGN;
				$note = $cb->NOTE;
				$item = $cb->ITEM;
				$dsca = $cb->DSCA;
				$cuni = $cb->CUNI;
				$admq = $cb->ADMQ;
				$actq = $cb->ACTQ;
				$varq = $cb->VARQ;
			}

			// if ($cwarf == 'K-FOR' OR $cwarf == 'K-FOR') {
			// 	$whfrom = $cwarf;
			// } elseif ($cwarf == 'K-PAS' OR $cwarf == 'K-PAS') {
			// 	$whfrom = $grp3;
			// }

			$barcode = $note;

			$exp = explode("-",$barcode);

			if ($exp[1] == 'PAS204') {
				$whfrom = 'K-CUR';
			} elseif ($exp[1] == 'PAS2204') {
				$whfrom = 'K-CUR';
			} elseif ($exp[1] == 'FOR205') {
				$whfrom = 'K-FOR';
			} elseif ($exp[1] == 'FOR2205') {
				$whfrom = 'K-FOR';
			} else {
				$whfrom = '';
			}

			$start = date('Y/m/d H:i:s');
			$date = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));

			$data = array(
				'year' => date('Y'), 
				'peri' => date('m'), 
				'cwarf' => $whfrom, 
				'tagn' => $tagn, 
				'barc' => $note, 
				'item' => $item, 
				'dsca' => $dsca, 
				'cuni' => $cuni, 
				'admq' => $admq, 
				'actq' => $actq, 
				'varq' => $varq, 
				'endt' => $date, 
				'users' => $this->input->post('user'), 
				'cwart' => $this->input->post('whto'), 
				'refcntd' => 1, 
				'refcntu' => 1, 
				'status_wip' => 1, 
				'generate_baan' => 0, 
			);

			$result 	=	$this->Sqlmodel->insert_data('data_wip',$data);

			$this->session->set_flashdata('pesan', 'Berhasil di Scan');
		} else {
			$this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
			
		}
		
		redirect('wip','refresh');
	}

	public function test($bcd)
	{
		$barcode = $bcd;
		
		$array = array(
			'whto' => 'K-AMB'
		);
		
		$this->session->set_userdata( $array );
		
		$cekDuplicate = $this->Sqlmodel->cekBarcodeId($barcode);
		// var_dump($ekDuplicate);die();
		if ($cekDuplicate != null) {
			$cekbarcode = $this->HomeModel->getBarcodeId($barcode);

			foreach ($cekbarcode as $cb) {
				// $year = $cb->YEAR;
				$year = date('Y');
				$peri = date('m');
				// $peri = $cb->PERI;
				$cwarf = $cb->CWAR;
				$grp3 = $cb->GRP3;
				$tagn = $cb->TAGN;
				$note = $cb->NOTE;
				$item = $cb->ITEM;
				$dsca = $cb->DSCA;
				$cuni = $cb->CUNI;
				$admq = $cb->ADMQ;
				$actq = $cb->ACTQ;
				$varq = $cb->VARQ;
			}

			if ($cwarf == 'K-FOR' OR $cwarf == 'K-FOR') {
				$whfrom = $cwarf;
			} elseif ($cwarf == 'K-PAS' OR $cwarf == 'K-PAS') {
				$whfrom = $grp3;
			}

			$start = date('Y/m/d H:i:s');
			$date = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));

			$data = array(
				'year' => date('Y'), 
				'peri' => date('m'), 
				'cwarf' => $whfrom, 
				'tagn' => $tagn, 
				'barc' => $note, 
				'item' => $item, 
				'dsca' => $dsca, 
				'cuni' => $cuni, 
				'admq' => $admq, 
				'actq' => $actq, 
				'varq' => $varq, 
				'endt' => $date, 
				'users' => $this->input->post('user'), 
				'cwart' => $this->input->post('whto'), 
				'refcntd' => 1, 
				'refcntu' => 1, 
				'status_wip' => 10, 
				'generate_baan' => 10, 
			);

			$result 	=	$this->Sqlmodel->insert_data('data_wip',$data);

			var_dump($data);die();

			$this->session->set_flashdata('pesan', 'Berhasil di Scan');
		} else {
			$this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
			
		}
		
		redirect('wip','refresh');
	}

	public function generateBaan()
	{
		$lastPn = $this->Sqlmodel->getDataGenerateBaan();

		foreach ($lastPn as $l) {

				$getVarq = $this->HomeModel->getVarq();

				if ($getVarq == null) {
					$varq = 0;
				} else {
					foreach ($getVarq as $gv) {
						$varq = $gv->MAXVAR;
					}
				}

				$start = date('Y/m/d H:i:s');
				$apdt = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));

				$result 	=	$this->HomeModel->insert_data($l->year,$l->peri,$l->cwarf,$l->tagn,$l->barc,$l->item,$l->dsca,$l->cuni,$l->admq,$l->actq,$varq+1,$l->endt,$l->users,$l->cwart,$apdt);
				if ($result == true) {
					$data2 = array('generate_baan' => 1,'varq' => $varq+1);

					$where = "barc = '".$l->barc."'";

					$result2 	=	$this->Sqlmodel->update("data_wip",$data2,$where);

					$data3 = array('barc' => $l->barc,
						'update_at' => date('Y-m-d H:i:s'),
						'qty' => $l->actq,
						'cwart' => $l->cwart,
					);

					$result3	=	$this->Sqlmodel->insert_data('item_wip_update',$data3);
				} else {
					$data4 = array('fail_upload' => 1,
						'users' => $this->session->userdata('user')
					);

					$result4	=	$this->Sqlmodel->insert_data('log_generate',$data4);

					$data2 = array('generate_baan' => 2);

					$where = "created_at = '".$l->created_at."' and tagn = '".$l->tagn."'";

					$result2 	=	$this->Sqlmodel->update("data_wip",$data2,$where);

					$data4 = array('fail_upload' => 1,
						'users' => $this->session->userdata('user')
					);

					$result4	=	$this->Sqlmodel->insert_data('log_generate',$data4);
				}
					
		}

		$cekLastUpdate = $this->Sqlmodel->cekLast();

		foreach ($cekLastUpdate as $lu) {
			$last = $lu->update_at;
		}

		$cekGagal = $this->Sqlmodel->cekGagal($last);

		foreach ($cekGagal as $cg) {
			$gagal = $cg->total_gagal;
		}

		if ($gagal > 0) {
			$this->session->set_flashdata('pesan', 'Data gagal upload : '.$gagal);
		} else {
			$this->session->set_flashdata('pesan', 'Berhasil melakukan upload');
		}		

		redirect('wip/history');	
	}

	public function updateDataWip()
	{
		if ($this->input->post('actq_sesudah') == null) {
			$data2 = array('cwart' => $this->input->post('whto'));

			$where = "barc = '".$this->input->post('barc')."' and tagn = '".$this->input->post('tagn')."'";

			$result2 	=	$this->Sqlmodel->update("data_wip",$data2,$where);

			if ($result2 > 0) {
				$this->session->set_flashdata('pesan', 'Berhasil melakukan update');
			} else {
				$this->session->set_flashdata('pesan', 'Gagal melakukan update');
			}
		} else {
			$data2 = array(
				'cwart' => $this->input->post('whto'),
				'actq' => $this->input->post('actq_sesudah')
			);

			$where = "barc = '".$this->input->post('barc')."' and tagn = '".$this->input->post('tagn')."'";

			$result2 	=	$this->Sqlmodel->update("data_wip",$data2,$where);

			if ($result2 > 0) {
				$this->session->set_flashdata('pesan', 'Berhasil melakukan update');
			} else {
				$this->session->set_flashdata('pesan', 'Gagal melakukan update');
			}
		}

		redirect('wip/list_tr');	
		
	}

	public function addDataBarcode()
	{
		for ($i=0; $i < count($this->input->post('barcode')); $i++) { 
			$barcode = $this->input->post('barcode')[$i];
		
			$array = array(
				'whto' => $this->input->post('whto')
			);
			
			$this->session->set_userdata( $array );

			if (!empty($barcode)) {
				$cekDuplicate = $this->Sqlmodel->cekBarcodeId($barcode);
				// var_dump($ekDuplicate);die();
				if ($cekDuplicate == null) {
					$cekbarcode = $this->HomeModel->getBarcodeId($barcode);
					
					if ($cekbarcode == null) {
						$this->session->set_flashdata('pesan', 'Barcode Tidak Terdeteksi');
					} else {
						foreach ($cekbarcode as $cb) {
							$year = date('Y');
							$peri = date('m');
							$cwarf = $cb->CWAR;
							$grp3 = $cb->GRP3;
							$tagn = $cb->TAGN;
							$note = $cb->NOTE;
							$item = $cb->ITEM;
							$dsca = $cb->DSCA;
							$cuni = $cb->CUNI;
							$admq = $cb->ADMQ;
							$actq = $cb->ACTQ;
							$varq = $cb->VARQ;
						}
	
						// if ($cwarf == 'K-FOR' OR $cwarf == 'K-FOR') {
						// 	$whfrom = $cwarf;
						// } elseif ($cwarf == 'K-PAS' OR $cwarf == 'K-PAS') {
						// 	$whfrom = $grp3;
						// }

						$barcode = $note;

						$exp = explode("-",$barcode);

						if ($exp[1] == 'PAS204') {
							$whfrom = 'K-CUR';
						} elseif ($exp[1] == 'PAS2204') {
							$whfrom = 'K-CUR';
						} elseif ($exp[1] == 'FOR205') {
							$whfrom = 'K-FOR';
						} elseif ($exp[1] == 'FOR2205') {
							$whfrom = 'K-FOR';
						} else {
							$whfrom = '';
						}
	
						$start = date('Y/m/d H:i:s');
						$date = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));
	
						$data = array(
							'year' => $year, 
							'peri' => $peri, 
							'cwarf' => $whfrom, 
							'tagn' => $tagn, 
							'barc' => $note, 
							'item' => $item, 
							'dsca' => $dsca, 
							'cuni' => $cuni, 
							'admq' => $admq, 
							'actq' => $actq, 
							'varq' => $varq, 
							'endt' => $date, 
							'users' => $this->session->userdata('username'),
							'cwart' => $this->input->post('whto'), 
							'refcntd' => 1, 
							'refcntu' => 1, 
							'status_wip' => 1, 
							'generate_baan' => 0, 
						);
	
						$result 	=	$this->Sqlmodel->insert_data('data_wip',$data);
	
						$this->session->set_flashdata('pesan', 'Berhasil di Scan');
					}
					
				} else {
					$this->session->set_flashdata('pesan', 'Barcode Sudah Pernah di Scan');
				}
			} else {

			}
		}
		
		redirect('wip/batch');

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
        $this->Sqlmodel->hapus_data($where,'data_wip');
        redirect('wip/list_tr');
	}
	
	public function uploadData()
	{
		$jam = date('H:i');

		if ($jam >= '16:00' and $jam <= '16:30' OR $jam >= '00:00' and $jam <= '00:30' OR $jam >= '07:00' and $jam <= '07:30') {
			$lastPn = $this->Sqlmodel->getDataGenerateBaan();

			foreach ($lastPn as $l) {

					$getVarq = $this->HomeModel->getVarq();

					if ($getVarq == null) {
						$varq = 0;
					} else {
						foreach ($getVarq as $gv) {
							$varq = $gv->MAXVAR;
						}
					}

					$start = date('Y/m/d H:i:s');
					$apdt = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));

					$result 	=	$this->HomeModel->insert_data($l->year,$l->peri,$l->cwarf,$l->tagn,$l->barc,$l->item,$l->dsca,$l->cuni,$l->admq,$l->actq,$varq+1,$l->endt,$l->users,$l->cwart,$apdt);
					if ($result == true) {
						$data2 = array('generate_baan' => 1,'varq' => $varq+1);

						$where = "barc = '".$l->barc."'";

						$result2 	=	$this->Sqlmodel->update("data_wip",$data2,$where);

						$data3 = array('barc' => $l->barc,
							'update_at' => date('Y-m-d H:i:s'),
							'qty' => $l->actq,
							'cwart' => $l->cwart,
						);

						$result3	=	$this->Sqlmodel->insert_data('item_wip_update',$data3);
					} else {
						$data4 = array('fail_upload' => 1,
							'users' => $this->session->userdata('user')
						);

						$result4	=	$this->Sqlmodel->insert_data('log_generate',$data4);

						$data2 = array('generate_baan' => 2);

						$where = "created_at = '".$l->created_at."' and tagn = '".$l->tagn."'";

						$result2 	=	$this->Sqlmodel->update("data_wip",$data2,$where);

						$data4 = array('fail_upload' => 1,
							'users' => $this->session->userdata('user')
						);

						$result4	=	$this->Sqlmodel->insert_data('log_generate',$data4);
					}
						
			}
		} else {
			echo '';
		}

		$this->cekByBaan();

		$this->load->view('wip/uploadData');
		
	}

	public function backdateWip()
	{
		$tgl_produksi = $this->input->post('tanggal_produksi');
		
		$start = $tgl_produksi;

		$npk = $this->session->userdata('npk');
		

		if (date('H:i') >= '07:30' and date('H:i') <= '16:30') {
			$tgl = date('Ymd',strtotime('-0 days',strtotime($start)));
		} elseif (date('H:i') >= '16:30' and date('H:i') <= '23:59') {
			$tgl = date('Ymd',strtotime('-0 days',strtotime($start)));
		} elseif (date('H:i') >= '00:00' and date('H:i') <= '00:30') {
			$tgl = date('Ymd',strtotime('-1 days',strtotime($start)));
		} elseif (date('H:i') >= '00:30' and date('H:i') <= '07:30') {
			$tgl = date('Ymd',strtotime('-1 days',strtotime($start)));
		}

		$data['data'] = $this->Sqlmodel->getDataWipBackdate($npk,$tgl);     
		$data['result'] = $this->Sqlmodel->getDataWipScanBackdate($tgl,$npk);    

		$data['belumUpload']	=	'-';
		$data['gagalUpload']	=	'-';

		$data['tgl_transaksi']	=	$tgl;

		$data['param'] = 'backdate';

		$this->load->view('template/header');
		$this->load->view('wip/list_tr', $data);
		$this->load->view('template/footer');
	}

	public function cekByBaan()
	{
		$getBcd = $this->Sqlmodel->getBcdGagal();

		foreach ($getBcd as $gb) {
			$getBcdBaan = $this->HomeModel->getBcdBaan($gb->barc);
			// var_dump($getBcdBaan);die();
			if (!empty($getBcdBaan)) {
				// var_dump($getBcdBaan);die();
				$data = array('generate_baan' => 1);

				$where = "barc = '".$gb->barc."'";

				$result2 	=	$this->Sqlmodel->update("data_wip",$data,$where);
			} else {
				// var_dump('kosong');die();
			}
		}
	}

	public function insertGagalUpload()
	{
		$lastPn = $this->Sqlmodel->getDataGenerateBaanFail();

		foreach ($lastPn as $l) {

			$getVarq = $this->HomeModel->getVarq();

			if ($getVarq == null) {
				$varq = 0;
			} else {
				foreach ($getVarq as $gv) {
					$varq = $gv->MAXVAR;
				}
			}

			$start = date('Y/m/d H:i:s');
			$apdt = date('Y/m/d H:i:s',strtotime('-7 hours',strtotime($start)));

			$result 	=	$this->HomeModel->insert_data($l->year,$l->peri,$l->cwarf,$l->tagn,$l->barc,$l->item,$l->dsca,$l->cuni,$l->admq,$l->actq,$varq+1,$l->endt,$l->users,$l->cwart,$apdt);
			if ($result == true) {
				$data2 = array('generate_baan' => 1,'varq' => $varq+1);

				$where = "barc = '".$l->barc."'";

				$result2 	=	$this->Sqlmodel->update("data_wip",$data2,$where);

				$data3 = array('barc' => $l->barc,
					'update_at' => date('Y-m-d H:i:s'),
					'qty' => $l->actq,
					'cwart' => $l->cwart,
				);

				$result3	=	$this->Sqlmodel->insert_data('item_wip_update',$data3);
			} else {
				$data4 = array('fail_upload' => 1,
					'users' => $this->session->userdata('user')
				);

				$result4	=	$this->Sqlmodel->insert_data('log_generate',$data4);

				$data2 = array('generate_baan' => 2);

				$where = "created_at = '".$l->created_at."' and tagn = '".$l->tagn."'";

				$result2 	=	$this->Sqlmodel->update("data_wip",$data2,$where);

				$data4 = array('fail_upload' => 1,
					'users' => $this->session->userdata('user')
				);

				$result4	=	$this->Sqlmodel->insert_data('log_generate',$data4);
			}
					
		}
	
	}

	public function getDataActqNull()
	{
		$getData = $this->Sqlmodel->getDataActqNull();
		
		foreach ($getData as $gd) {
			$barc = $this->HomeModel->getDataActqNull($gd->barc);

			if ($barc == null) {
				
			} else {
				// var_dump($getData);die();
				foreach ($barc as $b) {
					$barcode = $b->BARC;
					$actq = $b->ACTQ;
				}

				$data2 = array('actq' => $actq);

				$where = "barc = '".$barcode."'";

				$result 	=	$this->Sqlmodel->update("data_wip",$data2,$where);
				$result2 	=	$this->HomeModel->updateActqNull($actq,$barcode);
			}
		}

		var_dump('selesai');
	}

	public function test2($barcode='')
	{
		$exp = explode("-",$barcode);

		if ($exp[1] == 'PAS204') {
			$whfrom = 'K-CUR';
		} elseif ($exp[1] == 'PAS2204') {
			$whfrom = 'K-CUR';
		} elseif ($exp[1] == 'FOR205') {
			$whfrom = 'K-FOR';
		} elseif ($exp[1] == 'FOR2205') {
			$whfrom = 'K-FOR';
		} else {
			$whfrom = '';
		}

		echo $whfrom;
	}

}

/* End of file Wip.php */
 ?>