<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_app extends CI_Model {

	/**
	 * @author : Deddy Rusdiansyah
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
		
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
	 function get_jenis_wip(){
        $query="SELECT * from wip_keramik_kat where CURDATE() between period_start and period_end AND cat_target = 'WIP Keramik'";
        $q=$this->db->query($query);    
        if ($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
	
	 function get_jenis_fg(){
        $query="SELECT * from wip_keramik_kat where CURDATE() between period_start and period_end AND jns_wip = 'Finish Good' 
				AND cat_target = 'Ekspor' OR cat_target = 'Lokal'";
        $q=$this->db->query($query);    
        if ($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
	
	function get_jenis_pck(){
        $query="SELECT * from wip_keramik_kat where CURDATE() between period_start and period_end AND jns_wip like '%Packing%'";
        $q=$this->db->query($query);    
        if ($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
	
	function get_jenis_dko(){
        $query="SELECT * from wip_keramik_kat where CURDATE() between period_start and period_end AND jns_wip like '%Dekorasi%'";
        $q=$this->db->query($query);    
        if ($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
	
	 function get_target($id_wip){
        $query="select * from wip_keramik_kat where id_wip = '$id_wip'";
        $q=$this->db->query($query);    
        if ($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
	
	function get_targedko($id_dko){
        $query="select * from wip_keramik_kat where id_wip = '$id_dko'";
        $q=$this->db->query($query);    
        if ($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
	
	function get_kat_pck($kategori){
        $query="select * from wip_keramik_kat where id_wip = '$kategori'";
        $q=$this->db->query($query);    
        if ($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
	
	function get_kat_dko($kategori){
        $query="select * from wip_keramik_kat where id_wip = '$kategori'";
        $q=$this->db->query($query);    
        if ($q->num_rows() > 0){
            foreach($q->result() as $row){
                $data[]=$row;
            }
            return $data;
        }
    }
	
	function cari_max_mutasi_mhs(){
		$q = $this->db->query("SELECT MAX(id_mutasi) as no FROM mutasi_mhs");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	function get_chart(){
		$query = "SELECT t.tgl_input as kategori,
					 (SELECT SUM(x.pcs_item)
						FROM fg_transaksi x
					   WHERE x.tgl_input <= t.tgl_input AND pengiriman = 26 and x.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS lokal,
					 (SELECT SUM(x.pcs_item)
						FROM fg_transaksi x
					   WHERE x.tgl_input <= t.tgl_input AND pengiriman = 25 and x.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS ekspor,
					 (select x.stok from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 25 and x.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS stok_ekspor,
					 (select x.stok from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 26 and x.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS stok_lokal,
					 (select distinct x.t_min from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 25 and x.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS tmin_ekspor,
					 (select distinct x.t_max from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 25 and x.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS tmax_ekspor,
					 (select distinct x.t_min from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 26 and x.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS tmin_lokal,
					 (select distinct x.t_max from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 26 and x.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) AS tmax_lokal
				FROM fg_transaksi t where t.tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()
			group BY t.tgl_input";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_pck(){
		$query = "select tgl_input as kategori,ac,ar,
			(select avg(ac) from pck_transaksi where tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) as rerata
			from pck_transaksi where tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() group by tgl_input";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_dko_auto(){
		$query = "select tgl_input as kategori,ac,ar,
			(select avg(ac) from dko_transaksi where tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()) as rerata
			from dko_transaksi where tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() group by tgl_input";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_wip(){
		$query = "SELECT 
				  p.tgl_input as kategori,
				  (SELECT COALESCE(sum(pcs_wip),0) FROM wip_transaksi a WHERE jns_wip='5' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS bodypolos,
				  (SELECT COALESCE(sum(pcs_wip),0) FROM wip_transaksi a WHERE jns_wip='6' AND a.tgl_input=p.tgl_input
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS colorwave,
				  (SELECT COALESCE(sum(pcs_wip),0) FROM wip_transaksi a WHERE jns_wip='7' AND a.tgl_input=p.tgl_input
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS inglaze,
				  (SELECT COALESCE(sum(pcs_wip),0) FROM wip_transaksi a WHERE jns_wip='8' AND a.tgl_input=p.tgl_input
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS onglaze,
				  (SELECT  distinct target FROM wip_transaksi a WHERE jns_wip='5' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS tbp,
				   (SELECT  distinct target FROM wip_transaksi a WHERE jns_wip='6' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS clv,
				  (SELECT  distinct target_min FROM wip_transaksi a WHERE jns_wip='6' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS clvmin,
				  (SELECT  distinct target FROM wip_transaksi a WHERE jns_wip='7' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS tgi,
				  (SELECT  distinct target FROM wip_transaksi a WHERE jns_wip='8' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() )) AS tgo
				FROM wip_transaksi p group by day (tgl_input)";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_ovt(){
		$query = "select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
AND a.periode between DATE_FORMAT(NOW() ,'%Y-%m-01') and NOW()
group by month(a.periode), b.sec_des order by gt desc";

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function xx(){
		$query = "SELECT  tgl_input as kategori, 
					SUM(CASE WHEN department = 'Decal' THEN ovt ELSE 0 END) AS ovt_dco,
					SUM(CASE WHEN department = 'Decal' THEN org_ovt ELSE 0 END) AS ot_dco,
					SUM(CASE WHEN department = 'Dekorasi' THEN ovt ELSE 0 END) AS ovt_dko,
					SUM(CASE WHEN department = 'Dekorasi' THEN org_ovt ELSE 0 END) AS ot_dko,
					SUM(CASE WHEN department = 'Finish Good' THEN ovt ELSE 0 END) AS ovt_fg,
					SUM(CASE WHEN department = 'Finish Good' THEN org_ovt ELSE 0 END) AS ot_fg,
					SUM(CASE WHEN department = 'P. Box' THEN ovt ELSE 0 END) AS ovt_pb,
					SUM(CASE WHEN department = 'P. Box' THEN org_ovt ELSE 0 END) AS ot_pb,
					SUM(CASE WHEN department = 'Gudang Material' THEN ovt ELSE 0 END) AS ovt_gm,
					SUM(CASE WHEN department = 'Gudang Material' THEN org_ovt ELSE 0 END) AS ot_gm,
					SUM(CASE WHEN department = 'WIP' THEN ovt ELSE 0 END) AS ovt_wip,
					SUM(CASE WHEN department = 'WIP' THEN org_ovt ELSE 0 END) AS ot_wip,
					SUM(CASE WHEN department = 'Glasir' THEN ovt ELSE 0 END) AS ovt_glz,
					SUM(CASE WHEN department = 'Glasir' THEN org_ovt ELSE 0 END) AS ot_glz,
					SUM(CASE WHEN department = 'Jiggering' THEN ovt ELSE 0 END) AS ovt_jig,
					SUM(CASE WHEN department = 'Jiggering' THEN org_ovt ELSE 0 END) AS ot_jig,
					SUM(CASE WHEN department = 'Casting' THEN ovt ELSE 0 END) AS ovt_cas,
					SUM(CASE WHEN department = 'Casting' THEN org_ovt ELSE 0 END) AS ot_cas,
					SUM(CASE WHEN department = 'Mould' THEN ovt ELSE 0 END) AS ovt_moul,
					SUM(CASE WHEN department = 'Mould' THEN org_ovt ELSE 0 END) AS ot_moul,
					SUM(CASE WHEN department = 'BGPS' THEN ovt ELSE 0 END) AS ovt_bgps,
					SUM(CASE WHEN department = 'BGPS' THEN org_ovt ELSE 0 END) AS ot_bgps,
					SUM(CASE WHEN department = 'Firing' THEN ovt ELSE 0 END) AS ovt_fir,
					SUM(CASE WHEN department = 'Firing' THEN org_ovt ELSE 0 END) AS ot_fir,
					SUM(CASE WHEN department = 'Pad Printing' THEN ovt ELSE 0 END) AS ovt_pad,
					SUM(CASE WHEN department = 'Pad Printing' THEN org_ovt ELSE 0 END) AS ot_pad,
					SUM(CASE WHEN department = 'Packing' THEN ovt ELSE 0 END) AS ovt_pck,
					SUM(CASE WHEN department = 'Packing' THEN org_ovt ELSE 0 END) AS ot_pck,
					
					round((
					
					(SUM(CASE WHEN department = 'Decal' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Decal' THEN org_ovt ELSE 0 END)) +
						(SUM(CASE WHEN department = 'Decal' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Decal' THEN org_ovt ELSE 0 END)) +
					(SUM(CASE WHEN department = 'Finish Good' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Finish Good' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'P. Box' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'P. Box' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'Gudang Material' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Gudang Material' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'WIP' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'WIP' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'Glasir' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Glasir' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'Jiggering' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Jiggering' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'Casting' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Casting' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'Mould' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Mould' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'BGPS' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'BGPS' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'Firing' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Firing' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'Pad Printing' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Pad Printing' THEN org_ovt ELSE 0 END))+
					(SUM(CASE WHEN department = 'Packing' THEN ovt ELSE 0 END) /
					SUM(CASE WHEN department = 'Packing' THEN org_ovt ELSE 0 END))
					
					)/14,1) AS avg,
					
					round(avg(budget),1) as budget
					
				FROM 
					ovt_transaksi where tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()
				GROUP BY MONTH(tgl_input)";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
        
	
	function xxx(){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Decal' and tgl_input between DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
        
        //=================
        
        function get_chart_ovtm($tgl_awal,$tgl_akhir){
		$query = "select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
AND a.periode between '$tgl_awal' and '$tgl_akhir'
group by month(a.periode), b.sec_des order by gt desc";

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	//=================
	function get_chart_dcom($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Decal' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_dkom($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Dekorasi' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_pbm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'P. Box' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_gmm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Gudang Material' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_wipxm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'WIP' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_fgm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Finish Good' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_glzm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Glasir' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_jigm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Jiggering' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_casm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Casting' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_molm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Mould' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_bgpsm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'BGPS' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_fngm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Firing' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_padm($tgl_awal,$tgl_akhir){
		$query = "select tgl_input as kategori, ovt as jam_ovt, org_ovt, budget, TRUNCATE(COALESCE(ovt/org_ovt,0),1) as rerata_lembur
					from ovt_transaksi
					where department = 'Pad Printing' and tgl_input between '$tgl_awal' AND '$tgl_akhir'
					group by tgl_input";
		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	//=================
	
	function get_chart_manual($tgl_awal,$tgl_akhir){
		$tglklausa = "and x.tgl_input between '$tgl_awal' AND '$tgl_akhir'";
		
		
		$query = "SELECT t.tgl_input as kategori,
					 (SELECT SUM(x.pcs_item)
						FROM fg_transaksi x
					   WHERE x.tgl_input <= t.tgl_input AND pengiriman = 26 $tglklausa) AS lokal,
					 (SELECT SUM(x.pcs_item)
						FROM fg_transaksi x
					   WHERE x.tgl_input <= t.tgl_input AND pengiriman = 25 $tglklausa) AS ekspor,
					 (select x.stok from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 25 $tglklausa) AS stok_ekspor,
					 (select x.stok from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 26 $tglklausa) AS stok_lokal,
					 (select distinct x.t_min from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 25 $tglklausa) AS tmin_ekspor,
					 (select distinct x.t_max from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 25 $tglklausa) AS tmax_ekspor,
					 (select distinct x.t_min from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 26 $tglklausa) AS tmin_lokal,
					 (select distinct x.t_max from fg_transaksi x where x.tgl_input = t.tgl_input
					   AND pengiriman = 26 $tglklausa) AS tmax_lokal
				FROM fg_transaksi t where  t.tgl_input between '$tgl_awal' and '$tgl_akhir' group by t.tgl_input";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_manual_pck($tgl_awal,$tgl_akhir){
	
	 $tglklausa = "and tgl_input between '$tgl_awal' AND '$tgl_akhir'";
		
		$query = "	select tgl_input as kategori,ac,ar,
(select avg(ac) from pck_transaksi where kategori = 18 $tglklausa) as rerata
from pck_transaksi where kategori = 18 $tglklausa group by tgl_input";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_manual_dko($tgl_awal,$tgl_akhir){
	
	 $tglklausa = "and tgl_input between '$tgl_awal' AND '$tgl_akhir'";
		
		$query = "	select tgl_input as kategori,ac,ar,
(select avg(ac) from dko_transaksi where kategori = 22 $tglklausa) as rerata
from dko_transaksi where kategori = 22 $tglklausa group by tgl_input";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function get_chart_manual_wip($tgl_awal,$tgl_akhir){
		
		$query = " SELECT 
				  p.tgl_input as kategori,
				  (SELECT COALESCE(sum(pcs_wip),0) FROM wip_transaksi a WHERE jns_wip='5' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS bodypolos,
				  (SELECT COALESCE(sum(pcs_wip),0) FROM wip_transaksi a WHERE jns_wip='6' AND a.tgl_input=p.tgl_input
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS colorwave,
				  (SELECT COALESCE(sum(pcs_wip),0) FROM wip_transaksi a WHERE jns_wip='7' AND a.tgl_input=p.tgl_input
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS inglaze,
				  (SELECT COALESCE(sum(pcs_wip),0) FROM wip_transaksi a WHERE jns_wip='8' AND a.tgl_input=p.tgl_input
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS onglaze,
				  (SELECT  distinct target FROM wip_transaksi a WHERE jns_wip='5' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS tbp,
				   (SELECT  distinct target FROM wip_transaksi a WHERE jns_wip='6' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS clv,
				  (SELECT  distinct target_min FROM wip_transaksi a WHERE jns_wip='6' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS clvmin,
				  (SELECT  distinct target FROM wip_transaksi a WHERE jns_wip='7' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS tgi,
				  (SELECT  distinct target FROM wip_transaksi a WHERE jns_wip='8' AND a.tgl_input=p.tgl_input 
				  AND (a.tgl_input between '$tgl_awal' and '$tgl_akhir' )) AS tgo
				FROM wip_transaksi p where p.tgl_input between '$tgl_awal' and '$tgl_akhir' group by day (tgl_input)";
	

		$query_result = $this->db->query($query);
		$result = $query_result->result();
		return $result;
	}
	
	function cari_max_fg_transaksi(){
		$q = $this->db->query("SELECT MAX(id_fg) as no FROM fg_transaksi");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	function cari_max_wip_transaksi(){
		$q = $this->db->query("SELECT MAX(id_wip) as no FROM wip_transaksi");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	function cari_max_pck_transaksi(){
		$q = $this->db->query("SELECT MAX(id_pck) as no FROM pck_transaksi");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	function cari_max_dko_transaksi(){
		$q = $this->db->query("SELECT MAX(id_dko) as no FROM dko_transaksi");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	function cari_max_master_target(){
		$q = $this->db->query("SELECT MAX(id_wip) as no FROM wip_keramik_kat");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	function cari_max_target(){
		$q = $this->db->query("SELECT MAX(id_wip) as no FROM wip_keramik_kat");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	function cari_max_wisuda_mhs(){
		$q = $this->db->query("SELECT MAX(id_wisuda) as no FROM wisuda");
		foreach($q->result() as $dt){
			$no = (int) $dt->no+1;
		}
		return $no;
	}
	
	public function cari_semester(){
		date_default_timezone_set('Asia/Jakarta');
		$bln = date('m');
		
		switch ($bln){
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
				return "genap";
				break;
			case 8: 
			case 9:
			case 10:
			case 11:
			case 12:
			case 1:
				return "ganjil";
				break;	
		}
		
	}
	
	public function max_sks($ip){
		
		if($ip>=3.00){
			$sks = 24;
		}elseif($ip>=2.50){
			$sks = 22;
		}elseif($ip>=2.00){
			$sks = 20;	
		}elseif($ip>=1.50){
			$sks = 16;
		}elseif($ip>=1.00){
			$sks = 14;
		}else{
			$sks = 12;
		}
		return $sks;
		/*
		switch($ip){
			case 3.00:
				return 24;
				break;
			case 2.50:
				return 22;
				break;
			case 2.00:
				return 20;
				break;	
			case 1.50:
				return 16;
				break;
			case 1.00:
				return 14;
				break;
			case 0.00:
				return 12;
				break;
		}
		*/
				
	}
	
	function cari_th_akademik(){
		date_default_timezone_set('Asia/Jakarta');
		$th = date('Y');
		
		$smt = $this->model_global->cari_semester();
		if($smt=='ganjil'){
			$ket = 1;
		}else{
			$ket = 2;
		}
		$hasil = $th.$ket;
		
		return $hasil;
	}
	
	/*
	function semester($nim){
		$id['nim'] = $nim;
		$q = $this->db->get_where("mahasiswa",$id);
		$r = $q->num_rows();
		if($r>0){
			foreach($q->result() as $dt){
				$th = substr($dt->th_akademik,0,4);
				$bln_now = date('m');
				$th_now = date('Y');
				$thn = $th_now-$th;
				if($thn >1 && $bln_now >=2){
					$smt = ($thn*2)+1;
				}elseif($thn >1 && $bln_now >=8){
					$smt = ($thn*2)+2;
				}else{
					$smt = 1;
				}
			}
		}else{
			$smt = 1;
		}
		return $smt;
	}
	*/
	function semester($nim,$thak){
		$id['nim'] = $nim;
		$q = $this->db->get_where("mahasiswa",$id);
		$r = $q->num_rows();
		if($r>0){
			foreach($q->result() as $dt){
				date_default_timezone_set('Asia/Jakarta');
				$th_now = substr($thak,0,4);//date('Y');
				$th_masuk = substr($dt->th_akademik,0,4);
				//$smt_masuk = substr($dt->th_akademik,4,1);
				$smt = substr($thak,4,1);
				$th = $th_now-$th_masuk;
				$smt =  ($th*2)+$smt;
			}
		}else{
			$smt = 1;
		}
		return $smt;
	}
	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->model_global->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->model_global->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}
	
	public function tgl_ymo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->model_global->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	//query login
	public function getLoginData($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('admins', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'getLoginSIAKAD_online';
						$sess_data['username'] = $qad->username;
						$sess_data['nama_lengkap'] = $qad->nama_lengkap;
						$sess_data['level'] = 'admin';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'index.php/home');
			}
		}else{
			/**login Mahasiswa **/
			$u = mysql_real_escape_string($usr);
			$p = md5(mysql_real_escape_string($psw));
			$s = array('Aktif','Lulus');
			//$l = 'Lulus';
			$this->db->where('nim',$u);
			$this->db->where('password',$p);
			$this->db->where_in('status',$s);
			//$this->db->or_where('status','Lulus');
			$q_mhs = $this->db->get('mahasiswa');
			//$q_mhs = $this->db->get_where('mahasiswa', array('nim' => $u, 'password' => $p,'status'=>$s, 'status'=>'Lulus'));
			if($q_mhs->num_rows()>0){
				foreach($q_mhs->result() as $dt){
					$sess_data['logged_in'] = 'getLoginSIAKAD_online';
					$sess_data['username'] = $dt->nim;
					$sess_data['nama_lengkap'] = $dt->nama_mhs;
					$sess_data['kd_prodi'] = $dt->kd_prodi;
					$sess_data['level'] = 'mahasiswa';
					$sess_data['status'] = $dt->status;
					$this->session->set_userdata($sess_data);
				}
				header('location:'.base_url().'index.php/site_mahasiswa/home');
			}else{
				/*** Login Dosen ***/
				$u = mysql_real_escape_string($usr);
				$p = md5(mysql_real_escape_string($psw));
				$s = 'Aktif';
				//$l = 'Lulus';
				$q_mhs = $this->db->get_where('dosen', array('kd_dosen' => $u, 'password' => $p,'status'=>$s));
				if($q_mhs->num_rows()>0){
					foreach($q_mhs->result() as $dt){
						$sess_data['logged_in'] = 'getLoginSIAKAD_online';
						$sess_data['username'] = $dt->kd_dosen;
						$sess_data['nama_lengkap'] = $dt->nama_dosen;
						$sess_data['kd_prodi'] = $dt->kd_prodi;
						$sess_data['level'] = 'dosen';
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'index.php/site_dosen/home');
				}else{
				
					$this->session->set_flashdata('result_login', '<br>Username / Password yang anda masukkan salah. Atau Akun Anda diblokir. Silahkan Hubungi Administrator.');
					header('location:'.base_url().'index.php/login');
				}
			}
		}
	}
        
    function maxCfgar(){
                    $q = $this->db->query("SELECT MAX(id_fg) as no FROM fg_trans_ar");
                    foreach($q->result() as $dt){
                            $no = (int) $dt->no+1;
                    }
                    return $no;
            }
            
        function getJenisFg(){
                $query="SELECT * from wip_keramik_kat where CURDATE() between period_start and period_end AND ket like '%Pengiriman%'";
                $q=$this->db->query($query);    
                if ($q->num_rows() > 0){
                    foreach($q->result() as $row){
                        $data[]=$row;
                    }
                    return $data;
                }
            }
	
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */