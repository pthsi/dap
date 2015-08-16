<script>
            function get_kecamatan(){
                var id_wip = $("#jns_wip").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('c_wip/get_kecamatan2'); ?>", 
                    data:"id_wip="+id_wip, 
                    success: function(msg) {
                            $("#div_kecamatan2").html(msg);
                    }
                });
				
				$.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('c_wip/get_kecamatan1'); ?>", 
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
		var id_wip	= $("#id_wip").val();	
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/c_wip/cari",
			data	: "id_wip="+id_wip,
			dataType: "json",
			success	: function(data){
				$('#tgl_input').val(data.tgl_input);
				$('#pic').val(data.pic);
				$('#shift').val(data.shift);
				$('#jns_wip').val(data.jns_wip);
				$('#lokasi').val(data.lokasi);
				$('#pcs_wip').val(data.pcs_wip);
				$('#target_min').val(data.target_min);
				$('#target').val(data.target);
				$('#akurasi').val(data.akurasi);
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
		
		if(!$("#jns_wip").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Jenis WIP tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#jns_wip").focus();
			return false();
		}
		
		if(!$("#lokasi").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Lokasi tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#lokasi").focus();
			return false();
		}
		
		if(!$("#pcs_wip").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Qty WIP (pcs) tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#pcs_wip").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/c_wip/simpan",
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

  <div style="height:auto">
        <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
            	<input type="hidden" name="id_wip" id="id_wip" value="<?php echo $id_wip;?>" />
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
							$data = $this->model_data->ambil_pic_wip();
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
                    <label class="control-label" for="form-field-1">Jenis WIP Keramik</label>
                    <div class="controls">
                    	<select name="jns_wip" id="jns_wip" onChange="get_kecamatan();" class="span2">
                            <option value=""></option>
                            <?php
                                foreach($kota as $k){
                                    echo "<option value='".$k->id_wip."'>".$k->jns_wip."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Lokasi</label>
                    <div class="controls">
                    	<select name="lokasi" id="lokasi" class="span2">
                        	<option value="">-Pilih-</option>
                            <?php
							$data = $this->model_data->ambil_lokasi();
							foreach($data->result() as $dt){
							?>
                            <option value="<?php echo $dt->lokasi;?>"><?php echo $dt->lokasi;?></option>
                            <?php
							}
							?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Total WIP (pcs)</label>
                    <div class="controls">
                        <input type="text" name="pcs_wip" id="pcs_wip" class="span2"/>
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
                <div class="control-group">
                   <label class="control-label" for="form-field-1">Akurasi WIP (%)</label>
                    <div class="controls">
                        <input type="text" name="akurasi" id="akurasi" class="span2"/>
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
        <a href="<?php echo base_url();?>index.php/c_wip/tambah" name="add" id="add" class="btn btn-small btn-info">
            <i class="icon-check"></i>
            Tambah
        </a>
        <a href="<?php echo base_url();?>index.php/c_wip" class="btn btn-small btn-danger">
            <i class="icon-remove"></i>
            Close
        </a>
        </center>
	</div>
  </div>
</div>    
