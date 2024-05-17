<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApiModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function validate_barcode($barc)
	{
		$db2 = $this->load->database('baan', TRUE);

		$hasil = $db2->query(
			'select t$item as data, t$admq as qty, t$cwar as from, t$tagn as tagn, t$note as note,t$grp3 as to, t$dsca as dsca from baan.CBI_avinh020720 where t$note = \'' . $barc . '\' and t$sttr = 1 and t$stkn != 1'
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result();
		} else {
			return array();
		}
	}
	// public function get_barcode_data($barcode)
	// {
	// 	// get barcode data from database
	// 	$this->db->where('barcode', $barcode);
	// 	$query = $this->db->get('barcode_data');
	// 	// return barcode data
	// 	return $query->row_array();
	// }
	// public function validate_barcode_data($barcode_data)
	// {
	// 	// check if barcode data is valid
	// 	if (strlen($barcode_data['barcode']) == 13) {
	// 		// if barcode data is valid return true
	// 		return true;
	// 	} else {
	// 		// if barcode data is invalid return false
	// 		return false;
	// 	}
	// }
	// public function insert_barcode_data($barcode_data)
	// {
	// 	// insert barcode data to database
	// 	$this->db->insert('barcode_data', $barcode_data);
	// }

	public function get_summary_supply($month, $year)
	{
		$db2 = $this->load->database('dbsqlsrv', TRUE);

		$hasil = $db2->query(
			'SELECT b.plate_number AS item, SUM(a.qty_supply) as qty_supply
			FROM order_plate a
			JOIN data_plate b ON b.id_plate = a.id_plate
			where MONTH(a.tanggal_order) = ' . $month . ' and YEAR(a.tanggal_order) = ' . $year . '
			GROUP BY b.plate_number'
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result_array();
		} else {
			return array();
		}
	}

	public function get_summary_receipt($month, $year)
	{
		$db2 = $this->load->database('baan', TRUE);

		$hasil = $db2->query(
			'SELECT trim(t$item) AS item, SUM(t$qty) AS qty_receipt
			FROM baan.tavinh019720
			WHERE to_date(to_char(t$recd + (7/24), \'yyyyMM\'), \'yyyyMM\') = to_date(\''. $year.$month . '\', \'yyyyMM\')
			AND t$whfrom = \'KPRO1\' and t$whto = \'KPRO2\' and t$orno IS NOT NULL
			GROUP BY trim(t$item)'
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result_array();
		} else {
			return array();
		}
	}

	public function get_detail_supply($date)
	{
		$db2 = $this->load->database('dbsqlsrv', TRUE);

		$hasil = $db2->query(
			'SELECT b.plate_number as item, c.barcode as barcode, c.qty_order_plate as qty_supply, a.line as tujuan, c.username as user_supply
			FROM order_plate a
			JOIN data_plate b ON b.id_plate = a.id_plate
			JOIN detail_order_plate c on c.id_order_plate = a.id_order_plate
			WHERE a.tanggal_order >= \'' . $date . '\'
			AND a.tanggal_order  < \'' . date('Y-m-d', strtotime($date . ' + 1 days')) . '\''			
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result_array();
		} else {
			return array();
		}
	}

	public function get_detail_receipt($date)
	{
		$db2 = $this->load->database('baan', TRUE);

		$hasil = $db2->query(
			'SELECT trim(t$item) AS item, t$note AS barcode, t$qty AS qty_receipt, t$logn as user_receipt
			FROM baan.tavinh019720
			WHERE to_date(to_char(t$recd + (7/24), \'yyyy-MM-DD\'), \'yyyy-MM-DD\') = to_date(\''. $date . '\', \'yyyy-MM-DD\')
			AND t$whfrom = \'KPRO1\' and t$whto = \'KPRO2\' and t$orno IS NOT NULL'
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result_array();
		} else {
			return array();
		}
	}

	public function data_summary_request_by_date($date_start, $date_stop) 
	{
		$db2 = $this->load->database('dbsqlsrv', TRUE);

		$hasil = $db2->query(
			"SELECT b.plate_number AS item, SUM(a.jumlah_order_plan) as jumlah_order_plan
			FROM order_plate a
			JOIN data_plate b ON b.id_plate = a.id_plate
			where a.tanggal_order >= '" . $date_start . " 00:00:00' AND a.tanggal_order <= '" . $date_stop . " 23:59:00'
			GROUP BY b.plate_number"
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result_array();
		} else {
			return array();
		}
	}

	public function data_summary_supply_by_date($date_start, $date_stop) 
	{
		$db2 = $this->load->database('dbsqlsrv', TRUE);

		$hasil = $db2->query(
			"SELECT b.plate_number AS item, SUM(a.qty_supply) as qty_supply
			FROM order_plate a
			JOIN data_plate b ON b.id_plate = a.id_plate
			WHERE a.tanggal_order >= '" . $date_start . " 00:00:00' AND a.tanggal_order <= '" . $date_stop . " 23:59:00'
			GROUP BY b.plate_number"
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result_array();
		} else {
			return array();
		}
	}

	public function data_summary_receipt_by_date($date_start, $date_stop)
	{
		$db2 = $this->load->database('baan', TRUE);

		$hasil = $db2->query(
				'SELECT trim(t$item) AS item, sum(t$qty) AS qty_receipt
				FROM baan.tavinh019720
				WHERE to_date(to_char(t$recd + (7/24), \'yyyy-MM-DD\'), \'yyyy-MM-DD\') >= to_date(\''. $date_start . '\', \'yyyy-MM-DD\')
				AND to_date(to_char(t$recd + (7/24), \'yyyy-MM-DD\'), \'yyyy-MM-DD\') <= to_date(\''. $date_stop . '\', \'yyyy-MM-DD\')
				AND t$whfrom = \'KPRO1\' and t$whto = \'KPRO2\' and t$orno IS NOT NULL
				GROUP BY t$item'
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result_array();
		} else {
			return array();
		}
	}

	public function data_summary_tr_manual_by_date($date_start, $date_stop)
	{
		$db2 = $this->load->database('baan', TRUE);

		$hasil = $db2->query(
				'select trim(a.t$item) as item_check_tr_manual, sum(a.t$qstk) as qty_tr_manual
				from baan.twhinr110720 a
				left join baan.tavinh019720 b on a.t$orno = b.t$orno
				where (a.t$kost = 5 and a.t$cwar = \'KPRO1\' and a.t$koor = 36) AND (a.t$kost = 3 and a.t$cwar = \'KPRO2\' and a.t$koor = 36)
				and (to_char(a.t$trdt + (7/24), \'YYYY-MM-DD\')) >= \''. $date_start . '\' and (to_char(a.t$trdt + (7/24), \'YYYY-MM-DD\')) <= \''. $date_stop . '\'
				and b.t$orno IS NULL
				and trim(a.t$item) NOT LIKE \'%LESC%\'
				group by a.t$item'
		);

		if ($hasil->num_rows() > 0) {
			return $hasil->result_array();
		} else {
			return array();
		}
	}
}
