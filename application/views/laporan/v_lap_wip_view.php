<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="font-size:10px" class="center">No</th>
            <th style="font-size:10px" class="center">Tanggal Input</th>
            <th style="font-size:10px" class="center">PIC</th>
            <th style="font-size:10px" class="center">Shift</th>
            <th style="font-size:10px" class="center">Jenis WIP</th>
            <th style="font-size:10px" class="center">Lokasi</th>
            <th style="font-size:10px" class="center">Total (pcs)</th>
            <th style="font-size:10px" class="center">Target Min</th>
            <th style="font-size:10px" class="center">Target Max</th>
            <th style="font-size:10px" class="center">Akurasi</th>
            <th style="font-size:10px" class="center">Inputer</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
		$tgl_input = $this->model_global->tgl_indo($dt->tgl_input);
		?>
        <tr>
            <td style="font-size:10px" class="center"><?php echo $i++?></td>
            <td style="font-size:10px" class="center"><?php echo $tgl_input;?></td>
            <td style="font-size:10px" class="center"><?php echo $dt->nama_lengkap;?></td>
            <td style="font-size:10px" class="center"><?php echo $dt->shift;?></td>
            <td style="font-size:10px" class="center"><?php echo $dt->jns_wip;?></td>
            <td style="font-size:10px" class="center"><?php echo $dt->lokasi;?></td>
            <td style="text-align:right; font-size:10px" class="center"><?php echo number_format($dt->pcs_wip, 0, '.', ',');?> pcs</td>
            <td style="text-align:right; font-size:10px" class="center"><?php echo number_format($dt->target_min, 0, '.', ',');?> pcs</td>
            <td style="text-align:right; font-size:10px" class="center"><?php echo number_format($dt->target, 0, '.', ',');?> pcs</td>
            <td style="text-align:right; font-size:10px" class="center"><?php echo number_format($dt->akurasi, 0, '.', ',');?> %</td>
            <td style="font-size:10px" class="center"><?php echo $dt->inputer;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>