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
			url		: "<?php echo site_url(); ?>/c_glz/cari",
			data	: "id_fg="+id_fg,
			dataType: "json",
			success	: function(data){
				$('#tgl_input').val(data.tgl_input);
				$('#pic').val(data.pic);
				$('#jenis').val(data.jenis);
				$('#plan').val(data.plan);
				$('#aktual').val(data.aktual);
			}
		});
		
	}
		
	$("#simpan").click(function(){
		
		var string = $("#my-form").serialize();
		
                if(!$("#tgl_input").val()){
				$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal Input tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#tgl_input").focus();
			return false();
		}
		
		if(!$("#pic").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Planner tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#pic").focus();
			return false();
		}
		
		if(!$("#jenis").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Jenis Cetak tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#jenis").focus();
			return false();
		}
		
		if(!$("#plan").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Plan (pcs) tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#plan").focus();
			return false();
		}
		
		if(!$("#aktual").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Aktual (pcs) tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#aktual").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/c_glz/simpan",
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
                            <input type="text" name="tgl_input" id="tgl_input" class="span7 date-picker"  data-date-format="dd-mm-yyyy" value=""/>
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
							$data = $this->model_data->picGl();
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
                    <label class="control-label" for="form-field-1">Jenis Cetak</label>
                    <div class="controls">
                    	<select name="jenis" id="jenis" class="span2">
                           <option value="">-Pilih-</option>
                           <option value="dipping">Dipping</option>
                           <option value="konveyer">Konveyer</option>
                           <option value="mesin">Mesin</option>
                           <option value="spray">Spray</option>
                           <option value="waterfall">Waterfall</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Total (pcs)</label>
                    <div class="controls">
                        <input type="text" name="plan" id="plan" class="span2"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Aktual (pcs)</label>
               	<div class="controls">
               	  <input type="text" name="aktual" id="aktual" class="span2"/>
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
        <a href="<?php echo base_url();?>index.php/c_glz/tambah" name="add" id="add" class="btn btn-small btn-info">
            <i class="icon-check"></i>
            Tambah
        </a>
        <a href="<?php echo base_url();?>index.php/c_glz" class="btn btn-small btn-danger">
            <i class="icon-remove"></i>
            Close
        </a>
        </center>
	</div>
    </div>
</div>    
