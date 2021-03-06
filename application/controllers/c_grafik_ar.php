<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_grafik_ar extends CI_Controller {

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
				$d['chart_all'] = $this->model_global->get_chart_ar($d);
				$d['content']= 'fgar/v_fg_grafik';
				$d['data_status'] = "Bulan Ini";
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
				
				$pb = $this->input->post('pb');
                                if (!empty($pb)){
                                    $bulan = $this->model_global->ambilBlnOnly($pb);
                                    $tahun = $this->model_global->ambilYerOnly($pb);
                                }else{
                                    $bulan = date("m");
                                    $tahun = date("Y");
                                }
				
                                $grup = $this->input->post('grup');
					
				$this->load->model('model_global');
				$d['chart_all'] = $this->model_global->getChartManualFGR($bulan,$tahun,$grup);
				$d['content']= 'fgar/v_fg_grafik';
				
				$d['data_status'] = "Bulan ".$bulan." Tahun ".$tahun."";
				
				$this->load->view('home',$d);
				
			}else{
				redirect('login','refresh');
			}
		}
		
		
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */