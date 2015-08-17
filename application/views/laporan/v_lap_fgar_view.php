<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="font-size:10px">No</th>
            <th style="font-size:10px">Tanggal Input</th>
            <th style="font-size:10px">PIC</th>
            <th style="font-size:10px">Pengiriman</th>
            <th style="font-size:10px">Total (pcs)</th>
            <th style="font-size:10px">Target (Bulanan)</th>
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
            <td style="font-size:10px"><?php echo $i++?></td>
            <td style="font-size:10px"><?php echo $tgl_input;?></td>
            <td style="font-size:10px"><?php echo $dt->nama_lengkap;?></td>
            <td style="font-size:10px"><?php echo $dt->jenis;?></td>
            <td style="font-size:10px; text-align:right" class="center"><?php echo number_format($dt->total,0,'.','.');?> pcs</td>
            <td style="font-size:10px; text-align:right" class="center"><?php echo number_format($dt->target,0,'.','.');?> pcs</td>
            <td style="font-size:10px"><?php echo $dt->inputer;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>