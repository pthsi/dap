<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_lap_wip extends CI_Controller {

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
		if(!empty($cek)){
			$d['judul']="Laporan Rekap WIP Keramik";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/v_lap_wip';
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
			
			
			$periode1 = $this->input->post('periode1');
			$periode2 = $this->input->post('periode2');
			$tgl_awal = $this->model_global->tgl_str($periode1);
			$tgl_akhir = $this->model_global->tgl_str($periode2);
			$pic = $this->input->post('pic');
			$shift = $this->input->post('shift');
			$jns_wip = $this->input->post('jns_wip');
			
			if (!empty($pic)) {
				$pic_status = "AND a.pic='$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($shift)) {
				$shift_status = "AND a.shift='$shift'";
			}else{
				$shift_status = '';
			}
			
			if (!empty($jns_wip)) {
				$status_wip = "AND c.jns_wip = '$jns_wip'";
			}else{
				$status_wip = '';
			}
			
			$query = "SELECT a.tgl_input,b.nama_lengkap,a.shift,c.jns_wip,a.lokasi,a.pcs_wip,a.target,a.target_min,
						a.akurasi,a.inputer
						FROM wip_transaksi as a
						JOIN fg_users as b
						ON a.pic=b.username
						Join wip_keramik_kat as c
						on a.jns_wip = c.id_wip
					WHERE (a.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir') $pic_status $shift_status $status_wip";
			
			$q = $this->db->query($query);
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/v_lap_wip_view',$dt);
			
		}else{
			redirect('login','refresh');
		}
	}
	
	public function cetak_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$periode1 = $this->input->post('periode1');
			$periode2 = $this->input->post('periode2');
			$tgl_awal = $this->model_global->tgl_str($periode1);
			$tgl_akhir = $this->model_global->tgl_str($periode2);
			$pic = $this->input->post('pic');
			$shift = $this->input->post('shift');
			$jns_wip = $this->input->post('jns_wip');
			
			if (!empty($pic)) {
				$pic_status = "AND a.pic='$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($shift)) {
				$shift_status = "AND a.shift='$shift'";
			}else{
				$shift_status = '';
			}
			
			if (!empty($jns_wip)) {
				$status_wip = "AND c.jns_wip = '$jns_wip'";
			}else{
				$status_wip = '';
			}
			
			$query = "SELECT a.tgl_input,b.nama_lengkap,a.shift,c.jns_wip,a.lokasi,a.pcs_wip,a.target,
						a.akurasi,a.inputer
						FROM wip_transaksi as a
						JOIN fg_users as b
						ON a.pic=b.username
						Join wip_keramik_kat as c
						on a.jns_wip = c.id_wip
					WHERE (a.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir') $pic_status $shift_status $status_wip";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			if($r>0){
				$sess_data['tgl_awal'] = $tgl_awal;
				$sess_data['tgl_akhir'] = $tgl_akhir;
				$sess_data['pic'] = $pic;
				$sess_data['shift'] = $shift;
				$sess_data['jns_wip'] = $jns_wip;
				$this->session->set_userdata($sess_data);
				echo "Sukses";
			}else{
				echo "Maaf, Tidak Ada data";
			}
			
		}else{
			redirect('login','refresh');
		}
	}
	
	
	public function print_pdf()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$tgl_awal = $this->session->userdata('tgl_awal');
			$tgl_akhir = $this->session->userdata('tgl_akhir');
			$pic = $this->session->userdata('pic');
			$shift = $this->session->userdata('shift');
			$jns_wip = $this->session->userdata('jns_wip');
			
			if (!empty($pic)) {
				$pic_status = "AND a.pic='$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($shift)) {
				$shift_status = "AND a.shift='$shift'";
			}else{
				$shift_status = '';
			}
			
			if (!empty($jns_wip)) {
				$status_wip = "AND c.jns_wip = '$jns_wip'";
			}else{
				$status_wip = '';
			}
			
			$query = "SELECT a.tgl_input,b.nama_lengkap,a.shift,c.jns_wip,a.lokasi,a.pcs_wip,a.target,
						a.akurasi,a.inputer
						FROM wip_transaksi as a
						JOIN fg_users as b
						ON a.pic=b.username
						Join wip_keramik_kat as c
						on a.jns_wip = c.id_wip
					WHERE (a.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir') $pic_status $shift_status $status_wip";
			
			$q = $this->db->query($query);
			
			$r = $q->num_rows();
			
			if($r>0){
				
				
			  $pdf=new reportProduct();
			  $pdf->setKriteria("cetak_laporan");
			  $pdf->setNama("CETAK LAPORAN");
			  $pdf->AliasNbPages();
			  $pdf->AddPage("P","A4");
				//foreach($data->result() as $t){
					$A4[0]=210;
					$A4[1]=297;
					$Q[0]=216;
					$Q[1]=279;
					$pdf->SetTitle('Laporan Aplikasi');
					$pdf->SetCreator('Mpod Schuzatcky');
					
					$h = 7;
					$w = 190;
					$pdf->SetFont('Times','B',18);
					$pdf->Cell($w,$h,$this->config->item('nama_pendek'),0,1,'C');
					$pdf->SetFont('Times','B',14);
					$pdf->Cell($w,$h,$this->config->item('nama_instansi'),0,1,'C');
					$pdf->SetFont('Times','',10);
					$pdf->Cell($w,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'C');
					$pdf->Ln(8);
					
					//Column widths
					$h= 5;
					$pdf->SetFont('Arial','B',14);
					$pdf->Cell($w,$h,'Laporan Rekap WIP Keramik',0,1,'C');
					$pdf->Cell($w,$h,$tgl_awal.' - '.$tgl_akhir,0,1,'C');
					$pdf->Ln(5);
										
					
					$l=10;
					$w = array(8,28,20,15,25,20,15,15,15,20);
					
					//Header

					$pdf->SetFont('Arial','B',7);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$h=8;
					$pdf->Cell($w[0],$h,'No',1,0,'C',$fill);
					$pdf->Cell($w[1],$h,'Tanggal Input',1,0,'C',$fill);
					$pdf->Cell($w[2],$h,'PIC',1,0,'C',$fill);
					$pdf->Cell($w[3],$h,'Shift',1,0,'C',$fill);
					$pdf->Cell($w[4],$h,'Jenis WIP',1,0,'C',$fill);
					$pdf->Cell($w[5],$h,'Lokasi',1,0,'C',$fill);
					$pdf->Cell($w[6],$h,'Total (pcs)',1,0,'C',$fill);
					$pdf->Cell($w[7],$h,'Target',1,0,'C',$fill);
					$pdf->Cell($w[8],$h,'Akurasi',1,0,'C',$fill);
					$pdf->Cell($w[9],$h,'Inputer',1,0,'C',$fill);
					$pdf->Ln();
					
					//data
					//$pdf->SetFillColor(224,235,255);
					$h = 7;
					$pdf->SetFont('Arial','',9);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					$jmlsks = 0;
					foreach($q->result() as $row){
						$tgl = $this->model_global->tgl_indo($row->tgl_input);
						$pdf->Cell($w[0],$h,$no,1,0,'C');
						$pdf->Cell($w[1],$h,$tgl,1,0,'C');
						$pdf->Cell($w[2],$h,$row->nama_lengkap,1,0,'C');
						$pdf->Cell($w[3],$h,$row->shift,1,0,'C');
						$pdf->Cell($w[4],$h,$row->jns_wip,1,0,'C');
						$pdf->Cell($w[5],$h,$row->lokasi,1,0,'C');
						$pdf->Cell($w[6],$h,$row->pcs_wip,1,0,'C');
						$pdf->Cell($w[7],$h,$row->target,1,0,'C');
						$pdf->Cell($w[8],$h,$row->akurasi,1,0,'C');
						$pdf->Cell($w[9],$h,$row->inputer,1,0,'C');
						
						$pdf->Ln();
						$fill = !$fill;
						$no++;
					}
					// Closing line
					$pdf->Cell(array_sum($w),0,'','T');
	
					
					$pdf->Ln(10);
					$h = 5;
					//$pdf->Cell(50,$h,'Menyetujui',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'Cicadas, '.$this->model_global->tgl_indo(date('Y-m-d')),0,1,'C');
					//$pdf->Cell(50,$h,'Ketua Program Studi,',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'WIP Keramik,',0,1,'C');
					$pdf->Ln(20);
					//$pdf->Cell(50,$h,'_______________________',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'_____________________',0,1,'C');
					//$pdf->Cell(50,$h,'NIP : ',0,0,'L');
					$pdf->SetX(150);
					$pdf->Cell(100,$h,'NIK :',0,1,'L');
				//}
					
				//}
				$pdf->Output('wip_transaksi_'.$tgl_awal.'-'.$tgl_akhir.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('c_fg');
				//echo "Maaf Tidak ada data";
			}
		}else{
			redirect('login','refresh');
		}
	}
	
	public function print_excel()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if(!empty($cek) && $level=='admin'){
			
			$tgl_awal = $this->session->userdata('tgl_awal');
			$tgl_akhir = $this->session->userdata('tgl_akhir');
			$pic = $this->session->userdata('pic');
			$shift = $this->session->userdata('shift');
			$jns_wip = $this->session->userdata('jns_wip');
			
			if (!empty($pic)) {
				$pic_status = "AND a.pic='$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($shift)) {
				$shift_status = "AND a.shift='$shift'";
			}else{
				$shift_status = '';
			}
			
			if (!empty($jns_wip)) {
				$status_wip = "AND c.jns_wip = '$jns_wip'";
			}else{
				$status_wip = '';
			}
			
			$query = "SELECT a.tgl_input,b.nama_lengkap,a.shift,c.jns_wip,a.lokasi,a.pcs_wip,a.target,
						a.akurasi,a.inputer
						FROM wip_transaksi as a
						JOIN fg_users as b
						ON a.pic=b.username
						Join wip_keramik_kat as c
						on a.jns_wip = c.id_wip
					WHERE (a.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir') $pic_status $shift_status $status_wip";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			
			if($r>0){
				
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=wip_transaksi_".$tgl_awal.'_'.$tgl_akhir.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
            <p>LAPORAN REKAP WIP KERAMIK</p>
            <p><?php echo $tgl_awal.' - '.$tgl_akhir;?></p>
            <table border="1">
            	<thead>
                	<tr>
                    	<td>No</td>
                        <td>Tanggal Input</td>
                        <td>PIC</td>
                        <td>Shift</td>
                        <td>Jenis WIP Keramik</td>
                        <td>Lokasi</td>
                        <td>Total (pcs)</td>
                        <td>Target</td>
                        <td>Akurasi</td>
                        <td>Inputer</td>
					</tr>
				</thead>
                <tbody>
                <?php
				$no=1;
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_indo($dt->tgl_input);
				?>
                <tr>
                	<td><?php echo $no;?></td>  
					<td><?php echo $dt->tgl_input;?></td>
                    <td><?php echo $dt->nama_lengkap;?></td>
                     <td><?php echo $dt->shift;?></td>
                    <td><?php echo $dt->jns_wip;?></td>  
                    <td><?php echo $dt->lokasi;?></td>  
                    <td><?php echo $dt->pcs_wip;?></td>
                    <td><?php echo $dt->target;?></td>
                    <td><?php echo $dt->akurasi;?></td>
                    <td><?php echo $dt->inputer;?></td>                    
                </tr>    
            <?php
				$no++;	
				}
			?>
            	</tbody>
               </table>
             <?php
			}
		}else{
			redirect('login','refresh');
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */