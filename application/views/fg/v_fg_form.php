<script>
            function get_kecamatan(){
                var id_wip = $("#pengiriman").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('c_fg/get_kecamatan2'); ?>", 
                    data:"id_wip="+id_wip, 
                    success: function(msg) {
                            $("#div_kecamatan2").html(msg);
                    }
                });
				
				$.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('c_fg/get_kecamatan1'); ?>", 
                    data:"id_wip="+id_wip, 
                    success: function(msg) {
                            $("#div_kecamatan1").html(msg);
                    }
                });
			
            }
</script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	cari_data();
	
	function cari_data(){
		var id_fg	= $("#id_fg").val();	
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/c_fg/cari",
			data	: "id_fg="+id_fg,
			dataType: "json",
			success	: function(data){
				$('#tgl_input').val(data.tgl_input);
				$('#pic').val(data.pic);
				$('#shift').val(data.shift);
				$('#pengiriman').val(data.pengiriman);
				$('#pcs_item').val(data.pcs_item);
				$('#pcs_karton').val(data.pcs_karton);
                                $('#target_min').val(data.t_min);
				$('#target').val(data.t_max);
			}
		});
		
	}
		
	$("#simpan").click(function(){
		
		var string = $("#my-form").serialize();
		
		
		if(!$("#shift").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Shift tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#shift").focus();
			return false();
		}
		
		if(!$("#pic").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'PIC tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#pic").focus();
			return false();
		}
		
		
		if(!$("#tgl_input").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#tgl_input").focus();
			return false();
		}
		
		if(!$("#pengiriman").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Pengiriman tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#pengiriman").focus();
			return false();
		}
		
		if(!$("#pcs_item").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Qty by item (pcs) tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#pcs_item").focus();
			return false();
		}
		
		if(!$("#pcs_karton").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Qty by karton (pcs) tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#pcs_karton").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/c_fg/simpan",
			data	: string,
			cache	: false,
			success	: function(data){
				$.gritter.add({
					title: 'Peringatan..!!',
					text: data,
					class_name: 'gritter-success' 
				});
			}
		});
		
	});
	

});


</script>
<div class="row-fluid">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php echo $judul;?>
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
            	<input type="hidden" name="id_fg" id="id_fg" value="<?php echo $id_fg;?>" />
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Tanggal Input</label>

                    <div class="controls">
                    	<div class="input-append">
                            <input type="text" name="tgl_input" id="tgl_input" class="span7 date-picker"  data-date-format="dd-mm-yyyy"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                        </div>
                    </div>
                </div>
               <div class="control-group">
                    <label class="control-label" for="form-field-1">PIC</label>
                    <div class="controls">
                    	<select name="pic" id="pic" class="span2">
                        	<option value="">-Pilih-</option>
                            <?php
							$data = $this->model_data->ambil_pic_fg();
							foreach($data->result() as $dt){
							?>
                            <option value="<?php echo $dt->username;?>"><?php echo $dt->nama_lengkap;?></option>
                            <?php
							}
							?>
                        </select>
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Shift</label>
                    <div class="controls">
                    	<select name="shift" id="shift" class="span2">
                        	<option value="">-Pilih-</option>
                            <?php
							$data = $this->model_data->ambil_shift();
							foreach($data->result() as $dt){
							?>
                            <option value="<?php echo $dt->shift;?>"><?php echo $dt->shift;?></option>
                            <?php
							}
							?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Pengiriman</label>
                    <div class="controls">
                    	<select name="pengiriman" id="pengiriman" class="span2" onChange="get_kecamatan();">
                            <?php
                                foreach($kota as $k){
                                    echo "<option value='".$k->id_wip."'>".$k->cat_target."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Qty by item (pcs)</label>
                    <div class="controls">
                        <input type="text" name="pcs_item" id="pcs_item" class="span2"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Qty by karton (pcs)</label>
                    <div class="controls">
                        <input type="text" name="pcs_karton" id="pcs_karton" class="span2"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Batas Bawah Stok (pcs)</label>
               	<div id='div_kecamatan1' class="controls">
               	  <input type="text" name="target_min" id="target_min" class="span2" readonly/>
               	</div>
              	</div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Batas Atas Stok (pcs)</label>
               	<div id='div_kecamatan2' class="controls">
               	  <input type="text" name="target" id="target" class="span2" readonly/>
               	</div>
              	</div>
			</form>                
        </div>
    </div>

    <div class="modal-footer">
        <div class="pagination no-margin">
        <center>
        <button type="button" name="simpan" id="simpan" class="btn btn-small btn-success">
            <i class="icon-save"></i>
            Simpan
        </button>
        <a href="<?php echo base_url();?>index.php/c_fg/tambah" name="add" id="add" class="btn btn-small btn-info">
            <i class="icon-check"></i>
            Tambah
        </a>
        <a href="<?php echo base_url();?>index.php/c_fg" class="btn btn-small btn-danger">
            <i class="icon-remove"></i>
            Close
        </a>
        </center>
		</div>
    </div>
</div>    
