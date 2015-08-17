<div class="row-fluid">
<div class="table-header">
    <?php echo $judul;?> 
    <div class="widget-toolbar no-border pull-right">
    <a href="<?php echo base_url();?>index.php/c_fg/tambah" class="btn btn-small btn-success"  name="tambah" id="tambah">
        <i class="icon-check"></i>
        Tambah Data
    </a>
    <a href="<?php echo site_url();?>/c_fg" class="btn btn-small btn-info"  >
        <i class="icon-refresh"`></i>
        Refresh
    </a>
    </div>
</div>

<table  class="table fpTable lcnp table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="center">No</th>
            <th class="center">Tanggal Input</th>
            <th class="center">PIC</th>
            <th class="center">Shift</th>
            <th class="center">Pengiriman</th>
            <th class="center">Item (pcs)</th>
            <th class="center">Karton (pcs)</th>
            <th class="center">Inputer</th>
            <th class="center">Aksi</th>
        </tr>
    </thead>
    <tbody>
    	<?php 
		//$data = $this->model_data->data_mk();
		$i=1;
		foreach($data->result() as $dt){ 
			$tgl = $this->model_global->tgl_indo($dt->tgl_input);
		?>
        <tr>
        	<td class="center span1"><?php echo $i++?></td>
            <td class="center span2"><?php echo $dt->tgl_input;?></td>
            <td class="center"><?php echo $dt->nama_lengkap;?></td>
            <td class="center"><?php echo $dt->shift;?></td>
            <td class="center"><?php echo $dt->pengiriman;?></td>
            <td class="center"><?php echo $dt->pcs_item;?></td>
            <td class="center"><?php echo $dt->pcs_karton;?></td>
            <td class="center"><?php echo $dt->inputer;?></td>
            <td class="td-actions"><center>
            	<div class="hidden-phone visible-desktop action-buttons">
                    <a class="green" href="<?php echo site_url();?>/c_fg/edit/<?php echo $dt->id_fg;?>" >
                        <i class="icon-pencil bigger-130"></i>
                    </a>

                    <a class="red" href="<?php echo site_url();?>/c_fg/hapus/<?php echo $dt->id_fg;?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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
 