<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Programmer : Deddy Rusdiansyah.S.Kom
	 * http://deddyrusdiansyah.blogspot.com
	 * http://softwarebanten.com
	 * TIM : Edy Nasri, Aldi Novialdi Rusdiansyah, Eka Juliananta
	 */
	
	public function mata_kuliah(){
		$id['Fak'] = $this->input->post('id');
		$id['semester'] = $this->input->post('smt');
		$id['tayang'] = 'Ya';
		
		$q = $this->db->get_where("msmatakuliah",$id);
		foreach($q->result() as $dt){
			echo "<option value='".$dt->KdMK."'>".$dt->NamaMK.' - '.$dt->Smt."</option>";
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */