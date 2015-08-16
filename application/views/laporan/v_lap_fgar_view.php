<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center span1">No</th>
            <th class="center span2">Tanggal Input</th>
            <th class="center">PIC</th>
            <th class="center">Pengiriman</th>
            <th class="center">Total (pcs)</th>
            <th class="center">Target (Bulanan)</th>
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
            <td class="center"><?php echo $dt->jenis;?></td>
            <td style="text-align:right" class="center"><?php echo number_format($dt->total,0,'.','.');?></td>
            <td style="text-align:right" class="center"><?php echo number_format($dt->target,0,'.','.');?></td>
            <td class="center"><?php echo $dt->inputer;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>