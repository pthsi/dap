<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_glz extends CI_Controller {

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
			$d['judul']="Rekap Glasir";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query("select a.id_fg, a.tgl_input, b.nama_lengkap as pic, a.jenis, a.plan, a.aktual, 		
									a.inputer from jc_trans a join fg_users b on a.pic = b.username order by a.tgl_input desc");
									
			$d['content'] = 'glz/v_gl_view';
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
			$d['judul']="Input Cetak Jiggering dan Casting";
			$d['class'] = "transaksi";
			
			$id_fg = $this->model_global->maxJc();
			$d['id_fg'] = $id_fg;
			
			//$this->load->model('model_global');
			//$jns_wip = $this->model_global->getJenisFg();
			//$d['kota'] = $jns_wip;
			
			$d['content'] = 'jigcas/v_jc_form';
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
			$d['judul']="Edit Cetak Jiggering dan Casting";
			$d['class'] = "transaksi";
			
			$id_fg = $this->uri->segment(3);
			$d['id_fg'] = $id_fg;
            //$this->load->model('model_global');
			//$jns_wip = $this->model_global->getJenisFg();
			//$d['kota'] = $jns_wip;
			$d['content'] = 'jigcas/v_jc_form';
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
			$id_fg['id_fg']	= $this->input->post('id_fg');
                        			
			$q = $this->db->get_where("jc_trans",$id_fg);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl_input = $this->model_global->tgl_str($dt->tgl_input);
					$d['tgl_input'] = $tgl_input;
					$d['pic'] = $dt->pic;
                    $d['jenis'] = $dt->jenis;
					$d['plan'] = $dt->plan;
					$d['aktual'] = $dt->aktual;
				}
				echo json_encode($d);
			}else{
					$d['tgl_input'] = '';
					$d['pic'] = '';
					$d['jenis'] = '';
					$d['plan'] = '';
					$d['aktual'] = '';
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
			
			$id['id_fg'] = $this->input->post('id_fg');
			$tgl_input = $this->model_global->tgl_sql($this->input->post('tgl_input'));
			$dt['tgl_input'] = $tgl_input;
			$dt['pic'] = $this->input->post('pic');
			$dt['jenis'] = $this->input->post('jenis');
			$dt['plan'] = $this->input->post('plan');
			$dt['aktual'] = $this->input->post('aktual');   
			$dt['inputer'] = $username;
						
			$q = $this->db->get_where("jc_trans",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("jc_trans",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("jc_trans",$dt);
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
			$id_fg['id_fg']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("jc_trans",$id_fg);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("jc_trans",$id_fg);
			}
			redirect('c_jigcas','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */