<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/modules/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/themes/skies.js'); ?>"></script>	
<script type="text/javascript">

$(document).ready(function(){$('.date-picker').datepicker().next().on(ace.click_event, function(){$(this).prev().focus();});
	
});
</script>

<script type="text/javascript">

$(function () {
    var chart;
    $(document).ready(function() {
		
//==========================================================
		chart = new Highcharts.Chart({
            chart: {
                renderTo: 'containera',
                type: 'line',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Grafik AR Packing Ekspor',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
            },
            subtitle: {
                text: '<?php echo $data_status;?>'
            },
            xAxis: {
                categories: [
								<?php 
								foreach ($chart_all as $key => $x_axis ) : 
									echo "'".$x_axis->kategori."',";
								endforeach; 
                				?>
				],
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Persentase',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
					formatter: function() {
						var s = '<b>'+ this.x +'</b>',
							sum = 0;
				
						$.each(this.points, function(i, point) {
							s += '<br/>'+ point.series.name +': '+
								point.y +' %';
							sum += point.y;
						});
				
						
				
						return s;
					},
					shared: true
				},
				legend: {
					enabled: true,
					layout: 'horizontal',
					align: 'center',
					verticalAlign: 'bottom',
					borderWidth: 0				
				},
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true,
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Pencapaian AR',
                data: [
						<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->ac , 4, '.', '')*100 .",";
						endforeach; 
                ?>
				],
				color: '#4572A7'
            },
			{
                name: 'Target AR',
                data: [
						<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->ar , 4, '.', '')*100 .",";
						endforeach; 
                ?>
				],
				color: '#00CC00'
            },{
                name: 'Rerata Pencapaian AR',
                data: [
						<?php 
						foreach ($chart_all as $key => $series ) : 
							echo number_format( $series->rerata , 4, '.', '')*100 .",";
						endforeach; 
                ?>
				],
				color: '#FF0000'
            }
			]
			
        });
//======================================================================================
			
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
<form name="my-form" id="my-form" class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/c_grafik_pck/cari_data">		    <div class="control-group">    
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

<div id="containera" style="float:left; width: 100%; height: 330px; margin: 0 auto"></div>