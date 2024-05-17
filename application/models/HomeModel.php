<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeModel extends CI_Model {

    public function getBcdBaan($param)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'select * from BAAN.tcbinh013777 where t$barc= \''.$param.'\''
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getBarcodeId($param)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'SELECT baan.CBI_avinh020720.t$cwar as warehouse, baan.CBI_avinh020720.t$tagn as no_tag, baan.CBI_avinh020720.t$note as note, baan.CBI_avinh020720.t$pdno as no_wo, trim(baan.CBI_avinh020720.t$item) as item, baan.CBI_avinh020720.t$dsca as description_pn, baan.CBI_avinh020720.t$actq as qty, baan.CBI_avinh020720.t$actq as qty_actual, baan.CBI_avinh020720.t$orno as no_rfq, baan.CBI_avinh020720.t$bpid as bpid, baan.ttccom100720.t$nama as customer_name, (select SUM(baan.ttdsls401720.t$qoor) from baan.ttdsls401720 where t$orno = baan.ttdsls402720.t$orno) as qty_lot_deliv, baan.ttdsls401720.t$orno as sdf_order FROM BAAN.CBI_avinh020720 LEFT JOIN baan.ttdsls402720 ON baan.ttdsls402720.t$qono = baan.CBI_avinh020720.t$orno LEFT JOIN baan.ttdsls401720 ON baan.ttdsls401720.t$orno = baan.ttdsls402720.t$orno LEFT JOIN baan.ttccom100720 ON baan.CBI_avinh020720.t$bpid = BAAN.ttccom100720.t$bpid where trim(baan.CBI_avinh020720.t$note) = \''.$param.'\' ORDER BY baan.CBI_avinh020720.t$note desc FETCH FIRST 1 ROWS ONLY'
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getBarcodeIdDom($param)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'SELECT BAAN.CBI_avinh020720.t$cwar as warehouse, BAAN.CBI_avinh020720.t$tagn as no_tag, BAAN.CBI_avinh020720.t$note as note, BAAN.CBI_avinh020720.t$pdno as no_wo, trim(BAAN.CBI_avinh020720.t$item) as item, BAAN.CBI_avinh020720.t$dsca as description_pn, BAAN.CBI_avinh020720.t$admq as qty, BAAN.CBI_avinh020720.t$orno as no_rfq, BAAN.CBI_avinh020720.t$bpid as bpid FROM BAAN.CBI_avinh020720 where t$note = \''.$param.'\' ORDER BY t$note desc FETCH FIRST 1 ROWS ONLY'
            );            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getDetailBarcode($param)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'select * from  BAAN.ttcibd001720 where t$item= \'         '.$param.'\' FETCH FIRST 1 ROWS ONLY'
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getDataPN($pn)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
            // $hasil = $db2->query(
            //     'SELECT t$dsca as descs FROM BAAN.ttcibd001720 where t$item = \'         '.$pn.'\''
            // );

            $spt = 'K-SPT';

            $hasil = $db2->query(
                'SELECT BAAN.ttcibd001720.t$dsca as descs, baan.twhwmd215720.t$stoc as stok FROM BAAN.ttcibd001720 JOIN baan.twhwmd215720 ON baan.twhwmd215720.t$item = BAAN.ttcibd001720.t$item where BAAN.twhwmd215720.t$cwar = \''.$spt.'\' and BAAN.ttcibd001720.t$item = \'         '.$pn.'\' ORDER BY t$ltdt desc FETCH FIRST 1 ROWS ONLY'
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getDetailPn($param)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'select * from  BAAN.ttcibd001720 where t$item= \'         '.$param.'\' FETCH FIRST 1 ROWS ONLY'
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }
        
    public function test()
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'SELECT * FROM BAAN.tcbinh012777'
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function insert_data($year,$peri,$cwarf,$tagn,$barc,$item,$dsca,$cuni,$admq,$actq,$varq,$date,$user,$cwart,$apdt)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            // $date = date('y');

            $hasil = $db2->query(
                'INSERT INTO BAAN.tcbinh013777 VALUES (\''.$year.'\',\''.$peri.'\',\''.$cwarf.'\',\''.$tagn.'\',\''.$barc.'\',\''.$item.'\',\''.$dsca.'\',\''.$cuni.'\',\''.$admq.'\',\''.$actq.'\',\''.$varq.'\',TO_DATE(\''.$date.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$user.'\',\''.$cwart.'\',TO_DATE(\''.$apdt.'\', \'yyyy/mm/dd hh24:mi:ss\'),1,1)'
            );

            return $hasil;
        }

    public function getVarq()
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'select max(t$varq) as maxvar from baan.tcbinh013777 where TO_DATE(t$apdt, \'DD-MM-YY\') >= \'01-'.date('M').'-'.date('y').'\''
            );
            
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getDataActqNull($param)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'select t$actq as actq, t$note as barc from BAAN.CBI_avinh020720 where t$note= \''.$param.'\''
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function updateActqNull($actq,$barc)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);

            $hasil = $db2->query(
                'update baan.tcbinh013777 set t$actq = '.$actq.' where t$barc = \''.$barc.'\''
            );
        }

    //=======================================================================//

    public function updateQtyBarcode($pono,$pos,$qty)
    {
        // Load database kedua
        $db2 = $this->load->database('baan', TRUE);

        $hasil = $db2->query(
            'update baan.CBI_avinh019720 set t$qty = \''.$qty.'\' where t$pono = \''.$pono.'\' and t$pos = \''.$pos.'\''
        );

        if($hasil > 0){
            return $hasil;
        } else {
            return array();
        }
    }

    public function getWo($param)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            // $param = 'KAS';
            // $param2 = 'KAB';
            $date = '2023-MAY-01';
    
            $hasil = $db2->query(
                'select t$covn as covn, t$pdno as pdno, t$prcd as prcd, t$osta as osta from baan.ttisfc001720 where t$prdt >= TO_DATE(\''.$date.'\', \'yyyy-mm-dd\') and t$osta = 5 and t$pdno like \'%'.$param.'%\' OR t$prdt >= TO_DATE(\''.$date.'\', \'yyyy-mm-dd\') and t$osta = 7 and t$pdno like \'%'.$param.'%\' ORDER BY t$pdno asc'
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }
    
    public function cekLineTrBarcode($param='')
        {
           // Load database kedua
           $db2 = $this->load->database('baan', TRUE);
    
        //    $param = 'KAS028925';
    
           $hasil = $db2->query(
               'select (select count(t$orno) from baan.CBI_avinh019720 where t$barc like \'%'.$param.'%\' and t$orno = \' \') as status_orno, (select count(t$status) from baan.CBI_avinh019720 where t$barc like \'%'.$param.'%\') as total_status, (select count(t$status) from baan.CBI_avinh019720 where t$barc like \'%'.$param.'%\' and t$status = 1) as status_wo1, (select count(t$status) from baan.CBI_avinh019720 where t$barc like \'%'.$param.'%\' and t$status = 2) as status_wo2, (select count(t$status) from baan.CBI_avinh019720 where t$barc like \'%'.$param.'%\' and t$status = 2) as status_receipt, (select count(t$note) from baan.CBI_avinh019720 where t$barc like \'%'.$param.'%\' and t$note = \' \') as note from baan.CBI_avinh019720 where t$barc like \'%'.$param.'%\' OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY'
           );
           
           if($hasil->num_rows() > 0){
               return $hasil->result_array();
           } else {
               return array();
           }
        }
    
    public function cekReservasiWo($param)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                'select t$pdno as pdno, t$prcd as prcd, t$osta as osta, t$covn as covn, t$status as status, t$note as note, t$orno as orno from baan.ttisfc001720 join baan.CBI_avinh019720 on baan.ttisfc001720.t$pdno = baan.CBI_avinh019720.t$pono where t$pono like \'%'.$param.'%\''
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }
    
    public function getBarcodeReservasiWo($pono,$pos)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                'select t$pos as pos, t$pono as pono, t$qty as qty, t$barc as dsca, t$note as barc, t$item as item, t$whto as whto, t$whfrom as whfrom from baan.CBI_avinh019720 where t$pono = \''.$pono.'\' and t$pos = \''.$pos.'\''
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }
    
    public function getDetailWoReservasi($barc)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                'select t$pos as pos, t$status as status, t$pos as pos, t$pono as pono, t$qty as qty, t$item as item, t$note as note, t$orno as orno, t$whto as whto, t$whfrom as whfrom from baan.CBI_avinh019720 where t$barc like \'%'.$barc.'%\''
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }
    
    
    public function updateBarcodeReservasiWo($pono,$pos,$barc)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                'update baan.CBI_avinh019720 set t$status = 1, t$note = \''.$barc.'\' where t$pono = \''.$pono.'\' and t$pos = \''.$pos.'\''
            );
    
            if($hasil > 0){
                return $hasil;
            } else {
                return array();
            }
        }
    
    public function updateBarcodeReservasiWoKom($pono,$pos,$barc)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                'update baan.CBI_avinh019720 set t$note = \''.$barc.'\' where t$pono = \''.$pono.'\' and t$pos = \''.$pos.'\''
            );
    
            if($hasil > 0){
                return $hasil;
            } else {
                return array();
            }
        }

    public function getBarcodeIdCheck($barc)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                'select t$item as item, t$admq as qty, t$cwar as cwar, t$tagn as tagn, t$note as note, t$dsca as dsca, t$pdno as no_wo from baan.CBI_avinh020720 where t$note = \''.$barc.'\' and t$stat != 1 and t$sttr = 1 and t$stkn = 1 and (t$stup = 1 or t$stup = 2)'
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function getBarcodePraTr($barc)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                // 'select t$item as item, t$admq as qty, t$cwar as cwar, t$tagn as tagn, t$note as note, t$dsca as dsca, t$pdno as no_wo from baan.CBI_avinh020720 where t$note = \''.$barc.'\' and t$sttr != 1'
                'select t$item as item, t$admq as qty, t$cwar as cwar, t$tagn as tagn, t$note as note, t$dsca as dsca, t$pdno as no_wo from baan.CBI_avinh020720 where t$note = \''.$barc.'\' and t$sttr != 1'
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }
    
    public function getBarcodePraWta($barc)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                // 'select t$item as item, t$admq as qty, t$cwar as cwar, t$tagn as tagn, t$note as note, t$dsca as dsca from baan.CBI_avinh020720 where t$note = \''.$barc.'\' and t$sttr = 1 and t$stkn != 1'
                'select t$item as item, t$admq as qty, t$cwar as cwar, t$tagn as tagn, t$note as note, t$dsca as dsca from baan.CBI_avinh020720 where t$note = \''.$barc.'\' and t$sttr = 1 and t$stkn != 1'
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }
    
    public function updateBarcodeWoPraTr($note,$tagn)
        {
            // Load database kedua
            $db2 = $this->load->database('baan', TRUE);
            $date = date('Y-m-d H:i:s');
            $hasil = $db2->query(
                'update baan.CBI_avinh020720 set t$sttr = 1, t$dttr = TO_DATE(\''.$date.'\', \'yyyy/mm/dd hh24:mi:ss\') where t$note = \''.$note.'\' and t$tagn = \''.$tagn.'\''
            );
    
            if($hasil > 0){
                return $hasil;
            } else {
                return array();
            }
        }
    
    public function updateBarcodeWoWta($note,$tagn)
        {
            // Load database kedua
            $grp3 = 'KFFGX';
            $db2 = $this->load->database('baan', TRUE);
            $date = date('Y-m-d H:i:s');
            $hasil = $db2->query(
                'update baan.CBI_avinh020720 set t$grp3 = \''.$grp3.'\', t$stkn = 1, t$sttr = 1, t$dtkn = TO_DATE(\''.$date.'\', \'yyyy/mm/dd hh24:mi:ss\') where t$note = \''.$note.'\' and t$tagn = \''.$tagn.'\''
            );
    
            if($hasil > 0){
                return $hasil;
            } else {
                return array();
            }
        }

    public function updateBarcodeWoWtaChg($note,$tagn)
        {
            // Load database kedua
            $grp3 = 'KPRO2';
            $db2 = $this->load->database('baan', TRUE);
            $date = date('Y-m-d H:i:s');
            $hasil = $db2->query(
                'update baan.CBI_avinh020720 set t$grp3 = \''.$grp3.'\', t$stkn = 1, t$sttr = 1, t$dtkn = TO_DATE(\''.$date.'\', \'yyyy/mm/dd hh24:mi:ss\') where t$note = \''.$note.'\' and t$tagn = \''.$tagn.'\''
            );
    
            if($hasil > 0){
                return $hasil;
            } else {
                return array();
            }
        }

            
    public function insert_data_tr_timah($year,$peri,$cwarf,$tagn,$barc,$no_wo,$item,$dsca,$admq,$cuni,$user,$rfq,$bpid,$line,$lmac,$actq,$apdt,$aprv,$grp3,$refcntd,$refcntu,$prdt,$grp2,$endt,$stat,$stkn,$sttr,$stup,$dtkn)
        {
            // var_dump($year.'|'.$peri.'|'.$cwarf.'|'.$tagn.'|'.$barc.'|'.$no_wo.'|'.$item.'|'.$dsca.'|'.$admq.'|'.$cuni.'|'.$user.'|'.$rfq.'|'.$bpid.'|'.$line.'|'.$lmac.'|'.$actq.'|'.$apdt.'|'.$aprv.'|'.$grp3.'|'.$refcntd.'|'.$refcntu.'|'.$prdt.'|'.$grp2.'|'.$endt.'|'.$stat.'|'.$stkn.'|'.$sttr.'|'.$stup);die();
            $db2 = $this->load->database('baan', TRUE);
            // $hasil = 
            //     'insert into baan.CBI_avinh020720 values (\''.$year.'\',\''.$peri.'\',\''.$cwarf.'\',\''.$tagn.'\',\''.$barc.'\',\''.$no_wo.'\',\'         '.$item.'\',\''.$dsca.'\',\''.$admq.'\',\''.$cuni.'\',\''.$user.'\',\''.$rfq.'\',\''.$bpid.'\',\''.$line.'\',\''.$lmac.'\',\''.$actq.'\',TO_DATE(\''.$apdt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$aprv.'\',\''.$grp3.'\',\''.$refcntd.'\',\''.$refcntu.'\',TO_DATE(\''.$prdt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$grp2.'\',TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$stat.'\',TO_DATE(\''.$dtkn.'\', \'yyyy/mm/dd hh24:mi:ss\'),TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),TO_DATE(\''.$dtkn.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$grp2.'\',\''.$stkn.'\',\''.$sttr.'\',\''.$stup.'\')'
            // ;

//             var_dump('Insert into baan.CBI_avinh020720 (T$YEAR,T$PERI,T$CWAR,T$TAGN,T$NOTE,T$PDNO,T$ITEM,T$DSCA,T$ADMQ,T$CUNI,T$PRDT,T$USER,T$ORNO,T$BPID,T$MACH,T$LMAC,T$ACTQ,T$APDT,T$APRV,T$GRP3,T$GRP2,T$ENDT,T$STAT,T$STUP,T$DTUP,T$STTR,T$DTTR,T$STKN,T$DTKN,T$GRP4,T$VARQ,T$LOTQ,T$ENTR,T$CONV,T$ACT1,T$QTY3,T$USR2,T$USR3,T$GRP1,T$REFCNTD,T$REFCNTU) values (\''.$year.'\',\''.$peri.'\',\''.$cwarf.'\',\''.$tagn.'\',\''.$barc.'\',\''.$no_wo.'\',\'         '.$item.'\',\''.$dsca.'\',\''.$admq.'\',\''.$cuni.'\',TO_DATE(\''.$prdt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$user.'\',\''.$rfq.'\',\''.$bpid.'\',\''.$line.'\',\''.$lmac.'\',\''.$actq.'\',TO_DATE(\''.$apdt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$aprv.'\',\''.$grp3.'\',\''.$grp2.'\',TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$stat.'\',2,TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),1,TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),1,TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$user.'\',0,0,1,1,0,0,\''.$user.'\',\' \',\''.$user.'\',0,0)');
// die();


            $hasil = $db2->query(
                'Insert into baan.CBI_avinh020720 (T$YEAR,T$PERI,T$CWAR,T$TAGN,T$NOTE,T$PDNO,T$ITEM,T$DSCA,T$ADMQ,T$CUNI,T$PRDT,T$USER,T$ORNO,T$BPID,T$MACH,T$LMAC,T$ACTQ,T$APDT,T$APRV,T$GRP3,T$GRP2,T$ENDT,T$STAT,T$STUP,T$DTUP,T$STTR,T$DTTR,T$STKN,T$DTKN,T$GRP4,T$VARQ,T$LOTQ,T$ENTR,T$CONV,T$ACT1,T$QTY3,T$USR2,T$USR3,T$GRP1,T$REFCNTD,T$REFCNTU) values (\''.$year.'\',\''.$peri.'\',\''.$cwarf.'\',\''.$tagn.'\',\''.$barc.'\',\''.$no_wo.'\',\'         '.$item.'\',\''.$dsca.'\',\''.$admq.'\',\''.$cuni.'\',TO_DATE(\''.$prdt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$user.'\',\''.$rfq.'\',\''.$bpid.'\',\''.$line.'\',\''.$lmac.'\',\''.$actq.'\',TO_DATE(\''.$apdt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$aprv.'\',\''.$grp3.'\',\''.$grp2.'\',TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$stat.'\',2,TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),1,TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),1,TO_DATE(\''.$endt.'\', \'yyyy/mm/dd hh24:mi:ss\'),\''.$user.'\',0,0,1,1,0,0,\''.$user.'\',\' \',\''.$user.'\',0,0)'
            );

            if($hasil > 0){
                return $hasil;
            } else {
                return $hasil;
            }
        }

    public function cekTagnAutoWo($year,$month,$wh)
        {
            $dbaan = $this->load->database('baan', TRUE);

            $hasil = $dbaan->query(
                'SELECT t$tagn as tagn FROM baan.CBI_avinh020720 where t$year = \''.$year.'\' and t$peri = \''.$month.'\' and t$cwar = \''.$wh.'\' order by t$tagn desc OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY'
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

    public function searchCean($item)
        {
            $dbaan = $this->load->database('baan', TRUE);

            $hasil = $dbaan->query(
                'SELECT trim(t$item) as cean, t$cuni as cuni, t$dsca as dsca FROM baan.ttcibd001720 where t$item like \'%'.$item.'%\' OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY'
            );
            
            if($hasil->num_rows() > 0){
                return $hasil->result();
            } else {
                return array();
            }
        }

        public function validate_barcode($barc)
        {
            $db2 = $this->load->database('baan', TRUE);
    
            $hasil = $db2->query(
                'select t$item as "data", t$admq as "qty", t$cwar as "from", t$tagn as "tagn", t$note as "note",t$grp3 as "to", t$dsca as "dsca" from baan.CBI_avinh020720 where t$note = \'' . $barc . '\' and t$sttr = 1 and t$stkn != 1'
            );
            // var_dump($hasil);
    
            if ($hasil->num_rows() > 0) {
                return $hasil->result();
            } else {
                return array();
            }
        }

        public function update_data_tr($barc, $stkn, $sttr, $dtkn, $dttr, $grp3, $grp2)
        {
            // Load database kedua
            // $db3 = $this->load->database('infor_dev', TRUE);
            $db2 = $this->load->database('baan', TRUE);
    
            // $hasil = $db3->query(
            //     'update baan.tavinh020721 set t$stkn = '.$stkn.', t$sttr = '.$sttr.', t$dtkn = to_date(\''.$dtkn.'\', \'yyyy/mm/dd hh24:mi:ss\'), t$dttr = to_date(\''.$dttr.'\', \'yyyy/mm/dd hh24:mi:ss\'), t$grp3 = \''.$grp3.'\', t$grp2 = \''.$grp2.'\' where t$note = \''.$barc.'\''
            // );

            $hasil = $db2->query(
                'update baan.tavinh020720 set t$stkn = '.$stkn.', t$sttr = '.$sttr.', t$dtkn = to_date(\''.$dtkn.'\', \'yyyy/mm/dd hh24:mi:ss\'), t$dttr = to_date(\''.$dttr.'\', \'yyyy/mm/dd hh24:mi:ss\'), t$grp3 = \''.$grp3.'\', t$grp2 = \''.$grp2.'\' where t$note = \''.$barc.'\''
            );
    
            if($hasil > 0){
                return $hasil;
            } else {
                return array();
            }
        }

        public function getBarcodeComp($barc)
        {
            $db2 = $this->load->database('baan_dev', TRUE);

            $hasil = $db2->query(
                'select * from baan.CBI_avinh020721 where t$note = \'' . $barc . '\''
            );
            // var_dump($hasil);
    
            if ($hasil->num_rows() > 0) {
                return $hasil->result_array();
            } else {
                return array();
            }
        }
}

/* End of file HomeModel.php */
 ?>