<?php
// create api controller
// this controller will be used to create api for our application
// there is two method first is validate and second is submit
// validate method 	is usable for validate barcode if barcode is valid it will return json of barcode data and if barcode is invalid it will return  notofund error
// submit method is used to submit list of barcodes data to database

defined('BASEPATH') or exit('No direct script access allowed');
class Api extends CI_Controller
{
	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        date_default_timezone_set('Asia/Jakarta');
		parent::__construct();
		$this->load->model('HomeModel');
		$this->load->model('ProdControl');
		$this->load->model('ApiModel');
	}

	public function getBarcodeId($note)
    {
		$cekNote = $this->HomeModel->getBarcodeId($note);  
		if ($cekNote == NULL) {
			// $data['results'] = $this->HomeModel->getBarcodeIdDom($note);  

			$getData = $this->HomeModel->getBarcodeIdDom($note);  
		// var_dump($getData);die();
			
			foreach ($getData as $gd) {
				$data['results'] = [array(
					'WAREHOUSE' => $gd->WAREHOUSE,
					'NO_TAG' => $gd->NO_TAG,
					'NOTE' => $gd->NOTE,
					'NO_WO' => $gd->NO_WO,
					'ITEM' => $gd->ITEM,
					'DESCRIPTION_PN' => $gd->DESCRIPTION_PN,
					'QTY' => $gd->QTY,
					'QTY_ACTUAL' => '',
					'NO_RFQ' => $gd->NO_RFQ,
					'BPID' => $gd->BPID,
					'CUSTOMER_NAME' => '',
					'QTY_LOT_DELIV' => '',
					'SDF_ORDER' => '',
				)];

				array_push($data);
			}

			echo json_encode( $data, JSON_NUMERIC_CHECK );
		} else {		
				
			foreach ($cekNote as $gd) {
				$data['results'] = [array(
					'WAREHOUSE' => $gd->WAREHOUSE,
					'NO_TAG' => $gd->NO_TAG,
					'NOTE' => $gd->NOTE,
					'NO_WO' => $gd->NO_WO,
					'ITEM' => $gd->ITEM,
					'DESCRIPTION_PN' => $gd->DESCRIPTION_PN,
					'QTY' => $gd->QTY,
					'QTY_ACTUAL' => $gd->QTY_ACTUAL,
					'NO_RFQ' => $gd->NO_RFQ,
					'BPID' => $gd->BPID,
					'CUSTOMER_NAME' => $gd->CUSTOMER_NAME,
					'QTY_LOT_DELIV' => $gd->QTY_LOT_DELIV,
					'SDF_ORDER' => $gd->SDF_ORDER,
				)];

				array_push($data);
			}

			echo json_encode( $data, JSON_NUMERIC_CHECK );
		}


		// $data['results'] = $this->HomeModel->getBarcodeId($note);  
		// if ($data['results'] == NULL) {
		// 	$data['results'] = $this->HomeModel->getBarcodeIdDom($note);  
		// }  
        // echo json_encode( $data, JSON_NUMERIC_CHECK );
	}

	public function getBarcodeIdTest($note)
    {
		$cekNote = $this->HomeModel->getBarcodeId($note);  
		if ($cekNote == NULL) {
			// $data['results'] = $this->HomeModel->getBarcodeIdDom($note);  

			$getData = $this->HomeModel->getBarcodeIdDom($note);  
			
			foreach ($getData as $gd) {
				$data['results'] = [array(
					'WAREHOUSE' => $gd->WAREHOUSE,
					'NO_TAG' => $gd->NO_TAG,
					'NOTE' => $gd->NOTE,
					'NO_WO' => $gd->NO_WO,
					'ITEM' => $gd->ITEM,
					'DESCRIPTION_PN' => $gd->DESCRIPTION_PN,
					'QTY' => $gd->QTY,
					'QTY_ACTUAL' => '',
					'NO_RFQ' => $gd->NO_RFQ,
					'BPID' => $gd->BPID,
					'CUSTOMER_NAME' => '',
					'QTY_LOT_DELIV' => '',
					'SDF_ORDER' => '',
				)];

				array_push($data);
			}

			echo json_encode( $data, JSON_NUMERIC_CHECK );
		} else {		
				
			foreach ($cekNote as $gd) {
				$data['results'] = [array(
					'WAREHOUSE' => $gd->WAREHOUSE,
					'NO_TAG' => $gd->NO_TAG,
					'NOTE' => $gd->NOTE,
					'NO_WO' => $gd->NO_WO,
					'ITEM' => $gd->ITEM,
					'DESCRIPTION_PN' => $gd->DESCRIPTION_PN,
					'QTY' => $gd->QTY,
					'QTY_ACTUAL' => $gd->QTY_ACTUAL,
					'NO_RFQ' => $gd->NO_RFQ,
					'BPID' => $gd->BPID,
					'CUSTOMER_NAME' => $gd->CUSTOMER_NAME,
					'QTY_LOT_DELIV' => $gd->QTY_LOT_DELIV,
					'SDF_ORDER' => $gd->SDF_ORDER,
				)];

				array_push($data);
			}

			echo json_encode( $data, JSON_NUMERIC_CHECK );
		}
		// echo json_encode( $data, JSON_NUMERIC_CHECK );
	}
	
	public function index()
	{
		echo 'text';
	}
	public function validate()
	{
		// get barcode from post request
		$barcode = $this->input->post('barcode');
		// $barcode="KAS028925";
		// check if barcode is valid
		// echo $barcode;
		try{
// KAS028925
			$result=$this->HomeModel->validate_barcode($barcode);
			return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($result));
		}catch(Exception $e){
			return $this->output
            ->set_content_type('application/json')
            ->set_status_header(404)
            ->set_output(array("message"=>"code is invalid"));
		}

		// if ($this->HomeModel->validate_barcode($barcode)) {
		// 	// if barcode is valid return json of barcode data
		// 	$data = $this->HomeModel->get_barcode_data($barcode);
		// 	echo json_encode($data);
		// } else {
		// 	// if barcode is invalid return notfound error
		// 	echo json_encode(array('error' => 'notfound'));
		// }
	}

	public function report_dn($tanggal='')
	{
		if ($tanggal == NULL) {
            $tanggal = date('Y-m-d');
		}

		$data = $this->ProdControl->reportDn($tanggal);

		$result = [];

		foreach ($data as $d) { 
			$getDataBaan = $this->ProdControl->getLineDn(strtoupper($d->no_dn));
			foreach($getDataBaan as $gt) {
				$berat_supplier = $gt->QTY;
			}

			$result[] = [
				'tanggal' => date('d-m-Y',strtotime($d->tanggal)),
				'no_dn' => $d->no_dn,
				'supplier' => ($d->no_dn == 'KSP015487A') ? 'IMPORT' : $d->supplier,
				'item' => $d->item,
				'berat_supplier' => ($d->no_dn == 'KSP015487A') ? 0 : $berat_supplier,
				'berat_aktual' => number_format($d->berat_aktual),
				'selisih' => ($d->no_dn == 'KSP015487A') ? 0 : number_format($d->berat_aktual - $berat_supplier, 1, '.', '')
			];
		}
		
		echo json_encode($result);
	}

	public function getDataScan($barc)
	{
		$data = $this->ProdControl->getDataScan($barc);
		echo json_encode($data);
	}

	public function summary_supply_receipt($month = null)
    {
		
        if ($month == null) {
            $month = date('m');
            $year = date('Y');
        } else {
			// format mont is 2023-11
			$year = substr($month, 0, 4);
			$month = substr($month, 5, 2);
		}

		$data_summary_supply = $this->ApiModel->get_summary_supply($month, $year);
		$data_summary_receipt = $this->ApiModel->get_summary_receipt($month, $year);

		$joined_data = [];

		// Loop over $data_summary_supply
		foreach ($data_summary_supply as $supply) {
			$item = $supply['item'];
			$qty_supply = $supply['qty_supply'];

			// Check if item exists in $data_summary_receipt
			$receipt = array_filter($data_summary_receipt, function($receipt) use ($item) {
				return $receipt['ITEM'] == $item;
			});

			if (!empty($receipt)) {
				// Item exists in both arrays, add both qty_supply and QTY_receipt
				$receipt = array_shift($receipt);
				$joined_data[] = ['item' => $item, 'qty_supply' => $qty_supply, 'QTY_RECEIPT' => $receipt['QTY_RECEIPT']];
			} else {
				// Item only exists in $data_summary_supply, add qty_supply and NULL for QTY_RECEIPT
				$joined_data[] = ['item' => $item, 'qty_supply' => $qty_supply, 'QTY_RECEIPT' => NULL];
			}
		}

		// Loop over $data_summary_receipt
		foreach ($data_summary_receipt as $receipt) {
			$item = $receipt['ITEM'];
			$QTY_RECEIPT = $receipt['QTY_RECEIPT'];

			// Check if item exists in $joined_data (which means it also exists in $data_summary_supply)
			$exists = array_filter($joined_data, function($data) use ($item) {
				return $data['item'] == $item;
			});

			if (empty($exists)) {
				// Item only exists in $data_summary_receipt, add NULL for qty_supply and QTY_RECEIPT
				$joined_data[] = ['item' => $item, 'qty_supply' => NULL, 'QTY_RECEIPT' => $QTY_RECEIPT];
			}
		}

		$data['data'] = $joined_data;
		$data['filterDate'] = $data['filterDate'] = $year . '-' . $month;

        $this->load->view('template/header');
		$this->load->view('template/summary_supply_receipt',$data);
		$this->load->view('template/footer');
	}
	
	public function detail_supply_receipt($date = null)
    {
		
        if ($date == null) {
			$date = date('Y-m-d');
		}

		$data_detail_supply = $this->ApiModel->get_detail_supply($date);
		$data_detail_receipt = $this->ApiModel->get_detail_receipt($date);

		$joined_data = [];

		// Loop over $data_detail_supply
		foreach ($data_detail_supply as $supply) {
			$barcode = $supply['barcode'];
			$qty_supply = $supply['qty_supply'];

			// Check if barcode exists in $data_detail_receipt
			$receipt = array_filter($data_detail_receipt, function($receipt) use ($barcode) {
				return $receipt['BARCODE'] == $barcode;
			});

			if (!empty($receipt)) {
				// Item exists in both arrays, add both qty_supply and QTY_receipt
				$receipt = array_shift($receipt);
				$joined_data[] = [
					'item' => $supply['item'], 
					'barcode' => $barcode, 
					'qty_supply' => $qty_supply, 
					'QTY_RECEIPT' => $receipt['QTY_RECEIPT'], 
					'tujuan' => $supply['tujuan'], 
					'user_supply' => $supply['user_supply'],
					'user_receipt' => NULL
				];
			} else {
				// Item only exists in $data_detail_supply, add qty_supply and NULL for QTY_RECEIPT
				$joined_data[] = [
					'item' => $supply['item'], 
					'barcode' => $barcode,
					'qty_supply' => $qty_supply, 
					'QTY_RECEIPT' => NULL, 
					'tujuan' => $supply['tujuan'],
					'user_supply' => $supply['user_supply'],
					'user_receipt' => NULL
				];
			}
		}

		// Loop over $data_detail_receipt
		foreach ($data_detail_receipt as $receipt) {
			$barcode = $receipt['BARCODE'];
			$QTY_RECEIPT = $receipt['QTY_RECEIPT'];

			// Check if item exists in $joined_data (which means it also exists in $data_detail_supply)
			$exists = array_filter($joined_data, function($data) use ($barcode) {
				return $data['barcode'] == $barcode;
			});

			if (empty($exists)) {
				// Item only exists in $data_detail_receipt, add NULL for qty_supply and QTY_RECEIPT
				$joined_data[] = [
					'item' => $receipt['ITEM'], 
					'barcode' => $barcode, 
					'qty_supply' => NULL, 
					'QTY_RECEIPT' => $QTY_RECEIPT, 
					'tujuan' => NULL,
					'user_supply' => NULL,
					'user_receipt' => $receipt['USER_RECEIPT'],
				];
			}
		}

		$data['data'] = $joined_data;
		$data['filterDate'] = $date;

        $this->load->view('template/header');
		$this->load->view('template/detail_supply_receipt',$data);
		$this->load->view('template/footer');
	}
	
	public function summary_transaction($date_start = null, $date_end = null)
    {
		
        if ($date_start == null) {
            $date_start = date('Y-m-d');
        }

		if ($date_end == null) {
            $date_end = date('Y-m-d');
        }

		$data_summary_request_by_date = $this->ApiModel->data_summary_request_by_date($date_start, $date_end);
		$data_summary_supply_by_date = $this->ApiModel->data_summary_supply_by_date($date_start, $date_end);
		$data_summary_receipt_by_date = $this->ApiModel->data_summary_receipt_by_date($date_start, $date_end);
		$data_summary_tr_manual_by_date = $this->ApiModel->data_summary_tr_manual_by_date($date_start, $date_end);
		$data['date_start'] = $date_start;
		$data['date_end'] = $date_end;

		$data_summary = array();

		// Summarize data from $data_summary_request_by_date
		foreach ($data_summary_request_by_date as $item) {
			$key = $item['item'];
			if (!isset($data_summary[$key])) {
				$data_summary[$key] = array(
					'item' => $item['item'],
					'jumlah_order_plan' => 0,
					'qty_supply' => 0,
					'qty_receipt' => 0,
					'qty_tr_manual' => 0,
				);
			}

			$data_summary[$key]['jumlah_order_plan'] += $item['jumlah_order_plan'];
		}

		// Summarize data from $data_summary_supply_by_date
		foreach ($data_summary_supply_by_date as $item) {
			$key = $item['item'];
			if (isset($data_summary[$key])) {
				$data_summary[$key]['qty_supply'] += $item['qty_supply'];
			}
		}

		// Summarize data from $data_summary_receipt_by_date
		foreach ($data_summary_receipt_by_date as $item) {
			$key = $item['ITEM'];
			if (isset($data_summary[$key])) {
				$data_summary[$key]['qty_receipt'] += intval($item['QTY_RECEIPT']);
			}
		}

		// Summarize data from $data_summary_tr_manual_by_date
		foreach ($data_summary_tr_manual_by_date as $item) {
			$key = $item['ITEM_CHECK_TR_MANUAL'];
			if (isset($data_summary[$key])) {
				$data_summary[$key]['qty_tr_manual'] += intval($item['QTY_TR_MANUAL']);
			}
		}

		// Output the summarized data
		// var_dump($data_summary); die;
		$data['data'] = $data_summary;

        $this->load->view('template/header');
		$this->load->view('template/summary_transaction', $data);
		$this->load->view('template/footer');
	}	

	public function api_summary_transaction($date_start = null, $date_end = null)
    {
		
        if ($date_start == null) {
            $date_start = date('Y-m-d');
        }

		if ($date_end == null) {
            $date_end = date('Y-m-d');
        }

		$data_summary_request_by_date = $this->ApiModel->data_summary_request_by_date($date_start, $date_end);
		$data_summary_supply_by_date = $this->ApiModel->data_summary_supply_by_date($date_start, $date_end);
		$data_summary_receipt_by_date = $this->ApiModel->data_summary_receipt_by_date($date_start, $date_end);
		$data_summary_tr_manual_by_date = $this->ApiModel->data_summary_tr_manual_by_date($date_start, $date_end);
		$data['date_start'] = $date_start;
		$data['date_end'] = $date_end;

		$data_summary = array();

		// Summarize data from $data_summary_request_by_date
		foreach ($data_summary_request_by_date as $item) {
			$key = $item['item'];
			if (!isset($data_summary[$key])) {
				$data_summary[$key] = array(
					'item' => $item['item'],
					'jumlah_order_plan' => 0,
					'qty_supply' => 0,
					'qty_receipt' => 0,
					'qty_tr_manual' => 0,
				);
			}

			$data_summary[$key]['jumlah_order_plan'] += $item['jumlah_order_plan'];
		}

		// Summarize data from $data_summary_supply_by_date
		foreach ($data_summary_supply_by_date as $item) {
			$key = $item['item'];
			if (isset($data_summary[$key])) {
				$data_summary[$key]['qty_supply'] += $item['qty_supply'];
			}
		}

		// Summarize data from $data_summary_receipt_by_date
		foreach ($data_summary_receipt_by_date as $item) {
			$key = $item['ITEM'];
			if (isset($data_summary[$key])) {
				$data_summary[$key]['qty_receipt'] += intval($item['QTY_RECEIPT']);
			}
		}

		// Summarize data from $data_summary_tr_manual_by_date
		foreach ($data_summary_tr_manual_by_date as $item) {
			$key = $item['ITEM_CHECK_TR_MANUAL'];
			if (isset($data_summary[$key])) {
				$data_summary[$key]['qty_tr_manual'] += intval($item['QTY_TR_MANUAL']);
			}
		}

		// Output the summarized data
		echo json_encode($data_summary);
	}

	public function api_detail_supply_receipt($date = null)
    {
		
        if ($date == null) {
			$date = date('Y-m-d');
		}

		$data_detail_supply = $this->ApiModel->get_detail_supply($date);
		$data_detail_receipt = $this->ApiModel->get_detail_receipt($date);

		$joined_data = [];

		// Loop over $data_detail_supply
		foreach ($data_detail_supply as $supply) {
			$barcode = $supply['barcode'];
			$qty_supply = $supply['qty_supply'];

			// Check if barcode exists in $data_detail_receipt
			$receipt = array_filter($data_detail_receipt, function($receipt) use ($barcode) {
				return $receipt['BARCODE'] == $barcode;
			});

			if (!empty($receipt)) {
				// Item exists in both arrays, add both qty_supply and QTY_receipt
				$receipt = array_shift($receipt);
				$joined_data[] = [
					'item' => $supply['item'], 
					'barcode' => $barcode, 
					'qty_supply' => $qty_supply, 
					'QTY_RECEIPT' => $receipt['QTY_RECEIPT'], 
					'tujuan' => $supply['tujuan'], 
					'user_supply' => $supply['user_supply'],
					'user_receipt' => NULL
				];
			} else {
				// Item only exists in $data_detail_supply, add qty_supply and NULL for QTY_RECEIPT
				$joined_data[] = [
					'item' => $supply['item'], 
					'barcode' => $barcode,
					'qty_supply' => $qty_supply, 
					'QTY_RECEIPT' => NULL, 
					'tujuan' => $supply['tujuan'],
					'user_supply' => $supply['user_supply'],
					'user_receipt' => NULL
				];
			}
		}

		// Loop over $data_detail_receipt
		foreach ($data_detail_receipt as $receipt) {
			$barcode = $receipt['BARCODE'];
			$QTY_RECEIPT = $receipt['QTY_RECEIPT'];

			// Check if item exists in $joined_data (which means it also exists in $data_detail_supply)
			$exists = array_filter($joined_data, function($data) use ($barcode) {
				return $data['barcode'] == $barcode;
			});

			if (empty($exists)) {
				// Item only exists in $data_detail_receipt, add NULL for qty_supply and QTY_RECEIPT
				$joined_data[] = [
					'item' => $receipt['ITEM'], 
					'barcode' => $barcode, 
					'qty_supply' => NULL, 
					'QTY_RECEIPT' => $QTY_RECEIPT, 
					'tujuan' => NULL,
					'user_supply' => NULL,
					'user_receipt' => $receipt['USER_RECEIPT'],
				];
			}
		}
		
        echo json_encode($joined_data);
	}
}