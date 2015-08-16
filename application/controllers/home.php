<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
			$d['judul']="Dashboard";
			$d['class'] = "home";
			
			$this->load->model('model_dap');
			$d['db_dko'] = $this->model_dap->get_db_dko($d);
			$d['db_pck'] = $this->model_dap->get_db_pck($d);

			$d['content']= 'isi';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */