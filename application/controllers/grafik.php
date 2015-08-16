<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grafik extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	public function mhs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Grafik Mahasiswa";
			$d['class'] = "grafik";
			
			date_default_timezone_set('Asia/Jakarta'); 
			$thak = $this->input->post('thak');
			if(empty($thak)){
				$x_smt = $this->model_global->cari_semester();
				if($x_smt=='ganjil'){
					$smt = 1;
				}else{
					$smt = 2;
				}
				$th = date('Y').$smt;
				$d['th'] = $th;
			}else{
				$th = $thak;
				$d['th'] = $th;
			}
			
			$total = $this->model_data->data_chart_mhs_total($th);
			$aktif = $this->model_data->data_chart_mhs($th,'Aktif');
			$lulus = $this->model_data->data_chart_mhs($th,'Lulus');
			$cuti = $this->model_data->data_chart_mhs($th,'Cuti');
			$do = $this->model_data->data_chart_mhs($th,'DO');
			$meninggal = $this->model_data->data_chart_mhs($th,'Meninggal');
			
			$d['mhs_total'] = $total;
			$d['mhs_aktif'] = $aktif; //@number_format($total/$aktif*100,1);
			$d['mhs_lulus'] = $lulus; //@number_format($total/$lulus*100,1);
			$d['mhs_cuti'] = $cuti; //@number_format($total/$cuti*100,1);
			$d['mhs_do'] = $do; //@number_format($total/$do*100,1);
			$d['mhs_meninggal'] = $meninggal; //@number_format($total/$meninggal*100,1);
			
			$d['content']= 'grafik/mhs';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function dosen()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Grafik Dosen";
			$d['class'] = "grafik";
			
			date_default_timezone_set('Asia/Jakarta'); 
			
			
			$ti = $this->model_data->data_chart_dosen('55-201');
			$si = $this->model_data->data_chart_dosen('57-201');
			
			$d['total'] = $ti+$si;
			$d['si'] = $si;
			$d['ti'] = $ti; 
			
			$d['content']= 'grafik/dosen';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function mhs_aktif()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Grafik Mahasiswa Aktif";
			$d['class'] = "grafik";
			
			date_default_timezone_set('Asia/Jakarta'); 
			$thak = $this->input->post('thak');
			if(empty($thak)){
				$x_smt = $this->model_global->cari_semester();
				if($x_smt=='ganjil'){
					$smt = 1;
				}else{
					$smt = 2;
				}
				$th = date('Y').$smt;
				$d['th'] = $th;
			}else{
				$th = $thak;
				$d['th'] = $th;
			}
			
			$d['category'] = $this->model_data->create_category($th);
			$d['ti'] = $this->model_data->data_chart_mhs_aktif($th,'55-201');
			$d['si'] = $this->model_data->data_chart_mhs_aktif($th,'57-201');
			
			$d['content']= 'grafik/mhs_aktif';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function krs()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Grafik KRS Mahasiswa";
			$d['class'] = "grafik";
			
			
			
			date_default_timezone_set('Asia/Jakarta'); 
			
			$thak = $this->input->post('thak');
			if(empty($thak)){
				$x_smt = $this->model_global->cari_semester();
				if($x_smt=='ganjil'){
					$smt = 1;
				}else{
					$smt = 2;
				}
				$th = date('Y').$smt;
				$d['th'] = $th;
			}else{
				$th = $thak;
				$d['th'] = $th;
			}
			
			$d['category'] = $this->model_data->create_category($th);
			$d['ti'] = $this->model_data->data_chart_krs($th,'55-201');
			$d['si'] = $this->model_data->data_chart_krs($th,'57-201');
			
			$d['content']= 'grafik/krs';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	public function wisuda()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Grafik Wisuda";
			$d['class'] = "grafik";
			
			
			
			date_default_timezone_set('Asia/Jakarta'); 
			$thak = $this->input->post('thak');
			if(empty($thak)){
				$x_smt = $this->model_global->cari_semester();
				if($x_smt=='ganjil'){
					$smt = 1;
				}else{
					$smt = 2;
				}
				$th = date('Y').$smt;
				$d['th'] = $th;
			}else{
				$th = $thak;
				$d['th'] = $th;
			}
			
			$d['category'] = $this->model_data->create_category($th);
			$d['ti'] = $this->model_data->data_chart_wisuda($th,'55-201');
			$d['si'] = $this->model_data->data_chart_wisuda($th,'57-201');
			
			$d['content']= 'grafik/wisuda';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */