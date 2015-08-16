<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_ovt extends CI_Controller {

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
			$d['judul']="Rekap Overtime";
			$d['class'] = "transaksi";
			
			$d['data'] = $this->db->query("select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
group by month(a.periode), b.sec_des order by a.periode desc, gt desc");
			
			$d['content'] = 'ovt/v_ovt_view';
			$this->load->view('home',$d);
		}else{
			redirect('login','refresh');
		}
	}
	
	
	function importcsv() 
	{
        $d['error'] = '';    //initialize image upload error array to empty
        $d['judul']="Rekap Overtime";  
        $d['class'] = "transaksi";
		
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000000';
 
        $this->load->library('upload', $config);
        $d['data'] = $this->db->query("select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
group by month(a.periode), b.sec_des order by a.periode desc, gt desc");
 
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            
            $this->session->set_flashdata('error', 'Telah terjadi kesalahan');
            redirect('c_ovt','refresh');
        } else {
            $file_data = $this->upload->data();
            $file_path =  './uploads/'.$file_data['file_name'];
 
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                foreach ($csv_array as $row) {
					if (($row['SPL On Date']) == '' && ($row['SPL Off Date']) == ''){
						continue;
					}else{
				
							if (($row['SPL On Date']) == '') 
								{$periode = date('Y-m-d', strtotime($row['SPL Off Date']));}
							if (($row['SPL Off Date']) == '')
								{$periode = date('Y-m-d', strtotime($row['SPL On Date']));}
								
								$insert_data = array(
									'id'=>$row['ID'],
									'sond' => date('Y-m-d', strtotime($row['SPL On Date'])),
									'sondr'=>$row['SPL On Duration'],
									'sonbdr'=>$row['SPL On Break Duration'],
									'sofd' => date('Y-m-d', strtotime($row['SPL Off Date'])),
									'sofdr'=>$row['SPL Off Duration'],
									'sofbdr'=>$row['SPL Off Break Duration'],
									'periode'=>$periode,
								);                    
							
							$this->model_dap->insert_csv_ovt($insert_data);
					}
                }
                $this->session->set_flashdata('success', 'Data Berhasil Dimport');
                redirect('c_ovt','refresh');
                //echo "<pre>"; print_r($insert_data);
            } else 
               $this->session->set_flashdata('anomali', 'Telah terjadi kesalahan');
               redirect('c_ovt','refresh');
            }
 
        } 
 
}
/*END OF FILE*/