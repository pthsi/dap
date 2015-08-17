<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_lap_dko extends CI_Controller {

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
			$d['judul']="Laporan AR Dekorasi";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/v_lap_dko';
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
			$kategori = $this->input->post('kategori');
			
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
			
			if (!empty($kategori)) {
				$kategori_stat = "AND c.cat_target = '$kategori'";
			}else{
				$kategori_stat = '';
			}
			
			
			$query = "SELECT a.id_dko,a.tgl_input,b.nama_lengkap,a.shift,c.cat_target as kategori,a.lokasi,
			a.plan,a.actual,a.ar*100 as ar,truncate((a.ac)*100,2) as ac,a.inputer 
			FROM dko_transaksi as a JOIN fg_users as b ON a.pic = b.username 
			JOIN wip_keramik_kat as c ON a.kategori = c.id_wip 
			where tgl_input between '$tgl_awal' and '$tgl_akhir' $pic_status $shift_status $kategori_stat";
			
			$q = $this->db->query($query);
			$dt['data'] = $q;
			
			echo $this->load->view('laporan/v_lap_dko_view',$dt);
			
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
			$kategori = $this->input->post('kategori');
			
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
			
			if (!empty($kategori)) {
				$kategori_stat = "AND c.cat_target = '$kategori'";
			}else{
				$kategori_stat = '';
			}
			
			
			$query = "SELECT a.id_dko,a.tgl_input,b.nama_lengkap,a.shift,c.cat_target as kategori,a.lokasi,
			a.plan,a.actual,a.ar*100 as ar,truncate((a.ac)*100,2) as ac,a.inputer 
			FROM dko_transaksi as a JOIN fg_users as b ON a.pic = b.username 
			JOIN wip_keramik_kat as c ON a.kategori = c.id_wip 
			where tgl_input between '$tgl_awal' and '$tgl_akhir' $pic_status $shift_status $kategori_stat";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			if($r>0){
				$sess_data['tgl_awal'] = $tgl_awal;
				$sess_data['tgl_akhir'] = $tgl_akhir;
				$sess_data['pic'] = $pic;
				$sess_data['shift'] = $shift;
				$sess_data['kategori'] = $kategori;
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
			$kategori = $this->session->userdata('kategori');
			
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
			
			if (!empty($kategori)) {
				$kategori_stat = "AND c.cat_target = '$kategori'";
			}else{
				$kategori_stat = '';
			}
			
			
			$query = "SELECT a.id_dko,a.tgl_input,b.nama_lengkap,a.shift,c.cat_target as kategori,a.lokasi,
			a.plan,a.actual,a.ar*100 as ar,truncate((a.ac)*100,2) as ac,a.inputer 
			FROM dko_transaksi as a JOIN fg_users as b ON a.pic = b.username 
			JOIN wip_keramik_kat as c ON a.kategori = c.id_wip 
			where tgl_input between '$tgl_awal' and '$tgl_akhir' $pic_status $shift_status $kategori_stat";
			
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
					$pdf->Cell($w,$h,'Laporan AR Dekorasi',0,1,'C');
					$pdf->Cell($w,$h,$this->model_global->tgl_indo($tgl_awal).' - '.$this->model_global->tgl_indo($tgl_akhir),0,1,'C');
					$pdf->Ln(5);
										
					
					$l=12;
					$w = array(7,26,20,13,17,18,15,15,12,20,15,12);
					
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
					$pdf->Cell($w[4],$h,'Kategori',1,0,'C',$fill);
					$pdf->Cell($w[5],$h,'Lokasi',1,0,'C',$fill);
					$pdf->Cell($w[6],$h,'Plan (pcs)',1,0,'C',$fill);
					$pdf->Cell($w[7],$h,'Aktual (pcs)',1,0,'C',$fill);
					$pdf->Cell($w[8],$h,'AR (%)',1,0,'C',$fill);
					$pdf->Cell($w[9],$h,'Pencapaian (%)',1,0,'C',$fill);
					$pdf->Cell($w[10],$h,'Status',1,0,'C',$fill);
					$pdf->Cell($w[11],$h,'Inputer',1,0,'C',$fill);
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
						$pdf->Cell($w[4],$h,$row->kategori,1,0,'C');
						$pdf->Cell($w[5],$h,$row->lokasi,1,0,'C');
						$pdf->Cell($w[6],$h,$row->plan,1,0,'C');
						$pdf->Cell($w[7],$h,$row->actual,1,0,'C');
						$pdf->Cell($w[8],$h,$row->ar,1,0,'C');
						$pdf->Cell($w[9],$h,$row->ac,1,0,'C');
						
							$rencana=$row->ar;
							$hasil=$row->ac;
							
							if ($hasil=$rencana && $hasil>$rencana){
									$status = "Tercapai";
							}else{
									$status = "Gagal";}
						
						$pdf->Cell($w[10],$h,$status,1,0,'C');
						$pdf->Cell($w[11],$h,$row->inputer,1,0,'C');
						
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
					$pdf->Cell(100,$h,'Dekorasi,',0,1,'C');
					$pdf->Ln(20);
					//$pdf->Cell(50,$h,'_______________________',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'_____________________',0,1,'C');
					//$pdf->Cell(50,$h,'NIP : ',0,0,'L');
					$pdf->SetX(150);
					$pdf->Cell(100,$h,'NIK :',0,1,'L');
				//}
					
				//}
				$pdf->Output('dko_transaksi_'.$tgl_awal.'-'.$tgl_akhir.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('c_lap_fg');
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
			$kategori = $this->session->userdata('kategori');
			
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
			
			if (!empty($kategori)) {
				$kategori_stat = "AND c.cat_target = '$kategori'";
			}else{
				$kategori_stat = '';
			}
			
			
			$query = "SELECT a.id_dko,a.tgl_input,b.nama_lengkap,a.shift,c.cat_target as kategori,a.lokasi,
			a.plan,a.actual,a.ar*100 as ar,truncate((a.ac)*100,2) as ac,a.inputer 
			FROM dko_transaksi as a JOIN fg_users as b ON a.pic = b.username 
			JOIN wip_keramik_kat as c ON a.kategori = c.id_wip 
			where tgl_input between '$tgl_awal' and '$tgl_akhir' $pic_status $shift_status $kategori_stat";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			
			if($r>0){
				
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=dko_transaksi_".$tgl_awal.'_'.$tgl_akhir.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
            <p>LAPORAN AR Dekorasi</p>
            <p><?php echo $this->model_global->tgl_indo($tgl_awal).' - '.$this->model_global->tgl_indo($tgl_akhir);?></p>
            <table border="1">
            	<thead>
                	<tr>
                    	<td>No</td>
                        <td>Tanggal Input</td>
                        <td>PIC</td>
                        <td>Shift</td>
                        <td>Kategori</td>
                        <td>Lokasi</td>
                        <td>Plan (pcs)</td>
                        <td>Aktual (pcs)</td>
                        <td>AR (%)</td>
                        <td>Pencapaian (%)</td>
                        <td>Status</td>
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
                    <td><?php echo $dt->kategori;?></td>  
                    <td><?php echo $dt->lokasi;?></td>  
                    <td><?php echo $dt->plan;?></td>
                    <td><?php echo $dt->actual;?></td>
                    <td><?php echo $dt->ar;?></td>
                    <td><?php echo $dt->ac;?></td>
						<?php 
                            $rencana=$dt->ar;
                            $hasil=$dt->ac;
                            
                            if ($hasil=$rencana && $hasil>$rencana){
                                    echo "<td class='center' style='background-color:#12FF00'>Tercapai</td>";
                            }else{
                                    echo "<td class='center' style='background-color:#FF0004'>Gagal</td>";}
                            
                        ?>
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
