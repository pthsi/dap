<script>
            function get_kecamatan(){
                var kategori = $("#kategori").val();
         			$.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('c_dko/get_kat_dko'); ?>", 
                    data:"kategori="+kategori, 
                    success: function(msg) {
                            $("#div_kecamatan1").html(msg);
                    }
                });
            }

</script>


<script type="text/javascript">
$(document).ready(function(){
	
	$("#plan, #actual").keyup(function(){
				var val1 = parseInt($("#plan").val()*1);
				var val2 = parseInt($("#actual").val()*1);
                $("#ac").val((val2/val1).toFixed(3));
        	});
	
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	cari_data();
	
	function cari_data(){
		var id_dko	= $("#id_dko").val();	
		$.ajax({
			type	: "POST",
			url		: "<?php echo site_url(); ?>/c_dko/cari",
			data	: "id_dko="+id_dko,
			dataType: "json",
			success	: function(data){
				$('#tgl_input').val(data.tgl_input);
				$('#pic').val(data.pic);
				$('#shift').val(data.shift);
				$('#kategori').val(data.kategori);
				$('#lokasi').val(data.lokasi);
				$('#plan').val(data.plan);
				$('#actual').val(data.actual);
				$('#ar').val(data.ar);
				$('#ac').val(data.ac);
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
		
		if(!$("#kategori").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Jenis AR Dekorasi tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#kategori").focus();
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
		
		if(!$("#plan").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Qty Plan tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#plan").focus();
			return false();
		}
		
		if(!$("#actual").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Qty Aktual tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#actual").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/c_dko/simpan",
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
            	<input type="hidden" name="id_dko" id="id_dko" value="<?php echo $id_dko;?>" />
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
							$data = $this->model_data->ambil_dko_pck();
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
                    <label class="control-label" for="form-field-1">Jenis AR Dekorasi</label>
                    <div class="controls">
                    	<select name="kategori" id="kategori" onChange="get_kecamatan();" class="span2">
                            <option value=""></option>
                            <?php
                                foreach($kota as $k){
                                    echo "<option value='".$k->id_wip."'>".$k->cat_target."</option>";
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
                    <label class="control-label" for="form-field-1">Plan (pcs)</label>
                    <div class="controls">
                        <input type="text" name="plan" id="plan" class="span2"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Aktual (pcs)</label>
                    <div class="controls">
                        <input type="text" name="actual" id="actual" class="span2" onChange="get_ac();"/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">AR Target (%)</label>
               	<div id='div_kecamatan1' class="controls">
               	  <input type="text" name="ar" id="ar" class="span2" readonly/>
               	</div>
              </div>
                
                <div class="control-group">
                    <label class="control-label" for="form-field-1">Actual Rate (%)</label>
               	<div id='div_kecamatan2' class="controls">
               	  <input type="text" name="ac" id="ac" class="span2" readonly/>
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
        <a href="<?php echo base_url();?>index.php/c_dko/tambah" name="add" id="add" class="btn btn-small btn-info">
            <i class="icon-check"></i>
            Tambah
        </a>
        <a href="<?php echo base_url();?>index.php/c_dko" class="btn btn-small btn-danger">
            <i class="icon-remove"></i>
            Close
        </a>
        </center>
	</div>
  </div>
</div>    
