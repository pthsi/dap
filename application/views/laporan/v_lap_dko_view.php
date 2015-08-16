<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center span1">No</th>
            <th class="center span2">Tanggal Input</th>
            <th class="center">PIC</th>
            <th class="center">Shift</th>
            <th class="center">Kategori</th>
            <th class="center">Lokasi</th>
            <th class="center">Plan(pcs)</th>
            <th class="center">Aktual(pcs)</th> 
            <th class="center">AR(%)</th>
            <th class="center">Pencapaian(%)</th>
            <th class="center">Status</th>
            <th class="center">Inputer</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
		$tgl_input = $this->model_global->tgl_indo($dt->tgl_input);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center"><?php echo $dt->tgl_input;?></td>
            <td class="center"><?php echo $dt->nama_lengkap;?></td>
            <td class="center"><?php echo $dt->shift;?></td>
            <td class="center"><?php echo $dt->kategori;?></td>
            <td class="center"><?php echo $dt->lokasi;?></td>
            <td class="center"><?php echo number_format($dt->plan, 0, '.', ',');?></td>
            <td class="center"><?php echo number_format($dt->actual, 0, '.', ',');?></td>
            <td class="center"><?php echo $dt->ar;?></td>
            <td class="center"><?php echo $dt->ac;?></td>
            <?php 
			$rencana=$dt->ar;
			$hasil=$dt->ac;
			
			if ($hasil=$rencana && $hasil>$rencana){
					echo "<td class='center' style='background-color:#12FF00'>Tercapai</td>";
			}else{
					echo "<td class='center' style='background-color:#FF0004'>Gagal</td>";}
			
			?>
            <td class="center"><?php echo $dt->inputer;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>