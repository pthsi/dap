<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="font-size:10px">No</th>
            <th style="font-size:10px">Tanggal Input</th>
            <th style="font-size:10px">PIC</th>
            <th style="font-size:10px">Shift</th>
            <th style="font-size:10px">Kategori</th>
            <th style="font-size:10px">Lokasi</th>
            <th style="font-size:10px">Plan(pcs)</th>
            <th style="font-size:10px">Aktual(pcs)</th> 
            <th style="font-size:10px">Target AR(%)</th>
            <th style="font-size:10px">AR(%)</th>
            <th style="font-size:10px">Status</th>
            <th style="font-size:10px">Inputer</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
		$tgl_input = $this->model_global->tgl_indo($dt->tgl_input);
		?>
        <tr>
            <td style="font-size:10px"><?php echo $i++;?></td>
            <td style="font-size:10px"><?php echo $tgl_input;?></td>
            <td style="font-size:10px"><?php echo $dt->nama_lengkap;?></td>
            <td style="font-size:10px"><?php echo $dt->shift;?></td>
            <td style="font-size:10px"><?php echo $dt->kategori;?></td>
            <td style="font-size:10px"><?php echo $dt->lokasi;?></td>
            <td style="font-size:10px; text-align:right" class="center"><?php echo number_format($dt->plan, 0, '.', ',');?> pcs</td>
            <td style="font-size:10px; text-align:right" class="center"><?php echo number_format($dt->actual, 0, '.', ',');?> pcs</td>
            <td style="font-size:10px; text-align:right" class="center"><?php echo $dt->ar;?> %</td>
            <td style="font-size:10px; text-align:right" class="center"><?php echo $dt->ac;?> %</td>
            <?php 
			$rencana=$dt->ar;
			$hasil=$dt->ac;
			
			if ($hasil=$rencana && $hasil>$rencana){
					echo "<td class='center' style='color:#12FF00; font-size:10px'>Tercapai</td>";
			}else{
					echo "<td class='center' style='color:#FF0004; font-size:10px'>Gagal</td>";}
			
			?>
            <td style="font-size:10px"><?php echo $dt->inputer;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>