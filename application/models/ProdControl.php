<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdControl extends CI_Model {

    public function getStockTimah($pn)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);

            //database kedua
            $db2->select('TOP(1) qty_actual, qty_bundle, pn');
            $db2->from('stock_timah');
            $db2->where('pn', $pn);
            $query = $db2->get();
            return $query->result_object();
        }

    public function cekLastQtyScan()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);

            //database kedua
            $db2->select('TOP(1) actq, created_at');
            $db2->from('data_whfg_timah');
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getLastDataReceived($no_dn)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);

            //database kedua
            $db2->select('TOP(1) *, (select SUM(actq) as actual_total from data_whfg_timah where no_dn = \''.$no_dn.'\') as actualQty');
            $db2->from('data_whfg_timah');
            $db2->where('no_dn', $no_dn);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getCodeBarc($year,$month)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
            //database kedua
            $db2->select('TOP(1) peri,code_barc');
            $db2->from('data_whfg_timah');
            $db2->where('year', $year);
            $db2->where('peri', $month);
            $db2->order_by('code_barc', 'desc');
            $query = $db2->get();
            return $query->result_array();
        }

    public function searchCean($item)
        {
            $dbaan = $this->load->database('baan', TRUE);
    
            $hasil = $dbaan->query(
                'SELECT trim(t$item) as cean, t$cuni as cuni, t$dsca as dsca FROM baan.ttcibd001720 where trim(t$item) = \''.$item.'\' OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY'
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getLineDnSummary($id)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);

            //database kedua
            $db2->select('TOP(25) no_dn,actq,item,tagn');
            $db2->from('data_whfg_timah');
            $db2->where('no_dn', $id);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function lastQtyLead()
        {
            $db2 = $this->load->database('prod_control', TRUE);
    
            //database kedua
            $db2->select('TOP(1) lead_weight');
            $db2->from('lead_checking');
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getWoForklift($line)
        {
            $db2 = $this->load->database('prod_control', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('assy_schedule_wo');
            $db2->where('tgl_produksi', date('Y-m-d'));
            $db2->where('id_line', $line);
            $db2->where('status_forklift is NULL');
            $db2->order_by('created_at', 'asc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataScan($id)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);

            //database kedua
            $db2->select('TOP(1) *');
            $db2->from('data_whfg_timah');
            $db2->where('barc', $id);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataReceipt()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);

            //database kedua
            $db2->select('*');
            $db2->from('data_whfg_timah');
            // $db2->where('peri', date('m'));
            // $db2->where('year', date('Y'));
            $db2->where('created_at >=', '2023-04-01 00:01:00');
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function cekDnTransaction($po,$pono,$nodn)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);

            //database kedua
            $db2->select('TOP(1) tagn, uniq_code');
            $db2->from('data_whfg_timah');
            $db2->where('orno', $po);
            $db2->where('pono', $pono);
            $db2->where('no_dn', $nodn);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_array();
        }

    public function getPoTimah()
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $bp1 = 'SPRGS0044';
            $rcno = ' ';
            $date = '2022-JAN-01';

            $hasil = $db2->query(
                'select distinct(t$orno) as po, t$otbp as bp, t$nama as nama from BAAN.ttdpur401720 join baan.ttccom100720 on baan.ttccom100720.t$bpid = baan.ttdpur401720.t$otbp where t$otbp = \''.$bp1.'\' and t$rcno != \''.$rcno.'\' and t$odat >= TO_DATE(\''.$date.'\', \'yyyy-mm-dd\') OFFSET 0 ROWS FETCH NEXT 100 ROWS ONLY'
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getLineDnDetail($dn)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
            $hasil = $db2->query(
                'select a.t$orno as po, trim(a.t$item) as item, a.t$qodr as qty, a.t$pono as pono, a.t$dnno as nodn, b.t$cwar as cwar, b.t$otbp as bp from baan.CBI_avwmd018720 a join baan.ttdpur401720 b on b.t$orno = a.t$orno where t$dnno = \''.$dn.'\' OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY'
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getLineDn($dn)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
            $hasil = $db2->query(
                'select t$orno as po, trim(t$item) as item, trim(t$qodr) as qty, t$pono as pono, t$dnno as nodn from baan.CBI_avwmd018720 where t$dnno = \''.$dn.'\' OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY'
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getLinePo($po)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
            $hasil = $db2->query(
                'select t$pono as line, t$sqnb as seq, trim(t$item) as item, t$oqua as qty from baan.ttdpur401720 where t$orno = \''.$po.'\''
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function insert_data($tabel,$data)
        {
            $db2 = $this->load->database('prod_control', TRUE);
                $db2->insert($tabel,$data);
                    return TRUE;
        }
  
    public function update($namatabel,$data,$where)
        {
            $db2 = $this->load->database('prod_control', TRUE);
                $res = $db2->update($namatabel, $data, $where);

                return $res;
        }
  
    public function hapus_data($where,$table)
        {
            $db2 = $this->load->database('prod_control', TRUE);
            return $db2->where($where)
                            ->delete($table);
        }

    public function insert_data_ewip($tabel,$data)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
                $db2->insert($tabel,$data);
                    return TRUE;
        }
    
    public function update_ewip($namatabel,$data,$where)
        {
            $db2 = $this->load->database('prod_control', TRUE);
                $res = $db2->update($namatabel, $data, $where);

                return $res;
        }
    
    public function reportDn($tanggal)
    {
        if ($tanggal == NULL) {
            $tanggal = ''.date('Y-m-d').'';
        } else {
            $tanggal = date('Y-m-d', strtotime($tanggal));
        }

        // Load database kedua
        $db2 = $this->load->database('dbsqlsrv', TRUE);
        $hasil = $db2->query(
            "select		convert(varchar, created_at, 23) as tanggal, 
                        no_dn, SUM(actq) as berat_aktual, cwarf as supplier, item
            from		data_whfg_timah 
            where       month(created_at) = month('".$tanggal."') AND year(created_at) = year('".$tanggal."')
            group by	convert(varchar, created_at, 23), no_dn, cwarf, item
            order by	convert(varchar, created_at, 23) desc
            "
        );
        
        
        if($hasil->num_rows() > 0){
            return $hasil->result();
        } else {
            return array();
        }
    }
    
}

/* End of file Sqlmodel.php */
 ?>