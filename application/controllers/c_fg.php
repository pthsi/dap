<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_fg extends CI_Controller {

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
			$d['judul']="Rekap Finish Good Stok";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query('SELECT a.id_fg,a.tgl_input,b.nama_lengkap,a.shift,c.cat_target as pengiriman,a.pcs_item,
		a.pcs_karton,a.inputer FROM fg_transaksi as a JOIN fg_users as b ON a.pic 
		= b.username join wip_keramik_kat c on a.pengiriman = c.id_wip order by a.tgl_input desc');
			$d['content'] = 'fg/v_fg_view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	function get_kecamatan1(){
        $this->load->model('model_global');
        $id_wip = $this->input->post('id_wip');
        $target = $this->model_global->get_target($id_wip);
        
        foreach($target as $a){
			echo '<input type="text" name="target_min" id="target_min" class="span2" readonly="readonly" value="'.$a->target_min.'"/> <br>';
        }
    }
	
	function get_kecamatan2(){
        $this->load->model('model_global');
        $id_wip = $this->input->post('id_wip');
        $target = $this->model_global->get_target($id_wip);
        
        foreach($target as $a){
			echo '<input type="text" name="target" id="target" class="span2" readonly="readonly" value="'.$a->pcs_target.'"/>';
        }
    }
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Input Rekap Finish Good Stok";
			$d['class'] = "transaksi";
			
			$id_fg = $this->model_global->cari_max_fg_transaksi();
			$d['id_fg'] = $id_fg;
			
			$this->load->model('model_global');
			$jns_wip = $this->model_global->get_jenis_fg();
			$d['kota'] = $jns_wip;
			
			$d['content'] = 'fg/v_fg_form';
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
			$d['judul']="Edit Rekap Finish Good Stok";
			$d['class'] = "transaksi";
			
			$id_fg = $this->uri->segment(3);
			$d['id_fg'] = $id_fg;
                        $this->load->model('model_global');
			$jns_wip = $this->model_global->get_jenis_fg();
			$d['kota'] = $jns_wip;
			$d['content'] = 'fg/v_fg_form';
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
                        			
			$q = $this->db->get_where("fg_transaksi",$id_fg);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl_input = $this->model_global->tgl_str($dt->tgl_input);
					$d['tgl_input'] = $tgl_input;
					$d['pic'] = $dt->pic;
					$d['shift'] = $dt->shift;
					$d['pengiriman'] = $dt->pengiriman;
					$d['pcs_item'] = $dt->pcs_item;
					$d['pcs_karton'] = $dt->pcs_karton;
                                        $d['t_min'] = $dt->t_min;
                                        $d['t_max'] = $dt->t_max;
				}
				echo json_encode($d);
			}else{
					$d['tgl_input'] = '';
					$d['pic'] = '';
					$d['shift'] = '';
					$d['pengiriman'] = '';
					$d['pcs_item'] = '';
					$d['pcs_karton'] = '';
                                        $d['t_min'] = '';
					$d['t_max'] = '';
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
			$dt['shift'] = $this->input->post('shift');
			$dt['pengiriman'] = $this->input->post('pengiriman');
			$dt['pcs_item'] = $this->input->post('pcs_item');
			$dt['pcs_karton'] = $this->input->post('pcs_karton');
                        $dt['t_min'] = $this->input->post('target_min');
                        $dt['t_max'] = $this->input->post('target');
			$dt['inputer'] = $username;
						
			$q = $this->db->get_where("fg_transaksi",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("fg_transaksi",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("fg_transaksi",$dt);
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
			$id_fg['id_fg']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("fg_transaksi",$id_fg);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("fg_transaksi",$id_fg);
			}
			redirect('c_fg','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */