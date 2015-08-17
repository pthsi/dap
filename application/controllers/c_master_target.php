<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_master_target extends CI_Controller {

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
			$d['judul']="Master Target";
			$d['class'] = "master";
			
			$d['data'] = $this->db->query("SELECT a.id_wip,a.pic, a.jns_wip, a.time_release, a.cat_target,a.target_min, a.pcs_target, 
											a.pcs_target_cat, a.period_start, a.period_end, b.nama_lengkap, a.inputer, a.ket, a.`status`
											FROM wip_keramik_kat as a JOIN fg_users as b ON a.pic = b.username order by id_wip desc");
			
			$d['content'] = 'master/v_master_target_view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Master Target";
			$d['class'] = "master";
			
			$id_wip = $this->model_global->cari_max_master_target();
			$d['id_wip'] = $id_wip;
			$d['content'] = 'master/v_master_target_form';
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
			$d['judul']="Master Target";
			$d['class'] = "master";
			
			$id_wip = $this->uri->segment(3);
			$d['id_wip'] = $id_wip;
			$d['content'] = 'master/v_master_target_form';
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
			$id_wip['id_wip']	= $this->input->post('id_wip');
			
			$q = $this->db->get_where("wip_keramik_kat",$id_wip);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$time_release = $this->model_global->tgl_str($dt->time_release);
					$period_start = $this->model_global->tgl_str($dt->period_start);
					$period_end = $this->model_global->tgl_str($dt->period_end);
					$d['time_release'] = $time_release;
					$d['jns_wip'] = $dt->jns_wip;
					$d['cat_target'] = $dt->cat_target;
					$d['target_min'] = $dt->target_min;
					$d['pcs_target'] = $dt->pcs_target;
					$d['pcs_target_cat'] = $dt->pcs_target_cat;
					$d['period_start'] = $period_start;
					$d['period_end'] = $period_end;
					$d['ket'] = $dt->ket;
					$d['pic'] = $dt->pic;
					$d['status'] = $dt->status;
				}
				echo json_encode($d);
			}else{
					$d['time_release'] = '';
					$d['jns_wip'] = '';
					$d['cat_target'] = '';
					$d['target_min'] = '';
					$d['pcs_target'] = '';
					$d['pcs_target_cat'] = '';
					$d['period_start'] = '';
					$d['period_end'] = '';
					$d['pic'] = '';
					$d['ket'] = '';
					$d['status'] = '';
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
			
			$id['id_wip'] = $this->input->post('id_wip');
			$dt['jns_wip'] = $this->input->post('jns_wip');
			$time_release = $this->model_global->tgl_sql($this->input->post('time_release'));
			$dt['time_release'] = $time_release;
			$dt['cat_target'] = $this->input->post('cat_target');
			$dt['target_min'] = $this->input->post('target_min');
			$dt['pcs_target'] = $this->input->post('pcs_target');
			$dt['pcs_target_cat'] = $this->input->post('pcs_target_cat');
			$period_start = $this->model_global->tgl_sql($this->input->post('period_start'));
			$dt['period_start'] = $period_start;
			$period_end = $this->model_global->tgl_sql($this->input->post('period_end'));
			$dt['period_end'] = $period_end;
			$dt['pic'] = $this->input->post('pic');
			$dt['ket'] = $this->input->post('ket');
			$dt['status'] = $this->input->post('status');
			$dt['inputer'] = $username;
						
			$q = $this->db->get_where("wip_keramik_kat",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("wip_keramik_kat",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("wip_keramik_kat",$dt);
				echo "Data Sukses diSimpan";
			}
		}else{
			redirect('login','refresh');
		}
		
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$id_wip['id_wip']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("wip_keramik_kat",$id_wip);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("wip_keramik_kat",$id_wip);
			}
			redirect('c_wip','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */