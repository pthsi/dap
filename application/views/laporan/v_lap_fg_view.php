<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center span1">No</th>
            <th class="center span2">Tanggal Input</th>
            <th class="center">PIC</th>
            <th class="center">Shift</th>
            <th class="center">Pengiriman</th>
            <th class="center">Item (pcs)</th>
            <th class="center">Karton (pcs)</th>
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
            <td class="center"><?php echo $dt->pengiriman;?></td>
            <td class="center"><?php echo $dt->pcs_item;?></td>
            <td class="center"><?php echo $dt->pcs_karton;?></td>
            <td class="center"><?php echo $dt->inputer;?></td>
        </tr>
		<?php } ?>
    </tbody>
</table>