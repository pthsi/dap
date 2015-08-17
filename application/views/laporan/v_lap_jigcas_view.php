<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="font-size:10px" class="center">No</th>
            <th style="font-size:10px" class="center">Tanggal Cetak</th>
            <th style="font-size:10px" class="center">Planner</th>
            <th style="font-size:10px" class="center">Jenis Cetak</th>
            <th style="font-size:10px" class="center">Plan (pcs)</th>
            <th style="font-size:10px" class="center">Aktual (pcs)</th>
            <th style="font-size:10px" class="center">AR (%)</th>
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
            <td style="font-size:10px" class="center"><?php echo $dt->jenis;?></td>
            <td style="text-align:right; font-size:10px" class="center"><?php echo number_format($dt->plan,0,'.','.');?> pcs</td>
            <td style="text-align:right; font-size:10px" class="center"><?php echo number_format($dt->aktual,0,'.','.');?> pcs</td>
            <td style="text-align:right; font-size:10px" class="center"><?php echo number_format($dt->ar,2,'.','.');?> %</td>
            <td style="font-size:10px" class="center"><?php echo $dt->inputer;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>