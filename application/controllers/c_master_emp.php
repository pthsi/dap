<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_master_emp extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	 
	function __construct() {
            parent::__construct();
            $this->load->model('model_dap');
            $this->load->library('csvimport');
        }
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			$d['judul']="Master Karyawan";
			$d['class'] = "master";
			
			$d['data'] = $this->db->query("select * from dp_emp");
			
			$d['content'] = 'master/v_master_emp_view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	
	function importcsv() 
	{
        $d['error'] = '';    //initialize image upload error array to empty
        $d['judul']="Master Karyawan";  
        $d['class'] = "master";
		
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000000';
 
        $this->load->library('upload', $config);
        $d['data'] = $this->db->query("select * from dp_emp");
 
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            
            $this->session->set_flashdata('error', 'Telah terjadi kesalahan');
            redirect('c_master_emp','refresh');
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'id'=>$row['ID'],
                        'nama'=>$row['Full Name'],
                        'div'=>$row['Division'],
                        'dep'=>$row['Department'],
                        'sec'=>$row['Section'],
                        'div_des'=>$row['Division Description'],
                        'dep_des'=>$row['Department Description'],
                        'sec_des'=>$row['Section Description'],
                    );
                    $this->model_dap->insert_csv($insert_data);
                }
                $this->session->set_flashdata('success', 'Data Berhasil Dimport');
                redirect('c_master_emp','refresh');
                //echo "<pre>"; print_r($insert_data);
            } else 
               $this->session->set_flashdata('anomali', 'Telah terjadi kesalahan');
               redirect('c_master_emp','refresh');
            }
 
        } 
 
}
/*END OF FILE*/