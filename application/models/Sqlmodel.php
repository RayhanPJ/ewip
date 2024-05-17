<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Sqlmodel extends CI_Model {

    public function cekDetailOrderTimah($id_order)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('TOP(1) *');
            $db2->from('detail_order_timah');
            $db2->where('id_order', $id_order);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataDnTransaction($barc)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('TOP(1) *');
            $db2->from('data_whfg_timah');
            $db2->where('barc', $barc);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataTrWhkomUpdate()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_whkom');
            $db2->where('generate_baan', 0);
            $db2->where('status_whkom', 1);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getBcdGagal()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_wip');
            $db2->where('generate_baan', 2);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataWipBackdate($npk='',$tgl='')
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_wip');
            $db2->where('generate_baan >=', 0);
            if ($this->session->userdata('level') == 1) {
                echo '';
            } else {
                $db2->where('users', $npk);
            }
            if ($tgl == null) {
                echo '';
            } else {
                $db2->where('CONVERT(VARCHAR, created_at, 112) =', $tgl);
            }
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataWipScanBackdate($tgl='',$npk)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('count(barc) as scan, cwart, item, sum(actq) as qty');
            $db2->from('data_wip');
            $db2->where('CONVERT(VARCHAR, created_at, 112) =', $tgl);
            $db2->where('generate_baan >=', 0);
            if ($this->session->userdata('level') == 1) {
                echo '';
            } else {
                $db2->or_where('users', $npk);
            }
            if ($tgl == null) {
                echo '';
            } else {
                $db2->where('CONVERT(VARCHAR, created_at, 112) =', $tgl);
            }
            $db2->group_by('cwart, item');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataUpload($param,$npk)
    {
        $db2 = $this->load->database('dbsqlsrv', TRUE);
    
        //database kedua
        $db2->select('count(created_at) as jml');
        $db2->from('data_wip');
        $db2->where('generate_baan', $param);
        if ($this->session->userdata('level') == 1) {
            echo '';
        } else {
            $db2->where('users', $npk);
        }
        $db2->where('CONVERT(VARCHAR, created_at, 112) =', date('Ymd'));
        $query = $db2->get();
        return $query->result_object();
    }

    public function getDataGenerateBaan()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_wip');
            $db2->where('status_wip', 1);
            // $db2->where('actq !=', 0);
            $db2->where('generate_baan', 0);
            // $db2->or_where('status_wip', 1);
            // $db2->or_where('generate_baan', 2);
            // $db2->where('CONVERT(VARCHAR, created_at, 112) =', date('Ymd'));
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataGenerateBaanFail()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_wip');
            $db2->where('generate_baan', 2);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function cekBarcodeId($param)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_wip');
            $db2->where('barc', $param);
            $db2->where('status_wip', 1);
            $db2->limit(1);            
            $query = $db2->get();
            return $query->result_object();
        }

    public function cekBarcodeIdBack($param)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_wip');
            $db2->where('barc', $param);
            $db2->where('status_wip', 1);
            $db2->where('CONVERT(VARCHAR, created_at, 112) >=', date('Ymd',strtotime('-1 days',strtotime(date('Ymd')))));
            $db2->limit(1);            
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataWip($npk)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_wip');
            $db2->where('generate_baan >=', 0);
            $db2->where('generate_baan !=', 1);
            if ($this->session->userdata('level') == 1) {
                echo '';
            } else {
                // cek
                $db2->where('users', $this->session->userdata('username'));
            }
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataWipScan($tgl,$npk)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('count(barc) as scan, cwart, item, sum(actq) as qty');
            $db2->from('data_wip');
            $db2->where('CONVERT(VARCHAR, created_at, 112) =', $tgl);
            if (date('H:i') >= '07:30' AND date('H:i') <= '23:59') {
                $db2->where('CONVERT(VARCHAR, created_at, 108) >=', '07:30:00');
                $db2->where('CONVERT(VARCHAR, created_at, 108) <=', '23:59:00');
            } elseif (date('H:i') >= '00:30' AND date('H:i') <= '07:30') {
                $db2->where('CONVERT(VARCHAR, created_at, 108) >=', '00:30:00');
                $db2->where('CONVERT(VARCHAR, created_at, 108) <=', '07:30:00');
            }
            $db2->where('generate_baan >=', 0);
            if ($this->session->userdata('level') == 1) {
                echo '';
            } else {
                // cek
                $db2->where('users', $this->session->userdata('username'));
            }
            $db2->group_by('cwart, item');
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataWipSuccess()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('TOP(250) *');
            $db2->from('data_wip');
            $db2->where('generate_baan', 1);
            if ($this->session->userdata('level') == 1) {
                echo '';
            } else {
                // cek
                $db2->where('users', $this->session->userdata('username'));
            }
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function cekLast()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('item_wip_update');
            $db2->order_by('created_at', 'desc');
            $db2->limit(1);            
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataActqNull()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('barc,actq');
            $db2->from('data_wip');
            $db2->where('actq', 0);
            $db2->order_by('created_at', 'desc');
            $query = $db2->get();
            return $query->result_object();
        }

    public function cekGagal($param)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('sum(fail_upload) as total_gagal');
            $db2->from('log_generate');
            $db2->where('created_at >=', $param);   
            $query = $db2->get();
            return $query->result_object();
        }

    public function insert_data($tabel,$data)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
                $db2->insert($tabel,$data);
                    return TRUE;
        }
  
    public function update($namatabel,$data,$where)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
                $res = $db2->update($namatabel, $data, $where);

                return $res;
        }
  
    public function hapus_data($where,$table)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
            return $db2->where($where)
                            ->delete($table);
        }

    //============================================================//

    public function cekBarcodeReservasi($param)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_whkom');
            $db2->where('barc', $param);
            $db2->where('status_whkom', 1);
            $db2->limit(1);            
            $query = $db2->get();
            return $query->result_object();
        }

    public function getReservasiScan()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_whkom');
            $db2->where('generate_baan', 0);           
            $db2->where('status_whkom', 3);           
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataTrWhkom()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
            // var_dump('ok');die();
            //database kedua
            $db2->select('*');
            $db2->from('data_whkom');     
            $db2->where('peri', date('m'));  
            $db2->where('year', date('Y')); 
            $db2->order_by('created_at', 'desc');   
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataTrWhkomUsers($section,$username)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('TOP(50)*');
            $db2->from('data_whkom');   
            if ($username == 'admin') {

            } else {
                if ($section == 'whkom') {
                    $db2->where('status_whkom >=', 1);  
                    $db2->where('users', $username); 
                } elseif ($section == 'prod') {
                    $db2->where('status_whkom', 3);  
                    $db2->where('users_prod', $username); 
                }   
            }    
            $db2->where('created_at >=', date('Y-m-d',strtotime('-10 days',strtotime(date('Y-m-d')))));        
            $db2->order_by('created_at', 'desc');   
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDetailTr($barc)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_whkom'); 
            $db2->where('barc', $barc);      
            $query = $db2->get();
            return $query->result_object();
        }

    public function cekBcdTrWh($barc)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('TOP(1) *');
            $db2->from('data_whkom'); 
            $db2->where('barc', $barc);      
            $query = $db2->get();
            return $query->result_object();
        }

    //============================================================//

    public function cekBarcodePraTr($param)
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('*');
            $db2->from('data_whfg');
            $db2->where('barc', $param);
            $db2->where('status_whfg', 1);
            $db2->limit(1);            
            $query = $db2->get();
            return $query->result_object();
        }

    public function getDataTr()
        {
            $db2 = $this->load->database('dbsqlsrv', TRUE);
    
            //database kedua
            $db2->select('TOP(50) *');
            $db2->from('data_whfg');
            // $db2->where('barc', $param);
            // $db2->where('status_whfg', 1);
            $db2->order_by('created_at', 'desc');     
            $query = $db2->get();
            return $query->result_object();
        }

}

/* End of file Sqlmodel.php */
 ?>