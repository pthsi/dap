<div class="row-fluid">
    <div class="span12">
        <!--PAGE CONTENT BEGINS-->

        <div class="alert alert-block alert-success">
            
            <i class="icon-ok green"></i>

            Selamat datang di 
            <strong class="green">
                Aplikasi <?php echo $this->config->item('nama_aplikasi');?>
                <small>(v1.0.0)</small>
            </strong>
            ,
            <?php echo $this->config->item('nama_pendek');?> - <?php echo $this->config->item('nama_instansi');?>
        </div>
</div>                            
</div>

<table width="1145" height="450" border="0">
  <tr>
    <td width="380" height="450" style="background-color:#0C3">
    	<div style="width:380; height:450">OVER TIME</div>
    </td>
    <td width="380" height="450" style="background-color:#666">
    	<div style="width:380; height:450">WIP KERAMIK</div>
    </td>
    <td width="380" height="450">
   	  <table width="385" height="150" border="0">
    	  <tr>
    	    <td width="385" height="150">
            	<table width="385" height="150">
                <thead>
                  	<tr>
                    	<td colspan="6" style="background-color:#0F0; border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center"><strong>PENCAPAIAN DEKORASI</strong></div></td>
                  	</tr>
              	</thead>
                  <tr>
                    <td colspan="3" style="border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center">BULAN LALU</div></td>
                    <td colspan="3" style="border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center">BULAN INI</div></td>
                  </tr>
             	<tbody>     
                  <tr>
                    <td style="border-left: 1px solid #060;">AR</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">
						<?php 
							foreach ($db_dko as $key => $series ) : 
								echo number_format( $series->ar_lm , 4, '.', '')*100 ."";
							endforeach; 
                		?> %</td>
                    <td>AR</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">
                    	<?php 
							foreach ($db_dko as $key => $series ) : 
								echo number_format( $series->ar_tm , 4, '.', '')*100 ."";
							endforeach; 
                		?> %</td>
                  </tr>
                  <tr>
                    <td style="border-left: 1px solid #060;">Raihan</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">
                    	<?php 
							foreach ($db_dko as $key => $series ) : 
								echo number_format( $series->ac_lm , 4, '.', ',')*100 ."";
							endforeach; 
                		?>
                     %</td>
                    <td>Raihan</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">
                    	<?php 
							foreach ($db_dko as $key => $series ) : 
								echo number_format( $series->ac_tm , 4, '.', ',')*100 ."";
							endforeach; 
                		?>
                     %</td>
                  </tr>
                  <tr>
                    <td style="border-left: 1px solid #060;">Status</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">closed</td>
                    <td>Status</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">running</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #060; border-left: 1px solid #060;">Target</td>
                    <td style="border-bottom: 1px solid #060;">:</td>
                    <td style="border-right: 1px solid #060; border-bottom: 1px solid #060;">
                    	<?php 
							foreach ($db_dko as $key => $series ) : 
								$xac_lm=$series->ac_lm;
								$xac_tm=$series->ac_tm;
								$xar_lm=$series->ar_lm;
								$xar_tm=$series->ar_tm;
								if ($xac_lm<$xar_lm)
								{echo '<font color="red">gagal</font>';}
								else{echo '<font color="green">tercapai</font>';}
							endforeach;
						?>
                    </td>
                    <td style="border-bottom: 1px solid #060;">Target</td>
                    <td style="border-bottom: 1px solid #060;">:</td>
                    <td style="border-right: 1px solid #060; border-bottom: 1px solid #060;">
                    	<?php 
							foreach ($db_dko as $key => $series ) : 
								$xac_lm=$series->ac_lm;
								$xac_tm=$series->ac_tm;
								$xar_lm=$series->ar_lm;
								$xar_tm=$series->ar_tm;
								if ($xac_tm<$xar_tm)
								{echo '<font color="red">gagal</font>';}
								else{echo '<font color="green">tercapai</font>';}
							endforeach;
						?>
                    </td>
                  </tr>
            	</tbody>
                </table>
            </td>
  	    </tr>
    	  <tr>
    	    <td width="385" height="150">
            	<table width="385" height="150" border="0">
    	  <tr>
    	    <td width="385" height="150">
            	<table width="385" height="150">
                <thead>
                  	<tr>
                    	<td colspan="6" style="background-color:#CC0; border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center"><strong>PENCAPAIAN FINISH GOOD</strong></div></td>
                  	</tr>
              	</thead>
                  <tr>
                    <td colspan="3" style="border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center">BULAN LALU</div></td>
                    <td colspan="3" style="border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center">BULAN INI</div></td>
                  </tr>
             	<tbody>
                  <tr>
                    <td style="border-left: 1px solid #060;">Stok range</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">belum ada data</td>
                    <td>Stok range</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">belum ada data</td>
                  </tr>
                  <tr>
                    <td style="border-left: 1px solid #060;">Rerata stok</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">belum ada data</td>
                    <td style="border-left: 1px solid #060;">Rerata stok</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">belum ada data</td>
                  </tr>
                  <tr>
                    <td style="border-left: 1px solid #060;">Status</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">belum ada data</td>
                    <td>Status</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">belum ada data</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #060; border-left: 1px solid #060;">Target</td>
                    <td style="border-bottom: 1px solid #060;">:</td>
                    <td style="border-right: 1px solid #060; border-bottom: 1px solid #060;">belum ada data</td>
                    <td style="border-bottom: 1px solid #060;">Target</td>
                    <td style="border-bottom: 1px solid #060;">:</td>
                    <td style="border-right: 1px solid #060; border-bottom: 1px solid #060;">belum ada data</td>
                  </tr>
            	</tbody>
                </table>
            </td>
  	    </tr>
    	  <tr>
    	    <td width="385" height="150">
            	<table width="385" height="150">
                <thead>
                  	<tr>
                    	<td colspan="6" style="background-color:#0FF; border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center"><strong>PENCAPAIAN PACKING</strong></div></td>
                  	</tr>
              	</thead>
                  <tr>
                    <td colspan="3" style="border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center">BULAN LALU</div></td>
                    <td colspan="3" style="border-right: 1px solid #060; border-left: 1px solid #060; border-top: 1px solid #060; border-bottom: 1px solid #060;"><div align="center">BULAN INI</div></td>
                  </tr>
             	<tbody>     
                  <tr>
                    <td style="border-left: 1px solid #060;">AR</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">
                    	<?php 
							foreach ($db_pck as $key => $series ) : 
								echo number_format( $series->ar_lm , 4, '.', ',')*100 ."";
							endforeach; 
                		?>
                     %</td>
                    <td>AR</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">
                    	<?php 
							foreach ($db_pck as $key => $series ) : 
								echo number_format( $series->ar_tm , 4, '.', ',')*100 ."";
							endforeach; 
                		?>
                     %</td>
                  </tr>
                  <tr>
                    <td style="border-left: 1px solid #060;">Raihan</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">
                    	<?php 
							foreach ($db_pck as $key => $series ) : 
								echo number_format( $series->ac_lm , 4, '.', ',')*100 ."";
							endforeach; 
                		?>
                     %</td>
                    <td>Raihan</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">
                    	<?php 
							foreach ($db_pck as $key => $series ) : 
								echo number_format( $series->ac_tm , 4, '.', ',')*100 ."";
							endforeach; 
                		?>
                     %</td>
                  </tr>
                  <tr>
                    <td style="border-left: 1px solid #060;">Status</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">closed</td>
                    <td>Status</td>
                    <td>:</td>
                    <td style="border-right: 1px solid #060;">running</td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px solid #060; border-left: 1px solid #060;">Target</td>
                    <td style="border-bottom: 1px solid #060;">:</td>
                    <td style="border-right: 1px solid #060; border-bottom: 1px solid #060;">
                    	<?php 
							foreach ($db_pck as $key => $series ) : 
								$xac_lm=$series->ac_lm;
								$xac_tm=$series->ac_tm;
								$xar_lm=$series->ar_lm;
								$xar_tm=$series->ar_tm;
								if ($xac_lm<$xar_lm)
								{echo '<font color="red">gagal</font>';}
								else{echo '<font color="green">tercapai</font>';}
							endforeach;
						?>
                    </td>
                    <td style="border-bottom: 1px solid #060;">Target</td>
                    <td style="border-bottom: 1px solid #060;">:</td>
                    <td style="border-right: 1px solid #060; border-bottom: 1px solid #060;">
                    	<?php 
							foreach ($db_pck as $key => $series ) : 
								$xac_lm=$series->ac_lm;
								$xac_tm=$series->ac_tm;
								$xar_lm=$series->ar_lm;
								$xar_tm=$series->ar_tm;
								if ($xac_tm<$xar_tm)
								{echo '<font color="red">gagal</font>';}
								else{echo '<font color="green">tercapai</font>';}
							endforeach;
						?>
                    </td>
                  </tr>
            	</tbody>
                </table>
            </td>
  </tr>
</table>
