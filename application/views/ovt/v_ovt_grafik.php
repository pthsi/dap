<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
	
<script type="text/javascript">

$(document).ready(function(){$('.date-picker').datepicker().next().on(ace.click_event, function(){$(this).prev().focus();});
	
});
</script>

<script type="text/javascript">
    $(function () {
        $('#containera').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Rekap Lembur Semua Section Produksi'
            },
            subtitle: {
                text: '<?php echo $data_status;?>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jam Lembur (jam)'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Total Lembur: <b>{point.y:.1f} jam</b>'
            },
            series: [{
                name: 'Population',
                data: [
                        
                            <?php 
                            foreach ($chart_all as $key => $x_axis ) : 
                                echo "['".$x_axis->sec_des."',".number_format( $x_axis->gt , 2, '.', '')/60 ."],";
                            endforeach; 
                            ?>
                                             
                ],
                dataLabels: {
                    enabled: true,
                    rotation: -90   ,
                    color: '#FFFFFF',
                    align: 'right',
                    format: '{point.y:.1f}', // one decimal
                    y: -30, // 10 pixels down from the top
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
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
    	 
 <div class="row-fluid">
<form name="my-form" id="my-form" class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/c_grafik_ovt/cari_data">		    <div class="control-group">    
    <label class="control-label">Periode</label>
    <div class="controls">
    <input type="text" name="periode1" id="periode1" class="span2 date-picker"  data-date-format="dd-mm-yyyy"/>
     <span class="add-on">-s/d-</span>
    <input type="text" name="periode2" id="periode2" class="span2 date-picker"  data-date-format="dd-mm-yyyy"/>                           					
    <button type="submit" name="cari" id="cari" class="btn btn-small btn-info"><i class="icon-double-angle-right">FilterData</i></button>
    </div>
    </div>
</form>   
</div>
</div>

<div id="containera" style="float:left; width: 100%; height: 630px; margin: 0 auto"></div>