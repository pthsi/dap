
<div class="row-fluid">
<div class="table-header">
    <?php echo $judul;?> 
    <div class="widget-toolbar no-border pull-right">
    <a href="<?php echo base_url();?>index.php/c_master_target/tambah" class="btn btn-small btn-success"  name="tambah" id="tambah">
        <i class="icon-check"></i>
        Tambah Data
    </a>
    <a href="<?php echo site_url();?>/c_master_target" class="btn btn-small btn-info"  >
        <i class="icon-refresh"`></i>
        Refresh
    </a>
    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">Nama</th>
            <th class="center">Terbit</th>
            <th class="center">Depart.</th>
            <th class="center">Target Min</th>
            <th class="center">Target Max</th>
            <th class="center">Satuan</th>
            <th class="center">Mulai</th>
            <th class="center">Selesai</th>
            <th class="center">PIC</th>
            <th class="center">Keterangan</th>
            <th class="center">Status</th>
            <th class="center">Inputer</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		//$data = $this->model_data->data_mk();
		$i=1;
		foreach($data->result() as $dt){ 
			$period_start = $this->model_global->tgl_str($dt->period_start);
			$period_end= $this->model_global->tgl_str($dt->period_end);
			$time_release= $this->model_global->tgl_str($dt->time_release);
		?>
        <tr>
        	<td class="center" style="font-size:10px"><?php echo $i++?></td>
            <td class="center" style="font-size:10px"><?php echo $dt->jns_wip;?></td>
            <td class="center" style="font-size:10px"><?php echo $time_release;?></td>
            <td class="center" style="font-size:10px"><?php echo $dt->cat_target;?></td>
            <td class="center" style="font-size:10px"><?php echo $dt->target_min;?></td>
            <td class="center" style="font-size:10px"><?php echo $dt->pcs_target;?></td>
            <td class="center" style="font-size:10px"><?php echo $dt->pcs_target_cat;?></td>
            <td class="center" style="font-size:10px"><?php echo $period_start;?></td>
            <td class="center" style="font-size:10px"><?php echo $period_end;?></td>
            <td class="center" style="font-size:10px"><?php echo $dt->nama_lengkap;?></td>
            <td class="center" style="font-size:10px"><?php echo $dt->ket;?></td>
            <td class="center" style="font-size:10px; background-color:<?php 
			$mark=$dt->status;
			if ($mark=='active'){
			echo '#00FF00';
			}else{echo '#FF0000';}
			?>"><?php echo $dt->status;?></td>
            <td class="center" style="font-size:10px"><?php echo $dt->inputer;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="<?php echo site_url();?>/c_master_target/edit/<?php echo $dt->id_wip;?>" >
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/c_master_target/hapus/<?php echo $dt->id_wip;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
                        <i class="icon-trash bigger-130"></i>
                    </a>
                </div>

                <div class="hidden-desktop visible-phone">
                    <div class="inline position-relative">
                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-caret-down icon-only bigger-120"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                            <li>
                                <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                    <span class="green">
                                        <i class="icon-edit bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                    <span class="red">
                                        <i class="icon-trash bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                </center>
            </td>
        </tr>
		<?php } ?>
    </tbody>
</table>
</div>
 