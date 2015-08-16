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
			url		: "<?php echo site_url(); ?>/c_master_target/cari",
			data	: "id_wip="+id_wip,
			dataType: "json",
			success	: function(data){
				$('#jns_wip').val(data.jns_wip);
				$('#time_release').val(data.time_release);
				$('#cat_target').val(data.cat_target);
				$('#target_min').val(data.target_min);
				$('#pcs_target').val(data.pcs_target);
				$('#pcs_target_cat').val(data.pcs_target_cat);
				$('#period_start').val(data.period_start);
				$('#period_end').val(data.period_end);
				$('#pic').val(data.pic);
				$('#ket').val(data.ket);
				$('#status').val(data.status);
					
			}
		});
		
	}
		
	$("#simpan").click(function(){
		
		var string = $("#my-form").serialize();
		
		
		if(!$("#jns_wip").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Nama target tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#jns_wip").focus();
			return false();
		}
		
		if(!$("#time_release").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Waktu terbit  tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#time_release").focus();
			return false();
		}
		
		if(!$("#cat_target").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Kategori tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#cat_target").focus();
			return false();
		}
		
		
		if(!$("#pcs_target").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Target maximum tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#pcs_target").focus();
			return false();
		}
		
		if(!$("#pcs_target_cat").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Nama due date tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#pcs_target_cat").focus();
			return false();
		}
		
		if(!$("#period_start").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Waktu mulai tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#period_start").focus();
			return false();
		}
		
		if(!$("#period_end").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Waktu selesai tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#period_end").focus();
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
		
		if(!$("#status").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Status tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#status").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/c_master_target/simpan",
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
                    <label class="control-label" for="form-field-1">Nama Target / Budget</label>
                    <div class="controls">
                        <input type="text" name="jns_wip" id="jns_wip" class="span3"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Waktu Terbit</label>
                    <div class="controls">
                    	<div class="input-append">
                            <input type="text" name="time_release" id="time_release" class="span25 date-picker"  data-date-format="dd-mm-yyyy"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Departemen</label>
                    <div class="controls">
                        <input type="text" name="cat_target" id="cat_target" class="span3"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Target minimum  </label>                  
<div class="controls">
                        <input type="text" name="target_min" id="target_min" class="span3"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Target maximum </label>                   
<div class="controls">
                        <input type="text" name="pcs_target" id="pcs_target" class="span3"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Satuan</label>
                    <div class="controls">
                        <input type="text" name="pcs_target_cat" id="pcs_target_cat" class="span3"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Waktu Mulai berlaku</label>
                    <div class="controls">
                    	<div class="input-append">
                            <input type="text" name="period_start" id="period_start" class="span25 date-picker"  data-date-format="dd-mm-yyyy"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Waktu Selesai berlaku</label>
                    <div class="controls">
                    	<div class="input-append">
                            <input type="text" name="period_end" id="period_end" class="span25 date-picker"  data-date-format="dd-mm-yyyy"/>
                        <span class="add-on">
                            <i class="icon-calendar"></i>
                        </span>
                        </div>
                    </div>
                </div>
               <div class="control-group">
                    <label class="control-label" for="form-field-1">PIC</label>
                    <div class="controls">
                    	<select name="pic" id="pic" class="span3">
                        	<option value="">-Pilih-</option>
                            <?php
							$data = $this->model_data->ambil_pic_all();
							foreach($data->result() as $dt){
							?>
                            <option value="<?php echo $dt->username;?>"><?php echo $dt->nama_lengkap;?>-<?php echo $dt->department;?></option>
                            <?php
							}
							?>
                        </select>
                    </div>
                </div>
                 <div class="control-group">
                    <label class="control-label" for="form-field-1">Keterangan</label>
                    <div class="controls">
                        <input type="text" name="ket" id="ket" class="span3"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Status</label>
                    <div class="controls">
                    	<select name="status" id="status" class="span3">
                        	<option value="">-Pilih-</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                  		</select>
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
        <a href="<?php echo base_url();?>index.php/c_master_target/tambah" name="add" id="add" class="btn btn-small btn-info">
            <i class="icon-check"></i>
            Tambah
        </a>
        <a href="<?php echo base_url();?>index.php/c_master_target" class="btn btn-small btn-danger">
            <i class="icon-remove"></i>
            Close
        </a>
        </center>
	</div>
  </div>
</div>    
