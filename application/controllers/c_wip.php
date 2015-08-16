<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_wip extends CI_Controller {

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
			$d['judul']="Rekap WIP Keramik";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query('SELECT 	a.id_wip,a.tgl_input,b.nama_lengkap,a.shift,c.jns_wip,a.lokasi,
			a.pcs_wip,a.target,a.target_min,a.akurasi,a.inputer 
			FROM wip_transaksi as a JOIN fg_users as b ON a.pic = b.username JOIN 
			wip_keramik_kat as c ON a.jns_wip = c.id_wip  order by tgl_input desc');
			
			$d['content'] = 'wip/v_wip_view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	function get_kecamatan1(){
        $this->load->model('model_global');
        $id_wip = $this->input->post('id_wip');
        $target = $this->model_global->get_target($id_wip);
        
        //echo '<select name="kecamatan" id="kecamatan" class="span2">';
		
        foreach($target as $a){
            //echo '<option value="'.$a->id_wip.'">'.$a->pcs_target.'</option>';
			echo '<input type="text" name="target_min" id="target_min" class="span2" readonly="readonly" value="'.$a->target_min.'"/> <br>';
			//echo '<input type="text" name="target" id="target" class="span2" readonly="readonly" value="'.$a->pcs_target.'"/>';
        }
        //echo '</select>';
    }
	
	function get_kecamatan2(){
        $this->load->model('model_global');
        $id_wip = $this->input->post('id_wip');
        $target = $this->model_global->get_target($id_wip);
        
        //echo '<select name="kecamatan" id="kecamatan" class="span2">';
		
        foreach($target as $a){
            //echo '<option value="'.$a->id_wip.'">'.$a->pcs_target.'</option>';
			//echo '<input type="text" name="target_min" id="target_min" class="span2" readonly="readonly" value="'.$a->target_min.'"/> <br>';
			echo '<input type="text" name="target" id="target" class="span2" readonly="readonly" value="'.$a->pcs_target.'"/>';
        }
        //echo '</select>';
    }
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Input WIP Keramik";
			$d['class'] = "transaksi";
			
			$id_wip = $this->model_global->cari_max_wip_transaksi();
			$d['id_wip'] = $id_wip;
			
			$this->load->model('model_global');
			$jns_wip = $this->model_global->get_jenis_wip();
			$d['kota'] = $jns_wip;
			
			$d['content'] = 'wip/v_wip_form';
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
			$d['judul']="Edit WIP Keramik";
			$d['class'] = "transaksi";
			
			$id_wip = $this->uri->segment(3);
			$d['id_wip'] = $id_wip;
			
			$this->load->model('model_global');
			$jns_wip = $this->model_global->get_jenis_wip();
			$d['kota'] = $jns_wip;
			
			$d['content'] = 'wip/v_wip_form';
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
			
			$q = $this->db->get_where("wip_transaksi",$id_wip);
			$row = $q->num_rows();
			if($row>0){
				foreach($q->result() as $dt){
					$tgl_input = $this->model_global->tgl_str($dt->tgl_input);
					$d['tgl_input'] = $tgl_input;
					$d['pic'] = $dt->pic;
					$d['shift'] = $dt->shift;
					$d['jns_wip'] = $dt->jns_wip;
					$d['lokasi'] = $dt->lokasi;
					$d['pcs_wip'] = $dt->pcs_wip;
					$d['target_min'] = $dt->target_min;
					$d['target'] = $dt->target;
					$d['akurasi'] = $dt->akurasi;
				}
				echo json_encode($d);
			}else{
					$d['tgl_input'] = '';
					$d['pic'] = '';
					$d['shift'] = '';
					$d['jns_wip'] = '';
					$d['lokasi'] = '';
					$d['pcs_wip'] = '';
					$d['target_min'] = '';
					$d['target'] = '';
					$d['akurasi'] = '';
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
			$tgl_input = $this->model_global->tgl_sql($this->input->post('tgl_input'));
			$dt['tgl_input'] = $tgl_input;
			$dt['pic'] = $this->input->post('pic');
			$dt['shift'] = $this->input->post('shift');
			$dt['jns_wip'] = $this->input->post('jns_wip');
			$dt['lokasi'] = $this->input->post('lokasi');
			$dt['pcs_wip'] = $this->input->post('pcs_wip');
			$dt['target_min'] = $this->input->post('target_min');
			$dt['target'] = $this->input->post('target');
			$dt['akurasi'] = $this->input->post('akurasi');
			$dt['inputer'] = $username;
						
			$q = $this->db->get_where("wip_transaksi",$id);
			$row = $q->num_rows();
			if($row>0){
				$dt['tgl_update'] = date('Y-m-d h:i:s');
				$this->db->update("wip_transaksi",$dt,$id);
				echo "Data Sukses diUpdate";
			}else{
				$dt['tgl_insert'] = date('Y-m-d h:i:s');
				$this->db->insert("wip_transaksi",$dt);
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
			$id_wip['id_wip']	= $this->uri->segment(3);
			
			$q = $this->db->get_where("wip_transaksi",$id_wip);
			$row = $q->num_rows();
			if($row>0){
				$this->db->delete("wip_transaksi",$id_wip);
			}
			redirect('c_wip','refresh');
		}else{
			redirect('login','refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */