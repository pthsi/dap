<script type="text/javascript">

$(document).ready(function(){
	$('.date-picker').datepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
	$("#view").click(function(){
		cari_data();
	});
	
	function cari_data(){
		var string = $("#my-form").serialize();

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/c_lap_ovt/cari_data",
			data	: string,
			cache	: false,
			success	: function(data){
				$("#view_detail").html(data);
			}
		});
	}
	
	$("#cetak_pdf").click(function(){
		var string = $("#my-form").serialize();
		
		if(!$("#periode1").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal awal tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#periode1").focus();
			return false();
		}
		
		if(!$("#periode2").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal akhir tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#periode2").focus();
			return false();
		}

		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/c_lap_ovt/cetak_pdf",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>/c_lap_ovt/print_pdf");
				}else{
					$.gritter.add({
						title: 'Peringatan..!!',
						text: data,
						class_name: 'gritter-error' 
					});
				}
			}
		});
	});
	
	$("#cetak_excel").click(function(){
		var string = $("#my-form").serialize();
		
		if(!$("#periode1").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal awal tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#periode1").focus();
			return false();
		}
		
		if(!$("#periode2").val()){
			$.gritter.add({
				title: 'Peringatan..!!',
				text: 'Tanggal akhir tidak boleh kosong',
				class_name: 'gritter-error' 
			});
			$("#periode2").focus();
			return false();
		}
		
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/c_lap_ovt/cetak_pdf",
			data	: string,
			cache	: false,
			success	: function(data){
				if(data=='Sukses'){
					window.location.assign("<?php echo site_url();?>/c_lap_ovt/print_excel");
				}else{
					$.gritter.add({
						title: 'Peringatan..!!',
						text: data,
						class_name: 'gritter-error' 
					});
				}
			}
		});
	});
	
	
});
</script>

<div class="widget-box ">
    <div class="widget-header">
        <h4 class="lighter smaller">
            <i class="icon-book blue"></i>
            <?php echo $judul;?>
        </h4>
    </div>

    <div class="widget-body">
    	<div class="widget-main">
            <div class="row-fluid">
            <form class="form-horizontal" name="my-form" id="my-form">
                    <div class="control-group">
                        
                          <div class="input-append">
                          		<span class="add-on">
                                    Periode
                                </span>
                                <input type="text" name="periode1" id="periode1" class="span2 date-picker"  data-date-format="dd-mm-yyyy"/>
                                <span class="add-on">
                                    <i class="icon-calendar"></i>
                                </span>
                               <span class="add-on">
                                    -s/d-
                                </span> 
                                <input type="text" name="periode2" id="periode2" class="span2 date-picker"  data-date-format="dd-mm-yyyy"/>
                                <span class="add-on">
                                    <i class="icon-calendar"></i>
                                </span>
                                 <span class="add-on">
                                    Section
                                </span>
                                <select name="pic" id="pic" class="span2"><option value="">All</option>
                                    <?php
                                    $data = $this->model_data->ambil_section();
                                    foreach($data->result() as $dt){
                                    ?>
                                    <option value="<?php echo $dt->sec_des;?>"><?php echo $dt->sec_des;?></option>
                                    <?php
                                    }
                                    ?>
                            	</select>
                           					<span class="add-on">
                                    Grouping Waktu
                                </span>
                                <select name="shift" id="shift" class="span2">
                                    <option value="day">Harian</option>
                                    <option value="week">Mingguan</option>
                                    <option value="month">Bulanan</option>
                                    <option value="year">Tahunan</option>
                                </select>
                    	</div>
                    </div>
            <div class="alert alert-success"> 
            <center>                                     
                     <button type="button" name="view" id="view" class="btn btn-mini btn-info">
                     <i class="icon-th"></i> Lihat Data
                     </button>
                     <button type="button" name="cetak_pdf" id="cetak_pdf" class="btn btn-mini btn-primary">
                     <i class="icon-print"></i> Cetak PDF
                     </button>
                     <button type="button" name="cetak_excel" id="cetak_excel" class="btn btn-mini btn-success">
                     <i class="icon-print"></i> Cetak EXCEL
                     </button>
           </center>       
           </div>
           </form>   
        </div> <!-- wg body -->
    </div> <!--wg-main-->
</div>    
<div id="view_detail"></div>