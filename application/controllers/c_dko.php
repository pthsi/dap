<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_dko extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Rekap AR Dekorasi";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query('SELECT a.id_dko,a.tgl_input,b.nama_lengkap,a.shift,a.lokasi, c.cat_target as kategori,
			a.plan,a.actual,a.ar*100 as ar,truncate((a.ac)*100,2) as ac,a.inputer 
			FROM dko_transaksi as a JOIN fg_users as b ON a.pic = b.username 
			JOIN wip_keramik_kat as c ON a.kategori = c.id_wip order by tgl_input desc');
			
			$d['content'] = 'dko/v_dko_view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	function get_kecamatan1(){
        $this->load->model('model_global');
        $id_pck = $this->input->post('id_pck');
        $target = $this->model_global->get_targedko($id_pck);
		
        foreach($target as $a){
			echo '<input type="text" name="target_min" id="target_min" class="span2" readonly="readonly" value="'.$a->target_min.'"/> <br>';
        }
    }
	
	function get_kat_dko(){
        $this->load->model('model_global');
        $kategori = $this->input->post('kategori');
        $target = $this->model_global->get_kat_dko($kategori);
		
        foreach($target as $a){
			echo '<input type="text" name="ar" id="ar" class="span2" readonly="readonly" value="'.$a->pcs_target.'"/> <br>';
        }
    }
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Input AR Dekorasi";
			$d['class'] = "transaksi";
			
			$id_dko = $this->model_global->cari_max_dko_transaksi();
			$d['id_dko'] = $id_dko;
			
			$this->load->model('model_global');
			$jns_dko = $this->model_global->get_jenis_dko();
			$d['kota'] = $jns_dko;
			
			$d['content'] = 'dko/v_dko_form';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Edit AR Dekorasi";
			$d['class'] = "transaksi";
			
			$id_dko = $this->uri->segment(3);
			$d['id_dko'] = $id_dko;
			
			$this->load->model('model_global');
			$jns_dko = $this->model_global->get_jenis_dko();
			$d['kota'] = $jns_dko;
			
			$d['content'] = 'dko/v_dko_form';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id_dko['id_dko']	= $this->input->post('id_dko');
			
			$q = $this->db->get_where("dko_transaksi",$id_dko);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl_input = $this->model_global->tgl_str($dt->tgl_input);
					$d['tgl_input'] = $tgl_input;
					$d['pic'] = $dt->pic;
					$d['shift'] = $dt->shift;
					$d['kategori'] = $dt->kategori;
					$d['lokasi'] = $dt->lokasi;
					$d['plan'] = $dt->plan;
					$d['actual'] = $dt->actual;
					$d['ar'] = $dt->ar;
					$d['ac'] = $dt->ac;
				}
				echo json_encode($d);
			}else{
					$d['tgl_input'] = '';
					$d['pic'] = '';
					$d['shift'] = '';
					$d['kategori'] = '';
					$d['lokasi'] = '';
					$d['plan'] = '';
					$d['actual'] = '';
					$d['ar'] = '';
					$d['ac'] = '';
				echo json_encode($d);
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$username = $this->session->userdata('username');	
		if(!empty($cek) && $level=='admin'){
			date_default_timezone_set('Asia/Jakarta');
			
			$id['id_dko'] = $this->input->post('id_dko');
			$tgl_input = $this->model_global->tgl_sql($this->input->post('tgl_input'));
			$dt['tgl_input'] = $tgl_input;
			$dt['pic'] = $this->input->post('pic');
			$dt['shift'] = $this->input->post('shift');
			$dt['kategori'] = $this->input->post('kategori');
			$dt['lokasi'] = $this->input->post('lokasi');
			$dt['plan'] = $this->input->post('plan');
			$dt['actual'] = $this->input->post('actual');
			$dt['ar'] = $this->input->post('ar');
			$dt['ac'] = $this->input->post('ac');
			$dt['inputer'] = $username;
						
			$q = $this->db->get_where("dko_transaksi",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("dko_transaksi",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("dko_transaksi",$dt);
				echo "Data Sukses diSimpan";
			}
			
			//$id_u['nim'] = $this->input->post('nim');
			//$dt_u['status']= $this->input->post('status');
			//$this->db->update("mahasiswa",$dt_u,$id_u);
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id_dko['']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("dko_transaksi",$id_dko);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("dko_transaksi",$id_dko);
			}
			redirect('c_dko','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */