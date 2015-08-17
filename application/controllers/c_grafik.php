<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_grafik extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	 
	 public function fg_chart_all()
		{
			$cek = $this->session->userdata('logged_in');
			$level = $this->session->userdata('level');
			if(!empty($cek) && $level=='admin'){
				$d['judul']="Grafik Rekap Stok Finish Good";
				$d['class'] = "grafik";
					
				$this->load->model('model_global');
				$d['chart_all'] = $this->model_global->get_chart($d);
				$d['content']= 'fg/v_fg_grafik';
				$d['data_status'] = "Bulan Ini | PIC : All | Shift : All";
				$this->load->view('home',$d);
				
			}else{
				redirect('login','refresh');
			}
		}
	 
	 public function cari_data()
		{
			$cek = $this->session->userdata('logged_in');
			$level = $this->session->userdata('level');
			if(!empty($cek) && $level=='admin'){
				$d['judul']="Grafik Rekap Stok Finish Good";
				$d['class'] = "grafik";
				
				$periode1 = $this->input->post('periode1');
				$periode2 = $this->input->post('periode2');
				$tgl_awal = $this->model_global->tgl_str($periode1);
				$tgl_akhir = $this->model_global->tgl_str($periode2);
					
				$this->load->model('model_global');
				$d['chart_all'] = $this->model_global->get_chart_manual($tgl_awal,$tgl_akhir);
				$d['content']= 'fg/v_fg_grafik';
				
				$d['data_status'] = "Tgl ".$periode1." - ".$periode2."|PIC : All|Shift : All";
				
				$this->load->view('home',$d);
				
			}else{
				redirect('login','refresh');
			}
		}
		
		
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */