<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_lap_jc extends CI_Controller {

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
			$d['judul']="Laporan Rekap Cetak Jiggering & Casting";
			$d['class'] = "laporan";
			
            //$this->load->model('model_global');
			//$jns_wip = $this->model_global->getJenisFgUnlock();
			//$d['kota'] = $jns_wip;
                        
			$d['content']= 'laporan/v_lap_jigcas';
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
			$pengiriman = $this->input->post('pengiriman');
			
			if (!empty($pic)) {
				$pic_status = "AND a.pic='$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($pengiriman)) {
				$pengiriman_status = "AND a.jenis='$pengiriman'";
			}else{
				$pengiriman_status = '';
			}
			
			$query = "SELECT a.tgl_input,b.nama_lengkap,a.jenis,a.plan,a.aktual,a.inputer, truncate((a.aktual/a.plan),2)*100 as ar
						FROM jc_trans as a JOIN fg_users as b
						ON a.pic=b.username WHERE (a.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir') 
					   $pic_status $pengiriman_status order by a.tgl_input desc";
			
			$q = $this->db->query($query);
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/v_lap_jigcas_view',$dt);
			
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
			$pengiriman = $this->input->post('pengiriman');
			
			if (!empty($pic)) {
				$pic_status = "AND a.pic='$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($pengiriman)) {
				$pengiriman_status = "AND a.jenis='$pengiriman'";
			}else{
				$pengiriman_status = '';
			}
			
			$query = "SELECT a.tgl_input,b.nama_lengkap,a.jenis,a.plan,a.aktual,a.inputer, truncate((a.aktual/a.plan),2)*100 as ar
						FROM jc_trans as a JOIN fg_users as b
						ON a.pic=b.username WHERE (a.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir') 
					   $pic_status $pengiriman_status order by a.tgl_input desc";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			if($r>0){
				$sess_data['tgl_awal'] = $tgl_awal;
				$sess_data['tgl_akhir'] = $tgl_akhir;
				$sess_data['pic'] = $pic;
				$sess_data['pengiriman'] = $pengiriman;
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
			$pengiriman = $this->session->userdata('pengiriman');
			
			if (!empty($pic)) {
				$pic_status = "AND a.pic='$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($pengiriman)) {
				$pengiriman_status = "AND a.jenis='$pengiriman'";
			}else{
				$pengiriman_status = '';
			}
			
			$query = "SELECT a.tgl_input,b.nama_lengkap,a.jenis,a.plan,a.aktual,a.inputer, truncate((a.aktual/a.plan),2)*100 as ar
						FROM jc_trans as a JOIN fg_users as b
						ON a.pic=b.username WHERE (a.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir') 
					   $pic_status $pengiriman_status order by a.tgl_input desc";
			
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
					$pdf->Cell($w,$h,'Laporan Rekap Cetak Jiggering Dan Casting',0,1,'C');
					$pdf->Cell($w,$h,$tgl_awal.' - '.$tgl_akhir,0,1,'C');
					$pdf->Ln(5);
										
					
					$l=10;
					$w = array(10,30,30,15,25,25,25,30);
					
					//Header

					$pdf->SetFont('Arial','B',7);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$h=8;
					$pdf->Cell($w[0],$h,'No',1,0,'C',$fill);
					$pdf->Cell($w[1],$h,'Tanggal Cetak',1,0,'C',$fill);
					$pdf->Cell($w[2],$h,'Planner',1,0,'C',$fill);
					$pdf->Cell($w[3],$h,'Jenis Cetak',1,0,'C',$fill);
					$pdf->Cell($w[4],$h,'Plan (pcs)',1,0,'C',$fill);
					$pdf->Cell($w[5],$h,'Aktual (pcs)',1,0,'C',$fill);
					$pdf->Cell($w[6],$h,'AR (%)',1,0,'C',$fill);
					$pdf->Cell($w[7],$h,'Inputer',1,0,'C',$fill);
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
						$pdf->Cell($w[3],$h,$row->jenis,1,0,'C');
						$pdf->Cell($w[4],$h,number_format($row->plan,0,'.','.'),1,0,'R');
						$pdf->Cell($w[5],$h,number_format($row->aktual,0,'.','.'),1,0,'R');
						$pdf->Cell($w[6],$h,number_format($row->ar,0,'.','.'),1,0,'R');
						$pdf->Cell($w[7],$h,$row->inputer,1,0,'C');
						
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
					$pdf->Cell(100,$h,'Jiggering & Casting,',0,1,'C');
					$pdf->Ln(20);
					//$pdf->Cell(50,$h,'_______________________',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'_____________________',0,1,'C');
					//$pdf->Cell(50,$h,'NIP : ',0,0,'L');
					$pdf->SetX(150);
					$pdf->Cell(100,$h,'NIK :',0,1,'L');
				//}
					
				//}
				$pdf->Output('jc_transaksi_'.$tgl_awal.'-'.$tgl_akhir.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('c_jigcas');
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
			$pengiriman = $this->session->userdata('pengiriman');
			
			if (!empty($pic)) {
				$pic_status = "AND a.pic='$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($pengiriman)) {
				$pengiriman_status = "AND a.jenis='$pengiriman'";
			}else{
				$pengiriman_status = '';
			}
			
			$query = "SELECT a.tgl_input,b.nama_lengkap,a.jenis,a.plan,a.aktual,a.inputer, truncate((a.aktual/a.plan),2)*100 as ar
						FROM jc_trans as a JOIN fg_users as b
						ON a.pic=b.username WHERE (a.tgl_input BETWEEN '$tgl_awal' AND '$tgl_akhir') 
					   $pic_status $pengiriman_status order by a.tgl_input desc";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			
			if($r>0){
				
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=jc_transaksi_".$tgl_awal.'_'.$tgl_akhir.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
            <p>LAPORAN REKAP CETAK JIGGERING DAN CASTING</p>
            <p><?php echo $tgl_awal.' - '.$tgl_akhir;?></p>
            <table border="1">
            	<thead>
                	<tr>
                    	<td>No</td>
                        <td>Tanggal Cetak</td>
                        <td>Planner</td>
                        <td>Jenis Cetak</td>
                        <td>Plan (pcs)</td>
                        <td>Aktual (pcs)</td>
                        <td>AR (%)</td>
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
                    <td><?php echo $dt->jenis;?></td>  
                    <td><?php echo $dt->plan;?></td>  
                    <td><?php echo $dt->aktual;?></td> 
                    <td><?php echo $dt->ar;?></td> 
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