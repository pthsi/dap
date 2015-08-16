<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_fgar extends CI_Controller {

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
			$d['judul']="Rekap Finish Good Pengiriman";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query("select a.id_fg, a.tgl_input, c.nama_lengkap as pic, b.ket as jenis, a.total, a.target, a.inputer
from fg_trans_ar a join wip_keramik_kat b on a.jenis = b.id_wip join fg_users c on a.pic = c.username
order by a.tgl_input desc");
			$d['content'] = 'fgar/v_fg_view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	function get_kecamatan1(){
        $this->load->model('model_global');
        $id_wip = $this->input->post('id_wip');
        $target = $this->model_global->get_fgar($id_wip);
        
        foreach($target as $a){
			echo '<input type="text" name="target" id="target" class="span2" readonly="readonly" value="'.$a->pcs_target.'"/> <br>';
        }
    }
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Input Rekap Finish Good Pengiriman";
			$d['class'] = "transaksi";
			
			$id_fg = $this->model_global->maxCfgar();
			$d['id_fg'] = $id_fg;
			
			$this->load->model('model_global');
			$jns_wip = $this->model_global->getJenisFg();
			$d['kota'] = $jns_wip;
			
			$d['content'] = 'fgar/v_fg_form';
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
			$d['judul']="Edit Rekap Finish Good Pengiriman";
			$d['class'] = "transaksi";
			
			$id_fg = $this->uri->segment(3);
			$d['id_fg'] = $id_fg;
                        $this->load->model('model_global');
			$jns_wip = $this->model_global->getJenisFg();
			$d['kota'] = $jns_wip;
			$d['content'] = 'fgar/v_fg_form';
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
                        			
			$q = $this->db->get_where("fg_trans_ar",$id_fg);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl_input = $this->model_global->tgl_str($dt->tgl_input);
					$d['tgl_input'] = $tgl_input;
					$d['pic'] = $dt->pic;
                                        $d['pengiriman'] = $dt->jenis;
					$d['total'] = $dt->total;
					$d['target'] = $dt->target;
				}
				echo json_encode($d);
			}else{
					$d['tgl_input'] = '';
					$d['pic'] = '';
					$d['total'] = '';
					$d['target'] = '';
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
			$dt['jenis'] = $this->input->post('pengiriman');
			$dt['total'] = $this->input->post('total');
			$dt['target'] = $this->input->post('target');   
			$dt['inputer'] = $username;
						
			$q = $this->db->get_where("fg_trans_ar",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("fg_trans_ar",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("fg_trans_ar",$dt);
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
			
			$q = $this->db->get_where("fg_trans_ar",$id_fg);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("fg_trans_ar",$id_fg);
			}
			redirect('c_fgar','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */