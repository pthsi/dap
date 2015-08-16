<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_lap_ovt extends CI_Controller {

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
			$d['judul']="Laporan Rekap Overtime";
			$d['class'] = "laporan";
			
			$d['content']= 'laporan/v_lap_ovt';
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
			$pic = $this->input->post('pic'); //section
			$shift = $this->input->post('shift'); //grouping waktu
			
			if (!empty($pic)) {
				$pic_status = "and b.sec_des = '$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($shift)) {
				$shift_status = "$shift";
			}else{
				$shift_status = 'month';
			}
			
			
			$query = "select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
AND a.periode between '$tgl_awal' and '$tgl_akhir' $pic_status
group by $shift_status(a.periode), b.sec_des order by a.periode desc";
			
			$q = $this->db->query($query);
			$dt['data'] = $q;
                        $dt['sortir'] = $shift_status;
			
			echo $this->load->view('laporan/v_lap_ovt_view',$dt);
			
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
			$pic = $this->input->post('pic'); //section
			$shift = $this->input->post('shift'); //grouping waktu
			
			if (!empty($pic)) {
				$pic_status = "and b.sec_des = '$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($shift)) {
				$shift_status = "$shift";
			}else{
				$shift_status = 'month';
			}
			
			
			$query = "select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
AND a.periode between '$tgl_awal' and '$tgl_akhir' $pic_status
group by $shift_status(a.periode), b.sec_des order by a.periode desc";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			if($r>0){
				$sess_data['tgl_awal'] = $tgl_awal;
				$sess_data['tgl_akhir'] = $tgl_akhir;
				$sess_data['pic'] = $pic;
				$sess_data['shift'] = $shift;
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
			
			if (!empty($pic)) {
				$pic_status = "and b.sec_des = '$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($shift)) {
				$shift_status = "$shift";
			}else{
				$shift_status = 'month';
			}
			
			
			$query = "select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
AND a.periode between '$tgl_awal' and '$tgl_akhir' $pic_status
group by $shift_status(a.periode), b.sec_des order by a.periode desc";
			
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
					$pdf->SetFont('Times','B',14);
					$pdf->Cell($w,$h,$this->config->item('nama_pendek'),0,1,'C');
					$pdf->SetFont('Times','B',10);
					$pdf->Cell($w,$h,$this->config->item('nama_instansi'),0,1,'C');
					$pdf->SetFont('Times','',6);
					$pdf->Cell($w,4,'Alamat : '.$this->config->item('alamat_instansi'),0,1,'C');
					$pdf->Ln(2);
					
					//Column widths
					$h= 5;
					$pdf->SetFont('Arial','B',10);
					$pdf->Cell($w,$h,'Laporan Rekap Overtime',0,1,'C');
                                        $pdf->SetFont('Arial','',8);
					$pdf->Cell($w,$h,$tgl_awal.' - '.$tgl_akhir,0,1,'C');
					$pdf->Ln(5);
										
					
					$l=10;
					$w = array(4,12,30,38,48,20,20,15);
					
					//Header

					$pdf->SetFont('Arial','B',4);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = true;
					$h=8;
					$pdf->Cell($w[0],$h,'No',1,0,'C',$fill);
					$pdf->Cell($w[1],$h,'Periode',1,0,'C',$fill);
					$pdf->Cell($w[2],$h,'Divisi',1,0,'C',$fill);
					$pdf->Cell($w[3],$h,'Departemen',1,0,'C',$fill);
					$pdf->Cell($w[4],$h,'Section',1,0,'C',$fill);
					$pdf->Cell($w[5],$h,'Total Lembur (di Off Day)',1,0,'C',$fill);
					$pdf->Cell($w[6],$h,'Total Lembur (di On Day)',1,0,'C',$fill);
					$pdf->Cell($w[7],$h,'Grand Total',1,0,'C',$fill);
					$pdf->Ln();
					
					//data
					//$pdf->SetFillColor(224,235,255);
					$h = 3;
					$pdf->SetFont('Arial','',4);
					$pdf->SetFillColor(204,204,204);
    				$pdf->SetTextColor(0);
					$fill = false;
					$no=1;
					$jmlsks = 0;
					foreach($q->result() as $row){
						$tgl = $this->model_global->tgl_indo($row->periode);
						$pdf->Cell($w[0],$h,$no,1,0,'C');
						$pdf->Cell($w[1],$h,$tgl,1,0,'C');
						$pdf->Cell($w[2],$h,$row->div_des,1,0,'L');
						$pdf->Cell($w[3],$h,$row->dep_des,1,0,'L');
						$pdf->Cell($w[4],$h,$row->sec_des,1,0,'L');
						$pdf->Cell($w[5],$h,$row->ofdor/60 .' jam',1,0,'R');
						$pdf->Cell($w[6],$h,$row->ondor/60 .' jam',1,0,'R');
						$pdf->Cell($w[7],$h,$row->gt/60 .' jam',1,0,'R');
						
						$pdf->Ln();
						$fill = !$fill;
						$no++;
					}
					// Closing line
					$pdf->Cell(array_sum($w),0,'','T');
	
					
					$pdf->Ln(5);
					$h = 5;
					//$pdf->Cell(50,$h,'Menyetujui',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'Cicadas, '.$this->model_global->tgl_indo(date('Y-m-d')),0,1,'C');
					//$pdf->Cell(50,$h,'Ketua Program Studi,',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'Personalia,',0,1,'C');
					$pdf->Ln(10);
					//$pdf->Cell(50,$h,'_______________________',0,0,'C');
					$pdf->SetX(120);
					$pdf->Cell(100,$h,'_____________________',0,1,'C');
					//$pdf->Cell(50,$h,'NIP : ',0,0,'L');
					$pdf->SetX(150);
					$pdf->Cell(100,$h,'NIK :',0,1,'L');
				//}
					
				//}
				$pdf->Output('ovt_transaksi_'.$tgl_awal.'-'.$tgl_akhir.'.pdf','D');		
			}else{
				$this->session->set_flashdata('result_info', '<center>Tidak Ada Data</center>');
				redirect('c_lap_ovt');
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
			
			if (!empty($pic)) {
				$pic_status = "and b.sec_des = '$pic'";
			}else{
				$pic_status = '';
			}
			
			if (!empty($shift)) {
				$shift_status = "$shift";
			}else{
				$shift_status = 'month';
			}
			
			
			$query = "select distinct(b.sec_des) as sec_des, b.div_des , b.dep_des , a.periode,a.sond, sum(a.sondr) as sondr, sum(a.sonbdr) as sonbdr, 
(sum(a.sondr)-sum(a.sonbdr)) as ondor, a.sofd, sum(a.sofdr) as sofdr, sum(a.sofbdr) as sofbdr, 
(sum(a.sofdr)-sum(a.sofbdr)) as ofdor, ((sum(a.sondr)-sum(a.sonbdr))+(sum(a.sofdr)-sum(a.sofbdr))) as gt from ovt_transaksi a join dp_emp b on a.id = b.id
where b.div_des <> '' AND b.dep_des <> '' AND b.sec_des <> '' AND b.div_des IN ('PRODUCTION & MAINTENANCE','QUALITY CONTROL','R & D & QUALITY CONTROL') 
AND a.periode between '$tgl_awal' and '$tgl_akhir' $pic_status
group by $shift_status(a.periode), b.sec_des order by a.periode desc";
			
			$q = $this->db->query($query);
			$r = $q->num_rows();
			
			if($r>0){
				
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment; filename=ovt_transaksi_".$tgl_awal.'_'.$tgl_akhir.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
			?>
            <p>LAPORAN OVERTIME</p>
            <p><?php echo $this->model_global->tgl_indo($tgl_awal).' - '.$this->model_global->tgl_indo($tgl_akhir);?></p>
            <table border="1">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Periode</td>
                            <td>Divisi</td>
                            <td>Departemen</td>
                            <td>Section</td>
                            <td>Total Lembur (di Off Day)</td>
                            <td>Total Lembur (di On Day)</td>
                            <td>Grand Total</td>
                        </tr>
                    </thead>
                <tbody>
                <?php
				$no=1;
				foreach($q->result() as $dt){
					$tgl = $this->model_global->tgl_indo($dt->periode);
				?>
                <tr>
                    <td><?php echo $no;?></td>  
                    <td><?php echo $tgl;?></td>
                    <td><?php echo $dt->div_des;?></td>
                    <td><?php echo $dt->dep_des;?></td>
                    <td><?php echo $dt->sec_des;?></td>  
                    <td><?php echo $dt->ofdor;?></td>  
                    <td><?php echo $dt->ondor;?></td>
                    <td><?php echo $dt->gt;?></td>                    
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
