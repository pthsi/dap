<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center" style="font-size:10px">No</th>
            <th class="center" style="font-size:10px">Periode</th>
            <th class="center" style="font-size:10px">Divisi</th>
            <th class="center" style="font-size:10px">Departemen</th>
            <th class="center" style="font-size:10px">Section</th>
            <th class="center" style="font-size:10px">Total Lembur (di Off Day)</th>
            <th class="center" style="font-size:10px">Total Lembur (di On Day)</th>
            <th class="center" style="font-size:10px">Grand Total</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		$i=1;
		foreach($data->result() as $dt){ 
		$tperiode = $this->model_global->tgl_indo($dt->periode);
		?>
        <tr>
            <td class="left" style="font-size:10px"><?php echo $i++?></td>
            <td class="left" style="font-size:10px"><?php echo $tperiode;?></td>
            <td class="left" style="font-size:8px"><?php echo $dt->div_des;?></td>
            <td class="left" style="font-size:8px"><?php echo $dt->dep_des;?></td>
            <td class="left" style="font-size:8px"><?php echo $dt->sec_des;?></td>
            <td class="center" style="font-size:10px"><?php echo number_format($dt->ofdor/60,2,'.',',');?> (jam)</td>
            <td class="center" style="font-size:10px"><?php echo number_format($dt->ondor/60,2,'.',',');?> (jam)</td>
            <td class="center" style="font-size:10px"><?php echo number_format($dt->gt/60,2,'.',',');?> (jam)</td>
        </tr>
		<?php } ?>
    </tbody>
</table>