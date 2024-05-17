<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class WipModel extends CI_Model {

    public function cekBarcode($barcode)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'SELECT t$note as barcode, t$actq as qty, t$item as pn, t$cuni as cuni, t$cwar as whfrom FROM baan.tcbinh985777 where t$note = \''.$barcode.'\''
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function insert_data($orno,$trno,$trln,$pn,$qty,$whto,$whfr,$date,$cuni)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            // $date = date('y');

            $hasil = $db2->query(
                'INSERT INTO BAAN.tcbinh012777 (t$orno,t$trno,t$trln,t$whfr,t$whto,t$qty,t$odat,t$item,t$stat,t$cuni,T$LOGN,t$barc,T$NOTE,t$recd,T$REFCNTD,T$REFCNTU) 
                VALUES (\''.$orno.'\',\''.$trno.'\',\''.$trln.'\',\'K-SPT\',\''.$whto.'\','.$qty.',TO_DATE(\''.$date.'\', \'yyyy/mm/dd hh24:mi:ss\'),\'         '.$pn.'\',0,\''.$cuni.'\',\'rsn3584\',\' \',\' \',TO_DATE(\''.$date.'\', \'yyyy/mm/dd hh24:mi:ss\'),1,1)'
            );

            // INSERT INTO BAAN.tcbinh009777 (t$orno,t$trno,t$trln,t$whfr,t$whto,t$qty,t$odat,t$item,t$stat,t$cuni,T$LOGN,T$BARC,T$NOTE,T$RECD,T$REFCNTD,T$REFCNTU) VALUES 
// ('200400003','2020001',1,'KMTX','KMB',5,TO_DATE('2020/04/27 21:02:44', 'yyyy/mm/dd hh24:mi:ss'),'NS001',0,'AAA','RSN','BAR001','OK',TO_DATE('2020/04/27 21:02:44', 'yyyy/mm/dd hh24:mi:ss'),1,1)
            
            return $hasil;
            
            // if($hasil->num_rows() > 0){
            //     return $hasil->result();
            // } else {
            //     return array();
            // }
        }

}

/* End of file HomeModel.php */
 ?>