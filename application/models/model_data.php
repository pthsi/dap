<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_data extends CI_Model {

	/**
	 * @author : Deddy Rusdiansyah
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
	public function data_jurusan(){
		$q = $this->db->order_by('kd_prodi');
		$q = $this->db->get('prodi');
		return $q;
	}
	
	public function master_target(){
		$q = $this->db->order_by('id_wip');
		$q = $this->db->get('wip_keramik_kat');
		return $q;
	}
	
	public function nama_jurusan($id){
		$q = $this->db->query("SELECT * FROM prodi WHERE kd_prodi='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->prodi;
            }
        }else{
            $hasil = '';
        }
		return $hasil;
	}
	
	public function singkat_jurusan($id){
		$q = $this->db->query("SELECT * FROM prodi WHERE kd_prodi='$id'");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $hasil = $dt->singkat;
            }
        }else{
            $hasil ='';
        }
		return $hasil;
	}
	
	public function data_mk($jur){
		$id['kd_prodi'] = $jur;
		$q = $this->db->order_by('kd_mk');
		$q = $this->db->get_where('mata_kuliah',$id);
		return $q;
	}
	
	public function data_dosen($jur){
		$id['kd_prodi'] = $jur;
		$q = $this->db->order_by('kd_dosen');
		$q = $this->db->get_where('dosen',$id);
		return $q;
	}
	
	public function th_akademik_jadwal(){
		$q = $this->db->query("SELECT th_akademik FROM jadwal GROUP BY th_akademik ORDER BY th_akademik");
		return $q;
	}
	
	public function ambil_shift(){
		$q = $this->db->query("SELECT shift FROM fg_shift");
		return $q;
	}
	
	public function ambil_pic_fg(){
		$q = $this->db->query("SELECT username, nama_lengkap FROM fg_users WHERE acces='t3' AND level ='inputer,user'");
		return $q;
	}
        
        public function picFgar(){
		$q = $this->db->query("SELECT username, nama_lengkap FROM fg_users WHERE acces='t5' AND level ='inputer,user'");
		return $q;
	}
        
        public function picJc(){
		$q = $this->db->query("SELECT username, nama_lengkap FROM fg_users WHERE acces='t6' AND level ='inputer,user'");
		return $q;
	}
        
        public function picGl(){
		$q = $this->db->query("SELECT username, nama_lengkap FROM fg_users WHERE acces='t7' AND level ='inputer,user'");
		return $q;
	}
	
	public function ambil_pengiriman_fg(){
		$q = $this->db->query("SELECT pengiriman from fg_pengiriman");
		return $q;
	}
	
	public function ambil_pic_wip(){
		$q = $this->db->query("SELECT username, nama_lengkap FROM fg_users WHERE acces='t4' AND level ='inputer,user'");
		return $q;
	}
	
	public function ambil_pic_pck(){
		$q = $this->db->query("SELECT username, nama_lengkap FROM fg_users WHERE acces='t2' AND level ='inputer,user'");
		return $q;
	}
        
        public function ambil_section(){
		$q = $this->db->query("select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
group by day(b.sec_des), b.sec_des order by b.sec_des asc");
		return $q;
	}
	
	public function ambil_dko_pck(){
		$q = $this->db->query("SELECT username, nama_lengkap FROM fg_users WHERE acces='t1' AND level ='inputer,user'");
		return $q;
	}
	
	public function ambil_pic_all(){
		$q = $this->db->query("SELECT username, username as pic, department, nama_lengkap FROM fg_users WHERE acces='t4' or acces='t3' or acces='t2' or acces='t1' AND level ='inputer,user'");
		return $q;
	}
	
	public function ambil_jns_wip(){
		$q = $this->db->query("SELECT * from wip_keramik_kat where CURDATE() between period_start and period_end and cat_target = 'WIP Keramik'");
		return $q;
	}
	
	public function ambil_lokasi(){
		$q = $this->db->query("SELECT lokasi from wip_lokasi");
		return $q;
	}
	
	public function th_akademik_krs_mhs($nim){
		$q = $this->db->query("SELECT th_akademik FROM krs WHERE nim='$nim' GROUP BY th_akademik ORDER BY th_akademik");
		return $q;
	}
	
	public function th_akademik_krs_dosen($key){
		$q = $this->db->query("SELECT th_akademik FROM krs WHERE kd_dosen='$key' GROUP BY th_akademik ORDER BY th_akademik");
		return $q;
	}
	
	public function data_mhs($jur){
		$id['kd_prodi'] = $jur;
		$q = $this->db->order_by('nim');
		$q = $this->db->get_where('mahasiswa',$id);
		return $q;
	}
	
	public function data_all_mhs(){
		$this->db->where('status','Aktif');
		$this->db->order_by('nim');
		$q = $this->db->get('mahasiswa');
		return $q;
	}
	
	/*** jumlah data ***/
	public function jml_data($table){
		$q = $this->db->get($table);
		return $q->num_rows();
	}
	
	public function jml_data_jadwal($th,$smt,$prodi){
		$key['th_akademik']= $th;
		$key['semester'] = $smt;
		$key['kd_prodi'] = $prodi;
		$q = $this->db->get_where("jadwal",$key);
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_krs($th,$smt,$prodi){
		
		$q = $this->db->query("SELECT a.th_akademik,a.semester,b.kd_prodi 
								FROM krs as a
								JOIN jadwal as b
								ON a.id_jadwal = b.id_jadwal
								WHERE a.th_akademik='$th' AND a.semester='$smt' AND b.kd_prodi='$prodi'
								GROUP BY a.th_akademik,a.nim");
		$row = $q->num_rows();
		return $row;
	}
	
	public function jml_data_nilai($th,$smt,$mk){
		
		$q = $this->db->query("SELECT *
								FROM krs 
								WHERE th_akademik='$th' AND semester='$smt' AND kd_mk='$mk' AND NOT ISNULL(nilai_akhir)");
		$row = $q->num_rows();
		return $row;
	}
	
	
	/*** data table ***/
	public function data($table){
		$q = $this->db->get($table);
		return $q->result();
	}
	
	
	/**** REFERENSI ***/
	public function semester(){
		$q = array('ganjil','genap');
		return $q;
	}
	
	public function smt(){
		$q = array('1','2','3','4','5','6','7','8');
		return $q;
	}
	
	public function hari_kuliah(){
		$q = array('Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu');
		return $q;
	}
	
	public function jam_kuliah(){
		$q = array('08.00 - 10.00','10.00 - 12.00','13.00 - 15.00','15.00 - 17.00','19.00 - 20.00','20.00 - 22.00');
		return $q;
	}
	
	public function ruang_kuliah(){
		$q = array('R01','R02','R03','R04');
		return $q;
	}
	
	public function status_mhs(){
		$q = array('Aktif','Cuti','DO','Meninggal','Lulus');
		return $q;
	}
	
	public function status_dosen(){
		$q = array('Aktif','Keluar');
		return $q;
	}
	
	public function nilai(){
		$q = array('A','B+','B','C+','C','D','E');
		return $q;
	}
	
	public function jenjang_pendidikan(){
		$q = array('SMA / Sederajat','D3','S1','S2','S3');
		return $q;
	}
	
	
	/*** cari_data **/
	public function cari_id_username($u){
		$q = $this->db->query("SELECT * FROM admins WHERE username='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->id_username;
		}
		return $hasil;
	}
	
	public function cari_foto_username($u){
		$q = $this->db->query("SELECT * FROM admins WHERE username='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->foto;
		}
		return $hasil;
	}
	
	public function cari_foto_mahasiswa($u){
		$q = $this->db->query("SELECT * FROM mahasiswa WHERE nim='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->file_foto;
		}
		return $hasil;
	}
	
	public function cari_foto_dosen($u){
		$q = $this->db->query("SELECT * FROM dosen WHERE kd_dosen='$u'");
		foreach($q->result() as $dt){
			$hasil = $dt->file_foto;
		}
		return $hasil;
	}
	
	public function cari_data_mhs($nim){
		$id['nim'] = $nim;
		$q = $this->db->get_where("mahasiswa",$id);
		return $q;
	}
	
	public function cari_semester_aktif($nim){
		$q = $this->db->query("SELECT smt FROM krs WHERE nim='$nim' GROUP BY smt ORDER BY smt");
		return $q;
	}
	
	public function cari_smt_krs($th,$smt,$nim){
		$q = $this->db->query("SELECT smt FROM krs WHERE th_akademik='$th' AND semester='$smt' AND nim='$nim' GROUP BY smt");
		foreach($q->result() as $dt){
			$hasil = $dt->smt;
		}
		return $hasil;
	}
	
	public function cari_sks_jadwal($id){
		$q = $this->db->query("SELECT * FROM jadwal WHERE id_jadwal='$id'");
		foreach($q->result() as $dt){
			$mk = $dt->kd_mk;
			$q_mk = $this->db->query("SELECT sks FROM mata_kuliah WHERE kd_mk='$mk'");
			foreach($q_mk->result() as $dt_mk){
				$hasil = $dt_mk->sks;
			}
		}
		return $hasil;
	}
	
	public function cari_jml_sks_krs($th,$smt,$nim){
		$q = $this->db->query("SELECT SUM(sks) as t_sks FROM krs WHERE th_akademik='$th' AND semester='$smt' AND nim='$nim' GROUP BY smt");
		if($q->num_rows>0){
			foreach($q->result() as $dt){
				$hasil = $dt->t_sks;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function cari_jml_sks_krs_($th,$nim){
		$q = $this->db->query("SELECT SUM(sks) as t_sks FROM krs WHERE th_akademik='$th' AND nim='$nim' GROUP BY smt");
		if($q->num_rows>0){
			foreach($q->result() as $dt){
				$hasil = $dt->t_sks;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function cari_ipk_lalu($smt,$nim){
		if($smt>1){
			
			$smt = $smt-1;
			$q = $this->db->query("SELECT * FROM krs WHERE smt='$smt' AND nim='$nim'");
			$t_sks =0;
			$t_nilai=0;
			$t_akhir =0;
			foreach($q->result() as $dt){
				$t_sks = $t_sks + $dt->sks;
				$n_angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
				$t_nilai = $t_nilai + $n_angka;
				$akhir = $n_angka*$dt->sks;
				$t_akhir = $t_akhir+$akhir;
			}
			$h = number_format($t_akhir/$t_sks,2);
		}else{
			$h = 0;
		}
		return $h;
	}
	
	public function cari_ip($nim){
		
		$q = $this->db->query("SELECT * FROM krs WHERE nim='$nim' AND nilai_akhir<>''");
		if($q->num_rows()>0){
			$t_sks =0;
			$t_nilai=0;
			$t_akhir=0;
			$h=0;
			foreach($q->result() as $dt){
				$t_sks = $t_sks+$dt->sks;
				$n_angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
				$t_nilai = $t_nilai+$n_angka;
				$akhir = $n_angka*$dt->sks;
				$t_akhir = $t_akhir+$akhir;
			}
			$h = number_format($t_akhir/$t_sks,2);
		}else{
			$h=0;
		}
		return $h;
	}
	
	public function cari_ipk($smt,$nim){
		
		$q = $this->db->query("SELECT * FROM krs WHERE smt='$smt' AND nim='$nim' AND nilai_akhir<>''");
		if($q->num_rows()>0){
			$t_sks =0;
			$t_nilai=0;
			$t_akhir=0;
			foreach($q->result() as $dt){
				$t_sks = $t_sks+$dt->sks;
				$n_angka = $this->model_data->cari_nilai_angka($dt->nilai_akhir);
				$t_nilai = $t_nilai+$n_angka;
				$akhir = $n_angka*$dt->sks;
				$t_akhir = $t_akhir+$akhir;
			}
			$h = number_format($t_akhir/$t_sks,2);
		}else{
			$h=0;
		}
		return $h;
	}
	
	public function cari_nilai_angka($nilai){
		if($nilai=='A'){
			$h=4;
		}elseif($nilai=='B'){
			$h=3;
		}elseif($nilai=='C'){
			$h=2;
		}elseif($nilai=='D'){
			$h=1;	
		}elseif($nilai=='E'){
			$h=0;		
		}else{
			$h = '';
		}
		return $h;
	}
	
	
	
	public function cari_nama_mk($key){
		$q = $this->db->query("SELECT * FROM mata_kuliah WHERE kd_mk='$key'");
		if($q->num_rows()>0){
			foreach($q->result() as $dt){
				$hasil = $dt->nama_mk;
			}
		}else{
			$hasil='';
		}
		return $hasil;
	}
	
	public function cari_nama_dosen($key){
		$q = $this->db->query("SELECT * FROM dosen WHERE kd_dosen='$key'");
		if($q->num_rows()>0){
			foreach($q->result() as $dt){
				$hasil = $dt->nama_dosen;
			}
		}else{
			$hasil='';
		}
		return $hasil;
	}
	
	public function cari_nama_ka_prodi($key){
		$q = $this->db->query("SELECT * FROM prodi WHERE kd_prodi='$key'");
		foreach($q->result() as $dt){
			$hasil = array('nama'=>$dt->ketua_prodi,'nik'=>$dt->nik);
		}
		return $hasil;
	}
	
	public function cari_data_mhs_lengkap($key){
		$q = $this->db->query("SELECT * FROM mahasiswa WHERE nim='$key'");
		foreach($q->result() as $dt){
			$hasil = array('nama'=>$dt->nama_mhs,'sex'=>$dt->sex);
		}
		return $hasil;
	}
	
	public function cari_nama_mhs($key){
		$q = $this->db->query("SELECT * FROM mahasiswa WHERE nim='$key'");
		foreach($q->result() as $dt){
			$hasil = $dt->nama_mhs;
		}
		return $hasil;
	}
	
	public function cari_kd_prodi_mhs($key){
		$q = $this->db->query("SELECT * FROM mahasiswa WHERE nim='$key'");
		foreach($q->result() as $dt){
			$hasil = $dt->kd_prodi;
		}
		return $hasil;
	}
	
	public function cari_mk_jadwal($key){
		$q = $this->db->query("SELECT * FROM jadwal WHERE id_jadwal='$key'");
		foreach($q->result() as $dt){
			$hasil = $dt->kd_mk;
		}
		return $hasil;
	}
	
	public function jml_sks_mhs($th_ak,$smt,$nim){
		$q = $this->db->query("SELECT SUM(sks) as t_sks FROM krs WHERE th_akademik='$th_ak' AND semester='$smt' AND nim='$nim'");
		$r = $q->num_rows();
		if($r>0){
			foreach($q->result() as $dt){
				$h = $dt->t_sks;
			}
		}else{
			$h = 0;
		}
		return $h;
	}
	
	public function cari_jml_mhs_mk($thak,$kdmk,$kddosen){
		$q = $this->db->query("SELECT * FROM krs WHERE th_akademik='$thak' AND kd_mk='$kdmk' AND kd_dosen='$kddosen'");
		$r = $q->num_rows();
		/*
		if($r>0){
			foreach($q->result() as $dt){
				$h = $dt->t_sks;
			}
		}else{
			$h = 0;
		}
		*/
		return $r;
	}
	
	public function create_category_mhs($th){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik='$th' group by th_akademik");
		$hasil ='';
		foreach($q->result() as $dt){
			$hasil .=$dt->th_akademik.',';
			$x = $dt->th_akademik;
		}
		//$hasil .= $x+9;
		return $hasil;
	}
	
	public function create_category($th){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik<='$th' group by th_akademik");
		$hasil ='';
		foreach($q->result() as $dt){
			$hasil .=$dt->th_akademik.',';
			$x = $dt->th_akademik;
		}
		//$hasil .= $x+9;
		return $hasil;
	}
	
	public function create_category_krs_nim($nim){
		$q = $this->db->query("SELECT th_akademik FROM krs WHERE nim='$nim' group by th_akademik ORDER BY th_akademik");
		$hasil ='';
		foreach($q->result() as $dt){
			$hasil .=$dt->th_akademik.',';
			$x = $dt->th_akademik;
		}
		//$hasil .= $x+9;
		return $hasil;
	}
	
	public function create_data_krs_nim($nim){
		$q = $this->db->query("SELECT th_akademik,smt FROM krs WHERE nim='$nim' group by th_akademik ORDER BY th_akademik");
		//$data = array();
		$data = '[';
		foreach($q->result() as $dt){
			$th = $dt->th_akademik;
			$smt = $dt->smt;
			//$this->db->where(array('th_akademik'=>$th,'nim'=>$nim));
			//$this->db->from('krs');
			//$q2 = $this->db->get();
			 $data .= $this->model_data->cari_ipk($smt,$nim).','; //$q2->num_rows();
		}
		$data .=']';
		//return json_encode($data);
		return $data;
	}
	
	public function data_chart($key){
		$q = $this->db->query("SELECT th_akademik FROM krs group by th_akademik LIMIT 3");
        if($q->num_rows()>0){
            $data = array();
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;
                 $q2 = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th' AND kd_prodi='$key' GROUP BY nim,th_akademik");
                 $data[] = $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return json_encode($data);
	}
	
	public function data_chart_mhs_aktif($th,$key){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik<='$th' group by th_akademik LIMIT 3");
        if($q->num_rows()>0){
            $data = array();
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                $this->db->where(array('th_akademik'=>$th,'kd_prodi'=>$key,'status'=>'Aktif'));
                //$this->db->group_by('nim','th_akadmeik');
                $this->db->from('mahasiswa');
                $q2 = $this->db->get();
                 //$q2 = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th' AND kd_prodi='$key' GROUP BY nim,th_akademik");
                 $data[] = $q2->num_rows();
            }
        }else{
            $data=0;
        }
		return json_encode($data);
	}
	
	public function data_chart_krs($th,$key){
		$q = $this->db->query("SELECT th_akademik FROM krs WHERE th_akademik<='$th' group by th_akademik LIMIT 3");
        if($q->num_rows()>0){
            $data = array();
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                $this->db->where(array('th_akademik'=>$th,'kd_prodi'=>$key));
                //$this->db->group_by('nim','th_akadmeik');
                $this->db->from('krs');
                $q2 = $this->db->get();
                 //$q2 = $this->db->query("SELECT * FROM krs WHERE th_akademik='$th' AND kd_prodi='$key' GROUP BY nim,th_akademik");
                 $data[] = $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return json_encode($data);
	}
	
	public function get_chart_manual($tgl_akhir){
		$q = $this->db->query("SELECT 
				  p.tgl_input as kategori,
				  (SELECT COALESCE(sum(pcs_item),0) FROM fg_transaksi a WHERE pengiriman='Lokal' AND a.tgl_input=p.tgl_input) AS lokal,
				  (SELECT COALESCE(sum(pcs_item),0) FROM fg_transaksi a WHERE pengiriman='Ekspor' AND a.tgl_input=p.tgl_input) AS ekspor
				FROM fg_transaksi p where p.tgl_input between '2015-06-05' and '$tgl_akhir' group by day (tgl_input)");
										
                 $chart_all[] = $q2->num_rows();
     
		return json_encode($chart_all);
	}
	
	public function data_chart_wisuda($th,$key){
		$q = $this->db->query("SELECT th_akademik FROM wisuda WHERE th_akademik<='$th' group by th_akademik LIMIT 3");
        if($q->num_rows()>0){
            $data = array();
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                 $q2 = $this->db->query("SELECT a.th_akademik,b.kd_prodi
                                        FROM wisuda as a
                                        JOIN mahasiswa as b
                                        ON a.nim = b.nim
                                        WHERE a.th_akademik='".$th."' AND b.kd_prodi='".$key."'");
                 $data[] = $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return json_encode($data);
	}
	
	public function data_chart_mhs($th,$status){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik='$th' group by th_akademik LIMIT 1");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                $this->db->where(array('th_akademik'=>$th,'status'=>$status));
                $this->db->from('mahasiswa');
                $q2 = $this->db->get();
                 $data = $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return $data;
	}
	
	public function data_chart_mhs_total($th){
		$q = $this->db->query("SELECT th_akademik FROM mahasiswa WHERE th_akademik='$th' group by th_akademik LIMIT 1");
        if($q->num_rows()>0){
            foreach($q->result() as $dt){
                $th = $dt->th_akademik;

                $this->db->where(array('th_akademik'=>$th));
                $this->db->from('mahasiswa');
                $q2 = $this->db->get();
                $data= $q2->num_rows();
            }
        }else{
            $data = 0;
        }
		return $data;
	}
	
	public function data_chart_dosen($key){
		
			$this->db->where(array('kd_prodi'=>$key,'status'=>'Aktif'));
			$this->db->from('dosen');
			$q2 = $this->db->get();
            if($q2->num_rows()>0){
			     $data = $q2->num_rows();
            }else{
                $data = 0;
            }
		return $data;
	}
        
        function maxJc(){
                    $q = $this->db->query("SELECT MAX(id_fg) as no FROM jc_trans");
                    foreach($q->result() as $dt){
                            $no = (int) $dt->no+1;
                    }
                    return $no;
            }
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */