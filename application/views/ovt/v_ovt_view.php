               <?php if ($this->session->flashdata('error') == TRUE): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success') == TRUE): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('anomali') == TRUE): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('anomali'); ?></div>
                <?php endif; ?>
<form method="post" action="<?php echo base_url();?>index.php/c_ovt/importcsv" enctype="multipart/form-data">
                        <input type="file" name="userfile" >
                        <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary">
                    </form>
<div class="row-fluid">
<div class="table-header">
    <?php echo $judul;?> 
    <div class="widget-toolbar no-border pull-right">
    <a href="<?php echo site_url();?>/c_ovt" class="btn btn-small btn-info"  >
        <i class="icon-refresh"`></i>
        Refresh
    </a>
    </div>
</div>

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
    </thead>
    <tbody>
    	<?php 
		//$data = $this->model_data->data_mk();
		$i=1;
		foreach($data->result() as $dt){ 
                    $period = $this->model_global->tgl_ymo($dt->periode);
			?>
        <tr>
            <td class="left" style="font-size:10px"><?php echo $i++?></td>
            <td class="left" style="font-size:10px"><?php echo $period;?></td>
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
</div>
 